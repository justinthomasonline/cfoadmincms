<div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title"><?php echo $title;?></h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <input type="hidden" id="delete_url" value="<?php echo site_url('Dashboard/ajax_deletecontent');?>" >
                      <div class="col-md-12">
                          <a href="<?php echo site_url('dashboard/addcourses');?>" class="btn btn-success btn-sm pull-right">New</a>
                      </div>
                </div>
                <br>
                <table class="table table-striped table-hover">
                      <tr>
                        <th>Title</th>
                        <th>Published</th>
                        <th>Content url</th>
                        <th></th>
                      </tr>
                    <?php foreach($pages as $page)
                        {?>
                                            <tr>
                                                <td><?php echo $page['ContentTitle'];?></td>
                                                <td><span class="glyphicon <?php if($page['isPublished']==1) { echo "glyphicon-ok"; } else echo "glyphicon-remove";?>" aria-hidden="true"></span></td>
                                                <td><?php echo $page['contentUrl'];?></td>
                                                <td><a class="btn btn-default" href="<?php echo site_url('Dashboard/editcourse/'.$page['contentId']);?>">Edit</a>

   <a class="btn btn-danger" onclick="DeletePage('<?php echo $page['contentId'];?>')" href="javascript:void(0)">Delete</a>

                                                </td>
                                            </tr>
                                            <tr>

                        <?php } ?>                      
                        
                    </table>
              </div>
              </div>

          </div>