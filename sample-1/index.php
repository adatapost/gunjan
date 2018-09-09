<!doctype html>

<html>
<head>
    <style>
        #modal {
            visibility: hidden;
            position: absolute;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            text-align: center;
            z-index: 1000;
        }

        #modal #modal-content {
            width: 300px;
            margin: 100px auto;
            background-color: #fff;
            border: 1px solid #000;
            padding: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

<button type="button" onclick="showHide()">
    Register
</button>
<!-- Modal -->
<div id="modal">
    <div id="modal-content">
        <div class="modal-header">
            <h5>New User</h5>
        </div>
        <div class="modal-body">
            <p>Email</p>
            <p><input type="email" id="email" required/></p>
            <p>Password</p>
            <p><input type="password" id="password" required/></p>
            <p id="msg"></p>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="closeIt()">Close</button>
            <button type="button" onclick="doSave()">Register</button>
        </div>
    </div>
</div>

<script>
    var el = document.getElementById("modal");
    var email = document.querySelector("#email");
    var pass = document.querySelector("#password");
    var msg = document.querySelector("#msg");

    function showHide() {
        el.style.visibility = el.style.visibility == "visible" ? "hidden" : "visible";
    }
    function closeIt() {
        el.style.visibility = "hidden";
    }
    function doSave() {
        var data = new FormData();
        data.append("email", email.value);
        data.append("pass", pass.value);

        var xhr = new XMLHttpRequest();
        xhr.open("post", "UserController.php");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                var obj = JSON.parse(xhr.responseText);
                msg.innerHTML = obj.message;
                if (obj.status) {
                    msg.innerHTML = "Registration done successfully!!!";
                }
            }
        };
        xhr.send(data);
    }
</script>
</body>
</html>


