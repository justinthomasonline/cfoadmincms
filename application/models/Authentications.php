<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentications extends CI_Model {

 /*function Createuser($table,$insert)
   {
       $this->db->insert($table,$insert);
       if($this->db->affected_rows()==1)
       {
      
       
       $users=array(
          'UserName'=>$_POST['username'],
          'Password'=>  md5($_POST['password']),
           'Role'=>'2',
           'AgencyId'=>$this->session->userdata('auth')['agencyid'],
           'UserInfoId'=>$this->db->insert_id()
       );
       
      $this->db->insert('users',$users);
       
       return true;
       }  else {
       return false;    
       }
   }*/


   function Login()
   {
         $username = $this->security->xss_clean($this->input->post('username'));
         $password = $this->security->xss_clean($this->input->post('password'));
 
         // Prep the query
         $this->db->where('userName', $username);
         $this->db->where('password', md5($password));
 
         // Run the query
         $query = $this->db->get('users');
         // Let's check if there are any results
        
        
          
         if($this->db->affected_rows() == 1)
         {
             // If there is a user, then create session data
             $this->session->set_userdata('login',TRUE);
             $row = $query->row();
             $data = array(
                     'userid' => $row->id,
                     'username' => $row->userName,
                     'role'=>$row->role,
                     );
             $this->session->set_userdata('auth',$data);
             
             return true;
         }
         // If the previous process did not validate
         // then return false.
         return false;
         
         
          
      }




  function Logout()
   {

      $user_data = $this->session->all_userdata();
            
            foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
            $this->session->sess_destroy();
            redirect('Welcome/index');



   }
}

//echo $this->db->last_query();