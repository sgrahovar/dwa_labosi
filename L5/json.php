<?php
session_start();

/*
if(!isset($_SESSION['Username']))
{
	$_SESSION['Username'] = null;
	header('Location: login.html');
}
*/
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
<meta charset="UTF-8">
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
				<div style="text-align: center; margin-bottom: 30px;">
					<form method='post' action=''>
						<input type="text" id="filterProizvodac" name="filterProizvodac">
						<input type="text" id="filterProizvod" name="filterProizvod">
						<input type="submit" name="submitJson" value="Pretrazi">
					</form>
				</div>

			<table id="popisTable">
				
			</table>

		</div>

		<div class="clear"></div>

	</div>

	<div id="copyright">
		Copyright ZKD, 2014	
	</div>

</div>

<script>
function myFunction() {
		var val = document.getElementById('filterTable').value;
        var x = document.getElementsByClassName("row");
        var i = 0;
        var y;

        console.log("X length - " + x.length);

        for (i = 0; i < x.length; i++)
        {
        	y = x[i].getElementsByTagName("td");
        	var skip = 0;
        	//if ((y[0].textContent).toLowerCase().indexOf((val).toLowerCase()) < 0 || (y[2].textContent).toLowerCase().indexOf((val).toLowerCase()) < 0)
        	if((y[0].textContent).toLowerCase().indexOf((val).toLowerCase()) < 0)
        	{
        		x[i].style.display = 'none';
        	}
        	else
        	{	
        		console.log((y[0].textContent).toLowerCase());
        		skip = 1;
        		x[i].style.display = null;
        	}

        	if((y[2].textContent).toLowerCase().indexOf((val).toLowerCase()) < 0 && skip == 0)
        	{
        		x[i].style.display = 'none';
        	}
        	else
        	{	
        		console.log((y[2].textContent).toLowerCase());
        		x[i].style.display = null;
        	}
        }
}
</script>

</body>
</html>
