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
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
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
					<form method='post' action='pdf.php'>
						<input type="text" id="filterTable" name="filterTable">
						<button type="button" id="buttonSubmitAjax">Search Ajax</button>
						<input type="submit" name="submitPdf" value="Stvori PDF">
					</form>
				</div>

			<table id="popisTable">
				<tr class="header">
					<th>Naziv proizvoda</th>
					<th>Tip proizvoda</th>
					<th>Opis proizvoda</th>
					<th>Veg.</th>
					<th>Halal</th>
					<th>Koser</th>
					<th>Alergeni</th>
					<th>Cijena</th>
				</tr>

				<?php
					$query = "SELECT *,
								(
									SELECT GROUP_CONCAT(alergeni.naziv SEPARATOR ', ') FROM proizvod AS proizvod2
									INNER JOIN alergenihelper ON proizvod2.id = alergenihelper.proizvodId
									INNER JOIN alergeni ON alergenihelper.alergenid = alergeni.id
									WHERE proizvod2.id = proizvod1.id
									GROUP BY proizvod2.id
								) AS Alergeni
								FROM proizvod AS proizvod1
								INNER JOIN tipproizvoda on proizvod1.tipproizvodaid = tipproizvoda.id
								GROUP BY proizvod1.id ";


					$r = mysqli_query($con, $query);
					
					while($rArray = mysqli_fetch_array($r))
					{
						echo '<tr class="row">';
						echo '<td>'. $rArray['NazivProizvoda'] .'</td>';
						echo '<td>'. $rArray['Tip'] .'</td>';
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

			<div id="num" >
				<button type="button" id="pagePrevious"> Previous </button>
				<span style="color: white;" id="page_value"> 1 </span>
				<button type="button" id="pageNext"> Next </button>
			</div>

		</div>

		<div class="clear"></div>

	</div>

	<div id="copyright">
		Copyright ZKD, 2014	
	</div>

</div>


<script>
$( document ).ready(function() {

		var page = $('#page_value').text();

	$('#pageNext').on('click', function(){
		$('#page_value').text(Number(page) + 1);
		page = $('#page_value').text();
		searchAjax();
	});

	$('#pagePrevious').on('click', function(){
		$('#page_value').text(Number(page) - 1);
		page = $('#page_value').text();
		searchAjax();
	});

	$('#buttonSubmitAjax').on('click', function(){
		searchAjax();
		});

	function searchAjax()
	{	
		var request = $.ajax({
		  url: "getAjaxData.php",
		  method: "POST",
		  data: { search : $('#filterTable').val(), pageValue : $('#page_value').text() },
		  dataType: "html"
		});
		 
		request.done(function( data ) {
			$('#popisTable').find('tr.row').remove();
			$("#popisTable").append(data);
//			alert(data);
//			alert("Success");
		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  alert( "Request failed: " + textStatus );
		});
	}
//	});
});
</script>

</body>
</html>
