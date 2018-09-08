<?php
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$pass = isset($_POST["pass"]) ? $_POST["pass"] : "";

$result = array("status"=>false, "message"=>"Cannot register! Please verify input");
$cn = new PDO("mysql:host=localhost;dbname=sample_db","root","");

$sql = "insert into login values (?,?)";
$st = $cn->prepare($sql);
$st->execute(array($email,$pass));
$err = $st->errorInfo();
$result["status"] = !$err[1];
header("content-type: application/json");
echo json_encode($result);