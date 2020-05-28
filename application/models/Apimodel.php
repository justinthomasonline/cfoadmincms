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
        'Category'=>$row->category,
        'FeaturedImage'=>$row->FeaturedImage,
        'ContentMeta'=>$row->contentMeta,
        'Content'=>$row->content,
        'Content_more'=>array());


       $query1 = "select * from content_more where ContentId='$row->contentId'";
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




}

//echo $this->db->last_query();