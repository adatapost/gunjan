<?php
 $user_id = isset( $_REQUEST["user_id"] ) ? $_REQUEST["user_id"] : 0;

 $cn = new PDO("mysql:host=localhost;dbname=test_db","root","");
 
 $message = "";
 $full_name = isset( $_POST["full_name"] ) ? $_POST["full_name"] : "";
 $city = isset( $_POST["city"] ) ? $_POST["city"] : "";

 /* Update the record */
 var_dump($_FILES);
 if( isset($_FILES['photo'] )) {
    $photo = $_FILES["photo"];
    if( !$photo['error'] ) {
       $dest = $photo['name'];
       move_uploaded_file( $photo['tmp_name'], "photo/$dest" );
       $sql = "update user_profile set full_name = ?, city = ?, photo = ? where user_id=?";
       $st = $cn->prepare( $sql );
       $st->execute( array( $full_name, $city, $dest, $user_id ) );
       $message = "Profile upaded successfully!!!";
    } else {
      $message = "Please selet the photo";
    }

 } else {
      $message = "Please selet the photo";
 }

 /* Fetch the record */

$sql = "select 
  login.user_id,
  login.user_email,
  login.user_role,
  user_profile.full_name,
  user_profile.city,
  user_profile.photo
  
  from login 
  join user_profile on login.user_id = user_profile.user_id
  where login.user_id=?
";
 $st = $cn->prepare( $sql );
 $st->execute( array($user_id) );
 $row = $st->fetch(PDO::FETCH_ASSOC);
 
 if(!$row) {
   header("location: user-list-1.php");
   exit();
 }
?>

<h3>Edit User</h3>
<div>
 <form method="post" enctype="multipart/form-data">
   <input type="hidden" name="user_id" value="<?=$row['user_id']?>" />
   <p><label>Full Name <input type="text" 
       name="full_name" value="<?=$row['full_name']?>" /> </p>

   <p><label>City <input type="text" 
       name="city" value="<?=$row['city']?>" /> </p>
   <p>
    <img src="photo/<?=$row['photo']?>" alt="Missing" style="width: 100px" />
   <label>Photo 
     <input type="file" 
       name="photo" /> </p>
    <p>
      <button name="cmd" value="Update">Update Profile</button>
    </p>
    <p><?=$message ?><?p>
 </form>
</div>
<a href="user-list-1.php">Back</a>

