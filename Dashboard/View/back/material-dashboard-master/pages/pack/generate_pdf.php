<?php
error_reporting(0); // Disable error reporting
ini_set('display_errors', 0); // Turn off error display

ob_start(); 
require_once(__DIR__ . '/TCPDF-main/tcpdf.php'); // Use absolute path


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Reservation Table');
$pdf->SetSubject('Reservation Table');
$pdf->SetKeywords('Reservation, PDF, Table');

// Set default header data
$pdf->SetHeaderData('', 0, 'Reservation Table', '');

// Set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Set some language-dependent strings
$l = array();
$l['a_meta_charset'] = 'UTF-8';
$l['a_meta_dir'] = 'ltr';
$l['a_meta_language'] = 'en';
$l['w_page'] = 'page';
$pdf->setLanguageArray($l);

// Add a page
$pdf->AddPage();

// Fetch reservation data from database
include 'C:\xampp\htdocs\ali&yossra\ali&yossra\UserManagment\Dashboard\Controller\ReservationC.php';
$ReservationC = new ReservationC();
$reservationList = $ReservationC->AfficherReservation();

// Define table structure
$html = '<table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Source</th>
                    <th>Paiement</th>
                    <th>Date Creation</th>
                    <th>Pack Name</th>
                </tr>
            </thead>
            <tbody>';

            foreach ($reservationList as $reservation) {
                // Retrieve and store the "offre" information
                $offre = $ReservationC->Recupereroffre($reservation['idOffre']);
                $nomOffre = $offre['nom_offre']; // Get the name of the "offre"
            
                // Construct the HTML table row (<tr>) with reservation details
                $html .= '<tr>
                            <td>' . $reservation['idReservation'] . '</td>
                            <td>' . $reservation['source'] . '</td>
                            <td>' . $reservation['paiement'] . '</td>
                            <td>' . $reservation['dateCreation'] . '</td>
                            <td>' . $nomOffre . '</td>
                          </tr>';
            }
            

$html .= '</tbody></table>';

// Output HTML content to PDF
$pdf->writeHTML($html, true, false, true, false, '');

ob_end_clean(); // Clean (erase) the output buffer

// Close and output PDF document
$pdf->Output('reservation_table.pdf', 'D'); // 'D' for download

// End output buffering and clean output buffer
ob_end_flush(); // Flush (send) the output buffer and turn off output buffering
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
