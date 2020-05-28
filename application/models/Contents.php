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
    $query = "select * from $table ORDER BY menuId ASC";
    $res = $this->db->query($query);  
    return $res->result("array");
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


   function getsubmenus()
   {
    $query = "select * from submenu";
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


function updateMainMenu($id)
{
  

 $query = "select * from menus where menuPriority='$_POST[priority]' and menuLocation= '$_POST[menulocation]' ";

  $res = $this->db->query($query); 

      $existing = $res->result();
        echo $this->db->last_query();


exit();
  if(isset($_POST['ispublished']))
        {
            $ispublished = 1;
        }else
        {
            $ispublished = 0;
        }

  if ($this->db->affected_rows()==1)
  {
       
      $data=array(
'menuTitle'=>$_POST['title'],
'menuUrl'=>$_POST['maincorrespondingpage'],
'menuLocation'=>$_POST['menulocation'],
'menuPriority'=>$_POST['priority'],
'menuStatus'=>$ispublished
      );

   // $this->db->where('menuId', $id);
   // $this->db->update('menus', $data);

  }else
  {
         
      $q1= "select * from menus where menuPriority='$_POST[priority]' and menuLocation= '$_POST[menulocation]' and menuId<>'$id' ";
      $res = $this->db->query($q1); 

      $existing = $res->result();
        echo $existing->menuId;
  }
 

 echo $this->db->last_query(); exit();
 return 1;


 // if($priority == $_POST['priority'])
 // {

 // }


}


}

//echo $this->db->last_query();