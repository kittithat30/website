<?php
session_start();
require 'connect.php';

$meSql = "SELECT * FROM products ";
$meQuery = mysql_query($meSql);

$action = isset($_GET['a']) ? $_GET['a'] : "";
$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
if(isset($_SESSION['qty'])){
    $meQty = 0;
    foreach($_SESSION['qty'] as $meItem){
        $meQty = $meQty + $meItem;
    }
}else{
    $meQty=0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ตะกร้าสินค้า</title>
    <!--footer-->
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!--CSS-->
    <link rel="stylesheet" href="/3/css/product.css">
    <link rel="stylesheet" type="text/css" href="/test/css/home.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!--Bootstarp-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<body>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="/3/images/header/1.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="/3/images/header/2.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="/3/images/header/3.png" class="d-block w-100" alt="...">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            </div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="#">Logo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="product.php">Product</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>    
      <li class="nav-item">
        <a class="nav-link" href="cart.php">ตะกร้าสินค้า  <span class="badge"><?php echo $meQty; ?></span></a>
      </li>   
    </ul>
  </div>  
</nav>



<?php
if($action == 'exists'){
    echo "<div class=\"alert alert-warning\">เพิ่มจำนวนสินค้าแล้ว</div>";
}
if($action == 'add'){
    echo "<div class=\"alert alert-success\">เพิ่มสินค้าลงในตะกร้าเรียบร้อยแล้ว</div>";
}
if($action == 'order'){
	echo "<div class=\"alert alert-success\">สั่งซื้อสินค้าเรียบร้อยแล้ว</div>";
}
if($action == 'orderfail'){
	echo "<div class=\"alert alert-warning\">สั่งซื้อสินค้าไม่สำเร็จ มีข้อผิดพลาดเกิดขึ้นกรุณาลองใหม่อีกครั้ง</div>";
}
?>
            <table class="table table-warning">
                <thead>
                    <tr>
                        <th id="a1">รูป</th>
                        <th id="a1">รหัสสินค้า</th>
                        <th id="a1">ชื่อสินค้า</th>
                        <th id="a1">รายละเอียด</th>
                        <th id="a1">ราคา</th>
                        <th id="a1">จำนวนคงเหลือ</th>
                        <th id="a1">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($meResult = mysql_fetch_assoc($meQuery))
                    {
                        ?>
                        <tr>
                            <td id="a2"><img src="images/<?php echo $meResult['product_img_name']; ?>" border="0"></td>
                            <td id="a3"><?php echo $meResult['product_code']; ?></td>
                            <td id="a4"><?php echo $meResult['product_name']; ?></td>
                            <td id="a5"><?php echo $meResult['product_desc']; ?></td>
                            <td id="a6"><?php echo number_format($meResult['product_price'],2); ?></td>
                            <td id="a3"><?php echo $meResult['product_amount'];echo "&nbsp;ชิ้น" ?></td>
                            <td>
                                <a class="btn btn-primary btn-lg" href="updatecart.php?itemId=<?php echo $meResult['id']; ?>" role="button">
                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                    หยิบใส่ตะกร้า</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
    <!-- Footer -->
    <footer class="pt-5 pb-4" id="contact">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-6 mt-2 mb-4">
						<h5 class="mb-4 font-weight-bold">เกี่ยวกับเรา</h5>
						<p class="mb-4">ที่อยู่ที่สามารถติดต่อได้.</p>
						<ul class="f-address">
							<li>
								<div class="row">
									<div class="col-1"><i class="fas fa-map-marker"></i></div>
									<div class="col-10">
										<h6 class="font-weight-bold mb-0">ที่อยู่:</h6>
										<p>เลขที่100/613 ซอย15 ถนนอาจณรงค์ คลองเตย กทม. 10110</p>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col-1"><i class="far fa-envelope"></i></div>
									<div class="col-10">
										<h6 class="font-weight-bold mb-0">E-mail</h6>
										<p><a href="#">Kittithatwadklang@gmail.com</a></p>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col-1"><i class="fas fa-phone-volume"></i></div>
									<div class="col-10">
										<h6 class="font-weight-bold mb-0">เบอร์โทร:</h6>
										<p><a href="#">+66 (0) 620342790</a></p>
									</div>
								</div>
							</li>
						</ul>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6 mt-2 mb-4">
						<h5 class="mb-4 font-weight-bold">อัพเดทล่าสุด</h5>
						<ul class="recent-post">
							<li>
								<label class="mr-3">28 <br><span>Nov</span></label>
								<span>ระบบ Login.</span>
							</li>
             <br>
							<li>
								<label class="mr-3">28 <br><span>Nov</span></label>
								<span>ระบบ Register.</span>
							</li>
             <br>
							<li>
								<label class="mr-3">28 <br><span>Nov</span></label>
								<span>ระบบ ตะกร้าสินค้า.<span>
							</li>
						</ul>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6 mt-2 mb-4">
						<h5 class="mb-4 font-weight-bold">อัพเดทล่าสุด</h5>
						<ul class="recent-post">
							<li>
								<label class="mr-3">28 <br><span>Nov</span></label>
								<span>รอการอัพเดท.</span>
							</li>
             <br>
							<li>
								<label class="mr-3">28 <br><span>Nov</span></label>
								<span>รอการอัพเดท.</span>
							</li>
             <br>
							<li>
								<label class="mr-3">28 <br><span>Nov</span></label>
								<span>รอการอัพเดท.<span>
							</li>
						</ul>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6 mt-2 mb-4">
						<ul class="social-pet mt-4">
							<li><a href="https://www.facebook.com/kittithat30" title="facebook"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="https://twitter.com/" title="twitter"><i class="fab fa-twitter"></i></a></li>
							<li><a href="https://mail.google.com/" title="google-plus"><i class="fab fa-google-plus-g"></i></a></li>
							<li><a href="https://www.instagram.com/kittithat.w/" title="instagram"><i class="fab fa-instagram"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
		<!-- Copyright -->
		<section class="copyright">
			<div class="container">
				<div class="row">
					<div class="col-md-12 ">
						<div class="text-center text-white">
							&copy; 2019 Kittithat Wadklang
						</div>
					</div>
				</div>
			</div>
		</section>
    </body>
</html>
<?php
mysql_close();