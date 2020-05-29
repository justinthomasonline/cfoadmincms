<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contents extends CI_Model {

 function Create($table,$insert)
   {
    $this->db->trans_start();
    $this->db->insert($table,$insert);

    if(isset($_POST['infoTitle']))
    {
    $insert_id = $this->db->insert_id();
    $course_more =array();
        foreach($_POST['infoTitle'] as $key =>$item)
        {

            if(isset($_POST['infoBoxed'][$key]))
            {
                $infoboxed = 1;
            }else
            {
                $infoboxed = 0;
            }
            $content_more[]=array(
                'ContentId'=>$insert_id,
                'InfoTitle'=> $_POST['infoTitle'][$key],
                'InfoMessage'=>$_POST['infoMessage'][$key],
                'InfoBoxed'=>$infoboxed
            );

           

        }

        $this->db->insert_batch('content_more',$content_more);
    }
      
        return true;
      
       
    $this->db->trans_complete();
   }



 function Update($table,$data,$id)
   {
    $this->db->trans_start();
    
    $this->db->where('contentId', $id);
   $this->db->update($table, $data);

    if(isset($_POST['infoTitle']))
    {
    $course_more =array();
   
        foreach($_POST['infoTitle'] as $key =>$item)
        {

            if(isset($_POST['infoBoxed'][$key]))
            {
                $infoboxed = 1;
            }else
            {
                $infoboxed = 0;
            }

            if(isset($_POST['CourseMoreId'][$key]))
            {
              
                $content_more[]=array(
                    'CourseMoreId'=>$_POST['CourseMoreId'][$key],
                    'ContentId'=>$id,
                    'InfoTitle'=> $_POST['infoTitle'][$key],
                    'InfoMessage'=>$_POST['infoMessage'][$key],
                    'InfoBoxed'=>$infoboxed
                );
          }

           

        }

        
        $this->db->update_batch('content_more',$content_more,'CourseMoreId');
        
    }
      


        if(isset($_POST['infoTitle1']))
    {
   
    $course_more1 =array();
        foreach($_POST['infoTitle1'] as $key =>$item)
        {

            if(isset($_POST['infoBoxed1'][$key]))
            {
                $infoboxed = 1;
            }else
            {
                $infoboxed = 0;
            }
            $content_more1[]=array(
                'ContentId'=>$id,
                'InfoTitle'=> $_POST['infoTitle1'][$key],
                'InfoMessage'=>$_POST['infoMessage1'][$key],
                'InfoBoxed'=>$infoboxed
            );

           

        }

        $this->db->insert_batch('content_more',$content_more1);
    }




        return true;
      
       
    $this->db->trans_complete();
   }


function updatebanner($table,$data,$id)
{

   $this->db->where('BannerId', $id);
   $this->db->update($table, $data);

    return true;
}


function updateMainMenu($id,$data)
{
  $this->db->where('menuId', $id);
   $this->db->update('menus', $data);

    return true;
}

function updateSubMenu($id,$data)
{
  $this->db->where('subMenuId', $id);
   $this->db->update('submenu', $data);

    return true;
}


   function Checkunique($str)
   {
    $this->db->where('contentUrl', $str);
    $query = $this->db->get('contents');
   
    if($this->db->affected_rows()==0)
    {
        return true;
    }
    else
    {
        return false;
    }


   }


function ajax_check_unique_updation($table,$id,$content)
{

    $query = $this->db->query("select * from $table where contentId='$id' and contentUrl='$content'");
 
   if($query->num_rows()==1)
   {
    return true;
   }else if($query->num_rows()==0)
   {

            $this->db->where('contentUrl', $content);
                $query = $this->db->get($table);
               
                if($this->db->affected_rows()==0)
                {
                    return true;
                }
                else
                {
                    return false;
                }



   }
 }


   function check_unique_banner_priority($table,$id,$priority)
{

    $query = $this->db->query("select * from $table where BannerId='$id' and BannerPriority='$priority'");
 
   if($query->num_rows()==1)
   {
    return true;
   }else if($query->num_rows()==0)
   {

            $this->db->where('BannerPriority', $priority);
                $query = $this->db->get($table);
               
                if($this->db->affected_rows()==0)
                {
                    return true;
                }
                else
                {
                    return false;
                }



   }


}


 


   function getall($str)
   {
    $query = "select * from contents where ContentType='$str' ORDER BY contentId ASC";
    $res = $this->db->query($query);  
    return $res->result("array");
   }


    function getallbanners()
    {

    $query = "select * from banner ORDER BY BannerId ASC";
    $res = $this->db->query($query);  
    return $res->result("array");
    }


   function getallcontents()
   {
    $query = "select ContentTitle, contentUrl, ContentType from contents ORDER BY contentId ASC";
    $res = $this->db->query($query);  
    return $res->result("array");
   }


   function getallmenus($table)
   {
    $query = "select * from $table ORDER BY menuPriority ASC";
    $res = $this->db->query($query);  
    return $res->result("array");
   }
   

   function getsubmenubyid($submenuId)
   {
    $query = "select * from submenu where submenuId='$submenuId'";
    $res = $this->db->query($query);  
    return $res->row();
   }

   function getallheadermenus($table)
   {
     $query = "select * from $table where menuLocation='header' ORDER BY menuId ASC";
    $res = $this->db->query($query);  
    return $res->result("array");
   }
   function getcontent($pageurl)
   {
    $query = "select * from contents where contentUrl='$pageurl'";
    $res = $this->db->query($query);  
    return json_encode($res->result());
	 }


   function getsubmenus($parentid="")
   {
    
      $query = "select * from submenu where menuId='$parentid' ORDER BY subMenuPriority ASC";
   
    
    $res = $this->db->query($query);  
    $result=$res->result();
   $submenu= array();
  
  $index=0;
foreach($result as $row)
    {

      $submenu[$index]=array(
                    'subMenuId'=>$row->subMenuId,
                    'subMenuTilte'=>$row->subMenuTilte,
                    'subMenuUrl'=>$row->subMenuUrl,
                    'subMenuPriority'=>$row->subMenuPriority,
                    'menu'=>array());


       $query1 = "select * from menus where menuId='$row->menuId'";
       $res1 = $this->db->query($query1);  
       $result1=$res1->result();

          foreach($result1 as $row1)
             {
              $submenu[$index]['menu'][]=array(

                    'menuId'=>$row1->menuId,
                    'menuTitle'=>$row1->menuTitle,
                 );
             }
      

$index++;
    }
return $submenu;
   }
   
    


 function checkpriority($table,$id)
 {
   
   if($table=="submenu")
   {
      $query= "select subMenuPriority from $table where menuId='$id' ";
      $res = $this->db->query($query);  
      return json_encode($res->result("array"));
   }
 
 }






function getcontentbyid($table,$id)
{


$query = "select * from $table where contentId='$id'";
    $res = $this->db->query($query);  
    $result=$res->result();
   $content= array();
  
  $index=0;
foreach($result as $row)
    {

      $content[$index]=array(
                    'contentId'=>$row->contentId,
                    'ContentTitle'=>$row->ContentTitle,
                    'contentUrl'=>$row->contentUrl,
                    'isPublished'=>$row->isPublished,
                    'FeaturedImage'=>$row->FeaturedImage,
                    'contentMeta'=>$row->contentMeta,
                    'content'=>$row->content,
                    'category'=>$row->category,
                    'content_more'=>array());


       $query1 = "select * from content_more where ContentId='$id'";
       $res1 = $this->db->query($query1);  
       $result1=$res1->result();

          foreach($result1 as $row1)
             {
              $content[$index]['content_more'][]=array(

                    'CourseMoreId'=>$row1->CourseMoreId,
                    'InfoTitle'=>$row1->InfoTitle,
                    'InfoMessage'=>$row1->InfoMessage,
                    'InfoBoxed'=>$row1->InfoBoxed
                 );
             }
      

$index++;
    }
return $content;

 
}


function getbannerbyid($id)
{
  $query = "select * from banner where BannerId='$id'";
  $res = $this->db->query($query);  
  return $res->result("array");
  
}


function deletecontent($table,$id)
{
     $this -> db -> where('contentId', $id);
     $this -> db -> delete($table);

     $this -> db -> where('ContentId', $id);
     $this -> db -> delete('content_more');

    

}


function deletebanner($table,$id)
{
     $this -> db -> where('BannerId', $id);
     $this -> db -> delete($table);

}



function get_mainmenu_byid($id)
{
    $query = "select * from menus where menuId ='$id'";
    $res = $this->db->query($query);  
    return $res->result("array");
}



 function maxvalue($table, $field,$location)
 {


  $query = "SELECT MAX($field) AS maxpriority FROM $table where menuLocation='$location' ";
  $res =  $this->db->query($query); 

  if($res->row()->maxpriority==NULL)
  {
    return 1;
  }else
  {
    return $res->row()->maxpriority;
  }


 }


 function maxvalue_submenu($table,$field)
 {

 $query = "SELECT MAX($field) AS maxpriority FROM $table";
  $res =  $this->db->query($query); 



  if($res->row()->maxpriority==NULL)
  {
    return 0;
  }else
  {
    return $res->row()->maxpriority;
  }


 }


 function getmenucount($field)
 {
  $query="select menuId from menus where menulocation='$field'";
  $res=$this->db->query($query);

  return $this->db->affected_rows();
 }
 

 function getsubmenucount($parentid="")
 {
   $query="select subMenuId from submenu where menuId='$parentid'"; 
  $res=$this->db->query($query);

  return $this->db->affected_rows();
 }
 



function menu_priority_update()
{

  $q="select menuId from menus where menuPriority='$_POST[newvalue]' and menulocation='$_POST[menulocation]'";
  $res=$this->db->query($q);

  $existing_priority_Id =  $res->row()->menuId;

  $q="UPDATE menus SET menuPriority='$_POST[newvalue]' WHERE menuId='$_POST[menuId]' and menulocation='$_POST[menulocation]'";

  $res=$this->db->query($q); 

   $q="UPDATE menus SET menuPriority='$_POST[existingvalue]' WHERE menuId='$existing_priority_Id' and menulocation='$_POST[menulocation]'";

  $res=$this->db->query($q);

  return 1;



   // $q="UPDATE menus SET menuPriority='$_POST[newvalue]' WHERE menuId='$_POST[menuId]' and menulocation='$_POST[menulocation]'";



}


function submenu_priority_update()

{

  $q="select subMenuId from submenu where subMenuPriority='$_POST[newvalue]'";
  $res=$this->db->query($q);

  $existing_priority_Id =  $res->row()->subMenuId;

  $q="UPDATE submenu SET subMenuPriority='$_POST[newvalue]' WHERE subMenuId='$_POST[submenuId]'";

  $res=$this->db->query($q); 

   $q="UPDATE submenu SET subMenuPriority='$_POST[existingvalue]' WHERE subMenuId='$existing_priority_Id'";

  $res=$this->db->query($q);

  return 1;



   // $q="UPDATE menus SET menuPriority='$_POST[newvalue]' WHERE menuId='$_POST[menuId]' and menulocation='$_POST[menulocation]'";



}



function deletemenu()
{
  if($_POST['menutype']=="mainmenu")
  {

     $this -> db -> where('menuId', $_POST['menuId']);
     $this -> db -> delete('menus');

     $this -> db -> where('menuId', $_POST['menuId']);
     $this -> db -> delete('submenu');


  }else if($_POST['menutype']=="submenu")
  {
     $this -> db -> where('subMenuId', $_POST['menuId']);
     $this -> db -> delete('submenu');

  }


return 1;
}



}

//echo $this->db->last_query();