
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootsrtap Free Admin Template -  | Admin Dashboad Template</title>

    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />

    <!-- Page-Level CSS -->
    <link href="assets/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
</head>

<body>
<!--  wrapper -->
<div id="wrapper">
    <!-- navbar top -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
        <!-- navbar-header -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <h2 style="color: white; padding-left: 15px;"><b>ZMCEP - ZANZIBAR</b></h2>
        </div>
        <!-- end navbar-header -->

        <!-- navbar-top-and-logout-links -->
        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-3x"></i>
                </a>
                <!-- dropdown user-->
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i>User Profile</a></li>

                    <li class="divider"></li>
                    <li><a href="login.php" style="color: red;"><i class="fa fa-sign-out fa-fw "></i>Logout</a></li>
                </ul>
                <!-- end dropdown-user -->
            </li>
            <!-- end main dropdown -->
        </ul>

    </nav>
    <div>
        <?php include ("LinkPage.php")?>
    </div>
    <!-- end navbar side -->
    <!--  page-wrapper -->
    <div id="page-wrapper" style="margin-top: -10px">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Forms Attendece</h1>
            </div>
            <div>
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Form Elements -->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <i class="fa fa-bar-chart-o fa-fw"></i>Simple Table Example
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                            Others Reports
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            <li><a href="#"></a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Another action</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Something else</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Separated link</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped">

                                                <?php
                                                include_once ('resources/User.php');
                                                include_once ('resources/connection.php');
                                                include_once ('resources/utilities.php');

                                                $db=connection::connect();
                                                if(isset($_GET['id'])){
                                                    $id = $_GET['id'];
                                                    $db = connection::connect();
                                                    $selectQuery = $db->prepare("delete from house_collect where collect_id=:id");
                                                    $selectQuery->bindParam(':id',$id);
                                                    if($selectQuery->execute()){
                                                        echo "Data Deleted";
                                                    }
                                                }
                                                try{

                                                    $querView=$db->prepare("select collect_id,house_owner,address,phone,gender,email,house_number from house_collect");

                                                    $querView->execute();
                                                    $querView->setFetchMode(PDO::FETCH_ASSOC);
                                                }catch (PDOException $expct){

                                                    echo "error imejitokeza".$expct->getMessage();

                                                }

                                                ?>

                                                <table class="table table-bordered table-hover table-striped">
                                                    <tr>
                                                        <!--<th>educator id</th>-->
                                                        <th>house owner</th>
                                                        <th>address</th>
                                                        <th>gender</th>
                                                        <th>phone_number</th>
                                                        <th>Email</th>
                                                        <th>house number</th>
                                                        <th>edit</th>

                                                    </tr>
                                                    <tbody>
                                                    <?php while($row=$querView->fetch()):?>
                                                        <tr>
                                                           <!-- <td><?=htmlspecialchars($row['collect_id'])?></td>-->
                                                            <td><?=htmlspecialchars($row['house_owner'])?></td>
                                                            <td><?= htmlspecialchars($row['address'])?></td>
                                                            <td><?= htmlspecialchars($row['gender'])?></td>
                                                            <td><?= htmlspecialchars($row['phone'])?></td>
                                                            <td><?= htmlspecialchars($row['email'])?></td>
                                                            <td><?= htmlspecialchars($row['house_number'])?></td>
                                                            <td>
                                                                <a class="btn btn btn-info col-md-6" href="../Taka_taka/HouseRegistedForm.php?id=<?=$row['collect_id']?>">
                                                                    <svg class="bi bi-pencil-square" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                                    </svg>
                                                                </a>

                                                                <a class="btn btn-danger col-md-6" href="?id=<?=$row['collect_id']?>">

                                                                    <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                                    </svg>
                                                                </a>

                                                            </td>

                                                        </tr>
                                                    <?php endwhile;?>
                                                    </tbody>
                                                </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="assets/plugins/jquery-1.10.2.js"></script>
<script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
<script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="assets/plugins/pace/pace.js"></script>
<script src="assets/scripts/siminta.js"></script>
<script src="assets/plugins/morris/raphael-2.1.0.min.js"></script>
<script src="assets/plugins/morris/morris.js"></script>
<script src="assets/scripts/dashboard-demo.js"></script>

</html>
