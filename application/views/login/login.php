<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Account Login</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
  </head>
  <body>

    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">cfoman.org</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-center"> cfoman  <small>Account Login</small></h1>
          </div>
        </div>
      </div>
    </header>

    <section id="main">
      <div class="container">
        <div class="row">
        <div class="col-md-4 col-md-offset-4 text-danger">
          <?php 
              if($this->session->flashdata('msg'))
              {
                echo $this->session->flashdata('msg');
              }
          ?>
        </div>
          <div class="col-md-4 col-md-offset-4">
            <form method="post" action="<?php echo site_url('Welcome/index');?>" class="well">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Enter Username" value="<?=set_value('username')?>">
                    <span class="text-danger"> <?php echo form_error('username'); ?></span>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" value="<?=set_value('password')?>">
                    <span class="text-danger"><?php echo form_error('password'); ?></span>
                  </div>
                  
                  <button type="submit" class="btn btn-default btn-block">Login</button>
              </form>
          </div>
        </div>
      </div>
    </section>

    

    <footer id="footer">
      <p>Copyright AdminStrap, &copy; 2017</p>
    </footer>

  <script>
     CKEDITOR.replace( 'editor1' );
 </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
  </body>
</html>
