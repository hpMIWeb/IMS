<?php
//working
require_once('tcpdf/tcpdf.php');
session_start();
error_reporting(1);

include("DB/connection.php");


function displayInFormate($number){
   return number_format($number, 2, '.', ',');
}

$invoiceId = isset($_GET['id'])?$_GET['id']:1;
global $master_conn;
$invoiceDetails = [];
$invoiceDetails = [];
$_SESSION['invoiceId'] =$invoiceId;

if(!empty($invoiceId)){
    $invoiceResult = mysqli_query($master_conn, "SELECT * FROM invoice_master WHERE id='$invoiceId';");
    if ($invoiceResult) {
        // Fetch all data into an associative array
        $invoiceData = mysqli_fetch_assoc($invoiceResult);

        $invoiceItemId = $invoiceData['id'];
        
       
        
    } 
}

class MYPDF extends TCPDF {
    //Page header
    public function Header() {

        $tableHeader = '<style>
				table, td {					
				    font-size:10px;				  
					padding:2px;					
				}
				</style>';
        $tableHeader .= '<table style="width: 100%">';

            $tableHeader .= '<tr>';
            $tableHeader .= '<td style="width:20%;"></td>';
            $tableHeader .= '<td style="width:60%;"></td>';
            $tableHeader .= '<td style="text-align: right; width:20%;">Original Copy</td>';
            $tableHeader .= '</tr>';

            $tableHeader .= '<tr>';
            $tableHeader .= '<td style="width:20%;"></td>';
            $tableHeader .= '<td style="font-size: 20px;width:60%; text-align: center;"><u>SHREE HARI ENTERPRISE</u></td>';
            $tableHeader .= '<td style="width:20%;"></td>';
            $tableHeader .= '</tr>';

            $tableHeader .= '<tr>';
            $tableHeader .= '<td style="width:20%;"></td>';
            $tableHeader .= '<td style="font-size: 10px; width:60%;text-align: centerpadding:5px;">327,3rd,Villhal Plaza, Nr.Vraj Bhumi Apt .,Opp. GEB, New Naroda, Ahmedabad-382 330 </td>';
            $tableHeader .= '<td style="width:20%;"></td>';
            $tableHeader .= '</tr>';

            $tableHeader .= '<tr>';
            $tableHeader .= '<td style="width:20%;"></td>';
            $tableHeader .= '<td style="font-size: 10px; width:60%;text-align: center;">Email : shreeharient2107@gmail.com, M :98987 36438, 99987 13369</td>';
            $tableHeader .= '<td style="width:20%;"></td>';
            $tableHeader .= '</tr>';

            $tableHeader .= '<tr>';
            $tableHeader .= '<td style="width:20%;padding:5px;"></td>';
            $tableHeader .= '<td style="font-size: 10px; width:60%;text-align: center;padding:5px;"><b>TAX INVOICE</b></td>';
            $tableHeader .= '<td style="width:20%;padding:5px;"></td>';
            $tableHeader .= '</tr>';

        $tableHeader .= '</table>';

        $this->writeHTML($tableHeader, false, false, true, false, '');
        $getHeaderY = $this->GetY();
        $this->SetMargins(PDF_MARGIN_LEFT, $getHeaderY, PDF_MARGIN_RIGHT);
        $this->Ln(1);

    }

    public function ClientSection(){

        $tableClient = '<style>
				table, td {					
				    font-size:10px;				  
					padding:2px;										
				}
				</style>';
        $tableClient .= '<table style="width: 100%">';

        $tableClient .= '<tr>';
        $tableClient .= '<td style="width:25%;font-size: 8px;border-bottom: none;border-top: 0.5 solid #000;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"><b><i><u>Bill To</u></i></b></td>';
        $tableClient .= '<td style="width:25%;font-size: 8px;border-bottom: none;border-top: 0.5 solid #000;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"><b><i><u>Ship To</u></i></b></td>';
        $tableClient .= '<td style="width:25%;border-bottom: none;border-top: 0.5 solid #000;border-left: 0.5 solid #000;border-right: 0.5 solid #000;">PO NO.: 0000000</td>';
        $tableClient .= '<td style="width:25%;border-bottom: none;border-top: 0.5 solid #000;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"><b>INVOICE NO.: SHE-0134/2023-24</b></td>';
        $tableClient .= '</tr>';


        $tableClient .= '<tr>';
        $tableClient .= '<td style="width:25%;border-bottom: none;border-top: none;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"><b>M/s.:YOUNG ENGINEERS</b></td>';
        $tableClient .= '<td style="width:25%;border-bottom: none;border-top: none;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"><b>YOUNG ENGINEERS</b></td>';
        $tableClient .= '<td style="width:25%;border-bottom: none;border-top: none;border-left: 0.5 solid #000;border-right: 0.5 solid #000;">PO Date: 23/10/2023</td>';
        $tableClient .= '<td style="width:25%;border-bottom: none;border-top: none;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"><b>DATE: 23/10/2023</b></td>';
        $tableClient .= '</tr>';


        $address = nl2br("8,RANGVARSHA SOC.
        NR. SHREYAS CROSSING
                                         SHREE HARI APT LANE, PALDI");
        $tableClient .= '<tr>';
        $tableClient .= '<td style="width:25%;border-bottom: none;border-top: none;border-left: 0.5 solid #000;border-right: 0.5 solid #000;">'.$address.'</td>';
        $tableClient .= '<td style="width:25%;border-bottom: none;border-top: none;border-left: 0.5 solid #000;border-right: 0.5 solid #000;">C/O:- UMANG BHAI</td>';
        $tableClient .= '<td style="width:25%;border-bottom: none;border-top: none;border-left: 0.5 solid #000;border-right: 0.5 solid #000;">L.R. No.: 000000</td>';
        $tableClient .= '<td style="width:25%;border-bottom: none;border-top: none;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"></td>';
        $tableClient .= '</tr>';

        $stateAddress = nl2br("Ahmedabad, Guajrat");

        $tableClient .= '<tr>';
        $tableClient .= '<td style="width:25%;border-bottom: none;border-top: none;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"><b>'.$stateAddress.'</b></td>';
        $tableClient .= '<td style="width:25%;border-bottom: none;border-top: none;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"></td>';
        $tableClient .= '<td style="width:25%;border-bottom: none;border-top: none;border-left: 0.5 solid #000;border-right: 0.5 solid #000;">L.R. Date: 23/10/2023</td>';
        $tableClient .= '<td style="width:25%;border-bottom: none;border-top: none;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"></td>';
        $tableClient .= '</tr>';

        $tableClient .= '<tr>';
        $tableClient .= '<td style="width:25%;border-top: none;border-bottom: 0.5 solid #000;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"><b>GSTIN - 24BEEPS8196G1Z1</b></td>';
        $tableClient .= '<td style="width:25%;border-top: none;border-bottom: 0.5 solid #000;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"></td>';
        $tableClient .= '<td style="width:25%;border-top: none;border-bottom: 0.5 solid #000;border-left: 0.5 solid #000;border-right: 0.5 solid #000;">TRANSPORT: Self</td>';
        $tableClient .= '<td style="width:25%;border-top: none;border-bottom: 0.5 solid #000;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"></td>';
        $tableClient .= '</tr>';

        $tableClient .= '</table>';

        $this->writeHTML($tableClient, false, false, true, false, '');
    }

    public function ItemSection(){

        global $master_conn;
         $invoiceId  = $_SESSION['invoiceId']; 

        $tableItem = '<style>
                table, th {					
				    font-size:10px;				  
					padding:10px;
					border-bottom: 0.5 solid #000;										
					border-top: none;
					border-left: 0.5 solid #000;
					border-right: 0.5 solid #000;	
					background-color: #bdcebe;									
				}
				table, td {					
				    font-size:10px;				  
					padding:2px;
					border-bottom: none;										
					border-top: none;
					border-left: 0.5 solid #000;
					border-right: 0.5 solid #000;										
				}
				</style>';
        $tableItem .= '<table style="width: 100%">';
        $tableItem .= '<thead>';
        $tableItem .= '<tr>';
        $tableItem .= '<th style="text-align: center;width: 3%;" rowspan="2">S.N.</th>';
        $tableItem .= '<th style="text-align: center;width: 10%;" rowspan="2">ITEM CODE</th>';
        $tableItem .= '<th style="text-align: center;width: 18%;" rowspan="2">DESCRIPTION</th>';
        $tableItem .= '<th style="text-align: center;width: 7%;" rowspan="2">HSN/SAC CODE</th>';
        $tableItem .= '<th style="text-align: center;width: 4%;" rowspan="2">QTY</th>';
        $tableItem .= '<th style="text-align: center;width: 4%;" rowspan="2">UNIT</th>';
        $tableItem .= '<th style="text-align: center;width: 6%;" rowspan="2">RATE</th>';
        $tableItem .= '<th style="text-align: center;width:7%;" colspan="2">Discount</th>';
        $tableItem .= '<th style="text-align: center;width:6%;background-color: #bdcebe;" rowspan="2">Taxable Amount</th>';
        $tableItem .= '<th style="text-align: center;width:6%;" rowspan="2">Total GST%</th>';
        $tableItem .= '<th style="text-align: center;width:7%;" colspan="2">CGST</th>';
        $tableItem .= '<th style="text-align: center;width:7%;" colspan="2">SGST</th>';
        $tableItem .= '<th style="text-align: center;width:7%;" colspan="2">IGST</th>';
        $tableItem .= '<th style="text-align: center;width:8%;background-color: #bdcebe;" rowspan="2">Total</th>';
        $tableItem .= '</tr>';

        $tableItem .= '<tr>';
        $tableItem .= '<th style="text-align: center;width:2%;border-top:0.5 solid #000;">%</th>';
        $tableItem .= '<th style="text-align: center;width:5%;border-top:0.5 solid #000;">Amt.</th>';
        $tableItem .= '<th style="text-align: center;width:2%;border-top:0.5 solid #000;">%</th>';
        $tableItem .= '<th style="text-align: center;width:5%;border-top:0.5 solid #000;">Amt.</th>';
        $tableItem .= '<th style="text-align: center;width:2%;border-top:0.5 solid #000;">%</th>';
        $tableItem .= '<th style="text-align: center;width:5%;border-top:0.5 solid #000;">Amt.</th>';
        $tableItem .= '<th style="text-align: center;width:2%;border-top:0.5 solid #000;">%</th>';
        $tableItem .= '<th style="text-align: center;width:5%;border-top:0.5 solid #000;">Amt.</th>';
        $tableItem .= '</tr>';

        $tableItem .= '<thead>';
        $tableItem .= '<tbody>';


        //item loop start here

         $invoiceItemsResult = mysqli_query($master_conn, "SELECT invoice_details.*,item_list.item_name AS itemName,item_list.item_code AS itemCode,item_list.hsn_code AS hsnCode FROM invoice_details  LEFT JOIN item_list ON item_list.id =invoice_details.item_id WHERE invoice_idi='$invoiceId';");

            if ($invoiceItemsResult) {
                 $invoiceItemsData = mysqli_fetch_all($invoiceItemsResult, MYSQLI_ASSOC);

                 //print_r($invoiceItemsData);
                 $sr = 1;
                 foreach($invoiceItemsData as $key=>$data){
                    $tableItem .= '<tr nobr="true">';
                    $tableItem .= '<td style="text-align: center;width: 3%;border-top: 0.5 solid #000;">'.$sr.'</td>';
                    $tableItem .= '<td style="text-align: left;width: 10%;border-top: 0.5 solid #000;">'.$data['itemCode'].'</td>';
                    $tableItem .= '<td style="text-align: left;width: 18%;border-top: 0.5 solid #000;">'.$data['itemName'].'</td>';
                    $tableItem .= '<td style="text-align: center;width: 7%;border-top: 0.5 solid #000;">'.$data['hsnCode'].'</td>';
                    $tableItem .= '<td style="text-align: center;width: 4%;border-top: 0.5 solid #000;">'.displayInFormate($data['item_qty']).'</td>';
                    $tableItem .= '<td style="text-align: center;width: 4%;border-top: 0.5 solid #000;">Non.</td>';
                    $tableItem .= '<td style="text-align: right;width: 6%;border-top: 0.5 solid #000;">'.displayInFormate($data['item_rate']).'</td>';
                    $tableItem .= '<td style="text-align: center;width:2%;border-top: 0.5 solid #000;">'.displayInFormate($data['item_discount']).'</td>';
                    $tableItem .= '<td style="text-align: right;width:5%;border-top: 0.5 solid #000;">'.displayInFormate($data['item_discount_amount']).'</td>';
                    $tableItem .= '<td style="text-align: right;width:6%;border-top: 0.5 solid #000;background-color: #bdcebe;">'.displayInFormate($data['item_rate']).'</td>';
                    $tableItem .= '<td style="text-align: center;width:6%;border-top: 0.5 solid #000;"><b>'.displayInFormate($data['item_gst']).'</b></td>';
                    $tableItem .= '<td style="text-align: center;width:2%;border-top: 0.5 solid #000;">0</td>';
                    $tableItem .= '<td style="text-align: right;width:5%;border-top: 0.5 solid #000;">'.displayInFormate($data['item_gst_amount']/2).'</td>';
                    $tableItem .= '<td style="text-align: center;width:2%;border-top: 0.5 solid #000;">0</td>';
                    $tableItem .= '<td style="text-align: right;width:5%;border-top: 0.5 solid #000;">'.displayInFormate($data['item_gst_amount']/2).'</td>';
                    $tableItem .= '<td style="text-align: center;width:2%;border-top: 0.5 solid #000;"></td>';
                    $tableItem .= '<td style="text-align: right;width:5%;border-top: 0.5 solid #000;"></td>';
                    $tableItem .= '<td style="text-align: right;width:8%;border-top: 0.5 solid #000;background-color: #bdcebe;">'.displayInFormate($data['item_total']).'</td>';
                    $tableItem .= '</tr>';
                    $sr++;

                    
                 }

            }

        
        
        $tableItem .= '</tbody>';
        //blank 4 tr end

        //total tr start
        $tableItem .= '</tfoot>';
        $tableItem .= '<tr nobr="true" style="background-color: #bdcebe;">';
        $tableItem .= '<th style="text-align: center;width: 3%;border-top: 0.5 solid #000;border-bottom: 0.5 solid #000;"></th>';
        $tableItem .= '<th style="text-align: right;width: 10%;border-top: 0.5 solid #000;border-bottom: 0.5 solid #000;"><b>Total:-</b></th>';
        $tableItem .= '<th style="text-align: right;width: 33%;border-top: 0.5 solid #000;border-bottom: 0.5 solid #000;" colspan="4"><b>37</b></th>';
        $tableItem .= '<th style="text-align: right;width: 13%;border-top: 0.5 solid #000;border-bottom: 0.5 solid #000;" colspan="3">3,447.00</th>';
        $tableItem .= '<th style="text-align: left;width:12%;border-top: 0.5 solid #000;border-bottom: 0.5 solid #000;" colspan="2">13,307.62</th>';
        $tableItem .= '<th style="text-align: right;width:7%;border-top: 0.5 solid #000;border-bottom: 0.5 solid #000;" colspan="2">1,197.69</th>';
        $tableItem .= '<th style="text-align: right;width:7%;border-top: 0.5 solid #000;border-bottom: 0.5 solid #000;" colspan="2">1, 197.69</th>';
        $tableItem .= '<th style="text-align: right;width:7%;border-top: 0.5 solid #000;border-bottom: 0.5 solid #000;" colspan="2">0.00</th>';
        $tableItem .= '<th style="text-align: right;width:8%;border-top: 0.5 solid #000;border-bottom: 0.5 solid #000;">15,703.00</th>';
        $tableItem .= '</tr>';
        $tableItem .= '</tfoot>';
        //total tr end
        //
        $tableItem .= '</table>';
        $this->writeHTML($tableItem, false, false, true, false, '');
    }

    public function GSTTotalSection(){

        $tableGST = '<table style="width: 100%" nobr="true">';

        $tableGST .= '<tr nobr="true">';
        $tableGST .= '<td style="border-bottom: 0.5 solid #000;border-top: 0.5 solid #000;border-left: 0.5 solid #000; width: 30%">';
            //start sub table for GSTIN and Bank Details
            $tableGST .= '<table>';

            $tableGST .= '<tr>';
            $tableGST .= '<td style="padding:10px;background-color: #bdcebe;border: 0.5 solid #000;" colspan="3"><b>GSTIN:- 24CUVPP6514R1ZK</b></td>';
            $tableGST .= '</tr>';

            $tableGST .= '<tr>';
            $tableGST .= '<td style="font-size: 8px;width: 30%;">PAN</td>';
            $tableGST .= '<td style="font-size: 8px;width: 2%;">:</td>';
            $tableGST .= '<td style="font-size: 8px;width: 68%;">CUVPP654R</td>';
            $tableGST .= '</tr>';

            $tableGST .= '<tr>';
            $tableGST .= '<td style="font-size: 8px;width: 30%;">BANK</td>';
            $tableGST .= '<td style="font-size: 8px;width: 2%;">:</td>';
            $tableGST .= '<td style="font-size: 8px;width: 68%;">lnduslnd Bank. NEW NARODA,AHMEOABAD</td>';
            $tableGST .= '</tr>';

            $tableGST .= '<tr>';
            $tableGST .= '<td style="font-size: 8px;width: 30%;">ACCOUNT NO.</td>';
            $tableGST .= '<td style="font-size: 8px;width: 2%;">:</td>';
            $tableGST .= '<td style="font-size: 8px;width: 68%;">201002567977</td>';
            $tableGST .= '</tr>';

            $tableGST .= '<tr>';
            $tableGST .= '<td style="font-size: 8px;width: 30%;">IFSCCOOE</td>';
            $tableGST .= '<td style="font-size: 8px;width: 2%;">:</td>';
            $tableGST .= '<td style="font-size: 8px;width: 68%;">ND80001382</td>';
            $tableGST .= '</tr>';

        $tableGST .= '<tr>';
        $tableGST .= '<td style="font-size: 8px;width: 30%;">IFSCCOOE</td>';
        $tableGST .= '<td style="font-size: 8px;width: 2%;">:</td>';
        $tableGST .= '<td style="font-size: 8px;width: 68%;">ND80001382</td>';
        $tableGST .= '</tr>';


            $tableGST .= '</table>';
            //end sub table for GSTIN and Bank Details
        $tableGST .= '</td>';

        //start one blank td of main table
        $tableGST .= '<td style="border-bottom: 0.5 solid #000;border-top: 0.5 solid #000;width: 8%"></td>';
        //end one blank td of main table

        $tableGST .= '<td style="border-bottom: 0.5 solid #000;border-top: 0.5 solid #000;width: 30%">';
            //start sub table for GST calculation table
            $tableGST .= '<table>';

            $tableGST .= '<tr>';
            $tableGST .= '<td style="padding:2px;text-align:center;font-size: 10px;width: 10%;border: 0.5 solid #000;"></td>';
            $tableGST .= '<td style="padding:2px;text-align:center;font-size: 10px;width: 30%;border: 0.5 solid #000;">Taxable Amt.</td>';
            $tableGST .= '<td style="padding:2px;text-align:center;font-size: 10px;width: 15%;border: 0.5 solid #000;">Qty.</td>';
            $tableGST .= '<td style="padding:2px;text-align:center;font-size: 10px;width: 15%;border: 0.5 solid #000;">CGST</td>';
            $tableGST .= '<td style="padding:2px;text-align:center;font-size: 10px;width: 15%;border: 0.5 solid #000;">SGST</td>';
            $tableGST .= '<td style="padding:2px;text-align:center;font-size: 10px;width: 15%;border: 0.5 solid #000;">IGST</td>';
            $tableGST .= '</tr>';

            $tableGST .= '<tr>';
            $tableGST .= '<td style="padding:2px;text-align:center;font-size: 9px;width: 10%;border: 0.5 solid #000;"><b>12%</b></td>';
            $tableGST .= '<td style="padding:2px;text-align:center;font-size: 9px;width: 30%;border: 0.5 solid #000;">0</td>';
            $tableGST .= '<td style="padding:2px;text-align:center;font-size: 9px;width: 15%;border: 0.5 solid #000;">0</td>';
            $tableGST .= '<td style="padding:2px;text-align:center;font-size: 9px;width: 15%;border: 0.5 solid #000;">0</td>';
            $tableGST .= '<td style="padding:2px;text-align:center;font-size: 9px;width: 15%;border: 0.5 solid #000;">0</td>';
            $tableGST .= '<td style="padding:2px;text-align:center;font-size: 9px;width: 15%;border: 0.5 solid #000;">0</td>';
            $tableGST .= '</tr>';

            $tableGST .= '<tr>';
            $tableGST .= '<td style="padding:2px;text-align:center;font-size: 9px;width: 10%;border: 0.5 solid #000;"><b>18%</b></td>';
            $tableGST .= '<td style="padding:2px;text-align:center;font-size: 9px;width: 30%;border: 0.5 solid #000;">13307.62</td>';
            $tableGST .= '<td style="padding:2px;text-align:center;font-size: 9px;width: 15%;border: 0.5 solid #000;">37</td>';
            $tableGST .= '<td style="padding:2px;text-align:center;font-size: 9px;width: 15%;border: 0.5 solid #000;">1997.69</td>';
            $tableGST .= '<td style="padding:2px;text-align:center;font-size: 9px;width: 15%;border: 0.5 solid #000;">1997.69</td>';
            $tableGST .= '<td style="padding:2px;text-align:center;font-size: 9px;width: 15%;border: 0.5 solid #000;">0</td>';
            $tableGST .= '</tr>';

            $tableGST .= '<tr>';
            $tableGST .= '<td style="padding:2px;text-align:center;font-size: 9px;width: 10%;border: 0.5 solid #000;"><b>Total</b></td>';
            $tableGST .= '<td style="padding:2px;text-align:center;font-size: 9px;width: 30%;border-top: 0.5 solid #000;border-bottom: 0.5 solid #000;border-right: none !important;"><b>13307.62</b></td>';
            $tableGST .= '<td style="padding:2px;text-align:center;font-size: 9px;width: 15%;border-top: 0.5 solid #000;border-bottom: 0.5 solid #000;border-left: none; !important;"></td>';
            $tableGST .= '<td style="padding:2px;text-align:center;font-size: 9px;width: 15%;border: 0.5 solid #000;"><b>1997.69</b></td>';
            $tableGST .= '<td style="padding:2px;text-align:center;font-size: 9px;width: 15%;border: 0.5 solid #000;"><b>1997.69</b></td>';
            $tableGST .= '<td style="padding:2px;text-align:center;font-size: 9px;width: 15%;border: 0.5 solid #000;"><b>0.00</b></td>';
            $tableGST .= '</tr>';

            $tableGST .= '</table>';
            //end sub table for GST calculation table
        $tableGST .='</td>';

        //start one blank td of main table
        $tableGST .= '<td style="border-bottom: 0.5 solid #000;border-top: 0.5 solid #000;width: 2%"></td>';
        //end one blank td of main table


        $tableGST .= '<td style="border-bottom: 0.5 solid #000;border-top: 0.5 solid #000;border-right: 0.5 solid #000;width: 30%">';
             //start sub table for total amount calculation table
                 $tableGST .= '<table>';

                 $tableGST .= '<tr>';
                 $tableGST .= '<td style="padding:2px;text-align:right;font-size: 10px;width: 58%;">Total Amount Before Tax</td>';
                 $tableGST .= '<td style="padding:2px;text-align:center;font-size: 10px;width: 2%;">:</td>';
                 $tableGST .= '<td style="padding:2px;text-align:right;font-size: 10px;width: 40%;"><b>13,307.62</b></td>';
                 $tableGST .= '</tr>';

                 $tableGST .= '<tr>';
                 $tableGST .= '<td style="padding:2px;text-align:right;font-size: 10px;width: 58%;">Total Tax Amount GST</td>';
                 $tableGST .= '<td style="padding:2px;text-align:center;font-size: 10px;width: 2%;">:</td>';
                 $tableGST .= '<td style="padding:2px;text-align:right;font-size: 10px;width: 40%;"><b>2,395.38</b></td>';
                 $tableGST .= '</tr>';

                 $tableGST .= '<tr>';
                 $tableGST .= '<td style="padding:2px;text-align:right;font-size: 10px;width: 58%;">Total Amount After Tax</td>';
                 $tableGST .= '<td style="padding:2px;text-align:center;font-size: 10px;width: 2%;">:</td>';
                 $tableGST .= '<td style="padding:2px;text-align:right;font-size: 10px;width: 40%;"><b>15,703.00</b></td>';
                 $tableGST .= '</tr>';

                 $tableGST .= '<tr>';
                 $tableGST .= '<td style="padding:2px;text-align:right;font-size: 10px;width: 58%;">Transportation</td>';
                 $tableGST .= '<td style="padding:2px;text-align:center;font-size: 10px;width: 2%;">:</td>';
                 $tableGST .= '<td style="padding:2px;text-align:right;font-size: 10px;width: 40%;"><b>0.00</b></td>';
                 $tableGST .= '</tr>';

                 $tableGST .= '<tr>';
                 $tableGST .= '<td style="padding:2px;text-align:right;font-size: 10px;width: 58%;">Round</td>';
                 $tableGST .= '<td style="padding:2px;text-align:center;font-size: 10px;width: 2%;">:</td>';
                 $tableGST .= '<td style="padding:2px;text-align:right;font-size: 10px;width: 40%;"><b>0.00</b></td>';
                 $tableGST .= '</tr>';

                 $tableGST .= '</table>';
            //end sub table for total amount calculation table

        $tableGST .= '</td>';
        $tableGST .= '</tr>';

        $tableGST .='</table>';
        $this->writeHTML($tableGST, false, false, true, false, '');



        //grand total

        // Example usage:
        $amount = 15703.00;
        $amount_in_words = convertAmountToWords($amount);

        $tableGrandTotal = '<style>               
				table, td {					
				    font-size:10px;				  
					padding:5px;					
					background-color: #bdcebe;											
				}
				</style>';
        $tableGrandTotal .= '<table style="width: 100%" nobr="true">';

        $tableGrandTotal .= '<tr>';
        $tableGrandTotal .= '<td style="border-left:0.5 solid #000; border-bottom: 0.5 solid #000;"><i>Bill Amount In Words:</i>'.$amount_in_words.'</td>';
        $tableGrandTotal .= '<td style="border-right:0.5 solid #000; border-bottom: 0.5 solid #000;text-align: right;font-size:12px;">Grand Total : <b>15703.00</b></td>';
        $tableGrandTotal .= '</tr>';

        $tableGrandTotal .='</table>';
        $this->writeHTML($tableGrandTotal, false, false, true, false, '');
    }

    public function SignatureSection(){

        $tableSignature = '<style>               
				table, td {					
				    font-size:10px;				  
					padding:2px;					
																
				}
				</style>';
        $tableSignature .='<table nobr="true">';

        $tableSignature .='<tr>';
        $tableSignature .='<td style="text-align: left;border-left:0.5 solid #000; border-top: 0.5 solid #000;">Receivers  Signature</td>';
        $tableSignature .='<td style="text-align: center;border-top: 0.5 solid #000;"><b>Terms & Conditions</b></td>';
        $tableSignature .='<td style="text-align: right;border-right:0.5 solid #000; border-top: 0.5 solid #000;">FOR, SHREE HARI ENTERPRISE</td>';
        $tableSignature .='</tr>';


        $tableSignature .='<tr>';
        $tableSignature .='<td style="text-align: left;border-left:0.5 solid #000;"></td>';
        $tableSignature .='<td style="text-align: center;">E.&.O.E.</td>';
        $tableSignature .='<td style="text-align: right;border-right:0.5 solid #000;"></td>';
        $tableSignature .='</tr>';

        $tableSignature .='<tr>';
        $tableSignature .='<td style="text-align: left;border-left:0.5 solid #000;"></td>';
        $tableSignature .='<td style="text-align: center;">Goods once sold will not be taken back</td>';
        $tableSignature .='<td style="text-align: right;border-right:0.5 solid #000;"></td>';
        $tableSignature .='</tr>';

        $tableSignature .='<tr>';
        $tableSignature .='<td style="text-align: left;border-left:0.5 solid #000; border-bottom: 0.5 solid #000;"></td>';
        $tableSignature .='<td style="text-align: center;border-bottom: 0.5 solid #000;">Subject To Ahmedabad  junsdlctlon</td>';
        $tableSignature .='<td style="text-align: right;border-right:0.5 solid #000; border-bottom: 0.5 solid #000;"></td>';
        $tableSignature .='</tr>';

        $tableSignature .='</table>';
        $this->writeHTML($tableSignature, false, false, true, false, '');

    }

    public function Footer(){

        $tableFooter = '<style>
				table, td {					
				    font-size:10px;				  
					padding:2px;					
				}
				</style>';
        $tableFooter .= '<table style="width: 100%">';

        $tableFooter .= '<tr>';
        $tableFooter .= '<td style="width:20%;"></td>';
        $tableFooter .= '<td style="font-size: 10px; width:60%;text-align: centerpadding:5px;"><i>Page'.$this->PageNo().' of '.$this->getAliasNbPages().'</i></td>';
        $tableFooter .= '<td style="width:20%;"></td>';
        $tableFooter .= '</tr>';

        $tableFooter .= '</table>';

        $this->writeHTML($tableFooter, false, false, true, false, '');

    }
}


$pdf = new MYPDF();

// set margins
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(true, PDF_MARGIN_FOOTER+10);

$pdf->AddPage('L');
$pdf->ClientSection();
$pdf->ItemSection();
$pdf->GSTTotalSection();
$pdf->SignatureSection();
$pdf->SetXY(25, 25);


function convertAmountToWords(float $amount)
{
    $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
    // Check if there is any number after decimal
    $amt_hundred = null;
    $count_length = strlen($num);
    $x = 0;
    $string = array();
    $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $x < $count_length ) {
        $get_divider = ($x == 2) ? 10 : 100;
        $amount = floor($num % $get_divider);
        $num = floor($num / $get_divider);
        $x += $get_divider == 10 ? 1 : 2;
        if ($amount) {
            $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
            $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
            $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
       '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
       '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
        }
        else $string[] = null;
    }
    $implode_to_Rupees = implode('', array_reverse($string));
    $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
   " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
    return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
}


$pdf->SetFont('Times', '', 12);
$pdf->Output('INVOICE.pdf','I');

?>