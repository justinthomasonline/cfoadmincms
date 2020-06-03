$(document).ready(function(){

var i=2;

$('#generatecontent').click(function(){
   
    var url= $("#ckeditor_img_url").val();
    var elm = `
<script>
    CKEDITOR.replace( 'editor`+i+`', {
        height:200,
        filebrowserUploadUrl:'`+url+`',
        allowedContent: true
      });
      </script>             
      
      <div class="form-group">
                    <label>Information  Title</label>
                    <input type="text" class="form-control infotitle" placeholder="Information Title" name="infoTitle[]" >
                    <span class="text-danger custom_error"></span>
                  </div>

                  <div class="form-group">
                    <label>Information Body</label>
                    <textarea id="editor`+i+`" class="form-control infoMsg" placeholder="Page Body" name="infoMessage[]">
                    
                    </textarea>
                    <span class="text-danger custom_error`+i+`"></span>

                  </div>

                  <div class="checkbox">
                  <label>
                    <input type="checkbox" name="infoBoxed[]"  > Boxed
                  </label>
                </div>
                  <hr>
    
    `;
$("#dynamic-content").append(elm);

i++;
    
});

$("#FormSubmit").submit(function(e){
  
  e.preventDefault();
  var self=this;


  

  var error_msg_title = ""; 
  var error_msg_content_url = ""; 
  var error_msg_editor1="";
  var error_meta_data="";
  var error_featuredimage_extention="";
  var error_featuredimage_size=""

  if($("#title").val() == "")
  {
    error_msg_title = "Title is a required filed ";
    $("#title_error").html(error_msg_title);
    $("#title_error").addClass('is-invalid');
  }else{
    error_msg_title = "";
    $("#title_error").html(error_msg_title);
    $("#title_error").removeClass('is-invalid');

  }



  if($("#cke_editor1 iframe").contents().find("body").text() == "")
  {
   
    error_msg_editor1 = "Page body is a required filed";
    $("#editor1_error").html(error_msg_editor1);
    $("#editor1_error").addClass('is-invalid');
  }else
  {
   
    error_msg_editor1 = "";
    $("#editor1_error").html(error_msg_editor1);
    $("#editor1_error").removeClass('is-invalid');
  }


  if($("#meta_data").val()=="")
  {
    error_meta_data = "Meta data is a required filed ";
    $("#meta_error").html(error_meta_data);
    $("#meta_error").addClass('is-invalid');
  }else{
    
    error_msg_data = "";
    $("#meta_error").html(error_meta_data);
    $("#meta_error").removeClass('is-invalid');
  }


  $(".infotitle").each(function(){

    if(this.value=="")
    {
      $(this).next('.text-danger').html('This is a requird filed');
      $(this).next('.text-danger').addClass('is-invalid');
    }else
    {
      $(this).next('.text-danger').html('');
      $(this).next('.text-danger').removeClass('is-invalid');
    }


  });

  

  var counter=2;
  $(".infoMsg").each(function(){
    
    

    if($("#cke_editor"+counter+" iframe").contents().find("body").text() == "")
    {
      $('.custom_error'+counter).html('This is a requird filed');
      $('.custom_error'+counter).addClass('is-invalid');
    }else
    {
      $('.custom_error'+counter).html('');
      $('.custom_error'+counter).removeClass('is-invalid');
    }

    counter++;
  });





if($('#featuredimage').is(":visible"))

{

  var method = location.pathname.split('/').pop();

  if(method=="addcourses")
  {
            if ($('#featuredimage').get(0).files.length  != 0)     
           {
                          var featured_image_size=$('#featuredimage')[0].files[0].size;
                          var featured_image_extension=$('#featuredimage').val().replace(/^.*\./, '');

                      if( featured_image_size<=87031)
                      {
                        error_featuredimage_size="";
                        
                      }else
                      {
                        
                        error_featuredimage_size="has error";
                      }
                      
                    
                      if(featured_image_extension=="jpg" || featured_image_extension=="jpeg" ||featured_image_extension=="png")
                      {
                    
                        error_featuredimage_extention="";
                      
                      }else
                      { 
                    
                        error_featuredimage_extention="has error";
                      }
                      
                      
                      
                      if(error_featuredimage_extention !="" || error_featuredimage_size !="" )
                      {
                        
                        error_featured_image="The file must be either jpg, jpeg, png with file size less than 87031";
                        $("#featured_image_error").html(error_featured_image);
                        $("#featured_image_error").addClass('is-invalid');
                      }else{
                        error_featured_image="";
                        $("#featured_image_error").html(error_featured_image);
                        $("#featured_image_error").removeClass('is-invalid');
                      }

          }else{

                        error_featured_image="Featured image is required";
                        $("#featured_image_error").html(error_featured_image);
                        $("#featured_image_error").addClass('is-invalid');

          }


}

  }




  if($("#content_url").val() == "")
  {
    error_msg_content_url = "Content url is a required filed";
    $("#content_url_error").html(error_msg_content_url);
    $("#content_url_error").addClass('is-invalid');
  }else
  {
    
  
    $.ajax({
      type:"POST",
      cache:false,
      url:$("#ajax_check_unique").val(),
      data:{content_url: $("#content_url").val()},
      success: function (data) {
        if(data==0)
        {
          
          error_msg_content_url = "Content url is already in use";
          $("#content_url_error").html(error_msg_content_url);
          $("#content_url_error").addClass('is-invalid');
        }else
        {
          error_msg_content_url = "";
          $("#content_url_error").html(error_msg_content_url);
          $("#content_url_error").removeClass('is-invalid');
        }

        var num_is_invlaid = $('.is-invalid').length; 
        if(num_is_invlaid==0)
          {
           self.submit();
          }else
          {
            return false;
          }
       
      }
    });

   
  }



  



 
});








var j=$("#edit_dy_count").val();

$("#editgeneratecontent").click(function(){


    var url= $("#ckeditor_img_url").val();
    var elm = `
<script>
    CKEDITOR.replace( 'editor`+j+`', {
        height:200,
        filebrowserUploadUrl:'`+url+`'
      });
      </script>             
      
      <div class="form-group">
                    <label>Information  Title</label>
                    <input type="text" class="form-control infotitle" placeholder="Information Title" name="infoTitle1[]" >
                    <span class="text-danger custom_error"></span>
                  </div>

                  <div class="form-group">
                    <label>Information Body</label>
                    <textarea id="editor`+j+`" class="form-control infoMsg" placeholder="Page Body" name="infoMessage1[]">
                    
                    </textarea>
                    <span class="text-danger custom_error`+j+`"></span>

                  </div>

                  <div class="checkbox">
                  <label>
                    <input type="checkbox" name="infoBoxed1[]"> Boxed
                  </label>
                </div>
                  <hr>
    
    `;
$("#dynamic-content").append(elm);

j++;
    



});






$("#EditFormSubmit").submit(function(e){
  
  e.preventDefault();
  var self=this;

  var error_msg_title = ""; 
  var error_msg_content_url = ""; 
  var error_msg_editor1="";
  var error_meta_data="";
  var error_featuredimage_extention="";
  var error_featuredimage_size=""


 if($("#title").val() == "")
  {
    error_msg_title = "Title is a required filed ";
    $("#title_error").html(error_msg_title);
    $("#title_error").addClass('is-invalid');
  }else{
    error_msg_title = "";
    $("#title_error").html(error_msg_title);
    $("#title_error").removeClass('is-invalid');

  }



 


  if($("#meta_data").val()=="")
  {
    error_meta_data = "Meta data is a required filed ";
    $("#meta_error").html(error_meta_data);
    $("#meta_error").addClass('is-invalid');
  }else{
    
    error_msg_data = "";
    $("#meta_error").html(error_meta_data);
    $("#meta_error").removeClass('is-invalid');
  }


  $(".infotitle").each(function(){

    if(this.value=="")
    {
      $(this).next('.text-danger').html('This is a requird filed');
      $(this).next('.text-danger').addClass('is-invalid');
    }else
    {
      $(this).next('.text-danger').html('');
      $(this).next('.text-danger').removeClass('is-invalid');
    }


  });

  

  var counter=1;
  $(".infoMsg").each(function(){
    
    

    if($("#cke_editor"+counter+" iframe").contents().find("body").text() == "")
    {
      $('.custom_error'+counter).html('This is a requird filed');
      $('.custom_error'+counter).addClass('is-invalid');
    }else
    {
      $('.custom_error'+counter).html('');
      $('.custom_error'+counter).removeClass('is-invalid');
    }

    counter++;
  });


//   if ($('#featuredimage').get(0).files.length  != 0)     
//  {
//                 var featured_image_size=$('#featuredimage')[0].files[0].size;
//                 var featured_image_extension=$('#featuredimage').val().replace(/^.*\./, '');

//             if( featured_image_size<=87031)
//             {
//               error_featuredimage_size="";
              
//             }else
//             {
              
//               error_featuredimage_size="has error";
//             }
            
          
//             if(featured_image_extension=="jpg" || featured_image_extension=="jpeg" ||featured_image_extension=="png")
//             {
          
//               error_featuredimage_extention="";
            
//             }else
//             { 
          
//               error_featuredimage_extention="has error";
//             }
            
            
            
//             if(error_featuredimage_extention !="" || error_featuredimage_size !="" )
//             {
              
//               error_featured_image="The file must be either jpg, jpeg, png with file size less than 87031";
//               $("#featured_image_error").html(error_featured_image);
//               $("#featured_image_error").addClass('is-invalid');
//             }else{
//               error_featured_image="";
//               $("#featured_image_error").html(error_featured_image);
//               $("#featured_image_error").removeClass('is-invalid');
//             }

// }


   if($("#content_url").val() == "")
  {
    error_msg_content_url = "Content url is a required filed";
    $("#content_url_error").html(error_msg_content_url);
    $("#content_url_error").addClass('is-invalid');
  }else
  {
    
  
    $.ajax({
      type:"POST",
      cache:false,
      url:$("#ajax_check_unique").val(),
      data:{content_url: $("#content_url").val(), contentId: $('#contentId').val()},
      success: function (data) {

        
        if(data==0)
        {
          
          error_msg_content_url = "Content url is already in use";
          $("#content_url_error").html(error_msg_content_url);
          $("#content_url_error").addClass('is-invalid');
        }else
        {
          error_msg_content_url = "";
          $("#content_url_error").html(error_msg_content_url);
          $("#content_url_error").removeClass('is-invalid');
        }

        var num_is_invlaid = $('.is-invalid').length; 
        if(num_is_invlaid==0)
          {
           self.submit();
          }else
          {
            return false;
          }
       
      }
    });

   
  }




    return false;
  });







$("#EditFormCourse").submit(function(e)
  {



  e.preventDefault();
  var self=this;

  var error_msg_title = ""; 
  var error_msg_content_url = ""; 
  var error_msg_editor1="";
  var error_meta_data="";
  var error_featuredimage_extention="";
  var error_featuredimage_size=""


 if($("#title").val() == "")
  {
    error_msg_title = "Title is a required filed ";
    $("#title_error").html(error_msg_title);
    $("#title_error").addClass('is-invalid');
  }else{
    error_msg_title = "";
    $("#title_error").html(error_msg_title);
    $("#title_error").removeClass('is-invalid');

  }



 


  if($("#meta_data").val()=="")
  {
    error_meta_data = "Meta data is a required filed ";
    $("#meta_error").html(error_meta_data);
    $("#meta_error").addClass('is-invalid');
  }else{
    
    error_msg_data = "";
    $("#meta_error").html(error_meta_data);
    $("#meta_error").removeClass('is-invalid');
  }


  $(".infotitle").each(function(){

    if(this.value=="")
    {
      $(this).next('.text-danger').html('This is a requird filed');
      $(this).next('.text-danger').addClass('is-invalid');
    }else
    {
      $(this).next('.text-danger').html('');
      $(this).next('.text-danger').removeClass('is-invalid');
    }


  });

  

  var counter=1;
  $(".infoMsg").each(function(){
    
    

    if($("#cke_editor"+counter+" iframe").contents().find("body").text() == "")
    {
      $('.custom_error'+counter).html('This is a requird filed');
      $('.custom_error'+counter).addClass('is-invalid');
    }else
    {
      $('.custom_error'+counter).html('');
      $('.custom_error'+counter).removeClass('is-invalid');
    }

    counter++;
  });




if($("#featuredimagefilednew").is(":visible"))
{
  if ($('#featuredimage').get(0).files.length  == 0)     
 {

             error_featured_image="Course image is a requird filed";
              $("#featured_image_error").html(error_featured_image);
              $("#featured_image_error").addClass('is-invalid');

 }else{
                var featured_image_size=$('#featuredimage')[0].files[0].size;
                var featured_image_extension=$('#featuredimage').val().replace(/^.*\./, '');

            if( featured_image_size<=87031)
            {
              error_featuredimage_size="";
              
            }else
            {
              
              error_featuredimage_size="has error";
            }
            
          
            if(featured_image_extension=="jpg" || featured_image_extension=="jpeg" ||featured_image_extension=="png")
            {
          
              error_featuredimage_extention="";
            
            }else
            { 
          
              error_featuredimage_extention="has error";
            }
            
            
            
            if(error_featuredimage_extention !="" || error_featuredimage_size !="" )
            {
              
              error_featured_image="The file must be either jpg, jpeg, png with file size less than 87031";
              $("#featured_image_error").html(error_featured_image);
              $("#featured_image_error").addClass('is-invalid');
            }else{
              error_featured_image="";
              $("#featured_image_error").html(error_featured_image);
              $("#featured_image_error").removeClass('is-invalid');
            }

}

}

   if($("#content_url").val() == "")
  {
    error_msg_content_url = "Content url is a required filed";
    $("#content_url_error").html(error_msg_content_url);
    $("#content_url_error").addClass('is-invalid');
  }else
  {
    
  
    $.ajax({
      type:"POST",
      cache:false,
      url:$("#ajax_check_unique").val(),
      data:{content_url: $("#content_url").val(), contentId: $('#contentId').val()},
      success: function (data) {

        
        if(data==0)
        {
          
          error_msg_content_url = "Content url is already in use";
          $("#content_url_error").html(error_msg_content_url);
          $("#content_url_error").addClass('is-invalid');
        }else
        {
          error_msg_content_url = "";
          $("#content_url_error").html(error_msg_content_url);
          $("#content_url_error").removeClass('is-invalid');
        }

        var num_is_invlaid = $('.is-invalid').length; 
        if(num_is_invlaid==0)
          {
           self.submit();
          }else
          {
            return false;
          }
       
      }
    });

   
  }

    

    return false;
  });






$("#EditBanner").submit(function(e){

e.preventDefault();
  var self=this;

var  error_msg_title="";
var errot_msg_bannertext="";
var error_featured_image="";
var error_featuredimage_size="";
var error_featuredimage_extention="";
var error_msg_priority = "";
 

  if($("#title").val() == "")
  {
    error_msg_title = "Title is a required filed ";
    $("#title_error").html(error_msg_title);
    $("#title_error").addClass('is-invalid');
  }else{
    error_msg_title = "";
    $("#title_error").html(error_msg_title);
    $("#title_error").removeClass('is-invalid');

  }


  if($("#bannertext").val() == "")
  {
    error_msg_bannertext = "Title is a required filed ";
    $("#bannertext_error").html(error_msg_title);
    $("#bannertext_error").addClass('is-invalid');
  }else{
    error_msg_bannertext = "";
    $("#bannertext_error").html(error_msg_title);
    $("#bannertext_error").removeClass('is-invalid');

  }







  if($("#featuredimagefilednew").is(":visible"))
{
  if ($('#featuredimage').get(0).files.length  == 0)     
 {

             error_featured_image="Course image is a requird filed";
              $("#featured_image_error").html(error_featured_image);
              $("#featured_image_error").addClass('is-invalid');

 }else{
                var featured_image_size=$('#featuredimage')[0].files[0].size;
                var featured_image_extension=$('#featuredimage').val().replace(/^.*\./, '');

                
            if( featured_image_size<='907031')
            {
              error_featuredimage_size="";
              
            }else
            {
              
              error_featuredimage_size="has error";
            }
            
          
            if(featured_image_extension=="jpg" || featured_image_extension=="jpeg" ||featured_image_extension=="png")
            {
          
              error_featuredimage_extention="";
            
            }else
            { 
          
              error_featuredimage_extention="has error";
            }
            
            
            
            if(error_featuredimage_extention !="" || error_featuredimage_size !="" )
            {
              
              error_featured_image="The file must be either jpg, jpeg, png with file size less than 207031";
              $("#featured_image_error").html(error_featured_image);
              $("#featured_image_error").addClass('is-invalid');
            }else{
              error_featured_image="";
              $("#featured_image_error").html(error_featured_image);
              $("#featured_image_error").removeClass('is-invalid');
            }





}

}



 if($("#Priority").val() == "")
  {
    error_msg_priority = "Title is a required filed ";
    $("#priority_error").html(error_msg_priority);
    $("#priority_error").addClass('is-invalid');
  }else{


    $.ajax({
      type:"POST",
      cache:false,
      url:$("#ajax_check_unique").val(),
      data:{priority: $("#Priority").val(), id: $('#bannerid').val()},
      success: function (data) {

        
        if(data==0)
        {
          
          error_msg_priority = "Priority is already in use";
          $("#priority_error").html(error_msg_priority);
          $("#priority_error").addClass('is-invalid');
        }else
        {
          error_msg_priority = "";
          $("#priority_error").html(error_msg_priority);
          $("#priority_error").removeClass('is-invalid');
        }

        var num_is_invlaid = $('.is-invalid').length; 
        if(num_is_invlaid==0)
          {
           self.submit();
          }else
          {
            return false;
          }
       
      }
    });
   

  } 




   




return false;
});







});



