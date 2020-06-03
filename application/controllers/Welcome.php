<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		 parent::__construct();
		  $this->load->helper('form');
		  $this->load->helper('url');
		   $this->load->library('session');
		  /*if(! $this->session->userdata('login'))
		 {
			 redirect('login/Authentication/logout');
		 }*/
		  $this->load->library('form_validation');
		  $this->load->database();
		  $this->load->model('Authentications');
		  $this->load->helper('datetime');
  }


	public function index()
	{
		$this->load->helper('url');
		$this->form_validation->set_rules('username', 'Name', 'required'); 
		$this->form_validation->set_rules('password', 'password', 'required');

		if ($this->form_validation->run() == FALSE) { 
		$this->load->view('login/login');
		}
		else{
			$result=$this->Authentications->Login();
			if($result==TRUE)
			{
						
				redirect('Dashboard');
						
			}  else {

				$this->session->set_flashdata('msg', 'Username and Password is miss macthing');
				redirect('Welcome/index');
			}





		}
	}


		
			function logout()
			{
					$user_data = $this->session->all_userdata();
				
				foreach ($user_data as $key => $value) {
				if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
					$this->session->unset_userdata($key);
				}
			}
				$this->session->sess_destroy();
				redirect('welcome');
			}


}
