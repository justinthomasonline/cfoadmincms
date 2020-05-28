<div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title"><?php echo $title;?></h3>
              </div>
              <div class="panel-body">
              
          <input type="hidden" value="<?php echo site_url('Dashboard/checkpriority');?>" id="check_priority">
                <form action="<?php echo site_url('Dashboard/addsubmenus');?>" method="post">
                    <div class="form-group">
                    <label>Parent Menu</label>
                    <select class="form-control" id="parentMenu" name="parentMenu">
                          <option value="">Select</option>
                              <?php 

                                 foreach($parentmenu as $row)
                                  { ?>
                          <option value="<?php echo $row['menuId'];?>" <?php echo set_select('parentMenu',$row['menuId']); ?>><?php echo strtoupper($row['menuTitle']);?></option>
                
                                 <?php 

                                  }
                                  ?>
                    </select>


             <span class="text-danger custom_error" id="parentMenu_error"> <?php echo form_error('parentMenu'); ?></span>
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
           <option value="<?php echo $row['contentUrl'];?>" <?php echo set_select('maincorrespondingpage',  $row['contentUrl']); ?> > <?php echo strtoupper($row['ContentTitle']);?></option>
                
                                 <?php 

                                  }
                                  ?>
                    </select>

          <span class="text-danger custom_error"> <?php echo form_error('maincorrespondingpage'); ?></span>
                  </div>



        <div class="form-group">
                    <label>Menu priority</label>
              
                     <select class="form-control" name="priority" id="priority">
                          <option value="">Select</option>
                        
                                  <?php 

                                  for($i=1; $i<=10; $i++)
                                  { 
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                  }

                                  ?>
                    </select>

                <span class="text-danger"> <?php echo form_error('priority'); ?></span>

                  </div>



   <div class="checkbox">
                    <label>
                      <input type="checkbox" name="ispublished"  checked> Published
                    </label>
                  </div>




  <input type="submit" value="Submit" id="addsubmenusubmit">

                  </div>

               
                </form>
              </div>
              </div>

          </div>