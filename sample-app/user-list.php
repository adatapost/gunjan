<?php
  // To establish the database connection
              //database:host=server-name;dbname=database_name,"user","pass"
  $cn = new PDO("mysql:host=localhost;dbname=test_db","root","");

  $sql = "select 
  login.user_id,
  login.user_email,
  login.user_role,
  user_profile.full_name,
  user_profile.city,
  user_profile.photo
  
  from login 
  join user_profile on login.user_id = user_profile.user_id
";

  // Compile the SQL statement
  $st = $cn->prepare( $sql );

  // Execute the compiled SQL statement
  $st->execute();

 // If errors: 
 // $err = $st->errorInfo();
 // var_dump($err);

 //Get/Fetch rows
  $rows = $st->fetchall(PDO::FETCH_ASSOC);
?>

<table>
  <?php
    foreach($rows as $row) {
      ?>
      <tr>
       <td><?=$row["user_id"]?></td>
       <td><?=$row["user_email"]?></td>
       <td><?=$row["user_role"]?></td>
       <td><?=$row["full_name"]?></td>
       <td><?=$row["city"]?></td>
       <td><img src="photo/<?=$row['photo']?>" style='width:100px;' alt='Image missing' /></td>
      </tr>
    <?php
    }
   ?>
</table>