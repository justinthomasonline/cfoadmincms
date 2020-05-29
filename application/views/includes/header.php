<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Dashboard</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
   <script src="//cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
    
    
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
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
          <a class="navbar-brand" href="#">AdminStrap</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.html">Dashboard</a></li>
            <li><a href="<?php echo site_url('Dashboard/banners');?>">Home</a></li>
            <li><a href="<?php echo site_url('Dashboard/pages');?>">Pages</a></li>
            <li><a href="">Posts</a></li>
            <li><a href="">Users</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Welcome, Brad</a></li>
            <li><a href="login.html">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard <small>Manage Your Site</small></h1>
          </div>
          <div class="col-md-2">
            <div class="dropdown create">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Create Content
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a type="button" data-toggle="modal" data-target="#addPage">Add Page</a></li>
                <li><a href="#">Add Post</a></li>
                <li><a href="#">Add User</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="active">Dashboard</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="index.html" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <a href="<?php echo site_url('Dashboard/pages');?>" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Pages </a>
              <a href="<?php echo site_url('Dashboard/courses');?>" class="list-group-item"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> Courses </a>
              <a href="<?php echo site_url('Dashboard/events');?>" class="list-group-item"><span class="glyphicon glyphicon-blackboard" aria-hidden="true"></span> Events </a>
             


               <a href="<?php echo site_url('Dashboard/partners');?>" class="list-group-item"><span class="glyphicon glyphicon-pawn" aria-hidden="true"></span> Partners </a>

                <a href="<?php echo site_url('Dashboard/banners');?>" class="list-group-item"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Banners </a>
                

                 <a href="<?php echo site_url('Dashboard/menus');?>" class="list-group-item"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span> Menus </a>

               <!-- <a href="<?php echo site_url('Dashboard/submenus');?>" class="list-group-item"><span class="glyphicon glyphicon-align-center" aria-hidden="true"></span> sub menus </a> -->

               <a href="<?php echo site_url('Dashboard/settings');?>" class="list-group-item"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> settings </a>




              <a href="users.html" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users </a>
            </div>

            <div class="well">
              <h4>Disk Space Used</h4>
              <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                      60%
              </div>
            </div>
            <h4>Bandwidth Used </h4>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
                    40%
            </div>
          </div>
            </div>
          </div>