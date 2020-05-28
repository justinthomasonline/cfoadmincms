$(document).ready(function(){
	

$("#addsubmenusubmit").prop('disabled', true);
// submenu priority validation;
$("#parentMenu").change(function(){

       $("#priority").val("");
       
      $("#priority").children().each(function(i, opt){
            if($(opt).attr('disabled')){
                
                $(opt).attr("disabled", false);
              }
      });




if($("#parentMenu").val()!="")
{
         $.ajax({
      type:"POST",
      cache:false,
      url:$("#check_priority").val(),
      data:{parentId: $("#parentMenu  option:selected").val()},
      success: function (priorities)
		      {
		      	
     	      	$.each(JSON.parse(priorities), function(index, priority) 
		      	{
		  				$('#priority option[value="' + priority.subMenuPriority + '"]').prop('disabled', !priority.reportable);
				});

				$("#addsubmenusubmit").prop('disabled', false);
		       
		      }
    });


    }     

});








});