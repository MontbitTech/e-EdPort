<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
Refer https://www.youtube.com/watch?v=CVClHLwv-4I for face-api tutorial.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Pareeksha platform for conducting online examination.">
    <meta name="theme-color" content="#343a40">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta property="og:url" content="https://e-edport.com/" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="My Examination Performance - {Exam Code}" />
    <meta property="og:description" content="Details of my result here..." />

    <title>परीक्षा | {Examination Code} | Result</title>

    <!-- Setting Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('examination/dist/img/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('examination/dist/img/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('examination/dist/img/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('examination/dist/img/favicon/site.webmanifest')}}">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('examination/plugins/fontawesome-free/css/all.min.css')}}" media="none" onload="if(media!='all')media='all'">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('examination/dist/css/adminlte.min.css')}}" media="none" onload="if(media!='all')media='all'">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" media="none" onload="if(media!='all')media='all'">

</head>

<body onselectstart="return false" class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v8.0" nonce="zlMIPSAZ"></script>
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{asset('examination/dist/img/dps.png')}}" alt="" class="brand-image" style="opacity: .9">
                <span class="brand-text font-weight-light"> परीक्षा <span style="font-size: x-small;"> by
                        e-EdPort</span></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="font-size:medium;">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-puzzle-piece"></i>
                                <p>
                                    Result: <span class='examID'>{Exam Code}</span>
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#summary" class="nav-link">
                                        <i id="guidelines_button" class="far fa-circle fa-sm nav-icon"></i>
                                        <p> Performance Summary</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#myStrengthWeakness" class="nav-link">
                                        <i id="guidelines_button" class="far fa-circle fa-sm nav-icon"></i>
                                        <p> Strength & Weakness</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#comparison" class="nav-link">
                                        <i id="guidelines_button" class="far fa-circle fa-sm nav-icon"></i>
                                        <p> Classmate Comparison</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="advancedAnalytics" class="nav-link">
                                        <i id="guidelines_button" class="far fa-circle fa-sm nav-icon"></i>
                                        <p> Strength & Weakness</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-puzzle-piece"></i>
                                <p>
                                    Answer Key
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul id="questionList" class="nav nav-treeview">

                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div id="guidelines" class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Welcome, {User}</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right text-dark">
                                <li class="m-0 breadcrumb-item">Pareeksha</li>
                                <li class="m-0 breadcrumb-item"><span class='examID'>{Exam Code}</span></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="summary" class="card">
                                <div class="card-header">
                                    <h5 class="m-0 text-center">Performance Summary</h5>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Topic</th>
                                                <th style="width: 40px">Score</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Update software</td>
                                                <td><span class="badge bg-danger">55%</span></td>
                                            </tr>
                                            <tr>
                                                <td>Clean database</td>
                                                <td><span class="badge bg-warning">70%</span></td>
                                            </tr>
                                            <tr>
                                                <td>Cron job running</td>
                                                <td><span class="badge bg-primary">30%</span></td>
                                            </tr>
                                            <tr>
                                                <td>Fix and squish bugs</td>
                                                <td><span class="badge bg-success">90%</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php" class="fb-xfbml-parse-ignore">Share</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="strength" class="card">
                        <div class="card-header">
                            <h5 class="m-0 text-center">My Strength & Weakness</h5>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>

                    <div id="comparison" class="card">
                        <div class="card-header">
                            <h5 class="m-0 text-center">Classmate Comparison</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 569px;" width="1138" height="500" class="chartjs-render-monitor">
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
            <hr />
            <div id="questions" class="row"></div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script defer src="{{asset('examination/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script defer src="{{asset('examination/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- SweetAlert 2 -->
    <script defer src="{{asset('examination/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
    <!-- Chart JS -->
    <script src="{{asset('examination/plugins/chart.js/Chart.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script defer src="{{asset('examination/dist/js/adminlte.min.js')}}"></script>
    <!-- Result Integration -->
    <script defer src="{{asset('examination/dist/js/result.js')}}"></script>
    <!-- Lazy Image Load -->
    <script defer src="{{asset('examination/plugins/lazysizes/lazysizes.min.js')}}"></script>
    <!-- Getting Question Paper JSON -->
    <script>

    </script>
</body>

</html>