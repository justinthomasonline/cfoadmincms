<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		  if(! $this->session->userdata('login'))
		 {
			 redirect('Welcome/logout');
		 }
		  $this->load->library('form_validation');
		  $this->load->database();
		  $this->load->model('Contents');
		  $this->load->helper('datetime');
  }



    
  public function index()
  {

      $data['pagecount'] =  $this->Contents->getcount('Page');
      $data['coursecount'] =  $this->Contents->getcount('Course');
      $data['eventcount'] =  $this->Contents->getcount('Events');
      $data['partnercount'] =  $this->Contents->getcount('Partners');
      $data['unreadenquirycount'] =  $this->Contents->getenqcount();


      $this->load->view('includes/header',$data);
      $this->load->view('dashboard/dashboard');
      $this->load->view('includes/footer');

  }

public function seo_friendly_url($string)
{
  
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
    return strtolower(trim($string, '-'));
}

  public function pages()
  {
      $data['title'] = "List pages";
      $data['pages']=$this->Contents->getall('Page');

      $this->load->view('includes/header',$data);
      $this->load->view('dashboard/pages');
      $this->load->view('includes/footer');

  }

  public function courses()
  {
      $data['title'] = "List courses";
      $data['pages']=$this->Contents->getall('Course');

      $this->load->view('includes/header',$data);
      $this->load->view('dashboard/courses');
      $this->load->view('includes/footer');

  }


  public function addpages()
  {

    $this->form_validation->set_rules('title', 'Title', 'required'); 
    $this->form_validation->set_rules('content_url', 'Page url', 'trim|required|callback_check_unique');
    $this->form_validation->set_rules('editor1', 'Page Content', 'required'); 
    $this->form_validation->set_rules('meta_data', 'Meta Data', 'required'); 
    $this->form_validation->set_message('check_unique','This url already exist! Please try another');
    

    if ($this->form_validation->run() == FALSE) { 

      $this->load->view('includes/header');
      $this->load->view('dashboard/addpages');
      $this->load->view('includes/footer');
    }

    else {

        if(isset($_POST['iscontact']))
        {
            $iscontact = 1;
        }else
        {
            $iscontact = 0;
        }


        if(isset($_POST['ispublished']))
        {
            $ispublished = 1;
        }else
        {
            $ispublished = 0;
        }



        // if(isset($_FILES['featured_image']) && !empty($_FILES['featured_image']['name']))
        // { 
        //  $file = $_FILES['featured_image']['tmp_name'];
        //  $file_name = $_FILES['featured_image']['name'];
        //  $file_name_array = explode(".", $file_name);
        //  $extension = end($file_name_array);
        //  $new_image_name = rand() . '.' . $extension;
        //  chmod('upload', 0777);
        //  $allowed_extension = array("jpg", "gif", "png");
        //  if(in_array($extension, $allowed_extension))
        //  {
        //   move_uploaded_file($file, 'upload/' . $new_image_name);
        //  }
        // $featured_image=$new_image_name;
        // }else{
           
        //     $featured_image="";
        // }
    
      $featured_image="";

        $contentUrl = $this->seo_friendly_url($_POST['content_url']);  
        $data = array(
            'ContentType'=>'Page',
            'ContentTitle'=>$_POST['title'],
            'contentUrl'=>$contentUrl,
            'isPublished' => $ispublished,
            'isContactpage'=> $iscontact,
            'contentMeta' => $_POST['meta_data'],
            'content' => $_POST['editor1'],
            'FeaturedImage'=>$featured_image

        );

        
        $result = $this->Contents->Create('contents',$data);
       if($result==1)
       {
        $this->session->set_flashdata('msg_success', 'Successfully inserted');
       }else{
        $this->session->set_flashdata('msg_error', 'Unable to insert, try later');
       }

       redirect('Dashboard/addpages');
    }


    

  }





  public function addcourses()
  {

    $this->form_validation->set_rules('title', 'Title', 'required'); 
    $this->form_validation->set_rules('content_url', 'Page url', 'trim|required|callback_check_unique');
    $this->form_validation->set_rules('editor1', 'Page Content', 'required'); 
    $this->form_validation->set_rules('meta_data', 'Meta Data', 'required'); 
    $this->form_validation->set_message('check_unique','This url already exist! Please try another');
    

    if ($this->form_validation->run() == FALSE) { 

      $this->load->view('includes/header');
      $this->load->view('dashboard/addcourses');
      $this->load->view('includes/footer');
    }

    else {

        if(isset($_POST['ispublished']))
        {
            $ispublished = 1;
        }else
        {
            $ispublished = 0;
        }

        if(isset($_FILES['featured_image']) && !empty($_FILES['featured_image']['name']))
        { 
         $file = $_FILES['featured_image']['tmp_name'];
         $file_name = $_FILES['featured_image']['name'];
         $file_name_array = explode(".", $file_name);
         $extension = end($file_name_array);
         $new_image_name = rand() . '.' . $extension;
         chmod('upload/course/', 0777);
         $allowed_extension = array("jpg", "gif", "png");
         if(in_array($extension, $allowed_extension))
         {
          move_uploaded_file($file, 'upload/course/' . $new_image_name);
         }
        $featured_image=$new_image_name;
        }else{
           
            $featured_image="";
        }

        $contentUrl = $this->seo_friendly_url($_POST['content_url']); 
        $course_content = array(
            'ContentType'=>'Course',
            'ContentTitle'=>$_POST['title'],
            'contentUrl'=>$contentUrl,
            'isPublished' => $ispublished,
            'contentMeta' => $_POST['meta_data'],
            'content' => $_POST['editor1'],
            'FeaturedImage'=>$featured_image

        );

        $result = $this->Contents->Create('contents',$course_content);
       
       if($result==1)
       {
        $this->session->set_flashdata('msg_success', 'Successfully inserted');
       }else{
        $this->session->set_flashdata('msg_error', 'Unable to insert, try later');
       }

       redirect('Dashboard/addcourses');
    }


    

  }


  function check_unique($str)
{

$contentUrl = $this->seo_friendly_url($str); 
$result = $this->Contents->Checkunique($contentUrl);
return $result;

}






function ajax_check_unique()
{
  
$contentUrl = $this->seo_friendly_url($_POST['content_url']); 
$result = $this->Contents->Checkunique($contentUrl);
    if($result)
    {
        echo 1;
    }else
    {
        echo 0;
    }


}

    function upload()
    {
        if(isset($_FILES['upload']['name']))
{
    
 $file = $_FILES['upload']['tmp_name'];
 $file_name = $_FILES['upload']['name'];
 $file_name_array = explode(".", $file_name);
 $extension = end($file_name_array);
 $new_image_name = rand() . '.' . $extension;
 chmod('upload', 0777);
 $allowed_extension = array("jpg", "gif", "png");
 if(in_array($extension, $allowed_extension))
 {
  move_uploaded_file($file, 'upload/' . $new_image_name);
  $function_number = $_GET['CKEditorFuncNum'];
  $url = base_url('upload').'/' . $new_image_name;
  $message = '';

 
  echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
 }
}
    }



   function events()
   {
    $data['title'] = "List courses";
    $data['pages']=$this->Contents->getall('Events');

    $this->load->view('includes/header',$data);
    $this->load->view('dashboard/events');
    $this->load->view('includes/footer');
   } 


   function addevents()
   {

    $data['title'] = "Add events";  

    $this->form_validation->set_rules('title', 'Title', 'required'); 
    $this->form_validation->set_rules('category', 'Category', 'required');
    $this->form_validation->set_rules('content_url', 'Page url', 'trim|required|callback_check_unique');
    $this->form_validation->set_rules('editor1', 'Page Content', 'required'); 
    $this->form_validation->set_rules('meta_data', 'Meta Data', 'required'); 
    $this->form_validation->set_message('check_unique','This url already exist! Please try another');
    

    if ($this->form_validation->run() == FALSE) { 

      $this->load->view('includes/header',$data);
      $this->load->view('dashboard/addevents');
      $this->load->view('includes/footer');
    }
    else {

        if(isset($_POST['ispublished']))
        {
            $ispublished = 1;
        }else
        {
            $ispublished = 0;
        }

        // if(isset($_FILES['featured_image']) && !empty($_FILES['featured_image']['name']))
        // { 
        //  $file = $_FILES['featured_image']['tmp_name'];
        //  $file_name = $_FILES['featured_image']['name'];
        //  $file_name_array = explode(".", $file_name);
        //  $extension = end($file_name_array);
        //  $new_image_name = rand() . '.' . $extension;
        //  chmod('upload', 0777);
        //  $allowed_extension = array("jpg", "gif", "png");
        //  if(in_array($extension, $allowed_extension))
        //  {
        //   move_uploaded_file($file, 'upload/' . $new_image_name);
        //  }
        // $featured_image=$new_image_name;
        // }else{
           
        //     $featured_image="";
        // }
    
        $featured_image="";

        $contentUrl = $this->seo_friendly_url($_POST['content_url']); 
        $data = array(
            'ContentType'=>'Events',
            'ContentTitle'=>$_POST['title'],
            'contentUrl'=>$contentUrl,
            'isPublished' => $ispublished,
            'contentMeta' => $_POST['meta_data'],
            'content' => $_POST['editor1'],
            'FeaturedImage'=>$featured_image,
            'category'=>$_POST['category']

        );

        
        $result = $this->Contents->Create('contents',$data);
       if($result==1)
       {
        $this->session->set_flashdata('msg_success', 'Successfully inserted');
       }else{
        $this->session->set_flashdata('msg_error', 'Unable to insert, try later');
       }

       redirect('Dashboard/addevents');
    }

   }


   function menus()
   {
    $data['title']="Menus";
    $data['pages']=$this->Contents->getallmenus('menus');
    $data['headermenucount']=$this->Contents->getmenucount('header');
    $data['footermenucount']=$this->Contents->getmenucount('footer');


      $this->load->view('includes/header',$data);
      $this->load->view('dashboard/menus');
      $this->load->view('includes/footer');
   }

   function submenus($parentid="")
   {
         $data['title']="Sub Menus";

        
         $data['submenu']=$this->Contents->getsubmenus($parentid);

         $data['parentid']=$parentid;

    $data['submenucount']=$this->Contents->getsubmenucount($parentid);

      $this->load->view('includes/header',$data);
      $this->load->view('dashboard/submenu');
      $this->load->view('includes/footer');
   }




   function addmenus()
   {
     $data['title']="Add Menus";
     $data['menucontents']=$this->Contents->getallcontents();

     $this->form_validation->set_rules('menulocation', 'Menu Location', 'required'); 
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('maincorrespondingpage', 'corresponding page', 'required'); 
   
    
    

    if ($this->form_validation->run() == FALSE) { 
    
    
      $this->load->view('includes/header',$data);
      $this->load->view('dashboard/addmenus');
      $this->load->view('includes/footer');

    }else
    {


      $maxpriority = $this->Contents->maxvalue('menus','menuPriority',$_POST['menulocation']);


     

        if(isset($_POST['ispublished']))
        {
            $ispublished = 1;
        }else
        {
            $ispublished = 0;
        }


      $data=array(
        'menuTitle'=>trim($_POST['title']),
        'menuUrl'=>trim($_POST['maincorrespondingpage']),
        'menuLocation'=>trim($_POST['menulocation']),
        'menuPriority'=>$maxpriority+1,
        'menuStatus'=>$ispublished
      );





       $result = $this->Contents->Create('menus',$data);
       if($result==1)
       {
        $this->session->set_flashdata('msg_success', 'Successfully inserted');
       }else{
        $this->session->set_flashdata('msg_error', 'Unable to insert, try later');
       }

       redirect('Dashboard/addmenus');



    }


   }



 function addsubmenus($parentid="")
 {
     $data['title']="Add sub menus";
     $data['menucontents']=$this->Contents->getallcontents();
      $data['parentmenu']=$this->Contents->getallheadermenus('menus');

       $data['parentid']=$parentid;
      


    $this->form_validation->set_rules('parentMenu', 'Parent menu', 'required');
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('maincorrespondingpage', 'corresponding page', 'required'); 
   
    

    if ($this->form_validation->run() == FALSE) { 
    
    
      $this->load->view('includes/header',$data);
      $this->load->view('dashboard/addsubmenus');
      $this->load->view('includes/footer');

    }else
    {

      $maxpriority = $this->Contents->maxvalue_submenu('submenu','subMenuPriority');


        if(isset($_POST['ispublished']))
        {
            $ispublished = 1;
        }else
        {
            $ispublished = 0;
        }


      $data=array(
        'subMenuTilte'=>trim($_POST['title']),
        'subMenuUrl'=>trim($_POST['maincorrespondingpage']),
        'menuId'=>trim($_POST['parentMenu']),
        'subMenuPriority'=>$maxpriority+1,
        'subMenuStatus'=>$ispublished
      );



       $result = $this->Contents->Create('submenu',$data);
       if($result==1)
       {
        $this->session->set_flashdata('msg_success', 'Successfully inserted');
       }else{
        $this->session->set_flashdata('msg_error', 'Unable to insert, try later');
       }
      

         redirect('Dashboard/addsubmenus/'.$parentid);
       



    }
 }




function checkpriority()
{
  $_POST['parentId'];
  $result = $this->Contents->checkpriority('submenu', $_POST['parentId']);
  echo $result;
}


function partners()
{
      $data['title'] = "List Partners";
      $data['pages']=$this->Contents->getall('Partners');
      $this->load->view('includes/header',$data);
      $this->load->view('dashboard/parnters');
      $this->load->view('includes/footer');
}



function addpartners()
{
    
    $this->form_validation->set_rules('title', 'Title', 'required'); 
    $this->form_validation->set_rules('content_url', 'Page url', 'trim|required|callback_check_unique');
    $this->form_validation->set_rules('editor1', 'Page Content', 'required'); 
    $this->form_validation->set_rules('meta_data', 'Meta Data', 'required'); 
    if (empty($_FILES['featured_image']['name']))
       {
        $this->form_validation->set_rules('featured_image', 'Logo', 'required');
      }
    $this->form_validation->set_message('check_unique','This url already exist! Please try another');
    

    if ($this->form_validation->run() == FALSE) { 

      $this->load->view('includes/header');
      $this->load->view('dashboard/addpartners');
      $this->load->view('includes/footer');
    }

    else {

        if(isset($_POST['ispublished']))
        {
            $ispublished = 1;
        }else
        {
            $ispublished = 0;
        }

        if(isset($_FILES['featured_image']) && !empty($_FILES['featured_image']['name']))
        { 
         $file = $_FILES['featured_image']['tmp_name'];
         $file_name = $_FILES['featured_image']['name'];
         $file_name_array = explode(".", $file_name);
         $extension = end($file_name_array);
         $new_image_name = rand() . '.' . $extension;
         chmod('upload/parnters/', 0777);
         $allowed_extension = array("jpg", "gif", "png");
         if(in_array($extension, $allowed_extension))
         {
          move_uploaded_file($file, 'upload/parnters/' . $new_image_name);
         }
        $featured_image=$new_image_name;
        }else{
           
            $featured_image="";
        }

        $contentUrl = $this->seo_friendly_url($_POST['content_url']); 
        $course_content = array(
            'ContentType'=>'Partners',
            'ContentTitle'=>$_POST['title'],
            'contentUrl'=>$contentUrl,
            'isPublished' => $ispublished,
            'contentMeta' => $_POST['meta_data'],
            'content' => $_POST['editor1'],
            'FeaturedImage'=>$featured_image

        );

        $result = $this->Contents->Create('contents',$course_content);
       
       if($result==1)
       {
        $this->session->set_flashdata('msg_success', 'Successfully inserted');
       }else{
        $this->session->set_flashdata('msg_error', 'Unable to insert, try later');
       }

       redirect('Dashboard/addpartners');
    }
}



function banners()
{

      $data['title'] = "List Banners";
      $data['pages']=$this->Contents->getallbanners();
      $this->load->view('includes/header',$data);
      $this->load->view('dashboard/banners');
      $this->load->view('includes/footer');

}



function addbanners()
{



    $this->form_validation->set_rules('title', 'Title', 'required'); 
   
    $this->form_validation->set_rules('bannertext', 'Banner Text', 'required'); 
   
    if (empty($_FILES['featured_image']['name']))
       {
        $this->form_validation->set_rules('featured_image', 'Logo', 'required');
      }
    $this->form_validation->set_rules('Priority','Priority', 'required|trim|is_unique[banner.BannerPriority]'); 
   

    if ($this->form_validation->run() == FALSE) { 

      $this->load->view('includes/header');
      $this->load->view('dashboard/addbanners');
      $this->load->view('includes/footer');
    }

    else {
 
        if(isset($_POST['ispublished']))
        {
            $ispublished = 1;
        }else
        {
            $ispublished = 0;
        }

        if(isset($_FILES['featured_image']) && !empty($_FILES['featured_image']['name']))
        { 
         $file = $_FILES['featured_image']['tmp_name'];
         $file_name = $_FILES['featured_image']['name'];
         $file_name_array = explode(".", $file_name);
         $extension = end($file_name_array);
         $new_image_name = rand() . '.' . $extension;
         chmod('upload/banners/', 0777);
         $allowed_extension = array("jpg", "gif", "png");
         if(in_array($extension, $allowed_extension))
         {
          move_uploaded_file($file, 'upload/banners/' . $new_image_name);
         }
        $featured_image=$new_image_name;
        }else{
           
            $featured_image="";
        }

            $course_content = array(
            'BannerTitle'=>$_POST['title'],
            'BannerText'=>trim($_POST['bannertext']),
            'isPublished' => $ispublished,
            'BannerImage'=>$featured_image,
            'BannerPriority'=>$_POST['Priority']

        );


        $result = $this->Contents->Create('banner',$course_content);
       
       if($result==1)
       {
        $this->session->set_flashdata('msg_success', 'Successfully inserted');
       }else{
        $this->session->set_flashdata('msg_error', 'Unable to insert, try later');
       }

       redirect('Dashboard/addbanners');
    }


}





function editpages($id="")
{

      if ($_SERVER['REQUEST_METHOD'] != 'POST')

       { 

        $data['pages']=$this->Contents->getcontentbyid('contents',$id);
        $this->load->view('includes/header',$data);
        $this->load->view('dashboard/editpages');
        $this->load->view('includes/footer');
     }else
     {
     
              if(isset($_POST['ispublished']))
        {
            $ispublished = 1;
        }else
        {
            $ispublished = 0;
        }



         if(isset($_POST['iscontact']))
        {
            $iscontact = 1;
        }else
        {
            $iscontact = 0;
        }

        // if(isset($_FILES['featured_image']) && !empty($_FILES['featured_image']['name']))
        // { 
        //  $file = $_FILES['featured_image']['tmp_name'];
        //  $file_name = $_FILES['featured_image']['name'];
        //  $file_name_array = explode(".", $file_name);
        //  $extension = end($file_name_array);
        //  $new_image_name = rand() . '.' . $extension;
        //  chmod('upload', 0777);
        //  $allowed_extension = array("jpg", "gif", "png");
        //  if(in_array($extension, $allowed_extension))
        //  {
        //   move_uploaded_file($file, 'upload/' . $new_image_name);
        //  }
        // $featured_image=$new_image_name;
        // }else{
           
        //     $featured_image="";
        // }
    
      $featured_image="";

        $contentUrl = $this->seo_friendly_url($_POST['content_url']); 
        $data = array(
            'ContentType'=>'Page',
            'ContentTitle'=>trim($_POST['title']),
            'contentUrl'=>trim($contentUrl),
            'isPublished' => $ispublished,
            'isContactpage'=>$iscontact,
            'contentMeta' => $_POST['meta_data'],
            'content' => $_POST['editor'],
            'FeaturedImage'=>$featured_image

        );

     
        
        $result = $this->Contents->Update('contents',$data, $_POST['contentId']);
       if($result==1)
       {
        $this->session->set_flashdata('msg_success', 'Successfully Updated');
       }else{
        $this->session->set_flashdata('msg_error', 'Unable to update, try later');
       }

       redirect('Dashboard/editpages/'.$_POST['contentId']);
    }
}




function ajax_deletecontent()
{
  
    $result = $this->Contents->deletecontent('contents',$_POST['id']);
    echo 1;
}

function ajax_check_unique_updation()
{
  

  $contentUrl = $this->seo_friendly_url($_POST['content_url']); 
  $result=$this->Contents->ajax_check_unique_updation('contents', $_POST['contentId'], $contentUrl);
       if($result)
       {
         echo 1;
       }else
       {
         echo 0;
       }
 }


 function editcourse($id="")
 {
 if ($_SERVER['REQUEST_METHOD'] != 'POST')

       { 

        $data['pages']=$this->Contents->getcontentbyid('contents',$id);
        $this->load->view('includes/header',$data);
        $this->load->view('dashboard/editcourse');
        $this->load->view('includes/footer');
     }else
     {
     
                if(isset($_POST['ispublished']))
        {
            $ispublished = 1;
        }else
        {
            $ispublished = 0;
        }

        if(isset($_FILES['featured_image']) && !empty($_FILES['featured_image']['name']))
        { 
         $file = $_FILES['featured_image']['tmp_name'];
         $file_name = $_FILES['featured_image']['name'];
         $file_name_array = explode(".", $file_name);
         $extension = end($file_name_array);
         $new_image_name = rand() . '.' . $extension;
         chmod('upload/course/', 0777);
         $allowed_extension = array("jpg", "gif", "png");
         if(in_array($extension, $allowed_extension))
         {
          move_uploaded_file($file, 'upload/course/' . $new_image_name);
         }
        $featured_image=$new_image_name;
        }else{
           
            $featured_image=$_POST["old_featured_img"];
        }
    
  

        $contentUrl = $this->seo_friendly_url($_POST['content_url']); 
        $data = array(
            'ContentType'=>'Course',
            'ContentTitle'=>trim($_POST['title']),
            'contentUrl'=>trim($contentUrl),
            'isPublished' => $ispublished,
            'contentMeta' => $_POST['meta_data'],
            'content' => $_POST['editor'],
            'FeaturedImage'=>$featured_image

        );


        $result = $this->Contents->Update('contents',$data, $_POST['contentId']);
       if($result==1)
       {
        $this->session->set_flashdata('msg_success', 'Successfully Updated');
       }else{
        $this->session->set_flashdata('msg_error', 'Unable to update, try later');
       }

       redirect('Dashboard/editcourse/'.$_POST['contentId']);
    }

 }


function change_image()
{
       if(unlink('upload/'.$_POST['folder'].'/' .$_POST['img']))
        {
          echo 1;
        }else
        {
          echo 0;
        }

}


function ajax_deletebanner()
{



$this->Contents->deletebanner('banner',$_POST['id']);

unlink($_POST['path']);
         
     echo 1;
       

}


function editevents($id="")
{

   if ($_SERVER['REQUEST_METHOD'] != 'POST')

       { 

        $data['pages']=$this->Contents->getcontentbyid('contents',$id);
        $this->load->view('includes/header',$data);
        $this->load->view('dashboard/editevents');
        $this->load->view('includes/footer');
     }else
     {
     
              if(isset($_POST['ispublished']))
        {
            $ispublished = 1;
        }else
        {
            $ispublished = 0;
        }

        // if(isset($_FILES['featured_image']) && !empty($_FILES['featured_image']['name']))
        // { 
        //  $file = $_FILES['featured_image']['tmp_name'];
        //  $file_name = $_FILES['featured_image']['name'];
        //  $file_name_array = explode(".", $file_name);
        //  $extension = end($file_name_array);
        //  $new_image_name = rand() . '.' . $extension;
        //  chmod('upload', 0777);
        //  $allowed_extension = array("jpg", "gif", "png");
        //  if(in_array($extension, $allowed_extension))
        //  {
        //   move_uploaded_file($file, 'upload/' . $new_image_name);
        //  }
        // $featured_image=$new_image_name;
        // }else{
           
        //     $featured_image="";
        // }
    
      $featured_image="";

        $contentUrl = $this->seo_friendly_url($_POST['content_url']); 
        $data = array(
            'ContentType'=>'Events',
            'ContentTitle'=>trim($_POST['title']),
            'contentUrl'=>trim($contentUrl),
            'isPublished' => $ispublished,
            'contentMeta' => $_POST['meta_data'],
            'content' => $_POST['editor'],
            'category'=>$_POST['category'],
            'FeaturedImage'=>$featured_image

        );

     
        
        $result = $this->Contents->Update('contents',$data, $_POST['contentId']);
       if($result==1)
       {
        $this->session->set_flashdata('msg_success', 'Successfully Updated');
       }else{
        $this->session->set_flashdata('msg_error', 'Unable to update, try later');
       }

       redirect('Dashboard/editevents/'.$_POST['contentId']);
    }

}




function editpartners($id="")
{


  if ($_SERVER['REQUEST_METHOD'] != 'POST')

       { 

        $data['pages']=$this->Contents->getcontentbyid('contents',$id);
        $this->load->view('includes/header',$data);
        $this->load->view('dashboard/editpartners');
        $this->load->view('includes/footer');
     }else
     {
     
                if(isset($_POST['ispublished']))
        {
            $ispublished = 1;
        }else
        {
            $ispublished = 0;
        }

        if(isset($_FILES['featured_image']) && !empty($_FILES['featured_image']['name']))
        { 
         $file = $_FILES['featured_image']['tmp_name'];
         $file_name = $_FILES['featured_image']['name'];
         $file_name_array = explode(".", $file_name);
         $extension = end($file_name_array);
         $new_image_name = rand() . '.' . $extension;
         chmod('upload/parnters/', 0777);
         $allowed_extension = array("jpg", "gif", "png");
         if(in_array($extension, $allowed_extension))
         {
          move_uploaded_file($file, 'upload/parnters/' . $new_image_name);
         }
        $featured_image=$new_image_name;
        }else{
           
            $featured_image=$_POST["old_featured_img"];
        }
    
  

        $contentUrl = $this->seo_friendly_url($_POST['content_url']); 
        $data = array(
            'ContentType'=>'Partners',
            'ContentTitle'=>trim($_POST['title']),
            'contentUrl'=>trim($contentUrl),
            'isPublished' => $ispublished,
            'contentMeta' => $_POST['meta_data'],
            'content' => $_POST['editor'],
            'FeaturedImage'=>$featured_image

        );


        $result = $this->Contents->Update('contents',$data, $_POST['contentId']);
       if($result==1)
       {
        $this->session->set_flashdata('msg_success', 'Successfully Updated');
       }else{
        $this->session->set_flashdata('msg_error', 'Unable to update, try later');
       }

       redirect('Dashboard/editpartners/'.$_POST['contentId']);
    }

}




function editbanner($id="")
{

 if ($_SERVER['REQUEST_METHOD'] != 'POST')

       {

      $data['banner']=$this->Contents->getbannerbyid($id); 
      $this->load->view('includes/header',$data);
      $this->load->view('dashboard/editbanners');
      $this->load->view('includes/footer');
     }else
     {

      if(isset($_FILES['featured_image']) && !empty($_FILES['featured_image']['name']))
        { 
         $file = $_FILES['featured_image']['tmp_name'];
         $file_name = $_FILES['featured_image']['name'];
         $file_name_array = explode(".", $file_name);
         $extension = end($file_name_array);
         $new_image_name = rand() . '.' . $extension;
         chmod('upload/banners/', 0777);
         $allowed_extension = array("jpg", "gif", "png");
         if(in_array($extension, $allowed_extension))
         {
          move_uploaded_file($file, 'upload/banners/' . $new_image_name);
         }
        $featured_image=$new_image_name;
        }else{
           
            $featured_image=$_POST["old_featured_img"];
        }


      if(isset($_POST['ispublished']))
        {
            $ispublished = 1;
        }else
        {
            $ispublished = 0;
        }


          $data = array(
            'BannerTitle'=>trim($_POST['title']),
            'BannerText'=>trim($_POST['bannertext']),
            'BannerPriority'=>$_POST['Priority'],
            'isPublished' => $ispublished,
            'BannerImage'=>$featured_image

        );



           $result = $this->Contents->updatebanner('banner',$data, $_POST['bannerid']);
       if($result==1)
       {
        $this->session->set_flashdata('msg_success', 'Successfully Updated');
       }else{
        $this->session->set_flashdata('msg_error', 'Unable to update, try later');
       }

       redirect('Dashboard/editbanner/'.$id);
    }




     }

    





function check_unique_banner_priority()
{



 $result=$this->Contents->check_unique_banner_priority('banner', $_POST['id'], $_POST['priority']);
      if($result)
      {
        echo 1;
      }else
      {
        echo 0;
      }

}



function editmainmenu($id="")
{
  $data['title']="Edit main menu";

$data['id']=$id;

      $data['mainmenu']=$this->Contents->get_mainmenu_byid($id); 
      $data['menucontents']=$this->Contents->getallcontents();

      $this->form_validation->set_rules('menulocation', 'Menu Location', 'required'); 
     $this->form_validation->set_rules('title', 'Title', 'required');
     $this->form_validation->set_rules('maincorrespondingpage', 'corresponding page', 'required'); 
      

   if ($this->form_validation->run() == FALSE) 
   { 

      $this->load->view('includes/header',$data);
      $this->load->view('dashboard/editmainmenu');
      $this->load->view('includes/footer');


     }else
     {

      if(isset($_POST['ispublished']))
        {
            $ispublished = 1;
        }else
        {
            $ispublished = 0;
        }

        $data=array(
          'menuLocation'=>$_POST['menulocation'],
          'menuUrl'=>$_POST['maincorrespondingpage'],
          'menuTitle'=>$_POST['title'],
          'menuStatus'=>$ispublished
        );

     $result = $this->Contents->updateMainMenu($id,$data);

     if($result==1)
       {
        $this->session->set_flashdata('msg_success', 'Successfully Updated');
       }else{
        $this->session->set_flashdata('msg_error', 'Unable to update, try later');
       }

       redirect('Dashboard/editmainmenu/'.$id);



     }

}




function menu_priority_update()
{

      $result = $this->Contents->menu_priority_update();

      echo $result;
}



function submenu_priority_update()
{

      $result = $this->Contents->submenu_priority_update();

      echo $result;
}


function deletemenu()
{
  $result = $this->Contents->deletemenu();

      echo $result;
}


function editsubmenu($submenuId="", $parentid="")
{

    $data['title']="Edit sub menus";
     $data['menucontents']=$this->Contents->getallcontents();
     $data['parentmenu']=$this->Contents->getallheadermenus('menus');
      $data['submenu']=$this->Contents->getsubmenubyid($submenuId);

       $data['parentid']=$parentid;
       $data['submenuId']=$submenuId;
      


    $this->form_validation->set_rules('parentMenu', 'Parent menu', 'required');
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('maincorrespondingpage', 'corresponding page', 'required'); 
   
    

    if ($this->form_validation->run() == FALSE) { 
    
    
      $this->load->view('includes/header',$data);
      $this->load->view('dashboard/editsubmenu');
      $this->load->view('includes/footer');

    }else
    {

     


        if(isset($_POST['ispublished']))
        {
            $ispublished = 1;
        }else
        {
            $ispublished = 0;
        }


      $data=array(
        'subMenuTilte'=>trim($_POST['title']),
        'subMenuUrl'=>trim($_POST['maincorrespondingpage']),
        'menuId'=>trim($_POST['parentMenu']),
        'subMenuStatus'=>$ispublished
      );



       $result = $this->Contents->updateSubMenu($submenuId,$data);
       if($result==1)
       {
        $this->session->set_flashdata('msg_success', 'Successfully inserted');
       }else{
        $this->session->set_flashdata('msg_error', 'Unable to insert, try later');
       }
      

         redirect('Dashboard/editsubmenu/'.$submenuId.'/'.$parentid);
       



    }
  
}

function settings()
{
        $data['title']="settings";
        $this->load->view('includes/header',$data);
        $this->load->view('dashboard/settings');
        $this->load->view('includes/footer');
}


function homepagesetting()
{

 $this->form_validation->set_rules('maincorrespondingpage', 'corresponding page', 'required'); 
   if ($this->form_validation->run() == FALSE)
    { 

  $data['menucontents']=$this->Contents->getallcontents();
  $data['title']="Home page settings";
        $this->load->view('includes/header',$data);
        $this->load->view('dashboard/homepagesetting');
        $this->load->view('includes/footer');
    }
    else
    {
     

      $result = $this->Contents->updatehomepagesetting($_POST['maincorrespondingpage']);

       if($result==1)
       {
        $this->session->set_flashdata('msg_success', 'Successfully inserted');
       }else{
        $this->session->set_flashdata('msg_error', 'Unable to insert, try later');
       }
      

         redirect('Dashboard/homepagesetting/');

    }

}



function mailforwardsetting()
{

 $this->form_validation->set_rules('Primaryemail','Primary Email', 'required|valid_email');
 $this->form_validation->set_rules('Carboncopy','Carbon copy','required|valid_email');  

if(isset($_POST['Primaryemail']) && $_POST['Carboncopy'])
{
  $this->form_validation->set_rules('Carboncopy','Carbon copy','required|valid_email|callback_check_equalEmail['.$_POST['Primaryemail'].']');

    $this->form_validation->set_message('check_equalEmail','Same emails are not allowed');
  
}
 
   if ($this->form_validation->run() == FALSE)
    { 

  $data['mail']=$this->Contents->getforwardingmail();
  $data['title']="Mail settings";
        $this->load->view('includes/header',$data);
        $this->load->view('dashboard/mailforwardsetting');
        $this->load->view('includes/footer');
    }
    else
    {
     
     $data=array(
      'PrimaryEmail'=>$_POST['Primaryemail'],
      'CarbonCopy'=>$_POST['Carboncopy']
     );


      $result = $this->Contents->updatemailforwardsetting($data);

       if($result==1)
       {
        $this->session->set_flashdata('msg_success', 'Successfully Updated');
       }else{
        $this->session->set_flashdata('msg_error', 'Unable to insert, try later');
       }
      

         redirect('Dashboard/mailforwardsetting/');

    }

}


function check_equalEmail($Carboncopy, $primary)
{

  
    if($primary==$Carboncopy)
    {
       return false;
    }else
    {
        return true;
    }

}


function viewenquiry()
{

   $data['title']="List messages";

   $data['messages']=$this->Contents->getallmessages();
   $this->load->view('includes/header',$data);
   $this->load->view('dashboard/allenquiry');
   $this->load->view('includes/footer');

}

public function viewmessage($id="")
{

   $data['title']="View messages";

   $message=$this->Contents->getmessage($id);
   $data['name']=$message->name;
   $data['phone']=$message->phone;
   $data['email']=$message->email;
   $data['message']=$message->message;
   $data['time']=$message->created_at;
   

   $this->load->view('includes/header',$data);
   $this->load->view('dashboard/viewmessage');
   $this->load->view('includes/footer');

}
 
function user()
{

    $this->form_validation->set_rules('password', 'password', 'required'); 
    $this->form_validation->set_rules('password1', 'confrom Password', 'required'); 
    $this->form_validation->set_rules('password1', 'Confirm Password', 'required|matches[password]');
    

    if ($this->form_validation->run() == FALSE) { 
   $data['title']="update password";
   $this->load->view('includes/header',$data);
   $this->load->view('dashboard/user');
   $this->load->view('includes/footer');
 }
 else
 {


      $result = $this->Contents->updateuser(md5($_POST['password']));
       if($result==1)
       {
        $this->session->set_flashdata('msg_success', 'Successfully Updated');
       }else{
        $this->session->set_flashdata('msg_error', 'Unable to update, try later');
       }

       redirect('Dashboard');

 }

}


}
