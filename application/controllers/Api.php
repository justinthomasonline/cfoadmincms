<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Request-Headers: GET,POST,OPTIONS,DELETE,PUT");
header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');


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
		
		if($pageurl=="upcoming_events" || $pageurl=="past_events" )
		{
			$result = $this->Apimodel->getevents($pageurl);
		}else
		{
		$result = $this->Apimodel->getcontent1($pageurl);
		}
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

	 public function contact()
	 {
	 	$postdata = file_get_contents("php://input");
	 	$request = json_decode($postdata,true);
       

       if( ! empty($request)) {
          $name = $request['name'];
          $email = $request['email'];
          $phone = $request['phone'];
          $message = $request['message'];

          $contactData = array(
              'name' => $name,
              'email' => $email,
              'phone' => $phone,
              'message' => $message,
              'created_at' => date('Y-m-d H:i:s', time()),
              'status'=>0
          );

          $id = $this->Apimodel->insert_contact($contactData);

          $this->sendemail($contactData);
          
          $response = array('id' => $id);

      }else
      {
      	 $response = array('id' => '');
      }

      $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($response));


	 }


	 	 public function sendemail($contactData)
  {

  	  $emails = $this->Apimodel->getforwardingmail();

  	  

      $message = '<p>Hi, <br />Some one has submitted contact form.</p>';
      $message .= '<p><strong>Name: </strong>'.$contactData['name'].'</p>';
      $message .= '<p><strong>Email: </strong>'.$contactData['email'].'</p>';
      $message .= '<p><strong>Phone: </strong>'.$contactData['phone'].'</p>';
      $message .= '<p><strong>Name: </strong>'.$contactData['message'].'</p>';
      $message .= '<br />Thanks';

      $this->load->library('email');

      $config['protocol'] = 'sendmail';
      $config['mailpath'] = '/usr/sbin/sendmail';
      $config['charset'] = 'iso-8859-1';
      $config['wordwrap'] = TRUE;
      $config['mailtype'] = 'html';

      $this->email->initialize($config);

      $this->email->from('direction@cfoman.org', 'direction');
      $this->email->to($emails->PrimaryEmail);
      $this->email->cc($emails->CarbonCopy);
     // $this->email->bcc('them@rsgitech.com');

      $this->email->subject('Enquiry through website');
      $this->email->message($message);

      $this->email->send();
  }




}
