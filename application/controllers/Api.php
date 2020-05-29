<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");


class Api extends CI_Controller {
	

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
		  $this->load->model('Apimodel');
		  $this->load->helper('datetime');
		 
  }


	public function index($pageurl="")
	{
		
		$result = $this->Apimodel->getcontent1($pageurl);
		echo $result;

	 	// echo '<pre>';
	 	// 	print_r($result);
	 	// echo '</pre>';
	
	 }



	 public function getmenu($menutype)
	 {
	 	
		$result = $this->Apimodel->getmenu($menutype);
		echo $result;

		// echo '<pre>';
	 // 		print_r($result);
	 // 	echo '</pre>';
	 }




	 public function homePage()
	 {
	 	$result = $this->Apimodel->gethomepage();
	 	echo $result;

	  // echo '<pre>';
	 	// 	print_r($result);
	  // echo '</pre>';
	 }
}
