<div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title"><?php echo $title;?></h3>
              </div>
              <div class="panel-body">
                <div class="row">
                      <div class="col-md-12">
                          <a href="<?php echo site_url('dashboard/addmenus');?>" class="btn btn-success btn-sm pull-right">New</a>
                      </div>
                </div>
                <br>
                <table class="table table-striped table-hover">
                      <tr>
                        <th>Menu</th>
                        <th>Menu Location</th>
                        <th>Pages</th>
                        <th>Action</th>
                      </tr>
                    <?php foreach($pages as $page)
                        {?>
                                            <tr>
                                                <td><?php echo strtoupper($page['menuTitle']);?></td>
                                                <td><?php echo $page['menuLocation'];?></td>
                                                <td><?php echo $page['menuUrl'];?></td>
         <td><a class="btn btn-default" href="<?php echo site_url('Dashboard/editmainmenu/'.$page['menuId']);?>">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                                            </tr>
                                            <tr>

                        <?php } ?>                      
                        
                    </table>
              </div>
              </div>

          </div>