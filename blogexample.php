<?php
include('htmlMimeMail.php');

require_once('fpdf/fpdf.php');

// Create your class instance
$fpdf = new FPDF();
// Set up the default page margins for your PDF
// The parameters are margin left, margin top, margin right (units used are mm)
$fpdf->SetMargins(0, 0, 0);
// SetAutoPageBreak function will create a new page if our content exceeds the page limit. 0 stands for margin from bottom of the page before breaking.
$fpdf->SetAutoPageBreak(true, 0);
// AliasNbPages is optional if you want the ability to display page numbers on your PDF pages.
$fpdf->AliasNbPages();

// We need to define the path to where our font files are located. To add additional fonts from the default ones supplied see http://www.fpdf.org/makefont/)
define('FPDF_FONTPATH', 'font/');
// Setting up our fonts and styles - The first parameter is the string you will use in your code to access this font, the second is the style of the font you are setting (B = bold, I = italic, BI = Bold & Italic) and finally is the php file containing your font.
$fpdf->AddFont('Verdana', '','verdana.php'); // Add standard Arial
$fpdf->AddFont('Verdana', 'B', 'verdanab.php'); // Add bolded version of Arial
$fpdf->AddFont('Verdana', 'I', 'verdanai.php'); // Add italicised version of Arial

$fpdf->AddPage();

// Set font size
$fpdf->SetFontSize(10);
// Select our font family
$fpdf->SetFont('Verdana', '');

// First we add our Cell function

/* Parameters are as follows:
 56 - This is the width in mm that we set our Cell
6 - This is the height in mm
'Description' - Text to display inside the Cell
0 - This is for the border. 1 = border and 0 = no border.
0 - This is the position for our next Cell/MultiCell. 0 will fit the next cell in to the right of this one and 1 will fit the next cell underneath.
L - This is the alignment of our Cell. L = Left, R = Right and C = Centered.
FALSE - This is whether or not we want our Cell to have background fill colour.
*/
$fpdf->Image('fpdf/logo1.jpg', 0, 0, 200, 25);
//$fpdf->Cell(100, 8, 'Description', 1, 1, 'L', FALSE);
// Next we add our MultiCell.
//$fpdf->MultiCell(150, 6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendis seiaculis quam nec nibh frin gilla euismod.Nam accumsan neque eget lorem scelerisque vestibulum.', 0, 'L');
// These parameters are the same as the Cell function, however the value 6 is referring to the height for each line rather than in total and the Parameter for where the next Cell is to be positioned is not in the MultiCell function - Cells will automatically appear below.

// First we set the style of our cell - (We have Verdana below - but this function is also for swapping between font families)
$fpdf->SetFont('Verdana', 'B'); // Make our text bold.
// Lets set our font colour - this is in the format of R,G,B
//$fpdf->SetTextColor(255, 255, 255); // Set text to the colour white.
// If we want our Cell to have a background colour or a border we use the following:
$fpdf->SetFillColor(0, 0, 0); // Set background colour to black
$fpdf->SetDrawColor(31, 152, 152); // Set the border colour to Aqua
$fpdf->SetLineWidth(1); // Set our line width of our border to 1mm
// Now we output a Cell to display the above styles.
//$fpdf->Cell(70, 6, 'This is white text on a black box', 1, 0, 'L', TRUE);
// Then for example if we wanted the next cell to have orange text we would change the text colour
//$fpdf->SetTextColor(242, 154, 0);
//$fpdf->Cell(80, 6, 'This is orange text on a black box', 1, 0, 'L', TRUE);

// Check where we are currently located on the page
$fpdf->GetX(); // Return how many mm we are from the left of the page.
$fpdf->GetY(); // Returns how many mm we are from the top of the page.

// Move to a new point on our page.
$fpdf->SetXY(145, 30); // This will move us 50mm from the left and 40mm from the top of our page. Functions SetX and SetY can be used for setting these points separately.
$fpdf->MultiCell(150, 6, 'GOVARDHANA GIRI TRUST', 0, 'L');

$fpdf->SetFont('Verdana', '');
$fpdf->MultiCell(200, 4, 'Neelavara Goushala', 0, 'R');
$fpdf->MultiCell(200, 5, 'Post Neelavara', 0, 'R');
$fpdf->MultiCell(200, 4, 'Via Bramhavara', 0, 'R');
$fpdf->MultiCell(200, 4, 'Udupi', 0, 'R');
$fpdf->MultiCell(200, 4, '576101', 0, 'R');
$fpdf->MultiCell(200, 4, 'Tel: 0820-2526598 / 9449082198', 0, 'R');
$fpdf->MultiCell(200, 4, 'Email:goushala@pejawaravishwa.com', 0, 'R');

$month = date("F");
$day = date("d");
$year = date("Y");
$fulldate = $month." ".$day.", ".$year;
$fpdf->SetXY(20, 60);
$fpdf->MultiCell(150, 6, $fulldate, 0, 'L');
$fpdf->SetXY(70, 80);
$fpdf->Line(0, 75, 220, 75);
$fpdf->SetFont('Verdana', 'B');
$fpdf->MultiCell(150, 6, 'PAYMENT RECEIPT', 0, 'L');


$fpdf->SetXY(20, 100);
$fpdf->SetFont('Verdana', '');
$fpdf->MultiCell(150, 6, 'Dear ABCD,', 0, 'L');
$fpdf->SetXY(20, 110);
$fpdf->MultiCell(185, 6,'Your contribution of Rs. 1000/- towards Govardhana Giri Trust (A Charitable Organization recognized by Animal Welfare Board of India.) has been received with thanks and we wish you all the success in your future endeavors.', 0, 'L');

$fpdf->SetXY(20, 140);
$fpdf->MultiCell(150, 6, "Yours faithfully", 0, 'L');
$fpdf->SetXY(20, 145);
$fpdf->MultiCell(150, 6, "Govardhana Giri Trust", 0, 'L');

$fpdf->SetFont('Verdana', 'I');
$fpdf->SetFontSize(9);
$fpdf->SetXY(20, 180);
$fpdf->MultiCell(150, 6, "This is a computer generated receipt and hence no signature is required.", 0, 'L');


$fpdf->Line(0, 282, 220, 282);
$fpdf->SetFont('Verdana', '');
$fpdf->SetFontSize(9);
$fpdf->SetXY(20,285);
$fpdf->Cell(30, 4, "Govardhana Giri Trust, Neelavara Goushala, Post Neelavara, Via Bramhavara, Udupi, 576101.", 0, 1);
$fpdf->SetXY(20,290);
$fpdf->Cell(140,4,iconv("UTF-8", "ISO-8859-1", "©").' Pejawara Vishwa 2019 All Rights Reserved.',0,1,'C',0);


$fpdf->Output('documents/donation_receipt.pdf', 'F');
// The first parameter is what we are naming our file. The second parameter is the destination of your file.
// 'I' - This outputs the file to the browser - the file name is what it will default to if 'Save As' is selected. 'D' will force the file to be downloaded. 'F' will save the PDF file locally (To do this you need to include the file path in the file name field also).


$mail = new htmlMimeMail();
 
$text="Dear Mr / Mrs"
        . "We sincerly thank you for your valuable donation to the Govardhana Giri Trust and we wish you all the success in your future endeavor!"
        . ""
        . "Kind Regards,"
        . "Govardhana Giri Trust";
$html= "Dear Mr/Mrs ABCD<br/><br/>We sincerly thank you for your valuable donation to the Govardhana Giri Trust and we wish you all the success in your future endeavor!<br/><br/><br/>Kind Regards,<br/>Govardhana Giri Trust";

$from_address = "goushala@pejawaravishwa.com";
$to = "veekshith@atlanticdata.co.uk";

$attachment = $mail->getFile('documents/donation_receipt.pdf');

$mail->setHtml($html, $text);
$mail->setReturnPath($from_address);
 
$mail->setFrom($from_address);
$mail->setSubject("Pejawara Vishwa Donation Receipt");
 
$mail->setHeader('X-Mailer', 'HTML Mime mail class');

$mail->addAttachment($attachment,'donation_receipt.pdf','documents/');
 
$result = $mail->send(array($to), 'smtp');

?>
