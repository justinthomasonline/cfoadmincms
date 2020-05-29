function DeletePage(id)
{
	
sweetAlert({
  title: 'Are you sure?',
  text: "This action will delete pages as well as associated menus.",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then(function() {
   

			$.ajax({
      type:"POST",
      cache:false,
      url:$("#delete_url").val(),
      data:{id: id},
      success: function (data) {

        
        if(data==1)
        {
          
            sweetAlert(
			    'Deleted!',
			    'Your file has been deleted.',
			    'success'
			  );

           setTimeout(location.reload(), 90000);

        }

       
       
      }
    });




});
  



}



function DeleteBanner(id,path)
{



sweetAlert({
  title: 'Are you sure?',
  text: "This action will delete the banner.",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then(function() {
   

      $.ajax({
      type:"POST",
      cache:false,
      url:$("#delete_url").val(),
      data:{id: id,path: path},
      success: function (data) {

        
        if(data==1)
        {
          
            sweetAlert(
          'Deleted!',
          'Your file has been deleted.',
          'success'
        );

           setTimeout(location.reload(), 90000);

        }

       
       
      }
    });




});
  


}

function change_image(img,url,folder)
{



			$.ajax({
      type:"POST",
      cache:false,
      url:url,
      data:{img:img,folder:folder},
      success: function (data) {

        
        if(data==1)
        {
          
            sweetAlert(
			    'Deleted!',
			    'Your file has been deleted. Now you can upload a new image',
			    'success'
			  );

            $('#featuredimagefiled').hide();
            $('#featuredimagefilednew').show();

          

        }

       
       
      }
    });

}


function setpriority(newvalue,menulocation,existingvalue,menuId)
{
  
sweetAlert({
  title: 'Are you sure?',
  text: "This action will update menu priority.",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then(function() {


 $.ajax({
      type:"POST",
      cache:false,
      url:$("#menu_priority_update").val(),
      data:{newvalue:newvalue,existingvalue:existingvalue,menulocation:menulocation,menuId:menuId},
      success: function (data) {

        
        if(data==1)
        {
          
            sweetAlert(
          'Updated!',
          'Your menu priority has been updated. Now you can upload a new image',
          'success'
        );

            setTimeout(location.reload(), 90000);

          

        }

       
       
      }
    });
 

});


}

function sortmenu(option)
{


  if(option=="all")
  {
  $(".menu_row").show();
  }else if(option=="header")
  {
  $(".header").show();
  $(".footer").hide();
  }else if(option=="footer")
  {
  $(".header").hide();
  $(".footer").show();
  }
}


function setprioritysubmenu(newvalue,existingvalue,submenuId,url)
{
  
sweetAlert({
  title: 'Are you sure?',
  text: "This action will update sub menu priority.",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then(function() {


 $.ajax({
      type:"POST",
      cache:false,
      url:url,
      data:{newvalue:newvalue,existingvalue:existingvalue,submenuId:submenuId},
      success: function (data) {

        
        if(data==1)
        {
          
            sweetAlert(
          'Updated!',
          'Your sub menu priority has been updated. Now you can upload a new image',
          'success'
        );

            setTimeout(location.reload(), 100000);

          

        }

       
       
      }
    });
 

});


}


function Deletemenu(menuId,url,menutype)
{
sweetAlert({
  title: 'Are you sure?',
  text: "This action will delete the menu option.",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then(function() {
   

      $.ajax({
      type:"POST",
      cache:false,
      url:url,
      data:{menuId: menuId,menutype: menutype},
      success: function (data) {

        
        if(data==1)
        {
          
            sweetAlert(
          'Deleted!',
          'Your menu has been deleted.',
          'success'
        );

           setTimeout(location.reload(), 90000);

        }

       
       
      }
    });




});
  


}
