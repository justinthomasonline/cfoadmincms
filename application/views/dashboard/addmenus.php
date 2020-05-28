<div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title"><?php echo $title;?></h3>
              </div>
              <div class="panel-body">
              
                <form action="<?php echo site_url('Dashboard/addmenus');?>" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Menu Location</label>
                   <?php
                         $menulocation = [
                          NULL=>'select',
                          'header'  => 'Header Menu',
                          'footer'    => 'Footer Menu',
                            ]; 

               echo form_dropdown('menulocation', $menulocation,set_value('menulocation'), 'class="form-control"');   
                   ?>


             <span class="text-danger custom_error" id="title_error"> <?php echo form_error('menulocation'); ?></span>
                  </div>


                   <div class="form-group">
                    <label>Menu Title</label>
                    <input type="text" class="form-control" placeholder="Menu Title" id="title" name="title" value="<?=set_value('title')?>">
                    <span class="text-danger custom_error" id="title_error"> <?php echo form_error('title'); ?></span>
                  </div>


                  <div class="form-group">
                    <label>curresponding page</label>

              
                     <select class="form-control" id="maincorrespondingpage" name="maincorrespondingpage">
                          <option value="">Select</option>
                        <option value="blank">Blank Page</option>
                                  <?php 

                                 foreach($menucontents as $row)
                                  { ?>
                          <option value="<?php echo $row['contentUrl'];?>" <?php echo set_select('maincorrespondingpage',  $row['contentUrl']); ?>><?php echo $row['ContentTitle'];?> - <?php echo $row['ContentType'];?></option>
                
                                 <?php 

                                  }
                                  ?>
                    </select>

          <span class="text-danger custom_error" id="title_error"> <?php echo form_error('maincorrespondingpage'); ?></span>
                  </div>



        <div class="form-group">
                    <label>Menu priority</label>
              
                     <select class="form-control" name="priority">
                          <option value="">Select</option>
                        
                                  <?php 

                                  for($i=1; $i<=10; $i++)
                                  { 
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                  }

                                  ?>
                    </select>

                <span class="text-danger " id="title_error"> <?php echo form_error('priority'); ?></span>

                  </div>



   <div class="checkbox">
                    <label>
                      <input type="checkbox" name="ispublished"  checked> Published
                    </label>
                  </div>




  <input type="submit" value="Submit">

                  </div>

               
                </form>
              </div>
              </div>

          </div>