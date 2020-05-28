<div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title"><?php echo $title;?></h3>
              </div>
              <div class="panel-body">
                <div class="row">

                  <input type="hidden" id="delete_url" value="<?php echo site_url('Dashboard/ajax_deletebanner');?>" >
                      <div class="col-md-12">
                         <?php if(count($pages)<=5) { ?>
                          <a href="<?php echo site_url('dashboard/addbanners');?>" class="btn btn-success btn-sm pull-right">New</a>
                           <?php }else{
                           echo "Maximum limit reached"; 
                           } ?>
                      </div>
                </div>
                <br>
                <table class="table table-striped table-hover">
                      <tr>
                        <th>Title</th>
                        <th>Published</th>
                        <th>Priority</th>
                         <th>Image</th>
                        <th></th>
                        <th></th>

                      </tr>
                    <?php foreach($pages as $page)
                        {?>
                                            <tr>
                                                <td><?php echo $page['BannerTitle'];?></td>
                                                <td><span class="glyphicon <?php if($page['isPublished']==1) { echo "glyphicon-ok"; } else echo "glyphicon-remove";?>" aria-hidden="true"></span></td>
                                                <td><?php echo $page['BannerPriority'];?></td>
                                                <td>
  <img src="<?php echo base_url('upload/banners/');?><?php echo $page['BannerImage'] ;?>"  style="width:50%; height: auto"> 
                                                  </td>
                                               <td style="vertical-align: bottom;">
                                                  <a class="btn btn-default" href="<?php echo site_url('Dashboard/editbanner/'.$page['BannerId']);?>">Edit</a> 

                                                  </td>
                                                  <td style="vertical-align: bottom;">
     <a class="btn btn-danger" onclick="DeleteBanner('<?php echo $page['BannerId'];?>','<?php echo 'upload/banners/'.$page['BannerImage']; ?>')" href="javascript:void(0)">Delete</a>

                                                  </td>
                                            </tr>
                                            
                                              
                                            

                        <?php } ?>                      
                        
                    </table>
              </div>
              </div>

          </div>