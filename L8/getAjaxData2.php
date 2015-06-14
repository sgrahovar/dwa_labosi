<?php
	include_once('config.php');
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
				WHERE proizvod1.NazivProizvoda LIKE '%".$_POST['search']."%'
				OR proizvod1.OpisProizvoda LIKE '%".$_POST['search']."%'
				GROUP BY proizvod1.id LIMIT ". (($_POST['pageValue']-1)) .", 1";


	$r = mysqli_query($con, $query);
	
	if($r != null)

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