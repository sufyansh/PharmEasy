<?php
// Include the TCPDF library
require_once('C:/xampp/htdocs/PharmEasy/lib/tcpdf/tcpdf.php');


$num = ''; // Initialize $num

if (isset($_GET['id'])) {
    $data = get_item_details($_GET['id']); // Call a function to get item details
    $num = sizeof($data); // Get the size of the returned data
}

function fetchInvoiceDataFromDB() {

    // Check if 'id' is set in $_GET
  
    // Implement your database connection and query to fetch invoice data
    // For demonstration purposes, I'll just return sample data
    $invoiceData = array(
        'invoice_number' => $num,
        'date' => date('Y-m-d'),
        'items' => array(
            array('name' => 'Item 1', 'quantity' => 1, 'price' => 10.00),
            array('name' => 'Item 2', 'quantity' => 2, 'price' => 5.00)
        )
    );

    return $invoiceData;
}

// Fetch invoice data from the database
$invoiceData = fetchInvoiceDataFromDB();

// Create a new TCPDF instance
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('Your Company');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Invoice');
$pdf->SetSubject('Invoice');
$pdf->SetKeywords('Invoice, PDF, Example');

// Add a page
$pdf->AddPage();

// Build HTML for invoice
$html = '
    <h1>Invoice</h1>
    <p>Invoice Number: ' . $invoiceData['invoice_number'] . '</p>
    <p>Date: ' . $invoiceData['date'] . '</p>
    <table border="1">
        <tr>
            <th>Item</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </tr>';

// Calculate total amount
$totalAmount = 0;

// Loop through items
foreach ($invoiceData['items'] as $item) {
    $total = $item['quantity'] * $item['price'];
    $totalAmount += $total;

    // Add item row to HTML
    $html .= '
        <tr>
            <td>' . $item['name'] . '</td>
            <td>' . $item['quantity'] . '</td>
            <td>$' . number_format($item['price'], 2) . '</td>
            <td>$' . number_format($total, 2) . '</td>
        </tr>';
}

// Add total row to HTML
$html .= '
        <tr>
            <td colspan="3" align="right"><strong>Total:</strong></td>
            <td>$' . number_format($totalAmount, 2) . '</td>
        </tr>
    </table>';

// Write the HTML content to the PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF
$pdf->Output('invoice.pdf', 'D');

// Terminate script
exit;
?>
