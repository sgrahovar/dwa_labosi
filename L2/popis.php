<?php
$con = mysqli_connect('127.0.0.1', 'root', 'sanjin11', 'dwa - l2');
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
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

		<div class="col mar">

			<div style="text-align: center; margin-bottom: 30px;">
				<input type="text" id="filterTable">
				<button type="button" id="buttonSubmit" onclick="myFunction()">Submit</button>
			</div>

			<table border="1" id="popisTable">
				<tr>
					<th>Naziv proizvoda</th>
					<th>Tip proizvoda</th>
					<th>Opis proizvoda</th>
					<th>Vegetarijanski</th>
					<th>Halal</th>
					<th>Koser</th>
					<th>Alergeni</th>
					<th>Cijena</th>
				</tr>

				<?php
					$r = mysqli_query($con,"SELECT * FROM proizvod");
					
					while($rArray = mysqli_fetch_array($r))
					{
						echo '<tr class="row">';
						echo '<td>'. $rArray['NazivProizvoda'] .'</td>';
						echo '<td>'. $rArray['TipProizvoda'] .'</td>';
						echo '<td>'. $rArray['OpisProizvoda'] .'</td>';
						echo '<td>'. ($rArray['Vegetarijanski'] == 1 ? 'DA' : 'NE') .'</td>';
						echo '<td>'. ($rArray['Halal'] == 1 ? 'DA' : 'NE') .'</td>';
						echo '<td>'. ($rArray['Koser'] == 1 ? 'DA' : 'NE') .'</td>';
						echo '<td>'. $rArray['Alergeni'] .'</td>';
						echo '<td>'. $rArray['Cijena'] .'</td>';
						echo '</tr>';
					}

				?>

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