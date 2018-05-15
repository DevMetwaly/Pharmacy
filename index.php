<?php 
ob_start();
session_start();
include_once './php/MYSQLi.php';
if($_GET["page"]=="login" && $_SESSION['user'] ==""){
include "pages/login.php";
die();
}elseif($_GET['page']=="login") {
	header('Location: ./home');
}elseif(($_GET["page"]=="home" || $_GET["page"]=="index" || $_GET["page"]=="") && $_SESSION['user'] ==""){
	header('Location: ./login');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PHARMAX</title>
    <link rel="icon" href="Logo.png">
    
    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/pharmax.css" rel="stylesheet">
	<link href="<?=(!isset($_COOKIE["theme"]) || $_COOKIE["theme"]=="")?"dist/css/style1.css" :$_COOKIE["theme"]?> " rel="stylesheet" id="appTheme">

	
    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		
	<link href="vendor/jquery/jquery-ui.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="vendor\morrisjs\morris.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index">PHARMAX<span>PRO</span></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="./notifications#notf_soon">
                                <div>
                                    <i class="fa fa-warning fa-fw"></i> 
                                        <span>
                                            <?
                                                $res=$db->fetch("SELECT COUNT(*) as ExpireSoon
                                                            FROM proudcts p 
                                                            JOIN medicines m on p.Medicine_ID=m.Medicin_ID
                                                            where Expire_Date >= (NOW() -    INTERVAL 3 MONTH ) ; 
                                                ",false);
                                                echo ($res["ExpireSoon"]);
                                            ?>
                                        </span> Medicines expire soon
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="./notifications#notf_exp">
                                <div>
                                    <i class="fa fa-warning fa-fw"></i>
                                         <span>
                                            <?
                                                $res=$db->fetch("SELECT COUNT(*) as Expired
                                                            FROM proudcts p 
                                                            JOIN medicines m on p.Medicine_ID=m.Medicin_ID
                                                            where Expire_Date < NOW(); 
                                                ",false);
                                                echo ($res["Expired"]);
                                            ?>
                                        </span> Medicines expired
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="./notifications#notf_stock">
                                <div>
                                    <i class="fa fa-warning fa-fw"></i> 
                                         <span>
                                            <?
                                                $res=$db->fetch("SELECT COUNT(*) as Stock
                                                                FROM proudcts p
                                                                JOIN medicines m on p.Medicine_ID=m.Medicin_ID 
                                                                where Quantity < 10; 
                                                ",false);
                                                echo ($res["Stock"]);
                                            ?>
                                        </span> Medicines out of stock
                                </div>
                            </a>
                        </li>
                        
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="notifications">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="settings_acc"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="settings_app"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="#"  onclick="Send('php/Login.php?action=logout','GET',function(){  window.location = './login';});"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-profile">
                            <div class="profile-image">
                                <img src="<?=(isset($_SESSION["user"]["Image"]))?$_SESSION["user"]["Image"]:"./image/default-user.png";?>">
                            </div>
                            <div class="profile-info">
                                Welcome,<br>
                                <span> <a id="profile-li" href="./settings_acc"><?=$_SESSION["user"]["FName"]; ?></a>! </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="home"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Reports<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="sales"> Sales</a>
                                </li>
								<li>
                                    <a href="logs"> Logs</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Tables<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level permission">
                                <li>
                                    <a href="pharmacies">Pharmacies</a>
                                </li>
                                <li>
                                    <a href="employees">Employees</a>
                                </li>
                                <li>
                                    <a href="customers">Customers</a>
                                </li>
                                <li>
                                    <a href="invoices">Invoices</a>
                                </li>
								<li>
                                    <a href="inventory">Inventory</a>
                                </li>
                                <li>
                                    <a href="medicines">Medicines</a>
                                </li>
                                <li>
                                    <a href="suppliers">Suppliers</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level permission">
                                <li>
                                    <a href="ctrl_invoices">Invoices</a>
                                </li>
                                <li>
                                    <a href="ctrl_pharmacies">Pharmacies</a>
                                </li>
                                <li>
                                    <a href="ctrl_employees">Employees</a>
                                </li>
                                <li>
                                    <a href="ctrl_customers">Customers</a>
                                </li>
                                <li>
                                    <a href="ctrl_medicines">Medicines</a>
                                </li>
                                <li>
                                    <a href="ctrl_suppliers">Suppliers</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Organize<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="notifications">Notifications</a>
                                </li>
                                <li>
                                    <a href="schedule">Schedule</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Settings<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="settings_app">App Settings</a>
                                </li>
                                <li>
                                    <a href="settings_acc">Account Settings</a>
                                </li>
                                <li>
                                    <a href="settings">General Settings</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
		
        <?php	$page = $_GET['page'].'.php';
			$sdir = './pages/';
			$pages = scandir($sdir);
			//echo $page;
			if (in_array($page,$pages) && $page!="index.php") {
			    include $sdir.$page;
			}elseif($page=="index.php" || $page==".php"){
				include $sdir.'home.php';
			}else{
				include $sdir.'blank.php';
			}
		?>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <footer>
              PHARMAX WEB APPLICATION - Created by "Database Ghosts Team" - Supervised by Dr. Amany Sarhan.
    </footer>
    

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>
	<!-- DataTables JavaScript -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>
	<!-- Morris Charts JavaScript -->
    <script src="vendor/raphael/raphael.min.js"></script>
    <script src="vendor/morrisjs/morris.min.js"></script>
   
    <!-- Custom Theme JavaScript -->
    <script src="dist/js/pharmax.js"></script>
	<script src="vendor/jquery/jquery-ui.js"></script>
	<script src="vendor/jquery/js.cookie.js"></script>
	<script>
		if(Cookies.get('theme')=="undefined"){
			Cookies.set('theme','dist/css/style1.css');
			theme = Cookies.get('theme');
		}
		<?
		if ($_SESSION["user"]["Type"] !='Admin'){	
		echo "$('ul.nav.nav-second-level.permission a').hide();";
		foreach($permission[$_SESSION["user"]["Type"]] as $per){
			echo "$('ul.nav.nav-second-level.permission a[href=".$per."]').show();";
		}
		}
		?>
	</script>

</body>

</html>
