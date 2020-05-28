</div>
      </div>
    </section>

    <footer id="footer">
      <p>Copyright AdminStrap, &copy; 2017</p>
    </footer>

 

  <script>
     CKEDITOR.replace( 'editor1', {
       height:300,
       filebrowserUploadUrl:"<?php echo site_url('Dashboard/upload');?>",
       filebrowserUploadMethod :'form'
      
     });

    </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/dynamiccontent.js"></script>
    <script src="<?php echo base_url();?>assets/js/priority_validation.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/edit.js"></script>
    
    <?php 
              if($this->session->flashdata('msg_success'))
              { ?>
               <script>
                    $(document).ready(function(){
                                              sweetAlert(
                          '<?php echo $this->session->flashdata('msg_success');?>',
                          'success'
                        )
                    });
             </script>
             <?php  }else if($this->session->flashdata('msg_error'))
              { ?>
               <script>
                    $(document).ready(function(){
                      sweetAlert({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: '<?php echo $this->session->flashdata('msg_success');?>',
                                            footer: '<a href>Why do I have this issue?</a>'
                                          })
             });
    </script>
        <?php }  ?>



  </body>
</html>
