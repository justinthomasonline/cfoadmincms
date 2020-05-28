<div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Add Banners</h3>
              </div>
              <div class="panel-body">

              	<input type="hidden" value="<?php echo base_url('Dashboard/check_unique_banner_priority');?> " id="ajax_check_unique">
                <form action="<?php echo site_url('Dashboard/editbanner');?>" method="post" id="EditBanner" enctype="multipart/form-data">

                	<input type="hidden" name="bannerid" id="bannerid" value="<?php echo $banner[0]['BannerId'];?>">
                  <div class="form-group">
                    <label>Banner Title</label>
                    <input type="text" class="form-control" placeholder="Page Title" id="title" name="title" value="<?= set_value('title', $banner[0]['BannerTitle']);?>">
                    <span class="text-danger custom_error" id="title_error"> <?php echo form_error('title'); ?></span>
                  </div>

                

                  <div class="form-group">
                    <label>Banner Text</label>
            <textarea name="bannertext" class="form-control" id="bannertext" placeholder="Page Body"><?= set_value('bannertext', $banner[0]['BannerText']);?></textarea>
                    <span class="text-danger custom_error" id="bannertext_error"> <?php echo form_error('bannertext'); ?></span>

                  </div>

                      


                  <?php 

              if(file_exists('upload/banners/'. $banner[0]['BannerImage']))
                  { ?>
                  <div class="form-group" style="" id="featuredimagefiled">
                    <label>Banner Image</label>
                   <img src="<?php echo base_url('upload/banners');?>/<?php echo $banner[0]['BannerImage'];?>" style="width:20%; height:auto"/>

                   <a href="javascript:void(0)" onclick="change_image('<?php echo $banner[0]['BannerImage'];?>','<?php echo site_url('Dashboard/change_image');?>','banners')" class="btn btn-danger btn-sm pull-right align-middle">Change Image</a>
                   <input type="hidden" value="<?php echo $banner[0]['BannerImage'];?>" name="old_featured_img" />
                  </div>

                <?php  } else { ?>

                  <style type="text/css">
                    #featuredimagefilednew
                    {
                      display: block;
                                         
                  </style>

                <?php } ?>





                  <div class="form-group" id="featuredimagefilednew">
                    <label>Banner Image</label>
                    <input type="File" class="form-control" id="featuredimage" name="featured_image" accept=".jpg,.jpeg,.png" >
                    <span class="text-danger custom_error" id="featured_image_error"><?php echo form_error('featured_image');?></span>
                  </div>
                  


                    <div class="form-group">
                    <label>Priority</label>
                    <select class="form-control" name="Priority" id="Priority">
                      <option value=""> Select</option>
                      <option value="1" <?php if($banner[0]['BannerPriority']=="1") echo "selected";?> >1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>


                    </select>
                    <span class="text-danger custom_error" id="priority_error"><?php echo form_error('Priority');?></span>
                  </div>



                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="ispublished"  <?php if($banner[0]['isPublished']=="1") echo "checked";?> > Published
                    </label>
                  </div>


                <input type="submit" value="Submit">
                </form>
              </div>
              </div>

          </div>