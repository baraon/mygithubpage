<?php

session_start();

include('database.php');
include('functions.php');

//Get data from the form

$PID = $_POST['PID'];

//connect to DB
$conn = connect_db();
$result = mysqli_query($conn, "SELECT * FROM posts WHERE id = '$PID'");
$row = mysqli_fetch_assoc($result);

$content = sanitizeString($conn, $_POST['comment']);

//Fetch User information
$name = $row["name"];
$profile_pic = $row["profile_pic"];

// echo "$name";

$result_insert = mysqli_query($conn, "INSERT INTO comments(content, UID, name, profile_pic, likes) VALUES ('$content', $PID, '$name', '$profile_pic', 0)");

//check if insert was okay
if($result_insert){

    //redirect to feed page
    header("Location: feed.php");

}else{
    //throw an error
    echo "Oops! Something went wrong! Please try again!";
}



?>