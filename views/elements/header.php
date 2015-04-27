<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Blog System</title>
      <link rel="stylesheet" href="http://localhost/SoftUni/Exam's/WebDev/MVC_WebDevProject/library/bootstrap/css/bootstrap.css">
      <link rel="stylesheet" href="http://localhost/SoftUni/Exam's/WebDev/MVC_WebDevProject/styles/bootstrap-theme.css">
      <script type="text/javascript" src="http://localhost/SoftUni/Exam's/WebDev/MVC_WebDevProject/library/jquery-2.1.3.js"></script>
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo HOME_URL ?>">BlogSystem</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="<?php echo ROOT_URL . 'posts/index'; ?>">Posts</a></li> 
                          <?php if($this->auth->isLogged()): ?>
                          <li><a href="<?php echo ROOT_URL . 'posts/add'; ?>">Add post</a></li>
                          <?php endif; ?>
<!--                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="#">Action</a></li>
                              <li><a href="#">Another action</a></li>
                              <li><a href="#">Something else here</a></li>
                              <li class="divider"></li>
                              <li><a href="#">Separated link</a></li>
                              <li class="divider"></li>
                              <li><a href="#">One more separated link</a></li>
                            </ul>
                          </li>
                        </ul>
                        <form class="navbar-form navbar-left" role="search">
                          <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                          </div>
                          <button type="submit" class="btn btn-default">Submit</button>
                        </form>-->
                        
                        <ul class="nav navbar-nav navbar-right">
                            <?php if(!$this->auth->isLogged()): ?>
                            <li><a href="<?php echo ROOT_URL . 'register/index'; ?>">Register</a></li>
                            <li><a href="<?php echo ROOT_URL . 'login/index'; ?>">LogIn</a></li>
                            <?php endif; ?>
                            <?php if($this->auth->isLogged()): ?>
                            <li><a href="<?php echo ROOT_URL . 'logout/index'; ?>">LogOut</a></li>
                            <?php endif; ?>
                        </ul>
                        
                    </div>
                </div>
            </nav>
            <?php if($this->errorMessage != NULL): ?>
            <div class="alert alert-dismissible alert-danger">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong><?= $this->errorMessage ?></strong>
            </div>
            <?php endif; ?>
            <?php if($this->successMessage != NULL): ?>
            <div class="alert alert-dismissible alert-success">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong><?= $this->successMessage ?></strong>
            </div>
            <?php endif; ?>
            <div class="row">
                <div class="btn-group-vertical col-xs-2">
                    <a href="#" class="btn btn-default">SideBarButton</a>
                    <a href="#" class="btn btn-default">SideBarButton</a>
                    <a href="#" class="btn btn-default">SideBarButton</a>
                    <a href="#" class="btn btn-default">SideBarButton</a>
                </div>
                <div class="btn-group-vertical col-xs-10">