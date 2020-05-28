<div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Edit course</h3>
              </div>
              <div class="panel-body">
               <input type="hidden" value="<?php echo site_url('Dashboard/ajax_check_unique_updation');?>" id="ajax_check_unique" >




               <input type="hidden" value="<?php echo site_url('Dashboard/upload');?>" id="ckeditor_img_url" >

            
                <form action="<?php echo site_url('Dashboard/editcourse');?>" method="post" id="EditFormCourse" enctype="multipart/form-data">
                  <input type="hidden" value="<?php echo $pages[0]['contentId'];?>" name="contentId" id="contentId">
                  <div class="form-group">
                    <label>Page Title</label>
                    <input type="text" class="form-control" placeholder="Page Title" id="title" name="title" value="<?= set_value('title', $pages[0]['ContentTitle']);?> ">
                    <span class="text-danger custom_error" id="title_error"> <?php echo form_error('title'); ?></span>
                  </div>

                  <div class="form-group">
                    <label>Page url (space will be replaced with _ )</label>
                    <input type="text" class="form-control" id="content_url" placeholder="page url" name="content_url" value="<?=set_value('content_url', $pages[0]['contentUrl']); ?>">
                    <span class="text-danger custom_error" id="content_url_error"> <?php echo form_error('content_url'); ?></span>
                  </div>

                  <div class="form-group">
                    <label>Page Body</label>
                    <textarea  name="editor"  id="editor1" class="form-control infoMsg" placeholder="Page Body"><?=set_value('editor1', $pages[0]['content']); ?>
                    
                    </textarea>
                    <span class="text-danger custom_error1"></span>

                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="ispublished" <?php if($pages[0]['isPublished']=="1")  echo "checked";?>> Published
                    </label>
                  </div>
                  
                  <div class="form-group">
                    <label>Meta Description</label>
                    <input type="text" class="form-control" id="meta_data" placeholder="Add Meta Description..." name="meta_data" value="<?=set_value('meta_data',$pages[0]['contentMeta'] )?>">
                    <span class="text-danger custom_error" id="meta_error"> <?php echo form_error('meta_data'); ?></span>
                  </div>
                  


                
                  

              <?php 

              if(file_exists('upload/course/'. $pages[0]['FeaturedImage']))
                  { ?>
                  <div class="form-group" style="" id="featuredimagefiled">
                    <label>Featrured Image</label>
                   <img src="<?php echo base_url('upload/course');?>/<?php echo $pages[0]['FeaturedImage'];?>" style="with:20%; height:auto"/>

                   <a href="javascript:void(0)" onclick="change_image('<?php echo $pages[0]['FeaturedImage'];?>','<?php echo site_url('Dashboard/change_image');?>','course')" class="btn btn-danger btn-sm pull-right align-middle">Change Image</a>
                   <input type="hidden" value="<?php echo $pages[0]['FeaturedImage'];?>" name="old_featured_img" />
                  </div>

                <?php  } else { ?>

                  <style type="text/css">
                    #featuredimagefilednew
                    {
                      display: block;
                                         
                  </style>

                <?php } ?>


                  <div class="form-group" id="featuredimagefilednew">
                    <label>Featrured Image</label>
                    <input type="File" class="form-control" id="featuredimage" name="featured_image" >
                    <span class="text-danger custom_error" id="featured_image_error"></span>
                  </div>


                  <hr>

                  <div id="dynamic-content">

                    <?php $i=2; foreach($pages[0]['content_more'] as $cm)

                    {
                      ?>

         
                    <input type="hidden" value="<?php echo $cm['CourseMoreId'];?>" name="CourseMoreId[]">  
                    <div class="form-group">
                    <label>Information  Title</label>
                    <input type="text" class="form-control infotitle" placeholder="Information Title" name="infoTitle[]" value="<?php echo $cm['InfoTitle'];?>" >
                    <span class="text-danger custom_error"></span>
                  </div>

                  <div class="form-group">
                    <label>Information Body</label>
                    <textarea id="editor<?php echo $i;?>" class="form-control infoMsg" placeholder="Page Body" name="infoMessage[]">
                    <?php echo $cm['InfoMessage'];?>
                    </textarea>
                    <span class="text-danger custom_error<?php echo $i;?>"></span>

                  </div>

                  <div class="checkbox">
                  <label>
                    <input type="checkbox" name="infoBoxed[]"  <?php if($cm['InfoBoxed']=="1") echo "checked"; ?> > Boxed
                  </label>
                </div>
                  <hr>

                               <script>
    CKEDITOR.replace( 'editor<?php echo $i;?>', {
        height:200,
        filebrowserUploadUrl:'<?php echo site_url('Dashboard/upload');?>'
      });
      </script> 

                <?php $i++;} 

                ?>
                <input type="hidden" id="edit_dy_count" value="<?php echo $i;?>">

                            
                            
                            </div>

                  <div class="row">
                      <div class="col-md-12">
                         <a href="javascript:void(0)" id="editgeneratecontent" class="btn btn-success btn-sm pull-right"> More Informatio</a>
                      </div>
                </div>

                <input type="submit" value="Submit" name="btn_edit_form">
               
                </form>
              </div>
              </div>

          </div>