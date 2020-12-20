<?php

    $dbhost = 'mysqldb2020.ceu8sc5k97zu.us-west-2.rds.amazonaws.com';
    $dbuser = 'mysqldb2020';
    $dbpass = 'mysqldb2020';
    $dbname = "qatav";

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $email = $data->email;
    $pwd = $data->password;

    // Database connection
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if($conn->connect_error){
        echo "$conn->connect_error";
        die("Connection Failed : ". $conn->connect_error);
    } else {
        $duplicate=mysqli_query($conn,"select * from USER where email='$email' and password='$pwd'");
        if (mysqli_num_rows($duplicate)>0) {

            echo json_encode(array("statusCode"=>200));

        } else { echo json_encode(array("statusCode"=>201)); }
    }


    


?>
