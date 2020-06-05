<div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title"><?php echo $title;?></h3>
              </div>
              <div class="panel-body">
             
                <br>
                <table class="table table-striped table-hover">
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>View</th>
                      </tr>
                    <?php foreach($messages as $msg)
                        {
                           if($msg['status']==0) { 
                              $bgcolor="#fff"; 
                            }
                              else { $bgcolor="#ddd"; }
                          ?>
                                            <tr style="background-color: <?=$bgcolor;?>">
                                                <td><?php echo $msg['name'];?></td>
                                                <td><?php echo $msg['email'];?></td>
                                                <td><?php echo $msg['phone'];?></td>
                                                <td>
                                                  <a href="<?php echo site_url('Dashboard/viewmessage/'.$msg['id']);?>"> view</a>
                                                </td>
                                            </tr>
                                            

                        <?php } ?>                      
                        
                    </table>
              </div>
              </div>

          </div>