<?php
$user_email = isset($_POST["user_email"]) ? $_POST["user_email"] : "";
$user_pass = isset($_POST["user_pass"]) ? $_POST["user_pass"] : "";
$user_cpass = isset($_POST["user_cpass"]) ? $_POST["user_cpass"] : "";
$full_name = isset($_POST["full_name"]) ? $_POST["full_name"] : "";
$city = isset($_POST["city"]) ? $_POST["city"] : "";
$photo = isset($_FILES["photo"]) ? $_FILES["photo"] : "";
$cmd = isset($_POST["cmd"]) ? $_POST["cmd"] : "";
$message = "";

$cn = new PDO("mysql:host=localhost;dbname=test_db","root","");
if($cmd == "Add") {
  $message= "Error: Cannot register the record!!!";
  $sql = "insert into login (user_email,user_pass,user_role,date_created) values (?,?,?,?)";

  $arr = array( $user_email, $user_pass, "Student", date('Y-m-d') );
  
  $st = $cn->prepare( $sql );
  $r = $st->execute( $arr);
  if($r) {
     $sql = "select max(user_id) as user_id from login";
     $st = $cn->prepare( $sql );
     $st->execute();
     $row = $st->fetch(PDO::FETCH_ASSOC);
     if($row) {
        $file = "no-upload.png";
        if($photo) {
           $file = $photo['name'];
           move_uploaded_file( $photo['tmp_name'], 'photo/' . $file);
        }
        $sql = "insert into user_profile values (?,?,?,?)";
        $st = $cn->prepare($sql);
        $arr = array($row["user_id"], $full_name, $city, $file );
        $r = $st->execute( $arr);
        if($r) {
            $message= "Registration completed successfully!!!";
        } 
     }
  }
}
?>

<h3>New user</h3>

<form method="post" enctype="multipart/form-data">
<p>Email</p>
<p><input type="email" name="user_email" /></p>
<p>Password</p>
<p><input type="password" name="user_pass" /></p>
<p>Confirm Password</p>
<p><input type="password" name="user_cpass" /></p>
<p>Full Name</p>
<p><input type="text" name="full_name" /></p>
<p>City</p>
<p><input type="text" name="city" /></p>
<p>Photo</p>
<p><input type="file" name="photo" /></p>
<p><?=$message?></p>
<p>
 <button name="cmd" value="Add">Submit</button>
</p>
</form>