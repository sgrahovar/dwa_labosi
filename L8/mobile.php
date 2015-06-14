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
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">	-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Seminar 2</title>

	<!-- Bootstrap -->
	<link href="Scripts/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="style.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Economica|Jura|Shadows+Into+Light+Two|Amaranth' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="Scripts/zebra_datepicker/css/bootstrap.css" type="text/css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
</head>

<body style="background-color: rgb(188, 31, 42);">

<div id="wrapper" class="content-fluid">

	<div id="c2" >

		<div class="col mar col-sm-12" style="max-width: 100%; height: 100%;">
				<div style="text-align: center; margin-bottom: 30px;">
					<form method='post' action='pdf.php'>
						<input type="text" id="filterTable" name="filterTable">
						<button type="button" id="buttonSubmitAjax">Search Ajax</button>
						<input type="submit" name="submitPdf" value="Stvori PDF">
					</form>
				</div>

				<div id="sveOProizvodu">
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
								GROUP BY proizvod1.id LIMIT 0, 1";


					$r = mysqli_query($con, $query);
					
					while($rArray = mysqli_fetch_array($r))
					{
						echo '<h2>Naziv proizvoda: <i>'. $rArray['NazivProizvoda'] .'</i></h2>';
						echo '<h2>Tip proizvoda: <i>'. $rArray['Tip'] .'</i></h2>';
						echo '<h2>Opis proizvoda: <i>'. $rArray['OpisProizvoda'] .'</i></h2>';
						echo '<p style="margin-top: 10px;">Vegetarijanski: <i>'. ($rArray['Vegetarijanski'] == 1 ? 'DA' : 'NE') .'</i></p>';
						echo '<p>Halal: <i>'. ($rArray['Halal'] == 1 ? 'DA' : 'NE') .'</i></p>';
						echo '<p>Koser: <i>'. ($rArray['Koser'] == 1 ? 'DA' : 'NE') .'</i></p>';
						echo '<p>Alergeni: <i>'. $rArray['Alergeni'] .'</i></p>';
						echo '<p style="color: orange;">Cijena: <i>'. $rArray['Cijena'] .'</i></p>';
					}
				?>
				</div>



		</div>

		<div class="footer navbar-fixed-bottom">

			<div id="num" >
				<button type="button" id="pagePrevious" style="width: 45%; float: left;"> Previous </button>
				<span style="color: white;" id="page_value" style="width: 10%;"> 1 </span>
				<button type="button" id="pageNext" style="width: 45%; float: right;"> Next </button>
			</div>

		</div>


</div>


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

		<script src="Scripts/jquery-1.11.2.min.js"></script>
		<script src="Scripts/jquery-1.3.2-mobile.custom.min.js"></script>
		<script src="Scripts/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>


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
		  url: "getAjaxData2.php",
		  method: "POST",
		  data: { search : $('#filterTable').val(), pageValue : $('#page_value').text() },
		  dataType: "html"
		});
		 
		request.done(function( data ) {
			$('#sveOProizvodu').empty();
			$("#sveOProizvodu").append(data);
//			alert(data);
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
