<div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title"><?php echo $title;?></h3>
              </div>
              <div class="panel-body">
              
                <form action="<?php echo site_url('Dashboard/editmainmenu/'.$id);?>" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Menu Location</label>
                   <?php
                         $menulocation = [
                          NULL=>'select',
                          'header'  => 'Header Menu',
                          'footer'    => 'Footer Menu',
                            ]; 

               echo form_dropdown('menulocation', $menulocation,set_value('menulocation',$mainmenu[0]['menuLocation']), 'class="form-control"');   
                   ?>


             <span class="text-danger custom_error" id="title_error"> <?php echo form_error('menulocation'); ?></span>
                  </div>


                   <div class="form-group">
                    <label>Menu Title</label>
                    <input type="text" class="form-control" placeholder="Menu Title" id="title" name="title" value="<?=set_value('title', $mainmenu[0]['menuTitle'])?>">
                    <span class="text-danger custom_error" id="title_error"> <?php echo form_error('title'); ?></span>
                  </div>


                  <div class="form-group">
                    <label>curresponding page</label>

              
                     <select class="form-control" id="maincorrespondingpage" name="maincorrespondingpage">
                          <option value="">Select</option>
                        <option value="blank" <?php if($mainmenu[0]['menuUrl']=='blank') echo "selected";?> >Blank Page</option>
                                  <?php 

                                 foreach($menucontents as $row)
                                  { ?>
                          <option value="<?php echo $row['contentUrl'];?>" <?php if($mainmenu[0]['menuUrl']==$row['contentUrl']) echo "selected"; ?> ><?php echo $row['ContentTitle'];?> - <?php echo $row['ContentType'];?></option>
                
                                 <?php 

                                  }
                                  ?>
                    </select>

          <span class="text-danger custom_error" id="title_error"> <?php echo form_error('maincorrespondingpage'); ?></span>
                  </div>



       



   <div class="checkbox">
                    <label>
                      <input type="checkbox" name="ispublished"  <?php if( $mainmenu[0]['menuStatus'] == "1") echo "checked"; ?>> Published
                    </label>
                  </div>




  <input type="submit" value="Submit">

                  </div>

               
                </form>
              </div>
              </div>

          </div>