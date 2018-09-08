<!doctype html>

<html>
 <head>
     <title>ADC-Sample</title>
     <link rel="stylesheet" href="css/bootstrap.min.css" />
 </head>
 <body>

   <button type="button" class="btn btn-link" data-toggle="modal" data-target="#registerForm">
       Register
   </button>

   <!-- Modal -->
   <div class="modal fade" id="registerForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">New User</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <p>Email</p>
                   <p><input type="email" id="email" required /></p>
                   <p>Password</p>
                   <p><input type="password" id="password" required /></p>
                   <p id="msg"></p>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                   <button type="button" class="btn btn-primary" onclick="doSave()">Register</button>
               </div>
           </div>
       </div>
   </div>

   <script src="js/jquery-3.3.1.min.js"></script>
   <script src="js/bootstrap.bundle.min.js"></script>
  <script>
      $("#msg").text("");
      function doSave() {
          var data = {"email": $("#email").val(), "pass": $("#password").val() };
          $.post("UserController.php",data, function(result) {
             $("#msg").text( result.message );
             console.log( result  );
             if(result.status)
                $("#registerForm").modal('hide');
          });
      }
  </script>
 </body>
</html>

