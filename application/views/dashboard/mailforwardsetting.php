<div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title"><?php echo $title;?></h3>
              </div>
              <div class="panel-body">
              
                <form action="<?php echo site_url('Dashboard/mailforwardsetting');?>" method="post" enctype="multipart/form-data">
            




                  <div class="form-group">
                    <label>Primary Email</label>
  <input type="text" class="form-control" name="Primaryemail" 
  value="<?=set_value('Primaryemail', $mail->PrimaryEmail)?>">
  <span class="text-danger custom_error"> <?php echo form_error('Primaryemail'); ?></span>
                  </div>

                   <div class="form-group">
                    <label>Carbon copy</label>
                    <input type="text" class="form-control" name="Carboncopy" 
                    value="<?=set_value('Carboncopy',$mail->CarbonCopy)?>" >
                    <span class="text-danger custom_error"> <?php echo form_error('Carboncopy'); ?></span>
                  </div>





  <input type="submit" value="Update">

                  </div>

               
                </form>
              </div>
              </div>

          </div>