<?php
$con = mysqli_connect('127.0.0.1', 'root', 'sanjin11', 'dwa - l2');
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }	

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
				if(isset($_GET['username']))
				{
					echo 'Username: ' . $_GET['username'] . '&nbsp&nbsp&nbsp&nbsp&nbsp';
					echo '<button type="button">Odjava</button>';
				}
				else echo 'Niste loginani.';
		 	?>
		</div>
		<div class="clear"></div>
	</div>

	<div id="c2">

		<div class="col1">
			<ul>
				<li><a href="#">Link #1</a></li>
				<li><a href="#">Link #2</a></li>
				<li><a href="#">Link #3</a></li>
				<li class="last"><a href="#">Link #4</a></li>
			</ul> 
		</div>

		<div class="col mar" style="text-align: center; color: white;">

			<form method="post" action="">

				<label for="u">Naziv:</label> </br>
				<input type="text" name="nazivProizvoda" id="u"> </br>

				<label for="t">Tip proizvoda:</label> </br>
				<select name="tipProizvoda">
				<?php
					$r = mysqli_query($con,"SELECT * FROM tipproizvoda");
					
					while($rArray = mysqli_fetch_array($r))
						echo '<option value="'.$rArray['ID'].'">'.$rArray['Tip'].'</option>';

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

				<label for="c">Cijena:</label> </br>
				<input type="text" name="cijenaProizvoda" id="c">

				</br>
				</br>

				<input type="submit" value="Submit"> </br>

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
	$r = mysqli_query($con,"INSERT INTO proizvod (NazivProizvoda, TipProizvoda, OpisProizvoda, Vegetarijanski, Halal, Koser, Cijena) VALUES('".$_POST['nazivProizvoda']."', '".$_POST['tipProizvoda']."','".$_POST['opisProizvoda']."', '".$_POST['veg']."', '".$_POST['hal']."', '".$_POST['kos']."', '".$_POST['cijenaProizvoda']."')");
}

?>