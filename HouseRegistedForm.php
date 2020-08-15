



<!DOCTYPE html>
<html>
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
    <?php include_once ("resources/connection.php");
    include_once ('resources/utilities.php');



    try {

        if (isset($_POST['save'])) {
            $ownername = $_POST['house_owner'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $house_number = $_POST['house_number'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            $db = connection::connect();

            $sqlInsert = $db->prepare("insert into house_collect(house_owner,phone,email,gender,house_number,address) values (:house_owner,:phone,:email,:gender,:house_number,:address)");
            $sqlInsert->bindParam("house_owner",$ownername);
            $sqlInsert->bindParam("address",$address);
            $sqlInsert->bindParam("email",$email);
            $sqlInsert->bindParam("phone",$phone);
            $sqlInsert->bindParam("gender",$gender);
            $sqlInsert->bindParam("house_number", $house_number);
            $sqlInsert->execute();



            $userQuery = $db->prepare("INSERT INTO users(username,password,role) VALUES (:username,:password,:role)");
            $userQuery->bindParam(":username",$house_number);
            $userQuery->bindValue(":password","zanzibar2020");
            $userQuery->bindValue(":role","owner");
            $execQuery = $userQuery -> execute();



                        if($sqlInsert->rowCount()==1){


                            //var_dump($sqlInsert);
                            $result= "<p style='color: green;padding: 20px;'>data zimfia kwenye table</p>";
                         }else{
                            echo "said kibondee";
                            }


        }
    }catch(PDOException $error){
//        echo "<h1>hello</h1>";
//        var_dump($_POST);
        $result= "<p style='color: red;padding: 20px;'>data hazijafika kwenye table</p>".$error->getMessage();

    }

        if(isset($_POST['update'])) {
            $db = connection::connect();


            $house_owner = $_POST['house_owner'];
             $address = $_POST['address'];
             $gender = $_POST['gender'];
             $phone = $_POST['phone'];
            $email = $_POST['email'];
            $house_number = $_POST['house_number'];
            $edu_id=$_GET['id'];


            $sqlUpdate=$db->prepare("update house_collect set house_owner=:house_owner,address=:address,gender=:gender,phone=:phone,email=:email,house_number=:house_number where collect_id=:collect_id");
            $sqlUpdate->bindParam(':house_owner', $house_owner);
            $sqlUpdate->bindParam(':address', $address);
            $sqlUpdate->bindParam(':gender', $gender);
            $sqlUpdate->bindParam(':phone', $phone);
            $sqlUpdate->bindParam(':email', $email);
            $sqlUpdate->bindParam(':house_number', $house_number);
            $sqlUpdate->bindParam(':collect_id',$edu_id);

            if($sqlUpdate->execute()){
                echo "update success";
            }else{
                echo "errror is apper";
            }

        }

            if (isset($_GET['id'])) {

                $id = $_GET['id'];
                $db = connection::connect();
                $sqlSelect = $db->prepare("select * from house_collect where collect_id=:id");
                $sqlSelect->bindParam(':id', $id);
                if ($sqlSelect->execute()) {
                    $collect = $sqlSelect->fetchObject();
                }

            }







    ?>



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
                <h1 class="page-header">TRASH &nbsp; COLLECTING</h1>
            </div>
            <div>
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Form Elements -->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <i class="#"></i><b>House Registed Form
                            <?php include("FormsLinks.php");?>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped">
                                                <form action="#" method="post">
                                                    <?php if(isset($result)) echo $result;
                                                    //var_dump($_POST)
                                                    ?>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="validationSchoolName">house owner</label>
                                                            <input type="text" name="house_owner" class="form-control"
                                                                   value="<?php if(isset($collect)){echo $collect->house_owner; } ?>"

                                                                   placeholder="Enter you'r First owner please !" >
                                                        </div>

                                                    </div><br>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="validationSchoolName">phone number</label>
                                                            <input type="number" name="phone" class="form-control" placeholder="phone number"

                                                                value="<?php if(isset($collect)){echo $collect->phone;}?>"
                                                            >
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="validationSchoolName">gender</label>
                                                            <select type="text" class="form-control" placeholder="Gender" name="gender">
                                                                <option>Select Gender</option>
                                                                <option <?php if(isset($collect) && $collect->gender == "Male"){echo 'selected=selected'; } ?>>Male</option>
                                                                <option <?php if(isset($collect) && $collect->gender == "Female"){echo 'selected=selected'; } ?>>Female</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="validationSchoolName">email</label>
                                                            <input type="email" class="form-control" name="email" placeholder="email"
                                                                   value="<?php if(isset($collect)){echo $collect->email;} ?>" >
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="validationSchoolName">Address</label>
                                                            <input type="text" class="form-control" placeholder="address" name="address"
                                                                    value="<?php if(isset($collect)){echo $collect->address;} ?>" >
                                                        </div>
                                                    </div><br>
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <label for="validationSchoolName">house number</label>
                                                            <input type="text" class="form-control" placeholder="registed user" name="house_number"
                                                                   value="<?php if(isset($collect)){echo $collect->house_number;}  ?>" >
                                                        </div>

                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <input type="submit" class="btn btn-success col-md-2"
                                                                   name="<?php if(isset($collect)){echo "update"; }else{echo "save";}   ?>"
                                                                   value="<?php if(isset($collect)){echo 'update';}else{echo 'save';}  ?>"     >
                                                            <a type="submit" class="btn btn-primary h col-md-2" name="exit" style="margin-left: 20px"  value="view" href="..//Taka_taka/HouseRegistedView.php">view</a>
                                                        </div>
                                                    </div>
                                                </form>
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