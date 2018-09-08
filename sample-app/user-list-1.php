<!doctype html>

<head>
  <style>
    .item {
    display: inline-block;
    padding: 10px;
    margin: 10px;
    border: 1px solid #aaa;
    box-shadow: 3px 3px 3px 5px #eee;
   }
  .btn {
     text-decoration: none;
     border: 1px solid #aaa;
     padding: 4px;
  }
   .center { text-align: center; }
  </style>
</head>
<?php
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
  $st = $cn->prepare( $sql );
  $st->execute();
 // $err = $st->errorInfo();
 // var_dump($err);
  $rows = $st->fetchall(PDO::FETCH_ASSOC);

  foreach($rows as $row) {
      ?>
      <div class="item">
       <p><?=$row["user_id"]?></p>
       <p><?=$row["user_email"]?></p>
       <p><?=$row["user_role"]?></p>
       <p><?=$row["full_name"]?></p>
       <p><?=$row["city"]?></p>
       <p><img src="photo/<?=$row['photo']?>" style='width:100px;height: 100px' alt='Image missing' /></p>
        <p class="center">
          <a class="btn" href="edit-user.php?user_id=<?=$row['user_id']?>">Edit</a>
        </p>
      </div>
    <?php
    }
 