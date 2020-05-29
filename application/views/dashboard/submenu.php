<div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title"><?php echo $title;?></h3>
              </div>
              <div class="panel-body">
                <div class="row">
                      <div class="col-md-12">
                          <a href="<?php echo site_url('dashboard/addsubmenus/'.$parentid);?>" class="btn btn-success btn-sm pull-right">New submenu</a>
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
                      <td>


     <select onchange="setprioritysubmenu(this.value,'<?php echo $sub['subMenuPriority'];?>','<?php echo $sub['subMenuId'];?>','<?php echo site_url('Dashboard/submenu_priority_update');?>')" >

                    <?php
                      for($pr=1; $pr<=$submenucount;$pr++)
                      {?>
<option value="<?php echo $pr;?>" <?php if($pr==$sub['subMenuPriority']) echo "selected";?> > 
  <?php echo $pr;?> </option>

    <?php }
  ?>





  

                        </td>
                      <td><?php echo $sub['menu'][0]['menuTitle'];?></td>
                       <td><a class="btn btn-default" href="<?php echo site_url('Dashboard/editsubmenu/'.$sub['subMenuId'].'/'.$sub['menu'][0]['menuId']);?>">Edit</a> 

<a class="btn btn-danger" onclick="Deletemenu('<?php echo $sub['subMenuId'];?>','<?php echo site_url('Dashboard/deletemenu');?>','submenu')" href="javascript:void(0)">Delete</a>


                       </td>
                    </tr>

                                            
                        <?php } ?>                      
                        
                    </table>
              </div>
              </div>

          </div>