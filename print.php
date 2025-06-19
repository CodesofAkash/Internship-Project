<?php
require_once('tcpdf/tcpdf.php');
include_once('connection2.php');

// Fetch customer info from 'bill' table
$customer = [
    'fullName' => 'Customer Name',
    'phoneNumber' => 'N/A',
    'dateTime' => date('Y-m-d H:i:s')
];

$billQuery = $conn->query("SELECT * FROM bill ORDER BY id DESC LIMIT 1");
if ($billQuery && $billQuery->num_rows > 0) {
    $customer = $billQuery->fetch_assoc();
}

// Start PDF setup
$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle("Bill");
$pdf->SetHeaderData('', '', '', '');
$pdf->setHeaderFont(['helvetica', '', 12]);
$pdf->setFooterFont(['helvetica', '', 10]);
$pdf->SetDefaultMonospacedFont('helvetica');
$pdf->SetMargins(15, 10, 15);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->SetFont('helvetica', '', 11);
$pdf->AddPage();

// Start HTML content
$content = '
<h2 style="text-align:center;">Thank you for your purchase</h2>
<p><strong>' . $customer['fullName'] . '</strong></p>
<p><strong>Phone Number :</strong> ' . $customer['phoneNumber'] . '</p>
<p>' . $customer['dateTime'] . '</p>

<table border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr style="background-color:#f2f2f2;">
            <th><strong>S. No.</strong></th>
            <th><strong>Item Name</strong></th>
            <th><strong>Item Price</strong></th>
            <th><strong>Quantity</strong></th>
        </tr>
    </thead>
    <tbody>';

// Fetch order items from 'foodOrder' table
$total = 0;
$orderQuery = $conn->query("SELECT * FROM foodOrder");
if ($orderQuery && $orderQuery->num_rows > 0) {
    while ($row = $orderQuery->fetch_assoc()) {
        $lineTotal = $row["itemPrice"] * $row["quantity"];
        $total += $lineTotal;
        $content .= '
        <tr>
            <td>' . $row["sNo"] . '</td>
            <td>' . $row["itemName"] . '</td>
            <td>Rs. ' . $row["itemPrice"] . '</td>
            <td>' . $row["quantity"] . '</td>
        </tr>';
    }
} else {
    $content .= '<tr><td colspan="4" align="center">No items found.</td></tr>';
}

$content .= '
    </tbody>
</table>
<h4 style="text-align:right;">Total: Rs. ' . $total . '</h4>';
$content .= '<p style="text-align:center; margin-top:30px; font-size:10pt;">--- Thank you for visiting! ---</p>';
$content .= '<p style="text-align:center; font-size:9pt; color:#888;">&copy; ' . date('Y') . ' CodesOfAkash. All rights reserved.</p>';

// Output PDF
$pdf->writeHTML($content);
$pdf->Output('bill.pdf', 'I'); // Change 'I' to 'D' for forced download
?>
