<div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Add Page</h3>
              </div>
              <div class="panel-body">
              <input type="hidden" value="<?php echo site_url('Dashboard/upload');?>" id="ckeditor_img_url" >
              <input type="hidden" value="<?php echo site_url('Dashboard/ajax_check_unique');?>" id="ajax_check_unique" >
                <form action="<?php echo site_url('Dashboard/addpages');?>" method="post" id="FormSubmit" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Page Title</label>
                    <input type="text" class="form-control" placeholder="Page Title" id="title" name="title" value="<?=set_value('title')?>">
                    <span class="text-danger custom_error" id="title_error"> <?php echo form_error('title'); ?></span>
                  </div>

                  <div class="form-group">
                    <label>Page url (space will be replaced with _ )</label>
                    <input type="text" class="form-control" id="content_url" placeholder="page url" name="content_url" value="<?=set_value('content_url')?>">
                    <span class="text-danger custom_error" id="content_url_error"> <?php echo form_error('content_url'); ?></span>
                  </div>

                  <div class="form-group">
                    <label>Page Body</label>
                    <textarea name="editor1" class="form-control" placeholder="Page Body">
                    
                    </textarea>
                    <span class="text-danger custom_error" id="editor1_error"> <?php echo form_error('editor1'); ?></span>

                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="ispublished"  checked> Published
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="iscontact"  > Add contact form
                    </label>
                  </div>

                  <!-- <div class="form-group">
                    <label>Meta Tags</label>
                    <input type="text" class="form-control" placeholder="Add Some Tags..." value="tag1, tag2">
                  </div> -->
                  <div class="form-group">
                    <label>Meta Description</label>
                    <input type="text" class="form-control" id="meta_data" placeholder="Add Meta Description..." name="meta_data" value="<?=set_value('meta_data')?>">
                    <span class="text-danger custom_error" id="meta_error"> <?php echo form_error('meta_data'); ?></span>
                  </div>
                  


                 <!--  <div class="form-group">
                    <label>Featrured Image</label>
                    <input type="File" class="form-control" id="featuredimage" name="featured_image" >
                    <span class="text-danger custom_error" id="featured_image_error"></span>
                  </div> -->
                  

                  <hr>

                  <div id="dynamic-content">
                            
                            
                            </div>

                  <div class="row">
                      <div class="col-md-12">
                         <input type="button" id="generatecontent" class="btn btn-success btn-sm pull-right" value="More Information">
                      </div>
                </div>

                <input type="submit" value="Submit">
               
                </form>
              </div>
              </div>

          </div>