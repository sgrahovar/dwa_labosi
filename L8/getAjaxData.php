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
				GROUP BY proizvod1.id LIMIT ". (($_POST['pageValue']-1)*3) .", 3";


	$r = mysqli_query($con, $query);
	
	if($r != null)

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