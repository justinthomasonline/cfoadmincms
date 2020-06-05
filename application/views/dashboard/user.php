<div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title"><?php echo $title;?></h3>
              </div>
              <div class="panel-body">
              
                <form action="<?php echo site_url('Dashboard/user');?>" method="post" enctype="multipart/form-data">
            




                  <div class="form-group">
                    <label>New password</label>
  <input type="password" class="form-control" name="password" >
  <span class="text-danger custom_error"> <?php echo form_error('password'); ?></span>
                  </div>

                   <div class="form-group">
                    <label>Confrim Password</label>
                    <input type="password" class="form-control" name="password1">
                    <span class="text-danger custom_error"> <?php echo form_error('password1'); ?></span>
                  </div>





  <input type="submit" value="Update">

                  </div>

               
                </form>
              </div>
              </div>

          </div>