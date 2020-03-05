<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?=$this->e($title)?> | API Nux</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/static/plugins/fontawesome-free/css/all.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/static/plugins/select2/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/static/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
        <div class="container">
            <a href="/<?=$crumbs[0]?>/" class="navbar-brand">
                <img src="/static/img/logo.png" alt="A" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">PI-Nux</span>
            </a>
            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a href="/<?=$crumbs[0]?>/" class="nav-link">Home</a>
                    </li>
                    <?php
                    //Menu Scan
                    $modules = scandir("./modules/");
                    foreach($modules as $module){
                    if(is_dir("./modules/".$module) && !in_array($module,['.','..'])){?>
                    <li class="nav-item <?=($crumbs[1]==$module)? 'active':''?>">
                    <a href="/<?=$crumbs[0]?>/<?=$module?>/" class="nav-link<?php
                    if($_path[0]==$module) echo ' active';
                    ?>"><?=ucwords($module)?></a>
                    </li>
                    <?php }//if
                    }//foreach ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container<?=$_fluid?>">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> <?=$this->e($title)?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/<?=$crumbs[0]?>/">Home</a></li>
                    <?php
                    $crumb = "/".$crumbs[0]."/";
                    $cjml = count($crumbs);
                    for($n=1;$n<$cjml;$n++){
                        $crumb .= $crumbs[$n]."/";
                        if($cjml-1==$n){?>
                            <li class="breadcrumb-item"><?=ucwords($crumbs[$n])?></li>
                        <?php }else{ ?>
                            <li class="breadcrumb-item"><a href="<?=$crumb?>"><?=ucwords($crumbs[$n])?></a></li>
                        <?php }
                    } ?>
                </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container<?=$_fluid?>">
                <?=$this->section('content')?>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
        API Management
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; <?=date('Y')?> <a href="https://ibnux.github.io/" rel="nofollow">@ibnux</a> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="/static/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/static/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/static/js/adminlte.min.js"></script>
<!-- Select2 -->
<script src="/static/plugins/select2/js/select2.full.min.js"></script>

<?=$footerScript?>

</body>
</html>