<div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title"><?php echo $title;?></h3>
              </div>
              <div class="panel-body">
                <div class="row">
                      <div class="col-md-12">
                          <a href="<?php echo site_url('dashboard/addsubmenus');?>" class="btn btn-success btn-sm pull-right">New submenu</a>
                      </div>
                </div>
                <br>
                <table class="table table-striped table-hover">
                        <tr>
                        <th>Submenu Menu</th>
                        <th>Url</th>
                        <th>Priority</th>
                        <th>Parent menu</th>
                         <th>Action</th>
                        
                      </tr>
                    <?php foreach($submenu as $sub)
                        {?>
                        
                     <tr> 
                      <td><?php echo $sub['subMenuTilte'];?></td>
                      <td><?php echo $sub['subMenuUrl'];?></td>
                      <td><?php echo $sub['subMenuPriority'];?></td>
                      <td><?php echo $sub['menu'][0]['menuTitle'];?></td>
                       <td><a class="btn btn-default" href="<?php echo site_url('Dashboard/editsubmenus/'.$sub['subMenuId']);?>">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                    </tr>

                                            
                        <?php } ?>                      
                        
                    </table>
              </div>
              </div>

          </div>