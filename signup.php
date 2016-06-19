<?php

//start session
	include ('functions.php');

	session_start();

	$dbhost = "localhost";	
	$dbuser = "root";
	$dbpass = "root";
	$dbname = "myDB";
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	if(!$conn) {
		die("Connection Failed: " . mysqli_connect_error());
	}

	$name = sanitizeString($conn, $_POST["name"]);
	$username = sanitizeString($conn, $_POST["username"]);
	$email = sanitizeString($conn, $_POST["email"]);
	$dob = sanitizeString($conn, $_POST["dob"]);
	$gender = sanitizeString($conn, $_POST["gender"]);
	$verification_question = sanitizeString($conn, $_POST["verification_question"]);
	$verification_answer = sanitizeString($conn, $_POST["verification_answer"]);
	$location = sanitizeString($conn, $_POST["location"]);
	$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
	$default_pic = sanitizeString($conn, "https://pbs.twimg.com/profile_images/616076655547682816/6gMRtQyY.jpg");
	
	$sql = "INSERT INTO users (Username, Password, Name, email, dob, gender, verification_question, verification_answer, location, profile_pic) VALUES ('$username', '$password', '$name', '$email', '$dob', '$gender', '$verification_question', '$verification_answer', '$location', '$default_pic');";
	echo $sql;
	if (mysqli_query($conn, $sql))
	{
		// echo "It works!";
		$_SESSION["username"] = $username;
		header("Location: feed.php");
	}
	else
	{
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	
	mysqli_close($conn);
	?>
