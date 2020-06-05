<div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title"><?php echo $title;?></h3>
              </div>
              <div class="panel-body">
                <div class="row">
                      <div class="col-md-12">
                        <select onchange="sortmenu(this.value)" >
                          <option value="all">All</option> 
                          <option value="header">Header</option> 
                          <option value="footer">Footer</option> 
                        </select>


                          <a href="<?php echo site_url('dashboard/addmenus');?>" class="btn btn-success btn-sm pull-right">New</a>
                      </div>
                </div>
                <br>
                <input type="hidden" value="<?php echo site_url('Dashboard/menu_priority_update');?>" id="menu_priority_update">
                <table class="table table-striped table-hover">
                      <tr>
                        <th>Menu</th>
                        <th>Menu Location</th>
                        <th>Priority</th>
                        <th>Submenu</th>
                      <!--   <th>Pages</th> -->
                        <th>Action</th>
                      </tr>
                    <?php foreach($pages as $page)
                        {?>
                                            <tr class="<?php echo $page['menuLocation'];?> menu_row">
                                                <td><?php echo strtoupper($page['menuTitle']);?></td>
                                                <td><?php echo $page['menuLocation'];?></td>
                                                <td>
<select onchange="setpriority(this.value,'<?php echo $page['menuLocation'];?>','<?php echo $page['menuPriority'];?>','<?php echo $page['menuId'];?>')" >

  <?php if($page['menuLocation']=="header")
  {
    for($pr=2; $pr<=$headermenucount+1;$pr++)
    {?>
<option value="<?php echo $pr;?>" <?php if($pr==$page['menuPriority']) echo "selected";?> > 
  <?php echo $pr;?> </option>

    <?php }
  }else if($page['menuLocation']=="footer")


   {
    for($pr=2; $pr<=$footermenucount+1;$pr++)
    {?>
<option value="<?php echo $pr;?>" <?php if($pr==$page['menuPriority']) echo "selected";?> > 
  <?php echo $pr;?> </option>

    <?php }
  }

  

    ?>


</select>
                                               
                                                    


                                                  </td>

                                                  <td>

                                  <?php if($page['menuLocation']=="header")
                                      {
                                        ?>

                           <a href="<?php echo site_url('Dashboard/addsubmenus/'.$page['menuId']);?>"> Add</a> /

                            <a href="<?php echo site_url('Dashboard/submenus/'.$page['menuId']);?>"> View</a>

                         <?php }else {echo "Not applicable";} ?>

                                                  </td>

                                                <!-- <td><?php echo $page['menuUrl'];?></td> -->
         <td><a class="btn btn-default" href="<?php echo site_url('Dashboard/editmainmenu/'.$page['menuId']);?>">Edit</a> 


            <a class="btn btn-danger" onclick="Deletemenu('<?php echo $page['menuId'];?>','<?php echo site_url('Dashboard/deletemenu');?>','mainmenu')" href="javascript:void(0)">Delete</a>

         </td>
                                            </tr>
                                            <tr>

                        <?php } ?>                      
                        
                    </table>
              </div>
              </div>

          </div>