<?php
include '../connect.php';
if(isset($_POST['username']) && isset($_POST['password']) ) {


    $POSTDATA = array();
    $username = mysql_real_escape_string($_POST['username']);
    $password = mysql_real_escape_string($_POST['password']);//var_dump($_POST);
    //$hashpass = md5($password);

    //echo '<script>alert("1")</script>';

    if ($_POST['logid'] == "freelancer") {

        $table = 'freelancer';
        $_GET['event'] = "myEntry";

        $result = mysql_query("select * from admin where username='$username' and password='$password';");

       // echo '<script>alert("2.")</script>';
        $user_data = mysql_fetch_array($result);
        $no_rows = mysql_num_rows($result);

        if ($no_rows == 1) {
            //echo '<script>alert("3.")</script>';

            session_start();

            $_SESSION['login'] = true;
            if (isset($user_data['id'])) {
                $_SESSION['sbttc_basic_uid'] = $user_data['id'];
                $_SESSION['sbttc_basic_uname'] = $user_data['username'];
            }
            echo '<script>location.replace("view-results.php")</script>';
        } else {
            echo '<script>alert("Username or Password is invalid!!!!.")</script>';
            echo '<script>location.replace("index.php")</script>';
        }
    }
}
session_start();
if($_SESSION['sbttc_basic_uid']=='') {


//    $logid3=$_GET['logid'];
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Company Entry</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="css/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="css/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text"
                                           value="" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password"
                                           value="">
                                </div>

                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Login">
                                <input type="hidden" name="logid" value="freelancer"/>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="css/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="css/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="css/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="css/dist/js/sb-admin-2.js"></script>

    </body>

    </html>

<?php

}
else{
    echo '<script>location.replace("view-results.php")</script>';
}
?>