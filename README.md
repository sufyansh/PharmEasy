# PharmEasy.com
## This project was made for DBMS laboratory subject as a mini project by usining pure php language for 5th semester , which it represent an online pharmacy store.
## Main page:
![](project-images/main.png)
## Functionality
* ### user log in :
![](project-images/user_login.png)
* ### user sign up :
![](project-images/user_signup.png)
* ### search :
![](project-images/search_products.png)
* ### product :
![](project-images/product_details.png)
* ### cart :
![](project-images/cart.png)
* ### order conformation :
![](project-images/comform.png)
* ### admin home :
![](project-images/admin_main.png)
* ### admin log in :
![](project-images/admin_login.png)
* ### orders details and mangement :
![](project-images/orders.png)
* ### Products details :
![](project-images/Products.png)
* ### add new Product :
![](project-images/Products_add.png)
* ### edit Product :
![](project-images/Products_edit.png)
* ### search for Product :
![](project-images/Products_search.png)
* ### customers details :
![](project-images/customers.png)
* ### edit customer :
![](project-images/customer_edit.png)
* ### search for customer :
![](project-images/customer_search.png)
* ### admins details :
![](project-images/admins.png)
* ### add new admin account :
![](project-images/admins_add.png)
* ### edit admin :
![](project-images/admins_edit.png)
* ### search for admin :
![](project-images/admins_search.png)
### the infront-end has done with help of @mdfaisalahmed057



<!-- <?php
include "includes/functions.php";
?>
<?php -->
// Include the TCPDF library
<!-- require_once('C:/xampp/htdocs/PharmEasy/lib/tcpdf/tcpdf.php'); -->

// function fetchInvoiceDataFromDB() {
//     $num = ''; // Initialize $num

//     // Check if 'id' is set in $_GET
  
//     // Implement your database connection and query to fetch invoice data
//     // For demonstration purposes, I'll just return sample data
//     $invoiceData = array(
//         'invoice_number' => $num,
//         'date' => date('Y-m-d'),
//         'items' => array(
//             array('name' => 'Item 1', 'quantity' => 1, 'price' => 10.00),
//             array('name' => 'Item 2', 'quantity' => 2, 'price' => 5.00)
//         )
//     );

//     return $invoiceData;
// }

// Fetch invoice data from the database
<!-- if (isset($_GET['id'])) {
    // Get the ID from the URL
    $id = $_GET['id'];

    // Fetch invoice data from the database based on the ID
    $invoiceData = fetchInvoiceDataFromDB($id);
      $data = var_dump($invoiceData);;
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
        <p>Invoice Number: ' . $data['order_id'] . '</p>
        <p>Date: ' . $data['order_date'] . '</p>
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
    // foreach ($invoiceData['items'] as $item) {
    //     $total = $item['quantity'] * $item['price'];
    //     $totalAmount += $total;

    //     // Add item row to HTML
    //     $html .= '
    //         <tr>
    //             <td>' . $item['name'] . '</td>
    //             <td>' . $item['quantity'] . '</td>
    //             <td>$' . number_format($item['price'], 2) . '</td>
    //             <td>$' . number_format($total, 2) . '</td>
    //         </tr>';
    // }

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
    // $pdf->Output('invoice.pdf', 'D');

    // Terminate script
    exit;
} else {
    echo "ID not provided.";
}
// Terminate script
exit;
?> -->
