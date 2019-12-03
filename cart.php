<?php
session_start();
require 'connect.php';


$action = isset($_GET['a']) ? $_GET['a'] : "";
$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
if (isset($_SESSION['qty']))
{
    $meQty = 0;
    foreach ($_SESSION['qty'] as $meItem)
    {
        $meQty = $meQty + $meItem;
    }
} else
{
    $meQty = 0;
}
if (isset($_SESSION['cart']) and $itemCount > 0)
{
    $itemIds = "";
    foreach ($_SESSION['cart'] as $itemId)
    {
        $itemIds = $itemIds . $itemId . ",";
    }
    $inputItems = rtrim($itemIds, ",");
    $meSql = "SELECT * FROM products WHERE id in ({$inputItems})";
    $meQuery = mysql_query($meSql);
    $meCount = mysql_num_rows($meQuery);
} else
{
    $meCount = 0;
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
            <!-- Main component for a primary marketing message or call to action -->
            <?php
            if ($action == 'removed')
            {
                echo "<div class=\"alert alert-warning\">ลบสินค้าเรียบร้อยแล้ว</div>";
            }

            if ($meCount == 0)
            {
                echo "<div class=\"alert alert-warning\">ไม่มีสินค้าอยู่ในตะกร้า</div>";
            } else
            {
                ?>
                <form action="updatecart.php" method="post" name="fromupdate">
                    <table class="table table-warning">
                        <thead>
                            <tr>
                                <th>รูป</th>
                                <th>รหัสสินค้า</th>
                                <th>ชื่อสินค้า</th>
                                <th>รายละเอียด</th>
                                <th>จำนวน</th>
                                <th>ราคาต่อหน่วย</th>
                                <th>จำนวนเงิน</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_price = 0;
                            $num = 0;
                            while ($meResult = mysql_fetch_assoc($meQuery))
                            {
                                $key = array_search($meResult['id'], $_SESSION['cart']);
                                $total_price = $total_price + ($meResult['product_price'] * $_SESSION['qty'][$key]);
                                ?>
                                <tr>
                                    <td><img src="images/<?php echo $meResult['product_img_name']; ?>" border="0"></td>
                                    <td><?php echo $meResult['product_code']; ?></td>
                                    <td><?php echo $meResult['product_name']; ?></td>
                                    <td><?php echo $meResult['product_desc']; ?></td>
                                    <td>
                                    <input type="text" name="qty[<?php echo $num; ?>]" value="<?php echo $_SESSION['qty'][$key]; ?>" class="form-control" style="width: 60px;text-align: center;">
                                    <input type="hidden" name="arr_key_<?php echo $num; ?>" value="<?php echo $key; ?>">
                                    </td>
                                    <td><?php echo number_format($meResult['product_price'],2); ?></td>
                                    <td><?php echo number_format(($meResult['product_price'] * $_SESSION['qty'][$key]),2); ?></td>
                                    <td>
                                        <a class="btn btn-danger btn-lg" href="removecart.php?itemId=<?php echo $meResult['id']; ?>" role="button">
                                            <span class="glyphicon glyphicon-trash"></span>
                                            ลบทิ้ง</a>
                                    </td>
                                </tr>
                                <?php
                                $num++;
                            }
                            ?>
                            <tr>
                                <td colspan="8" style="text-align: right;">
                                    <h4>จำนวนเงินรวมทั้งหมด <?php echo number_format($total_price,2); ?> บาท</h4>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" style="text-align: right;">
                                    <button type="submit" class="btn btn-info btn-lg">คำนวณราคาสินค้าใหม่</button>
                                    <a href="order.php" type="button" class="btn btn-primary btn-lg">สังซื้อสินค้า</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <?php
            }
            ?>
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
