<?php
/*
 * set var
 */
$cfHost = "localhost";
$cfUser = "root";
$cfPassword = "snackjack2499";
$cfDatabase = "shopping_cart";

/*
 * connection mysql
 */
$meConnect = mysql_connect($cfHost, $cfUser, $cfPassword) or die("Error conncetion mysql...");
$meDatabase = mysql_select_db($cfDatabase);
mysql_query("SET NAMES UTF8");
