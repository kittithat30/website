<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <!--Register-->
    <link rel="stylesheet" type="text/css" href="\test\css\home.css">
    <!-- -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">  

</head>
<body>

<?php
require 'connectlogin.php';

	if(isset($_POST['submit'])) {

	$sql = "INSERT INTO `register` (`ID`, `Name`, `Lastname`, `Email`, `Phone`, `Job`, `Username`, `Password`) 
			VALUES (NULL, '".$_POST['Name']."', '".$_POST['Lastname']."', '".$_POST['Email']."', '".$_POST['Phone']."', '".$_POST['Job']."', '".$_POST['Username']."', '".$_POST['Password']."');";
	$result = $conn->query($sql);
	if($result) {
		echo "<script> alert('ยืนยันการสมัครสมาชิก');</script>";
		header('location: login.php');
	}else {
		echo "ขออภัยทำรายการไม่สำเร็จ";
	}
	}
?>


<div class="container">
    <br>
<div class="card bg-light">
<article class="card-body mx-auto" style="max-width: 400px;">
	<h4 class="card-title mt-3 text-center">สร้าง Account</h4>
	<hr>
	<form action="" name="form1" method="post" onsubmit="JavaScript:return fncsubmit();">
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="Name" id ="Name" class="form-control" placeholder="ชื่อ" type="text">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
         </div>
         <input name="Lastname" id ="Lastname" class="form-control" placeholder="นามสกุล" type="text">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input name="Email" id="Email" class="form-control" placeholder="อีเมล์" type="email">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
		</div>
		<select class="custom-select" style="max-width: 120px;">
		    <option selected="">+66</option>
		</select>
    	<input name="Phone" id="Phone" class="form-control" placeholder="เบอร์โทรศัพท์" type="text">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-building"></i> </span>
		</div>
		<select name="Job" id="Job" class="form-control">
			<option selected=""></option>
			<option>พนักงานทั่วไป</option>
			<option>ผู้บริหาร</option>
			<option>นักบัญชี</option>
		</select>
	</div> <!-- form-group end.// -->
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="Username" id="Username" class="form-control" placeholder="ไอดี" type="text">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input name ="Password" id="Password" class="form-control" placeholder="รหัสผ่าน" type="password">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input name ="rePassword" id="rePassword" class="form-control" placeholder="ยืนยันรหัสผ่าน" type="password">
    </div> <!-- form-group// -->                                      
    <div class="form-group">
        <button type="submit" name="submit" value="Save" class="btn btn-primary btn-block"> สร้าง Account  </button>
    </div> <!-- form-group// -->      
    <p class="text-center">มี account อยู่แล้ว? <a href="login.php">Login</a> </p>                                                                 
</form>
</article>
</div> <!-- card.// -->
</div> 
<!--container end.//-->

<!-- Submit กรอก User , Pass -->
<script language="javascript">
    function fncsubmit()
    {
	    if(document.form1.Name.value == "")
	    {
		    alert('กรุณากรอกชื่อ');
		    document.form1.Name.focus();
		    return false;
	    }	
	    if(document.form1.Lastname.value == "")
	    {
		    alert('กรุณากรอกนามสกุล');
		    document.form1.Lastname.focus();		
		    return false;
	    }	
		if(document.form1.Email.value == "")
	    {
		    alert('กรุณากรอก E-mail');
		    document.form1.Email.focus();
		    return false;
	    }	
		if(document.form1.Phone.value == "")
	    {
		    alert('กรุณากรอกเบอร์โทรศัพท์');
		    document.form1.Phone.focus();
		    return false;
	    }	
		if(document.form1.Job.value == "")
	    {
		    alert('กรุณากรอกอาชีพ');
		    document.form1.Job.focus();
		    return false;
	    }	
		if(document.form1.Username.value == "")
	    {
		    alert('กรุณากรอก Username');
		    document.form1.Username.focus();
		    return false;
	    }	
		if(document.form1.Password.value == "")
	    {
		    alert('กรุณากรอก Password');
		    document.form1.Password.focus();
		    return false;
	    }	
		if(document.form1.rePassword.value == "")
	    {
		    alert('กรุณายืนยัน Password');
		    document.form1.rePassword.focus();
		    return false;
	    }	
		if(form1.Password.value != form1.rePassword.value)
		{
			alert('Password ไม่ตรงกัน');
			document.form1.Password.focus();
		    document.form1.rePassword.focus();
		    return false;
		}
		document.form1.submit();
    }   
</script>
<!--------------------------------------->

<br><br>
</body>
</html>