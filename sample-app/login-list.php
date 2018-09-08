<?php
 $cn = new PDO("mysql:host=localhost;dbname=test_db","root","");
 $st = $cn->prepare("select * from login");
 $st->execute();
 $rows = $st->fetchall(PDO::FETCH_ASSOC);
?>
<table>
 <tr>
  <th>Id</th>
  <th>Name</th>
  <th>Role</th>
  <th>Date Created</th>
 </tr>
 <?php
   foreach($rows as $r) {
      ?>
     <tr>
       <td><?=$r['user_id']?></td>
       <td><?=$r['user_email']?></td>
       <td><?=$r['user_role']?></td>
       <td><?=$r['date_created']?></td>
     </tr>
     <?php
   }
 ?>
</table>