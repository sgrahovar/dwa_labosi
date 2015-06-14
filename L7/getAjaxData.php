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
				GROUP BY proizvod1.id";


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

/* Prvi zadatak - password

public function encryptPassword($password)
{
	return password_hash($password, PASSWORD_BCRYPT);
}

public function verifyPassword($password, $dbPassword)
{
	if( password_verify($password, $dbPassword) ) return 1;
	else return 0;
}

public function loginUser($data)
{
	$query = $this->connection->prepare("SELECT ID, Email, Password, Name, Surname FROM users WHERE Email = :email LIMIT 1");
	$query->bindParam(':email', $data['email']);

	$query->execute();
	$result = $query->fetch();

	if($result > 0)
	{
		if($this->verifyPassword($data['password'], $result['Password']))
		{
           $tmpArray = array(
               "ID" => $result['ID'],
               "Name" => $result['Name'],
               "Surname" => $result['Surname'],
               "Email" => $result['Email']
           );
           $_SESSION['User'] = $tmpArray;
           header('Location: index.php');

		}
		else echo 'Wrong password';
	}	
	else echo 'Wrong username / password.';
}
*/


?>