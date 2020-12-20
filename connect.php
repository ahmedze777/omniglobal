<?php
	$dbhost = 'mysqldb2020.ceu8sc5k97zu.us-west-2.rds.amazonaws.com';
	$dbuser = 'mysqldb2020';
	$dbpass = 'mysqldb2020';
	$dbname = "qatav";

	$email = $_POST['Email'];
	$password = $_POST['Password'];
	$fname = $_POST['FName'];
	$lname = $_POST['LName'];
	$phone_areaCode = $_POST['Phone_AreaCode'];
	$phone_no = $_POST['Phone_no'];
	$fb_uid = $_POST['FB_UID'];
	$google_uid = $_POST['Google_UID'];
	// $ses = $_POST['SES']

	#Genterating Auth_code
	$omni_authcode = rand(111111, 999999);


	echo($email);
	echo($password);
	echo($fname);
	echo($lname);
	echo($phone_areaCode);
	echo($phone_no);
	echo($fb_uid);
	echo($google_uid);
	// echo($ses);
	echo($omni_authcode);

	// Database connection
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into USER(Email, Password, FName, LName, Phone_AreaCode, Phone_no, FB_UID, Google_UID, Omni_AuthCode) values(?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssissss", $email, $password, $fname, $lname, $phone_areaCode, $phone_no, $fb_uid, $google_uid, $omni_authcode);
		$execval = $stmt->execute();
		echo "test";
		echo $execval;
		if($execval) {
				// redirect to home.html after successful login
				echo json_encode(array("statusCode"=>200));
				header("Location: home.html");
		} else {

				echo json_encode(array("statusCode"=>201));
		}

		$stmt->close();
		$conn->close();
	}
?>
