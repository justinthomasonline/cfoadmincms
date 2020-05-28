<div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Add Banners</h3>
              </div>
              <div class="panel-body">


                <form action="<?php echo site_url('Dashboard/addbanners');?>" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Banner Title</label>
                    <input type="text" class="form-control" placeholder="Page Title" id="title" name="title" value="<?=set_value('title')?>">
                    <span class="text-danger custom_error" id="title_error"> <?php echo form_error('title'); ?></span>
                  </div>

                

                  <div class="form-group">
                    <label>Banner Text</label>
            <textarea name="bannertext" class="form-control" id="bannertext" placeholder="Page Body"><?php echo set_value('bannertext'); ?> </textarea>
                    <span class="text-danger custom_error"> <?php echo form_error('bannertext'); ?></span>

                  </div>

                            


                  <div class="form-group">
                    <label>Banner Image</label>
                    <input type="File" class="form-control" id="featuredimage" name="featured_image" accept=".jpg,.jpeg,.png" >
                    <span class="text-danger custom_error" id="featured_image_error"><?php echo form_error('featured_image');?></span>
                  </div>
                  


                    <div class="form-group">
                    <label>Priority</label>
                    <select class="form-control" name="Priority">
                      <option value=""> Select</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>


                    </select>
                    <span class="text-danger custom_error"><?php echo form_error('Priority');?></span>
                  </div>



                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="ispublished"  checked> Published
                    </label>
                  </div>


                <input type="submit" value="Submit">
                </form>
              </div>
              </div>

          </div>