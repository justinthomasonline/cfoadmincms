<div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title"><?php echo $title;?></h3>
              </div>
              <div class="panel-body">
              
                <form action="<?php echo site_url('Dashboard/homepagesetting');?>" method="post" enctype="multipart/form-data">
            




                  <div class="form-group">
                    <label>Select Default home page</label>

              
                     <select class="form-control" id="maincorrespondingpage" name="maincorrespondingpage">
                      <option value=""> select </option>                           
                                    <?php 

                                 foreach($menucontents as $row)
                                  { ?>
                <option value="<?php echo $row['contentId'];?>" <?php if($row['isHomepage']=="1") echo "selected";?> ><?php echo $row['ContentTitle'];?> </option>       
                
                                 <?php 

                                  }
                                  ?>
                    </select>

          <span class="text-danger custom_error"> <?php echo form_error('maincorrespondingpage'); ?></span>
                  </div>






  <input type="submit" value="Update">

                  </div>

               
                </form>
              </div>
              </div>

          </div>