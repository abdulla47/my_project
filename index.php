

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <title>Login</title>

    <link href="styles.css" rel="stylesheet" type="text/css">
    <link href="assets/bootstrapp.min.css" rel="stylesheet" type="text/css">

</head>

<body class="body">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-4 ">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="row">
                    <div class="p-5">
                        <div class="text-center">
                            <p> Trash Sollection System<br>User login </p>
                            <hr style="background-color: #84b899;">
                        </div>
                        <?php
                        include_once 'resources/User.php';
                        include_once 'resources/session.php';
                        include_once 'resources/connection.php';
                        include_once 'resources/utilities.php';

                        if(isset($_POST['login_btn'])){
                            //tengeza array itakayo beba erro
                            $from_errors=array();
                            $required_fields_array = array('username', 'password');

                            foreach($required_fields_array as $name_of_field){
                                if(!isset($_POST[$name_of_field]) || $_POST[$name_of_field] == NULL){
                                    $form_errors[] = $name_of_field . " is a required field must fil it";
                                }
                            }

                            if(empty($form_errors)){
                            $username=$_POST['username'];
                            $password=$_POST['password'];

                            $db=connection::connect();
                            $sqlSelect=$db->prepare('select * from users where username=:username');
                            $sqlSelect->bindParam(':username',$username);
                            $sqlSelect->execute();

                            while ($row=$sqlSelect->fetch()){

                                //$id=$row['id'];
                                $username=$row['username'];
                                $hash_password=$row['password'];
                                
                                if(password_verify($password,$hash_password)){
                                    //$_SESSION['id']=$id;
                                    $_SESSION['username']=$username;
                                    header("location:index.php");
                                }else{
                                    $result= $result = "<p style='padding: 20px; color: red; border: 1px solid gray;'> Invalid username or password</p>";
                                }
                            }
                        }else {
                                if(count($form_errors) == 1){
                                    $result = "<p style='color: red;'> There was 1 error in the form<br>";

                                    $result .= "<ul style='color: red;'>";
                                    //loop through error array and display all items
                                    foreach($form_errors as $error){
                                        $result .= "<li> {$error} </li>";
                                    }
                                    $result .= "</ul></p>";

                                }else{
                                    $result = "<p style='color: red;'> There were " .count($form_errors). " errors in the form <br>";

                                    $result .= "<ul style='color: red;'>";
                                    //loop through error array and display all items
                                    foreach($form_errors as $error){
                                        $result .= "<li> {$error}</li>";
                                    }
                                    $result .= "</ul></p>";
                                }
                            }

                        }
                        ?>








                        <form class="user" action="#" method="post">
                            <?php if(isset($result)){echo $result;} ?>
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" id="exampleInputEmail" aria-describedby="admin" placeholder="Username.">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" id="exampleInputPassword" placeholder="Password">
                            </div>
                            <hr style="background-color: #84b899;">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                    <label class="custom-control-label" for="customCheck">Remember Me</label>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-success  btn-block" name="login_btn" value="Login">
                        </form>
                        <hr style="background-color: #84b899;">
                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="register.php">Create an Account!</a>
                            <hr style="background-color: #84b899;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
