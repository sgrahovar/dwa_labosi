<?php

session_start();



//echo '<p style="color: white;">Username: '.$_SESSION['Username'].'</p>';

include_once('config.php');

    if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
    {
		$query = "SELECT * FROM Users WHERE Username = '".$_POST['username']."' AND Password = '".$_POST['password']."'";
		$r = mysqli_query($con, $query);
		if(mysqli_num_rows($r) > 0)
		{
			$_SESSION['Username'] = $_POST['username'];
	//		echo '<p style="color: white;">Logged in</p>';
		}
		else header('Location: login.html');
	}

if(!isset($_SESSION['Username']))
{
	header('Location: login.html');
}


?>

 <!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<link rel="stylesheet" type="text/css" href="style.css"> 
<link href='http://fonts.googleapis.com/css?family=Oswald|Jura' rel='stylesheet' type='text/css'>
<!--
Preferirana boja na
stranici je #BC1F2A, uz slične boje #7A0A12 i #DE535D, s nasuprotnim triadnim bojama
#14786D i #88B51E
-->
<head>
<title>My Title</title>
</head>

<body>

<div id="wrapper">

	<div id="header">
		<div id="logo">
			<img src="images/logo.png" style="width: 100%; height: 100%">
		</div>
		<div id="user" style="margin-left: 10px;">
			<?php 

			if(isset($_POST['logoutButton']))
			{
				unset($_SESSION['Username']);
				header('Location: login.html');
			}

					echo '<p style="color: white;">Logged in as: '. $_SESSION['Username']
					.'<form method="post" action="" style="margin-top: -30px;"> <input type="submit" name="logoutButton" value="Logout"> </form></p>';
		 	?>
		</div>
		<div class="clear"></div>
	</div>

	<div id="c2">

		<div class="col1">
			<ul>
				<li><a href="login.html">Login.html</a></li>
				<li><a href="login.php">Login.php</a></li>
				<li><a href="popis.php">Tablica</a></li>
				<li><a href="insert.php">Insert u tablicu</a></li>
				<li><a href="insertTipProizvoda.php">Insert - tip proizvoda</a></li>
				<li class="last"><a href="insertAlergen">Insert - alergeni</a></li>
			</ul> 
		</div>

		<div class="col mar">
			<h2>Osobni podaci</h2>
			<p>Sanjin Grahovar Sadikovic, 24.08.1991</p>

			<h2>Podaci o skolovanju</h2>
				<ul>
					<li>Osnovna skola Petar Zrinski, 1998 - 2006</li>
					<li>Srednja skola - Tehnicka skola Rudera Boskovica, 2006 - 2010</li>
					<li>Fakultet - Tehnicko veleuciliste u Zagrebu, 2012 - danas</li>
				</ul>

			<h2>Podaci o radnom iskustvu</h2>
			<p>Bla</p>

			<h2>Znanja i vjestine</h2>
			<p>Bla</p>
		</div>

		<div class="clear"></div>

	</div>

	<div id="copyright">
		Copyright ZKD, 2014	
	</div>

</div>

</body>
</html>