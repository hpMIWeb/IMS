<?php
require 'vendor/autoload.php';
include "DB/connection.php";

// Fetch all data from the phone_book_master table
$userResult = mysqli_query($master_conn, "SELECT `phone_book_master`.*, category_master.name AS categoryName FROM `phone_book_master` LEFT JOIN category_master ON category_master.id=phone_book_master.category");

// Check if there are rows in the result
if ($userResult && mysqli_num_rows($userResult) > 0) {
    // Initialize data array with headers
    $data = array(
        array('Category', 'Name', 'Address', 'Contact Number', 'Designation', 'Company Name', 'Remark'),
    );

    // Fetch and add each row to the data array
    while ($userRow = mysqli_fetch_assoc($userResult)) {
        $data[] = array(
            $userRow['categoryName'],
            $userRow['name'],
            $userRow['address'],
            $userRow['contact_number'],
            $userRow['designation'],
            $userRow['company_name'],
            $userRow['remark'],
        );
    }

    // Create a new Spreadsheet
    $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();

    // Select the active worksheet
    $spreadsheet->setActiveSheetIndex(0);
    $sheet = $spreadsheet->getActiveSheet();

    // Set bold font for header row
    $headerStyle = $sheet->getStyle('A1:G1');
    $headerFont = $headerStyle->getFont();
    $headerFont->setBold(true);

    // Add data to the worksheet
    foreach ($data as $rowIndex => $row) {
        foreach ($row as $colIndex => $value) {
            $sheet->setCellValueByColumnAndRow($colIndex + 1, $rowIndex + 1, $value);
        }
    }

    // Save Excel file
    $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

    // Set headers for download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="phone-book-data.xlsx"');
    header('Cache-Control: max-age=0');

    // Output to browser
    $writer->save('php://output');
} else {
    // No data found, handle accordingly (e.g., display a message)
    echo "No data found in the phone_book_master table.";
}
