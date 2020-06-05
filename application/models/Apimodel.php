<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apimodel extends CI_Model {

  
   
   function getcontent($pageurl)
   {
    $query = "select * from contents where contentUrl='$pageurl'";
    $res = $this->db->query($query);  
    return json_encode($res->result());
	 }


   function getcontent1($pageurl)
   {
    $query = "select * from contents where contentUrl='$pageurl'";
    $res = $this->db->query($query);  
    $result=$res->result();
    $content= array();
  
  $index=0;
foreach($result as $row)
    {

      $content[$index]=array(
        'ContentId'=>$row->contentId,
        'ContentType'=>$row->ContentType,
        'ContentTitle'=>$row->ContentTitle,
        'ContentUrl'=>$row->contentUrl,
        'isPublished'=>$row->isPublished,
        'isContactpage'=>$row->isContactpage,
        'Category'=>$row->category,
        'FeaturedImage'=>$row->FeaturedImage,
        'ContentMeta'=>$row->contentMeta,
        'Content'=>$row->content,
        'Content_more'=>array());


       $query1 = "select * from content_more where ContentId='$row->contentId' ORDER BY CourseMoreId ASC ";
       $res1 = $this->db->query($query1);  
       $result1=$res1->result();

          foreach($result1 as $row1)
             {
              $content[$index]['Content_more'][]=array(

                    'CourseMoreId'=>$row1->CourseMoreId,
                    'InfoTitle'=>$row1->InfoTitle,
                    'InfoMessage'=>$row1->InfoMessage,
                    'InfoBoxed'=>$row1->InfoBoxed

                );
             }
      

$index++;
    }
return json_encode($content,JSON_PRETTY_PRINT);
   }


function getevents($pageurl)
{
  if($pageurl=="past_events")
  {
    $type="past";
    $title="Past events";
  }else  if($pageurl=="upcoming_events")
  {
    $type="upcoming";
    $title="Upcoming events";
  }

     $query = "select * from contents where ContentType='Events' and category='$type'";
    $res = $this->db->query($query);  
    $result=$res->result();
    $content= array();


     $content[0]=array(
        
        
        'ContentTitle'=>$title,
        'ContentUrl'=>$pageurl,
        'isPublished'=>1,
        'isContactpage'=>0,
        'Category'=>'Events',
        'FeaturedImage'=>'',
        'ContentMeta'=>$title,
        'Content'=>"",
        'Content_more'=>array());

     foreach($result as $row)
             {
              $content[0]['Content_more'][]=array(

                    'CourseMoreId'=>$row->contentId,
                    'InfoTitle'=>$row->ContentTitle,
                    'InfoMessage'=>$row->content,
                    'InfoBoxed'=>"1"

                );
            }

            return json_encode($content,JSON_PRETTY_PRINT);
}

function getmenu($menutype)
{

     $query = "select * from menus where menuLocation='$menutype' ORDER BY menuPriority ASC";
    $res = $this->db->query($query);  
    $result=$res->result();
    $headermenu= array();
  
  if($menutype=="header")
  {
              $index=0;
               foreach($result as $row)
                {

              $headermenu[$index]=array(
                'menuTitle'=>$row->menuTitle,
                'menuUrl'=>$row->menuUrl,
              'headersubmenu'=>array());


              $query1 = "select * from submenu where menuId='$row->menuId' ORDER BY subMenuPriority ASC";

               $res1 = $this->db->query($query1);  
               $result1=$res1->result();

                  foreach($result1 as $row1)
                     {
                      $headermenu[$index]['headersubmenu'][]=array(

                            'subMenuTilte'=>$row1->subMenuTilte,
                            'subMenuUrl'=>$row1->subMenuUrl,
                             );
                     }





                $index++;
            }

  }else
  {
        foreach($result as $row)
       {

        $headermenu[]=array(
        'menuTitle'=>$row->menuTitle,
        'menuUrl'=>$row->menuUrl);
      
       }

  }

return json_encode($headermenu,JSON_PRETTY_PRINT);


}


function gethomepage()
{


     $response = array();
     $banner = array();
     $homepageContent=array();
     $course=array();
     $partners=array();

    $bannerQuery = "select * from banner where isPublished='1' ORDER BY BannerPriority ASC";
    $bannerRes = $this->db->query($bannerQuery);  
    $bannerResult=$bannerRes->result();

    foreach ($bannerResult as $row) 
    {
      $banner[]=array(
        'BannerTitle'=>$row->BannerTitle,
        'BannerText'=>$row->BannerText,
        'BannerImage'=>$row->BannerImage
      );


     
    }

    $response['banner'] = $banner;



    $HomepageQuery = "select * from contents where isHomepage='1' and isPublished='1'";
    $HomepageRes = $this->db->query($HomepageQuery);  
    $HomepageResult=$HomepageRes->result();

    foreach ($HomepageResult as $row) 
    {
      $homepageContent[]=array(
        'ContentTitle'=>$row->ContentTitle,
        'content'=>$row->content,
        'contentMeta'=>$row->contentMeta
      );


     
    }

    $response['homepageContent'] = $homepageContent;


    $CourseQuery = "select * from contents  where ContentType='Course' and isPublished='1'";
    $CourseRes = $this->db->query($CourseQuery);  
    $CourseResult=$CourseRes->result();

    foreach ($CourseResult as $row) 
    {
      $course[]=array(
        'ContentTitle'=>$row->ContentTitle,
        'content'=>$row->content,
        'contentMeta'=>$row->contentMeta,
        'contentUrl'=>$row->contentUrl,
        'FeaturedImage'=>$row->FeaturedImage,
        );


     
    }

    $response['course'] = $course;



$PartnersQuery = "select * from contents  where ContentType='Partners' and isPublished='1'";
    $PartnersRes = $this->db->query($PartnersQuery);  
    $PartnersResult=$PartnersRes->result();

    foreach ($PartnersResult as $row) 
    {
      $partners[]=array(
        'FeaturedImage'=>$row->FeaturedImage,
          );


     
    }

    $response['partners'] = $partners;





    return json_encode($response,JSON_PRETTY_PRINT);


}



public function insert_contact($contactData)
  {
      $this->db->insert('contacts', $contactData);
      return $this->db->insert_id();
  }


public function getforwardingmail()
{
  $q="select *  from contactformemail where emailId='1'";
  $res=$this->db->query($q);

  return $res->row();

}


}

//echo $this->db->last_query();