<?php
//working
require_once 'tcpdf/tcpdf.php';
session_start();
error_reporting(1);

include "DB/connection.php";

function displayInFormate($number)
{
    // Set the locale to Indian English
    setlocale(LC_NUMERIC, 'en_IN');

    // Use the number_format function with Indian formatting
    return number_format($number, 2, '.', ',');
}

$invoiceId = isset($_GET['id']) ? $_GET['id'] : 1;
global $master_conn;
$invoiceDetails = [];
$invoiceDetails = [];
$_SESSION['invoiceId'] = $invoiceId;
$_SESSION['invoiceType'] = '';
$_SESSION['totalAmountBeforeTax'] = 0;
$_SESSION['totalTaxAmount'] = 0;
$_SESSION['totalAmountWithTax'] = 0;
$_SESSION['roundOff'] = 0;

if (!empty($invoiceId)) {
    $invoiceResult = mysqli_query($master_conn, "SELECT * FROM invoice_master WHERE id='$invoiceId';");
    if ($invoiceResult) {
        // Fetch all data into an associative array
        $invoiceData = mysqli_fetch_assoc($invoiceResult);

        $invoiceItemId = $invoiceData['id'];
        $invoiceItemId = $invoiceData['id'];
        $_SESSION['invoiceData'] = $invoiceData;
        $_SESSION['invoiceType'] = $invoiceData['invoice_type'] == '1' ? 'CASH MEMO' : 'GST INVOICE';

    }
}

class MYPDF extends TCPDF
{
    //Page header
    public function Header()
    {

        $invoiceType = $_SESSION['invoiceType'];
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
        $tableHeader .= '<td style="font-size: 20px;width:60%; text-align: center;"><u>YOUNG ENGINEERS</u></td>';
        $tableHeader .= '<td style="width:20%;"></td>';
        $tableHeader .= '</tr>';

        $tableHeader .= '<tr>';
        $tableHeader .= '<td style="width:20%;"></td>';
        $tableHeader .= '<td style="font-size: 10px; width:60%;text-align: centerpadding:5px;">8,RANGVARSHA SOC. NR.SHREYAS CROSSING SHREE HARI APT LANE, PALDI,Ahmedabad</td>';
        $tableHeader .= '<td style="width:20%;"></td>';
        $tableHeader .= '</tr>';

        $tableHeader .= '<tr>';
        $tableHeader .= '<td style="width:20%;"></td>';
        $tableHeader .= '<td style="font-size: 10px; width:60%;text-align: center;">Email : shreeharient2107@gmail.com, M :98987 36438, 99987 13369</td>';
        $tableHeader .= '<td style="width:20%;"></td>';
        $tableHeader .= '</tr>';

        $tableHeader .= '<tr>';
        $tableHeader .= '<td style="width:20%;padding:5px;"></td>';
        $tableHeader .= '<td style="font-size: 10px; width:60%;text-align: center;padding:5px;"><b>' . $invoiceType . '</b></td>';
        $tableHeader .= '<td style="width:20%;padding:5px;"></td>';
        $tableHeader .= '</tr>';

        $tableHeader .= '</table>';

        $this->writeHTML($tableHeader, false, false, true, false, '');
        $getHeaderY = $this->GetY();
        $this->SetMargins(PDF_MARGIN_LEFT, $getHeaderY, PDF_MARGIN_RIGHT);
        $this->Ln(1);

    }

    public function ClientSection()
    {

        $invoiceData = $_SESSION['invoiceData'];
        $clientName = $invoiceData['client_name'];
        $clientAddress = $invoiceData['client_address'];
        $clientState = $invoiceData['client_state'];
        $clientGST = $invoiceData['client_gst_number'];
        $invoiceNumber = $invoiceData['bill_no'];
        $invoiceDate = date('d-M-Y', strtotime($invoiceData['invoice_date']));

        $tableClient = '<style>
				table, td {
				    font-size:10px;
					padding:2px;
				}
				</style>';
        $tableClient .= '<table style="width: 100%">';

        $tableClient .= '<tr>';
        $tableClient .= '<td style="width:34%;font-size: 8px;border-bottom: none;border-top: 0.5 solid #000;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"><b><i><u>Bill To</u></i></b></td>';
        $tableClient .= '<td style="width:33%;font-size: 8px;border-bottom: none;border-top: 0.5 solid #000;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"><b><i><u>Ship To</u></i></b></td>';
        $tableClient .= '<td style="width:33%;border-bottom: none;border-top: 0.5 solid #000;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"><b>INVOICE NO.: ' . $invoiceNumber . '</b></td>';
        $tableClient .= '</tr>';

        $tableClient .= '<tr>';
        $tableClient .= '<td style="width:34%;border-bottom: none;border-top: none;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"><b>M/s.:' . $clientName . '</b></td>';
        $tableClient .= '<td style="width:33%;border-bottom: none;border-top: none;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"><b>' . $clientName . '</b></td>';
        $tableClient .= '<td style="width:33%;border-bottom: none;border-top: none;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"><b>DATE: ' . $invoiceDate . '</b></td>';
        $tableClient .= '</tr>';

        $address = nl2br($clientAddress);
        $tableClient .= '<tr>';
        $tableClient .= '<td style="width:34%;border-bottom: none;border-top: none;border-left: 0.5 solid #000;border-right: 0.5 solid #000;">' . $address . '</td>';
        $tableClient .= '<td style="width:33%;border-bottom: none;border-top: none;border-left: 0.5 solid #000;border-right: 0.5 solid #000;">C/O:- ' . $clientName . '</td>';
        $tableClient .= '<td style="width:33%;border-bottom: none;border-top: none;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"></td>';
        $tableClient .= '</tr>';

        $stateAddress = nl2br($clientState);

        $tableClient .= '<tr>';
        $tableClient .= '<td style="width:34%;border-bottom: none;border-top: none;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"><b>' . $stateAddress . '</b></td>';
        $tableClient .= '<td style="width:33%;border-bottom: none;border-top: none;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"></td>';
        $tableClient .= '<td style="width:33%;border-bottom: none;border-top: none;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"></td>';
        $tableClient .= '</tr>';

        $tableClient .= '<tr>';
        $tableClient .= '<td style="width:34%;border-top: none;border-bottom: 0.5 solid #000;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"><b>GSTIN - ' . $clientGST . '</b></td>';
        $tableClient .= '<td style="width:33%;border-top: none;border-bottom: 0.5 solid #000;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"></td>';
        $tableClient .= '<td style="width:33%;border-top: none;border-bottom: 0.5 solid #000;border-left: 0.5 solid #000;border-right: 0.5 solid #000;"></td>';
        $tableClient .= '</tr>';

        $tableClient .= '</table>';

        $this->writeHTML($tableClient, false, false, true, false, '');
    }

    public function ItemSection()
    {

        global $master_conn;
        $invoiceId = $_SESSION['invoiceId'];

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
        $tableItem .= '<th style="text-align: center;width: 3%;" >S.N.</th>';
        $tableItem .= '<th style="text-align: center;width: 10%;" >ITEM CODE</th>';
        $tableItem .= '<th style="text-align: center;width: 10%;" >DESCRIPTION</th>';
        $tableItem .= '<th style="text-align: center;width: 10%;" >HSN/SAC CODE</th>';
        $tableItem .= '<th style="text-align: center;width: 5%;" >QTY</th>';
        $tableItem .= '<th style="text-align: center;width: 4%;" >UNIT</th>';
        $tableItem .= '<th style="text-align: center;width: 7%;" >RATE</th>';
        $tableItem .= '<th style="text-align: center;width:7%;" >Discount</th>';
        $tableItem .= '<th style="text-align: center;width:10%;background-color: #bdcebe;" >Taxable Amount</th>';
        $tableItem .= '<th style="text-align: center;width:5%;" >GST%</th>';
        $tableItem .= '<th style="text-align: center;width:7%;" >CGST</th>';
        $tableItem .= '<th style="text-align: center;width:7%;" >SGST</th>';
        $tableItem .= '<th style="text-align: center;width:7%;" >IGST</th>';
        $tableItem .= '<th style="text-align: center;width:8%;background-color: #bdcebe;" >Total</th>';
        $tableItem .= '</tr>';
        $tableItem .= '<thead>';
        $tableItem .= '<tbody>';

        //item loop start here

        $invoiceItemsResult = mysqli_query($master_conn, "SELECT invoice_details.*,item_list.item_name AS itemName,item_list.item_code AS itemCode,item_list.hsn_code AS hsnCode FROM invoice_details  LEFT JOIN item_list ON item_list.id =invoice_details.item_id WHERE invoice_idi='$invoiceId';");

        $totalAmount = 0;
        $totalTax = 0;
        $totalTaxableAmount = 0;
        $totalQty = 0;
        if ($invoiceItemsResult) {
            $invoiceItemsData = mysqli_fetch_all($invoiceItemsResult, MYSQLI_ASSOC);

            $sr = 1;
            foreach ($invoiceItemsData as $key => $data) {

                $itemTotal = $data['item_qty'] * $data['item_rate'];
                $itemTax = $data['item_gst_amount'];
                $itemDiscount = $data['item_discount'];
                $itemDiscountAmount = $data['item_discount_amount'];
                $itemTaxableAmount = $itemTotal - $itemDiscountAmount;
                $totalQty = $totalQty + $data['item_qty'];

                $tableItem .= '<tr nobr="true">';
                $tableItem .= '<td style="text-align: center;width: 3%;border-top: 0.5 solid #000;">' . $sr . '</td>';
                $tableItem .= '<td style="text-align: left;width: 10%;border-top: 0.5 solid #000;">' . $data['itemCode'] . '</td>';
                $tableItem .= '<td style="text-align: left;width: 10%;border-top: 0.5 solid #000;">' . $data['itemName'] . '</td>';
                $tableItem .= '<td style="text-align: center;width: 10%;border-top: 0.5 solid #000;">' . $data['hsnCode'] . '</td>';
                $tableItem .= '<td style="text-align: center;width: 5%;border-top: 0.5 solid #000;">' . displayInFormate($data['item_qty']) . '</td>';
                $tableItem .= '<td style="text-align: center;width: 4%;border-top: 0.5 solid #000;">Non.</td>';
                $tableItem .= '<td style="text-align: right;width: 7%;border-top: 0.5 solid #000;">' . displayInFormate($data['item_rate']) . '</td>';
                $tableItem .= '<td style="text-align: right;width:7%;border-top: 0.5 solid #000;">' . displayInFormate($data['item_discount_amount']) . '</td>';
                $tableItem .= '<td style="text-align: right;width:10%;border-top: 0.5 solid #000;">' . displayInFormate($itemTaxableAmount) . '</td>';
                $tableItem .= '<td style="text-align: center;width:5%;border-top: 0.5 solid #000;"><b>' . displayInFormate($data['item_gst']) . '</b></td>';
                $tableItem .= '<td style="text-align: right;width:7%;border-top: 0.5 solid #000;">' . displayInFormate($data['item_gst_amount'] / 2) . '</td>';
                $tableItem .= '<td style="text-align: right;width:7%;border-top: 0.5 solid #000;">' . displayInFormate($data['item_gst_amount'] / 2) . '</td>';
                $tableItem .= '<td style="text-align: center;width:7%;border-top: 0.5 solid #000;"></td>';
                $tableItem .= '<td style="text-align: right;width:8%;border-top: 0.5 solid #000;">' . displayInFormate($data['item_total']) . '</td>';
                $tableItem .= '</tr>';
                $sr++;

                $totalAmount = $totalAmount + $data['item_total'];
                $totalTax = $totalTax + $itemTax;
                $totalTaxableAmount = $totalTaxableAmount + $itemTaxableAmount;

                $_SESSION['totalAmountBeforeTax'] = $itemTaxableAmount;
                $_SESSION['totalTaxAmount'] = $totalTax;
                $_SESSION['totalAmountWithTax'] = $totalAmount;
                $_SESSION['roundOff'] = 0;

            }

        }

        $tableItem .= '</tbody>';
        //blank 4 tr end

        //total tr start
        $tableItem .= '</tfoot>';
        $tableItem .= '<tr nobr="true" style="background-color: #bdcebe;">';
        $tableItem .= '<th style="text-align: center;width: 3%;border-top: 0.5 solid #000;border-bottom: 0.5 solid #000;"></th>';
        $tableItem .= '<th style="text-align: right;width: 6%;border-top: 0.5 solid #000;border-bottom: 0.5 solid #000;"><b>Total:-</b></th>';
        $tableItem .= '<th style="text-align: right;width: 29%;border-top: 0.5 solid #000;border-bottom: 0.5 solid #000;" ><b>' . displayInFormate($totalQty) . '</b></th>';
        $tableItem .= '<th style="text-align: right;width:62%;border-top: 0.5 solid #000;border-bottom: 0.5 solid #000;">' . displayInFormate($totalAmount) . '</th>';
        $tableItem .= '</tr>';
        $tableItem .= '</tfoot>';
        //total tr end
        //
        $tableItem .= '</table>';
        $this->writeHTML($tableItem, false, false, true, false, '');
    }

    public function GSTTotalSection()
    {

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

        $tableGST .= '</table>';
        //end sub table for GSTIN and Bank Details
        $tableGST .= '</td>';

        //start one blank td of main table
        $tableGST .= '<td style="border-bottom: 0.5 solid #000;border-top: 0.5 solid #000;width: 8%"></td>';
        //end one blank td of main table

        $tableGST .= '<td style="border-bottom: 0.5 solid #000;border-top: 0.5 solid #000;width: 30%">';
        //start sub table for GST calculation table

        //end sub table for GST calculation table
        $tableGST .= '</td>';

        //start one blank td of main table
        $tableGST .= '<td style="border-bottom: 0.5 solid #000;border-top: 0.5 solid #000;width: 2%"></td>';
        //end one blank td of main table

        $tableGST .= '<td style="border-bottom: 0.5 solid #000;border-top: 0.5 solid #000;border-right: 0.5 solid #000;width: 30%">';
        //start sub table for total amount calculation table
        $tableGST .= '<table>';

        $tableGST .= '<tr>';
        $tableGST .= '<td style="padding:2px;text-align:right;font-size: 10px;width: 58%;">Total Amount Before Tax</td>';
        $tableGST .= '<td style="padding:2px;text-align:center;font-size: 10px;width: 2%;">:</td>';
        $tableGST .= '<td style="padding:2px;text-align:right;font-size: 10px;width: 40%;"><b>' . displayInFormate($_SESSION['totalAmountBeforeTax']) . '</b></td>';
        $tableGST .= '</tr>';

        $tableGST .= '<tr>';
        $tableGST .= '<td style="padding:2px;text-align:right;font-size: 10px;width: 58%;">Total Tax Amount GST</td>';
        $tableGST .= '<td style="padding:2px;text-align:center;font-size: 10px;width: 2%;">:</td>';
        $tableGST .= '<td style="padding:2px;text-align:right;font-size: 10px;width: 40%;"><b>' . displayInFormate($_SESSION['totalTaxAmount']) . '</b></td>';
        $tableGST .= '</tr>';

        $tableGST .= '<tr>';
        $tableGST .= '<td style="padding:2px;text-align:right;font-size: 10px;width: 58%;">Total Amount After Tax</td>';
        $tableGST .= '<td style="padding:2px;text-align:center;font-size: 10px;width: 2%;">:</td>';
        $tableGST .= '<td style="padding:2px;text-align:right;font-size: 10px;width: 40%;"><b>' . displayInFormate($_SESSION['totalAmountWithTax']) . '</b></td>';
        $tableGST .= '</tr>';

        $tableGST .= '<tr>';
        $tableGST .= '<td style="padding:2px;text-align:right;font-size: 10px;width: 58%;">Round</td>';
        $tableGST .= '<td style="padding:2px;text-align:center;font-size: 10px;width: 2%;">:</td>';
        $tableGST .= '<td style="padding:2px;text-align:right;font-size: 10px;width: 40%;"><b>' . displayInFormate($_SESSION['invoiceData']['round_off']) . '</b></td>';
        $tableGST .= '</tr>';

        $tableGST .= '</table>';
        //end sub table for total amount calculation table

        $tableGST .= '</td>';
        $tableGST .= '</tr>';

        $tableGST .= '</table>';
        $this->writeHTML($tableGST, false, false, true, false, '');

        //grand total

        $remark = $_SESSION['invoiceData']['remark'];
        // Example usage:
        $amount_in_words = convertAmountToWords($_SESSION['invoiceData']['net_amount']);

        $tableGrandTotal = '<style>
				table, td {
				    font-size:10px;
					padding:5px;
					background-color: #bdcebe;
				}
				</style>';
        $tableGrandTotal .= '<table style="width: 100%" nobr="true">';

        $tableGrandTotal .= '<tr>';
        $tableGrandTotal .= '<td style="border-left:0.5 solid #000; border-bottom: 0.5 solid #000;"><i>Bill Amount In Words:</i>' . $amount_in_words . '</td>';
        $tableGrandTotal .= '<td style="border-right:0.5 solid #000; border-bottom: 0.5 solid #000;text-align: right;font-size:12px;">Grand Total : <b>' . displayInFormate($_SESSION['invoiceData']['net_amount']) . '</b></td>';
        $tableGrandTotal .= '</tr>';
        $tableGrandTotal .= '<tr>';
        $tableGrandTotal .= '<td style="border-left:0.5 solid #000; border-bottom: 0.5 solid #000;"><b>Remarks:</b>' . $remark . '</td>';
        $tableGrandTotal .= '<td style="border-right:0.5 solid #000; border-bottom: 0.5 solid #000;text-align: right;font-size:12px;"></td>';
        $tableGrandTotal .= '</tr>';

        $tableGrandTotal .= '</table>';
        $this->writeHTML($tableGrandTotal, false, false, true, false, '');
    }

    public function SignatureSection()
    {

        $tableSignature = '<style>
				table, td {
				    font-size:10px;
					padding:2px;

				}
				</style>';
        $tableSignature .= '<table nobr="true">';

        $tableSignature .= '<tr>';
        $tableSignature .= '<td style="text-align: left;border-left:0.5 solid #000; border-top: 0.5 solid #000;">Receivers  Signature</td>';
        $tableSignature .= '<td style="text-align: center;border-top: 0.5 solid #000;"><b>Terms & Conditions</b></td>';
        $tableSignature .= '<td style="text-align: right;border-right:0.5 solid #000; border-top: 0.5 solid #000;">FOR, YOUNG ENGINEERS</td>';
        $tableSignature .= '</tr>';

        $tableSignature .= '<tr>';
        $tableSignature .= '<td style="text-align: left;border-left:0.5 solid #000;"></td>';
        $tableSignature .= '<td style="text-align: center;">E.&.O.E.</td>';
        $tableSignature .= '<td style="text-align: right;border-right:0.5 solid #000;"></td>';
        $tableSignature .= '</tr>';

        $tableSignature .= '<tr>';
        $tableSignature .= '<td style="text-align: left;border-left:0.5 solid #000;"></td>';
        $tableSignature .= '<td style="text-align: center;">Goods once sold will not be taken back</td>';
        $tableSignature .= '<td style="text-align: right;border-right:0.5 solid #000;"></td>';
        $tableSignature .= '</tr>';

        $tableSignature .= '<tr>';
        $tableSignature .= '<td style="text-align: left;border-left:0.5 solid #000; border-bottom: 0.5 solid #000;"></td>';
        $tableSignature .= '<td style="text-align: center;border-bottom: 0.5 solid #000;">Subject To Ahmedabad  junsdlctlon</td>';
        $tableSignature .= '<td style="text-align: right;border-right:0.5 solid #000; border-bottom: 0.5 solid #000;"></td>';
        $tableSignature .= '</tr>';

        $tableSignature .= '</table>';
        $this->writeHTML($tableSignature, false, false, true, false, '');

    }

    public function Footer()
    {

        $tableFooter = '<style>
				table, td {
				    font-size:10px;
					padding:2px;
				}
				</style>';
        $tableFooter .= '<table style="width: 100%">';

        $tableFooter .= '<tr>';
        $tableFooter .= '<td style="width:20%;"></td>';
        $tableFooter .= '<td style="font-size: 10px; width:60%;text-align: centerpadding:5px;"><i>Page' . $this->PageNo() . ' of ' . $this->getAliasNbPages() . '</i></td>';
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
$pdf->SetAutoPageBreak(true, PDF_MARGIN_FOOTER + 10);

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
    $here_digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
    while ($x < $count_length) {
        $get_divider = ($x == 2) ? 10 : 100;
        $amount = floor($num % $get_divider);
        $num = floor($num / $get_divider);
        $x += $get_divider == 10 ? 1 : 2;
        if ($amount) {
            $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
            $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
            $string[] = ($amount < 21) ? $change_words[$amount] . ' ' . $here_digits[$counter] . $add_plural . '
       ' . $amt_hundred : $change_words[floor($amount / 10) * 10] . ' ' . $change_words[$amount % 10] . '
       ' . $here_digits[$counter] . $add_plural . ' ' . $amt_hundred;
        } else {
            $string[] = null;
        }

    }
    $implode_to_Rupees = implode('', array_reverse($string));
    $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . "
   " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
    return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
}

$pdf->SetFont('Times', '', 12);
$pdf->Output('INVOICE.pdf', 'I');
