<?php
mysql_connect('localhost','root',''); mysql_select_db('db_ticketing');
require('../../assets/fpdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");
$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->Image('../../assets/images/logo-def.png',2,0.8,1.6,1.6);
$pdf->SetX(5);            
$pdf->MultiCell(19.5,0.3,'REKAP DATA WUZ TICKET',0,'L');   
$pdf->SetFont('Arial','B',10);
$pdf->SetX(5);
$pdf->MultiCell(19.5,0.5,'JL. Entah Dimana',0,'L');
$pdf->SetX(5);
$pdf->MultiCell(19.5,0.5,'email : cswuz@gmail.com',0,'L');
$pdf->Line(1,2.6,28.5,2.6);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,2.7,28.5,2.7);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(26.5,0.7,"REKAP DATA RUTE",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);

$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);

$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Kode', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Keberangkatan', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Asal', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Tujuan', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Harga', 1, 0, 'C');
$pdf->Cell(7, 0.8, 'Transportasi', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
$query=mysql_query("select * from rute");
while($lihat=mysql_fetch_array($query)){
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(2, 0.8, $lihat[0],1, 0, 'C');
	$pdf->Cell(4, 0.8, $lihat[1], 1, 0,'C');
	$qry=mysql_query("SELECT*FROM place where kd_place='$lihat[2]'");
                  while($jen=mysql_fetch_array($qry)){
	$pdf->Cell(5, 0.8, $jen[1],1, 0, 'C'); }
	$qry=mysql_query("SELECT*FROM place where kd_place='$lihat[3]'");
                  while($jennn=mysql_fetch_array($qry)){
	$pdf->Cell(5, 0.8, $jennn[1], 1, 0,'C'); }
	$pdf->Cell(3, 0.8, $lihat[4], 1, 0,'C');
	$qry=mysql_query("SELECT*FROM transportation where kd_transportation='$lihat[5]'");
                  while($jenn=mysql_fetch_array($qry)){
	$pdf->Cell(7, 0.8, $jenn[1], 1, 1,'C');
		}

	$no++;
}

$pdf->Output("lap_penerimaan.pdf","I");

?>

