<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/3/css/login.css">
</head>
<body>
    <?php
        require 'connectlogin.php';
        if(isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $conn->real_escape_string($_POST['password']);
 
             $sql ="SELECT * FROM `register` WHERE `Username` = '".$username."' AND `Password` = '".$password."'";
             $result = $conn->query($sql);

             if($result->num_rows > 0) {
                 $row = $result->fetch_assoc();
                 $_SESSION['id'] = $row['id'];
                 $_SESSION['Name'] = $row['Name'];
                 header('Location:index.php');
             } else {
                 echo "<div class=\"alert alert-danger\">คุณยังไม่ได้สมัครสมาชิก</div>";
             }
         }

    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto mt-5">
                <div class="card">
                    <form action="" method="post" name="form1" onsubmit="JavaScript:return fncsubmit();">
                        <div class="card-header text-center bg-info">
                            Login.
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="username" name="username">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center bg-palegreen ">
                            <a href="index.php" class="btn btn-warning" role="button">HOME</a>
                            <input type="submit" name="submit" class="btn btn-success" value="Login">
                            <a href="register.php" class="btn btn-danger" role="button">Register</a>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- Submit กรอก User , Pass -->
    <script language="javascript">
    function fncsubmit()
    {
	    if(document.form1.username.value == "")
	    {
		    alert('กรุณากรอก Username');
		    document.form1.username.focus();
		    return false;
	    }	
	    if(document.form1.password.value == "")
	    {
		    alert('กรุณากรอก Password');
		    document.form1.password.focus();		
		    return false;
	    }	
	    document.form1.submit();
    }   
</script>
<!--------------------------------------->

<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="node_modules/popper.js/dist/umd/popper.min.js"></script>



</body>
</html>