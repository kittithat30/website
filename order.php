<?php
session_start();
require 'connect.php';

$action = isset($_GET['a']) ? $_GET['a'] : "";
$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$_SESSION['formid'] = sha1('itoffside.com' . microtime());
if (isset($_SESSION['qty'])) {
	$meQty = 0;
	foreach ($_SESSION['qty'] as $meItem) {
		$meQty = $meQty + $meItem;
	}
} else {
	$meQty = 0;
}
if (isset($_SESSION['cart']) and $itemCount > 0) {
	$itemIds = "";
	foreach ($_SESSION['cart'] as $itemId) {
		$itemIds = $itemIds . $itemId . ",";
	}
	$inputItems = rtrim($itemIds, ",");
	$meSql = "SELECT * FROM products WHERE id in ({$inputItems})";
	$meQuery = mysql_query($meSql);
	$meCount = mysql_num_rows($meQuery);
} else {
	$meCount = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>รายการสั่งซื้อ</title>
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
<script type="text/javascript">
	function updateSubmit(){
		if(document.formupdate.order_fullname.value == ""){
			alert('โปรดใส่ชื่อนามสกุลด้วย!');
			document.formupdate.order_fullname.focus();
			return false;
		}
			if(document.formupdate.order_address.value == ""){
			alert('โปรดใส่ที่อยู่ด้วย!');
			document.formupdate.order_address.focus();
			return false;
		}
			if(document.formupdate.order_phone.value == ""){
			alert('โปรดใส่เบอร์โทรด้วย!');
			document.formupdate.order_phone.focus();
			return false;
		}
        alert('บันทึกรายการสำเร็จรอข้อความจากทางทีมงานเพื่อยืนยันสถานะสินค้า!');
		document.formupdate.submit();
		return false;
	}
</script>
    </head>
    <body>
            <!-- Static navbar -->
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <a class="navbar-brand" href="#">SHOP</a>
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
                
                <form class="table-danger" action="updateorder.php" method="post" name="formupdate" role="form" id="formupdate" onsubmit="JavaScript:return updateSubmit();">
                    <h3>รายการสั่งซื้อ</h3>
                    <div class="form-group">
    					<label for="exampleInputEmail1">ชื่อ-นามสกุล</label>
    					<input type="text" class="form-control" id="order_fullname" placeholder="ใส่ชื่อนามสกุล" style="width: 300px;" name="order_fullname">
  					</div>
                	<div class="form-group">
    					<label for="exampleInputAddress">ที่อยู่</label>
    					<textarea class="form-control" rows="3" style="width: 500px;" name="order_address" id="order_address"></textarea>
  					</div>
                	<div class="form-group">
    					<label for="exampleInputPhone">เบอร์โทรศัพท์</label>
    					<input type="text" class="form-control" id="order_phone" placeholder="ใส่เบอร์โทรศัพท์ที่สามารถติดต่อได้" style="width: 300px;" name="order_phone">
  					</div>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="bg-warning">
                                <th >รหัสสินค้า</th>
                                <th>ชื่อสินค้า</th>
                                <th>รายละเอียด</th>
                                <th>จำนวน</th>
                                <th>ราคาต่อหน่วย</th>
                                <th>จำนวนเงิน</th>
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
                                <tr class="bg-info">
                                    <td><?php echo $meResult['product_code']; ?></td>
                                    <td><?php echo $meResult['product_name']; ?></td>
                                    <td><?php echo $meResult['product_desc']; ?></td>
                                    <td >
                                    	<?php echo $_SESSION['qty'][$key]; ?>
                                    	<input type="hidden" name="qty[]" value="<?php echo $_SESSION['qty'][$key]; ?>" />
                                    	<input type="hidden" name="product_id[]" value="<?php echo $meResult['id']; ?>" />
                                    	<input  type="hidden" name="product_price[]" value="<?php echo $meResult['product_price']; ?>" />
                                    </td>
                                    <td><?php echo number_format($meResult['product_price'], 2); ?></td>
                                    <td ><?php echo number_format(($meResult['product_price'] * $_SESSION['qty'][$key]), 2); ?></td>
                                </tr>
                                <?php
								$num++;
								}
                            ?>
                            <tr class="bg-success">
                                <td colspan="8" style="text-align: right;">
                                    <h4>จำนวนเงินรวมทั้งหมด <?php echo number_format($total_price, 2); ?> บาท</h4>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" style="text-align: right;">
                                	<input type="hidden" name="formid" value="<?php echo $_SESSION['formid']; ?>"/>
                                	<a href="cart.php" type="button" class="btn btn-danger btn-lg">ย้อนกลับ</a>
                                    <button type="submit" class="btn btn-primary btn-lg">บันทึกการสั่งซื้อสินค้า</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <?php
				}
            ?>


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="bootstrap/js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
<?php
mysql_close();
