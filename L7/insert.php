<?php
session_start();
if(!isset($_SESSION['Username']))
{
	$_SESSION['Username'] = null;
	header('Location: login.html');
}


include_once('config.php');

/*
http://stackoverflow.com/questions/4997252/get-post-from-multiple-checkboxes
*/

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

		<div class="col mar" style="text-align: center; color: white;">

			<form method="post" action="">

				<label for="u">Naziv:</label> </br>
				<input type="text" name="nazivProizvoda" id="u"> </br>

				<label for="t">Tip proizvoda:</label> </br>
				<select name="tipProizvoda">
				<?php
					$tip = mysqli_query($con,"SELECT * FROM tipproizvoda");
					
					while($tipArray = mysqli_fetch_array($tip))
						echo '<option value="'.$tipArray['ID'].'">'.$tipArray['Tip'].'</option>';
				?>
				</select><br>

				<label for="o">Opis proizvoda:</label> </br>
				<textarea name="opisProizvoda" id="o"></textarea> </br>

				<label for="v">Vegetarijanski: </label> </br>
				<select name="veg">
					<option value="1">Da</option>
					<option value="0">Ne</option>
				</select>
				</br>

				<label for="h">Halal:</label> </br>
				<select name="hal">
					<option value="1">Da</option>
					<option value="0">Ne</option>
				</select>
				</br>

				<label for="k">Koser:</label> </br>
				<select name="kos">
					<option value="1">Da</option>
					<option value="0">Ne</option>
				</select>
				</br>

				<label for="a">Alergeni:</label> </br>
				<div style="width: 300px; margin: 0 auto;">
				<?php
				$alergen = mysqli_query($con,"SELECT * FROM alergeni");
				
				while($alergenArray = mysqli_fetch_array($alergen))
					echo '<label>
							<div style="width: 150px; text-align: left; float: left;">
							<input type="checkbox" value="'.$alergenArray['ID'].'" name="alergeni[]">'.$alergenArray['Naziv'].'</option>
							</div>
						  </label>';
				?>
				<div style="clear: both;"></div>
				</div>


				</br><label for="c">Cijena:</label> </br>
				<input type="text" name="cijenaProizvoda" id="c">

				</br>
				</br>

				<input type="submit" value="Submit" name="submit"> </br>

			</form>

		</div>

		<div class="clear"></div>

	</div>

	<div id="copyright">
		Copyright ZKD, 2014	
	</div>

</div>

</body>
</html>

<?php

if(isset($_POST['submit']))
{
	$valueString = "";
	$id = 1;
//	print_r($_POST['alergeni']);


	
	$query1 = "INSERT INTO proizvod (NazivProizvoda, TipProizvodaId, OpisProizvoda, Vegetarijanski, Halal, Koser, Cijena) VALUES('".$_POST['nazivProizvoda']."', '".$_POST['tipProizvoda']."','".$_POST['opisProizvoda']."', '".$_POST['veg']."', '".$_POST['hal']."', '".$_POST['kos']."', '".$_POST['cijenaProizvoda']."')";
	$query2 = "INSERT INTO alergenihelper (proizvodId, alergenId) VALUES ".substr($valueString, 0, -2);

	mysqli_autocommit($con, false);
	$flag = true;

	/* PRVI QUERY
	*************************************/
	$result = mysqli_query($con, $query1);
	if(!$result) {$flag = false; echo 'fail, q1';}

	$id = mysqli_insert_id($con);
	foreach($_POST['alergeni'] as $val)
	{
		$valueString .= '(' . $id . ', ' . $val . '), ';
	}

	/* DRUGI QUERY
	*************************************/
	$result = mysqli_query($con, $query2);
	if(!$result) {$flag = false; echo 'fail, q2';}


	/* COMMIT ILI ROLLBACK
	*************************************/
	if ($flag) 
	{
	mysqli_commit($con);
	} 
	else 
	{
	mysqli_rollback($con);
	} 

}

?>