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
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ร้านขายของออนไลน์</title>
        <!--footer-->
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <!--CSS-->
        <link rel="stylesheet" type="text/css" href="\test\css\home.css">
        <link rel="stylesheet" type="text/css" href="/css/index.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <!--Bootstarp-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
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
      <a class="navbar-brand" href="#">SHOP</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
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

<div class="row ">
    <div class="col-sm-3 mr-auto">
    ยินดีต้อนรับคุณ <?php echo $_SESSION['Name'];?>
    <a href="/3/logout.php">ออกจากระบบ</a>
    <hr>


    <div class="list-group" >
              <a href="#" class="list-group-item shadow-lg p-3 bg-info rounded text-light">หมวดสินค้า</a>
              
                <a href="#S1" class="list-group-item shadow-lg p-3 rounded text-dark">เสื้อ</a>
                <a href="#S2" class="list-group-item shadow-lg p-3 rounded text-dark">กางเกง</a>
                <a href="#S3" class="list-group-item shadow-lg p-3 rounded text-dark">รองเท้า</a>              
    </div>

      <hr class="d-sm-none">
    </div>
    <div class="col-sm-8">
    <br>
    <h2 id="S1">เสื้อ</h2>
      <div class="card-group">
      <div class="card">
    <img class="card-img-top" src="\test\img\เสื้อ.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title"><b>เสื้อ One price</b></h5>
      <p class="card-text">เสื้อ Limited แฟน One Price ไม่ควรพลาด.</p>
      <b>ราคา 250 บาท</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href="product.php" class="btn btn-primary">ไปที่ร้านค้า</a>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="\test\img\เสื้อ2.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title"><b>เสื้อยืด</b></h5>
      <p class="card-text">เสื้อยืดพิเศษเนื้อผ้าอย่างดีสำหรับคนพิเศษ.</p>
      <b>ราคา 250 บาท</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href="product.php" class="btn btn-primary">ไปที่ร้านค้า</a>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="\test\img\เสื้อ3.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title"><b>เสื้อ BT21</b></h5>
      <p class="card-text">เสื้อ BT21 แฟน BT21 ไม่ควรพลาด เนื้อผ้าคอตต้อน.</p>
      <b>ราคา 250 บาท</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href="product.php" class="btn btn-primary">ไปที่ร้านค้า</a>
    </div>
  </div>
      </div>
      <br>
      <h2 id="S2">กางเกง</h2>
      <div class="card-group">
      <div class="card">
    <img class="card-img-top" src="\test\img\กางเกง.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title"><b>กางเกงขาสั้นผู้ชาย</b></h5>
      <p class="card-text">กางเกงขาสั้นใส่สบายสำหรับผู้ชาย.</p>
      <b>ราคา 250 บาท</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href="product.php" class="btn btn-success">ไปที่ร้านค้า</a>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="\test\img\กางเกง2.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title"><b>กางเกงขาสั้นผู้ชาย</b></h5>
      <p class="card-text">กางเกงขาสั้นใส่สบายสำหรับผู้ชาย.</p>
      <b>ราคา 250 บาท</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href="product.php" class="btn btn-success">ไปที่ร้านค้า</a>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="\test\img\กางเกง3.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title"><b>กางเกงขาสั้นผู้ชาย</b></h5>
      <p class="card-text">กางเกงขาสั้นใส่สบายสำหรับผู้ชาย.</p>
      <b>ราคา 250 บาท</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href="product.php" class="btn btn-success">ไปที่ร้านค้า</a>
    </div>
  </div>
    </div>
    <br>
    <h2 id="S3">รองเท้า</h2>
<div class="card-group">
  <div class="card">
    <img class="card-img-top" src="\test\img\รองเท้า.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title"><b>Adidas NMD</b></h5>
      <p class="card-text">รองเท้าแฟชั่นสำหรับผู้ชาย.</p>
      <b>ราคา 250 บาท</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href="product.php" class="btn btn-danger">ไปที่ร้านค้า</a>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="\test\img\รองเท้า2.png" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title"><b>Adidas</b></h5>
      <p class="card-text">รองเท้าแฟชั่นสำหรับผู้ชาย.</p>
      <b>ราคา 250 บาท</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href="product.php" class="btn btn-danger">ไปที่ร้านค้า</a>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="\test\img\รองเท้า3.png" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title"><b>Sport</b></h5>
      <p class="card-text">รองเท้ากีฬาสำหรับผู้ชาย.</p>
      <b>ราคา 250 บาท</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href="product.php" class="btn btn-danger">ไปที่ร้านค้า</a>
    </div>
  </div>
  </div>
  <br>
  </div>
</div>
    </div>
  </div>
 <br>

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
