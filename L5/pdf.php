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
					WHERE proizvod1.NazivProizvoda LIKE '%".$_POST['filterTable']."%' OR proizvod1.OpisProizvoda LIKE '%".$_POST['filterTable']."%'
					GROUP BY proizvod1.id";

		$r = mysqli_query($con, $query);
		

include("fpdf/fpdf.php");

function _convert($str) {
    return iconv('UTF-8', 'iso-8859-2//TRANSLIT', $str);
}

$pdf=new FPDF();

$pdf->AddFont('arial','i','f072f536a4ed854c0b9b83012693c7f4_ariali.php');
$pdf->AddFont('arial','b','d4a27eed1986515f89b2ef5bba4fe927_arialbd.php');
$pdf->AddFont('arial','','1ee15561d6f7eb750ccbd7b4d1336623_arial.php');

//set font for the entire document
$pdf->SetFont('arial','b',20);
$pdf->SetTextColor(50,60,100);

//set up a page
$pdf->AddPage('P'); 

//display the title with a border around it
$pdf->SetXY(50,20);
$pdf->SetDrawColor(50,60,100);
$pdf->Cell(100,10,'Proizvodi',1,0,'C',0);

//Set x and y position for the main text, reduce font size and write content

$i = 40;
while($row = mysqli_fetch_array($r))
{	
	//Naziv proizvoda
	$pdf->SetXY(10, $i);
	$pdf->SetFontSize(20);
	$pdf->Write(5, _convert($row["NazivProizvoda"]));

	//Opis proizvoda
	$pdf->SetXY(10.5, $i+5);
	$pdf->SetFontSize(10);
	$pdf->Write(5, _convert($row["OpisProizvoda"]));

	//Alergeni
	$pdf->SetXY(10.5, $i+10);
	$pdf->SetFontSize(10);
	$pdf->Write(5, _convert('Alergeni: ' . $row["Alergeni"]));

	//Cijena
	$pdf->SetXY(10.5, $i+15);
	$pdf->SetFontSize(10);
	$pdf->Write(5, 'Cijena: ' . $row["Cijena"]);
	$i += 30;
}

ob_end_clean();
//Output the document
$pdf->Output('example1.pdf','I'); 




?>