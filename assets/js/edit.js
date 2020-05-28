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
  text: "This action will the banner.",
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