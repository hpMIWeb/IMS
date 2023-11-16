<?php
session_start();
require_once('tcpdf/tcpdf.php');


class MYPDF extends TCPDF
{
    //Page header
    public function Header()
    {

    }

    public function Footer(){
        $this->SetY(-12);
        $this->SetFont('helvetica', 'B', 9);
        $this->Cell(280,5,'Page ' . $this->PageNo().'/'. $this->getAliasNbPages(),'',1,'C');
    }

    function ownDetails()
    {


       $this->SetFont('helvetica','B', 15);
        $this->Cell(280, 0, "YOUNG ENGINEERING", 0, 1, 'C');
        // Add a bottom border
        $this->Cell(280, 2, '', 'B', 0, 'C');
        $this->Ln();  // Move to the next line  
        $this->SetFont('helvetica', 5);  // Set a smaller font size for the address
        // Address
        $this->Cell(280, 0, "8, Rangvarsha Soc., NR. Shreyas Crossing", 0, 1, 'C');

       

    }

    function ImprovedTable2_2()
    {
        global $conn;
        

       
        $w = array(190);

        $this->SetFont('times','',8);
        $this->SetLineWidth(.3);
        $w = array(95,95);
        $this->SetFont('times','',8);
        $this->SetLineWidth(.3);
        $this->Cell($w[0],5,"TPIA : ",'LRBT',0,'L');
        $this->Cell($w[1],5,"Work Order Date : ",'LRT');

        $this->Ln();
        $w = array(95,95);
        $this->SetFont('times','',8);
        $this->SetLineWidth(.3);
        $this->Cell($w[0],5,"Contract Value With GST  :gfbgf ",'LRBT',0,'L');
        $this->Cell($w[1],5,"Work Period : ",'LRBT',0,'L');

        $this->Ln();
        $w = array(190);
        $this->SetFont('times','',8);
        $this->Cell($w[0],5,"Project Name : cds",'LRTB',1,'L');


    }

    function ImprovedTable2_3()
    {
        global $conn;

        $w = array(165,25);

       

        $this->SetFont('times','B',8);
        $this->SetLineWidth(.3);
        $this->Cell($w[0],5,"Total Amount with Tax (Rs.) ",'LRTB',0,'R');
        $this->Cell($w[1],5,"vdvdf",'LRTB',0,'R');
        $this->Ln();

        $this->SetFont('times','B',8);
        $this->SetLineWidth(.3);

        $this->Cell($w[0],5,"Net Amount ",'LRTB',0,'R');
        $this->Cell($w[1],5,(151515),'LRTB',0,'R');
        $this->Ln();
    }

    function ImprovedTable2_4()
    {
        global $conn;
        $netamount = 155;
        $pmcmpname =  "vsdvjsv";
        $amountinwords =  "vsvjkf";
        $amountproper = ucwords("vdsvsdvsdv");

        $this->SetFont('times','B',8);
        $this->SetLineWidth(.3);
        $this->MultiCell(0,5,"Total Amount in Words: INR $amountproper",'LRBT','L');

        $company ="vsdv";
        $cperson = 'pmcontactpname';


       
        $w= array(95,5,90);
        $this->SetFont('times','B',8);
        $this->SetLineWidth(.3);
        $this->Cell($w['0'],5," BANKING DETAILS",'LRBT',0,'C');
        $this->Cell($w['1'],5,"",'',0,'C');
        $this->Cell($w['2'],5," BASIC DETAILS",'LRBT',0,'C');
        $this->Ln();

        $w= array(40,55,5,45,45);

        $this->SetFont('times','',8);
        $this->SetLineWidth(.3);
        $this->Cell($w['0'],5,"Bank Name",'LB',0,'L');
        $this->Cell($w['1'],5,"vsvsdv",'LRTB',0,'L');
        $this->Cell($w['2'],5,"",'',0,'L');
        $this->Cell($w['3'],5,"Gst Number",'LRTB',0,'L');
        $this->Cell($w['4'],5,"vsnvl",'LRTB',0,'L');

        $this->Ln();

        $this->SetFont('times','',8);
        $this->SetLineWidth(.3);
        $this->Cell($w['0'],5,"Bank Account Number",'LB',0,'L');
        $this->Cell($w['1'],5,"vsdvsvsdv",'LRTB',0,'L');
        $this->Cell($w['2'],5,"",'',0,'L');
        $this->Cell($w['3'],5,"Pan Number",'LRTB',0,'L');
        $this->Cell($w['4'],5,"vsdv",'LRTB',0,'L');
        $this->Ln();

      
        $this->SetFont('times','',8);
        $this->SetLineWidth(.3);
        $this->Cell($w['0'],5,"Branch Code/ Name ",'LB',0,'L');
        $this->Cell($w['1'],5,"vsklv",'LRTB',0,'L');
        $this->Cell($w['2'],5,"",'',0,'L');
        $this->Cell($w['3'],5,"Contact Person Name",'LRTB',0,'L');
        $this->Cell($w['4'],5,"Vsdvdsvsdv",'LRTB',0,'L');
        $this->Ln();

        $this->SetFont('times','',8);
        $this->SetLineWidth(.3);
        $this->Cell($w['0'],5,"Branch IFSC Code ",'LB',0,'L');
        $this->Cell($w['1'],5,"vsvdsv",'LRTB',0,'L');
        $this->Cell($w['2'],5,"",'',0,'L');
        $this->Cell($w['3'],5,"Contact Number",'LRTB',0,'L');
        $this->Cell($w['4'],5,"vsdvds",'LRTB',0,'L');
        $this->Ln();

        $this->SetFont('times','',8);
        $this->SetLineWidth(.3);
        $this->Cell($w['0'],5,"Branch MICR Code",'LB',0,'L');
        $this->Cell($w['1'],5,"vsdvsdvd",'LR',0,'L');
        $this->Cell($w['2'],5,"",'R',0,'L');
        $this->Cell($w['3'],5,"",'',0,'L');
        $this->Cell($w['4'],5,'','R',0,'L');
        $this->Ln();

        $displayPreaparedByName ="vsdv";
        $displayTpiaName = 'tpianame';
        $displayClientName = 'cname'    ;


        //get prepared by
    

        $w= array(64,63,63);

        $this->SetFont('times','B',9);
        $this->SetLineWidth(.3);
       // $this->Cell($w[0],5,"Prepared By ($displayPreaparedByName)",'LRBT',0,'C');
        //$this->Cell($w[1],5,"Reviewed & Checked By (TPIA - $displayTpiaName)",'LRTB',0,'C');
       // $this->Cell($w[2],5,"For Information To ($displayClientName)",'LRTB',0,'C');
        $this->MultiCell($w[0],10,"Prepared By ($displayPreaparedByName)",'LRBT','L', 0, 0);
        $this->MultiCell($w[1],10,"Reviewed & Checked By (TPIA - $displayTpiaName)",'LRBT','L', 0, 0);
        $this->MultiCell($w[2],10,"For Information To ($displayClientName)",'LRBT','L', 0, 1);
//        $this->Cell($w[0],5,"Prepared By ($displayPreaparedByName)",'LRBT',0,'C');
//        $this->Cell($w[1],5,"Reviewed & Checked By (TPIA - $displayTpiaName)",'LRTB',0,'C');
//        $this->Cell($w[2],5,"For Information To ($displayClientName)",'LRTB',0,'C');
//        $this->Ln();
        $this->SetFont('times','',9);
        $this->SetLineWidth(.3);
        $this->Cell($w[0],5,"Name : vsdvsdv ",'LRTB',0,'L');
        $this->Cell($w[1],5,"Name : vsdvsdv ",'LRTB',0,'L');
        $this->Cell($w[2],5,"Name :  ",'LRTB',0,'L');
        $this->Ln();

        $this->SetFont('times','',9);
        $this->SetLineWidth(.3);
        $this->Cell($w[0],5,"Sign : ",'LRTB',0,'L');
        $this->Cell($w[1],5,"Sign : ",'LRTB',0,'L');
        $this->Cell($w[2],5,"Sign : ",'LRTB',0,'L');
        $this->Ln();

        $this->SetFont('times','',9);
        $this->SetLineWidth(.3);
        $this->Cell($w[0],5,"Date : ",'LRTB',0,'L');
        $this->Cell($w[1],5,"Date : ",'LRTB',0,'L');
        $this->Cell($w[2],5,"Date : ",'LRTB',0,'L');
        $this->Ln();

    }

    function ImprovedTable2_5()
    {
        $w = array(150,40);

        
        $this->SetFont('times','B',10);
        $this->SetLineWidth(.3);
        $this->Cell($w[0],6,"Total",'LRTB',0,'R');
        $this->Cell($w[1],6,1515,'LRTB',0,'C');

        $this->Ln();

    }

    function ImprovedTable2_6()
    {
        global $conn;
        //get data
        $getInvoiceId =1515;
        $userName = $userDesignation = '';
        $emplyeeName = $empDesignation = '';


        $this->SetFont('times','',10);
        $appendTable = '<style>
				table, td {								 
				    font-size:10px;
				    font-weight:normal;
					padding:2px;
					text-align:center;
					
				}
				</style>
                <table>';
        $appendTable .='<tr>';
            $appendTable .='<td colspan="2" style="text-align: left;border: 0.5px solid #000;">Mesurements & Bill Prepared by</td>';
            $appendTable .='<td colspan="2" style="text-align: left;border: 0.5px solid #000;">Mesurements & Bill Accepted by</td>';
        $appendTable .='</tr>';

        $appendTable .='<tr>';
        $appendTable .='<td colspan="2" style="text-align: left;border: 0.5px solid #000;"><b>For,</b></td>';
        $appendTable .='<td colspan="2" style="text-align: left;border: 0.5px solid #000;"><b>For, </b></td>';
        $appendTable .='</tr>';

        $appendTable .='<tr>';
        $appendTable .='<td style="text-align: left; width: 12%;;border: 0.5px solid #000;">Name:</td>';
        $appendTable .='<td style="text-align: left; width: 38%;;border: 0.5px solid #000;"><b>'.$userName.'</b></td>';
        $appendTable .='<td style="text-align: left; width: 12%;;border: 0.5px solid #000;">Name:</td>';
        $appendTable .='<td style="text-align: left; width: 38%;;border: 0.5px solid #000;"><b>'.$emplyeeName.'</b></td>';
        $appendTable .='</tr>';


        $appendTable .='<tr>';
        $appendTable .='<td style="text-align: left; width: 12%;;border: 0.5px solid #000;">Designation:</td>';
        $appendTable .='<td style="text-align: left; width: 38%;;border: 0.5px solid #000;"><b>'.$userDesignation.'</b></td>';
        $appendTable .='<td style="text-align: left; width: 12%;;border: 0.5px solid #000;">Designation:</td>';
        $appendTable .='<td style="text-align: left; width: 38%;;border: 0.5px solid #000;"><b>'.$empDesignation.'</b></td>';
        $appendTable .='</tr>';

//        $appendTable .='<tr>';
//        $appendTable .='<td colspan="2" style="text-align: left; width: 50%;border-top: none !important; border-bottom: none;!important; border-left: 0.5px solid #000; !important; border-right: 0.5px solid #000; !important;"></td>';
//        $appendTable .='<td style="text-align: left; width: 12%;border: 0.5px solid #000;">Employee Code No:</td>';
//        $appendTable .='<td style="text-align: left; width: 38%;;border: 0.5px solid #000;"><b></b></td>';
//        $appendTable .='</tr>';

        $appendTable .='<tr>';
        $appendTable .='<td colspan="2" style="text-align: left; width: 50%; border-top: none !important; border-bottom: none;!important; border-left: 0.5px solid #000; !important; border-right: 0.5px solid #000; !important; "></td>';
        $appendTable .='<td colspan="2" style="text-align: left; width: 50%; border-top: none !important; border-bottom: none;!important; border-left: 0.5px solid #000; !important; border-right: 0.5px solid #000; !important; "></td>';
        $appendTable .='</tr>';

        $appendTable .='<tr>';
        $appendTable .='<td colspan="2" style="text-align: left; width: 50%; border-top: none !important; border-bottom: none;!important; border-left: 0.5px solid #000; !important; border-right: 0.5px solid #000; !important; "></td>';
        $appendTable .='<td colspan="2" style="text-align: left; width: 50%; border-top: none !important; border-bottom: none;!important; border-left: 0.5px solid #000; !important; border-right: 0.5px solid #000; !important; "></td>';
        $appendTable .='</tr>';

        $appendTable .='<tr>';
        $appendTable .='<td colspan="2" style="text-align: left; width: 50%; border-top: none !important; border-bottom: none !important; border-left: 0.5px solid #000; !important; border-right: 0.5px solid #000; !important;"></td>';
        $appendTable .='<td colspan="2" style="text-align: left; width: 50%; border-top: none !important; border-bottom: none !important; border-left: 0.5px solid #000; !important; border-right: 0.5px solid #000; !important;"></td>';
        $appendTable .='</tr>';

        $appendTable .='<tr>';
        $appendTable .='<td colspan="2" style="text-align: left; width: 50%; border-top: none !important; border-bottom: none !important; border-left: 0.5px solid #000; !important; border-right: 0.5px solid #000; !important;"></td>';
        $appendTable .='<td colspan="2" style="text-align: left; width: 50%; border-top: none !important; border-bottom: none !important; border-left: 0.5px solid #000; !important; border-right: 0.5px solid #000; !important;"></td>';
        $appendTable .='</tr>';

        $appendTable .='<tr>';
        $appendTable .='<td colspan="2" style="text-align: left; width: 50%; border-top: none !important; border-bottom: none !important; border-left: 0.5px solid #000; !important; border-right: 0.5px solid #000; !important;"></td>';
        $appendTable .='<td colspan="2" style="text-align: left; width: 50%; border-top: none !important; border-bottom: none !important; border-left: 0.5px solid #000; !important; border-right: 0.5px solid #000; !important;"></td>';
        $appendTable .='</tr>';

        $appendTable .='<tr>';
        $appendTable .='<td colspan="2" style="text-align: left;border: 0.5px solid #000;">Authorised signatory/Signature & Stamp</td>';
        $appendTable .='<td colspan="2" style="text-align: left;border: 0.5px solid #000;">Authorised signatory/Signature & Stamp</td>';
        $appendTable .='</tr>';

        $appendTable .='</table>';

        $this->writeHTML($appendTable, false, false, true, false, '');






    }
}

$pdf = new MYPDF('L', 'mm', 'A4', true, 'UTF-8'); // Set 'L' for landscape
$pdf->AddPage();
$pdf->ownDetails();
//$pdf->ImprovedTable2_2();
//$pdf->ImprovedTable2_3();

$pdf->SetFont('Times', '', 12);
//$pdf->Output();
$pdf->Output('INVOICE.pdf','I');
?>