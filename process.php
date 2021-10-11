<?php

session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "crud";

$mysqli = new mysqli($hostname, $username, $password, $dbname) or die(mysqli_error($mysqli));

$name = "";
$location = "";

if (isset($_POST['save'])){
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("INSERT INTO data (name, location) VALUES('$name', '$location')") or die(mysqli_error($mysqli)); 

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");

}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM data WHERE id=$id") or die(mysqli_error($mysqli));

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");

}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die(mysqli_error($mysqli));
    if (mysqli_num_rows($result) == 1){
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
    }
}

?>