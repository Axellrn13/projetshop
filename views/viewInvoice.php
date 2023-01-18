<?php

ob_start();

require_once('FPDF/fpdf.php');

$pdf = new FPDF( 'P', 'mm', 'A4' );
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130 ,5,'WEB4SHOP',0,0);
$pdf->Cell(59 ,5,'Facture',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130 ,5,'15 Bd André Latarjet',0,0);
$pdf->Cell(59 ,5,'',0,1);//end of line

$pdf->Cell(130 ,5,'69100 Villeurbanne',0,0);
$pdf->Cell(25 ,5,'Date',0,0);
$pdf->Cell(34 ,5,date("Y-m-d"),0,1);//end of line

$pdf->Cell(130 ,5,'0625136894',0,0);
$pdf->Cell(25 ,5,'Facture n°',0,0);
$pdf->Cell(34 ,5,random_int(1000000, 9999999),0,1);//end of line

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Numéro de client',0,0);
$pdf->SetX($pdf->GetX() + 10);
$pdf->Cell(40 ,5,$orders->customer_id(),0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//billing address
$pdf->Cell(100 ,5,'Facture destinée à :',0,1);//end of line
$pdf->Cell(189 ,5,'',0,1);

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,$customers[0]->surname()." ".$customers[0]->forname(),0,1);
$pdf->Cell(10 ,5,'',0,0);
$address;
$phone;
foreach($delivery_addresses as $del):
    if($del->id() == $orders->delivery_add_id()){
        $address = $del->add1();
        $phone = $del->phone();
    }
endforeach;
$pdf->Cell(90 ,5,$address,0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,$phone,0,1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(130 ,5,'Articles',1,0);
$pdf->Cell(25 ,5,'Prix unitaire',1,0);
$pdf->Cell(34 ,5,'Quantité',1,1);//end of line

$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter
foreach ($ordersitems as $orderitem) :
    if($orderitem->order_id() == $orders->id()){
        foreach ($articles as $article):
            if ($article->id() == $orderitem->product_id()) {
                $pdf->Cell(130 ,5,$article->name(),1,0);
                $pdf->Cell(25 ,5,$article->price().'€',1,0);
                $pdf->Cell(34 ,5,$orderitem->quantity(),1,1,'R');
            }
        endforeach;
    }
endforeach;

//summary
$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Taux TVA',0,0);
$pdf->Cell(4 ,5,'€',1,0);
$pdf->Cell(30 ,5,'20%',1,1,'R');//end of line

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Total TTC',0,0);
$pdf->Cell(4 ,5,'€',1,0);
$pdf->Cell(30 ,5,$orders->total(),1,1,'R');//end of line

$pdf->Output();

?>