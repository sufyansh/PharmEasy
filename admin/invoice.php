<?php
include "includes/functions.php";
require_once('C:/xampp/htdocs/PharmEasy/lib/tcpdf/tcpdf.php'); 

if (isset($_GET['id'])) {
    // Get the ID from the URL
    $id = $_GET['id'];
    
    // Fetch invoice data from the database based on the ID
    $invoiceData = fetchInvoiceDataFromDB($id); 

    if ($invoiceData === null || empty($invoiceData)) {
        echo "Invoice data not found for ID: $id";
        exit; // Terminate script
    }

    // Fetch item and user data
    $itemID = fetchInvoiceDataFromDBItem($invoiceData[0]['item_id']);
    $userID = fetchInvoiceDataFromDBUser($invoiceData[0]['user_id']);
    
    if ($itemID === null || $userID === null) {
        echo "Item or User data not found.";
        exit; // Terminate script
    }
    
  

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
        <p>Invoice Number: ' . $invoiceData[0]['order_id'] . '</p>
        <p>Date: ' . $invoiceData[0]['order_date'] . '</p>
        <table border="1">
            <tr>
                <th>Item</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Detail</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>';

    // Calculate total amount
    $totalAmount = 0;

    // Check if 'items' key exists and is an array
    if (is_array($itemID)) {
        // Loop through items
        foreach ($itemID as $item) {
            $total = $item['item_quantity'] * $item['item_price'];
            $totalAmount += $total;
            // Add item row to HTML
            $html .= '
                <tr>
                    <td>' . $item['item_title'] . '</td>
                    <td>' . $item['item_brand'] . '</td>
                    <td>' . $item['item_cat'] . '</td>
                    <td>' . $item['item_details'] . '</td>
                    <td>' . $item['item_quantity'] . '</td>
                    <td>$' . number_format($item['item_price'], 2) . '</td>
                    <td>$' . number_format($total, 2) . '</td>
                </tr>';
        }
    } else {
        echo "No items found for the invoice.";
        exit; // Terminate script
    }

    // Add total row to HTML
    $html .= '
            <tr>
                <td colspan="6" align="right"><strong>Total:</strong></td>
                <td>$' . number_format($totalAmount, 2) . '</td>
            </tr>
        </table>';

    // Write the HTML content to the PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Close and output PDF
    $pdf->Output('invoice.pdf', 'D');

    // Terminate script
    exit;
} else {
    echo "ID not provided.";
}
// Terminate script
exit;
?>
