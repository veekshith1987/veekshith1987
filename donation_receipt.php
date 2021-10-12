<?php

include('htmlMimeMail.php');

function correctstring($value) {
    if (strpos($value, "\'")) {
        do {
            $value = str_replace("\'", "'", "$value");
        }while(strpos($value, "\'"));
    }else if (strpos($value, "\"")) {
        do {
            $value = str_replace('\"', '"', "$value");
        }while(strpos($value, '\"'));
    }

    return $value;
}



$offsetH=20;
$offsetV=0;

$k=0;

include ('libs/class.ezpdf.php');
$pdf =& new Cezpdf('a4','portrait');
$pdf->setPreferences('HideToolbar','false');
$pdf->setPreferences('HideMenuBar','true');
$pdf->setPreferences('HideWindoUI','true');
$pdf->setPreferences('FitWindow','true');
$pdf->ezSetMargins(0,0,0,0);

$rights=array('print');



        
    
        $lineCount=800;
        
        

        $pdf->selectFont('fonts/Times-Roman.afm');
        $pdf->ezImage("images/logo1.jpg", 0, 0, 'none', 'left');
      

        $pdf->selectFont('fonts/Times-Roman.afm');
        $pdf->ezSetY(720+$offsetV);
        $address="<b>GOVARDHANA GIRI TRUST</b>\n". "Neelavara Goushala" ."\n". "Post Neelavara"."\n". "Via Bramhavara" ."\n". "Udupi" ."\n". "576101" ."\nTel: 0820-2526598 / 9449082198\nEmail:goushala@pejawaravishwa.com";
        $pdf->ezText($address,10,array('justification'=>'right','left'=>'35','right'=>'50'));


        $pdf->selectFont('fonts/Helvetica.afm');

        $lineCount=600; //or $lineCount-110
       
        
        $today="Date: ".date("d M Y");
        $pdf->addText(35,$lineCount,10,$today,0,0);
       // $loFirstName = getSalutation(1, $loname, NULL, NULL);
        $pdf->addText(35,$lineCount-50,10,"<b>Dear Mr/Mrs ABCD</b>",0,0);
        $lineCount=$lineCount-10;

        $lineCount=580;
        

       
            $msg="Thank you for your valuable donation of Rs. 5000 /- towards GOVARDHANA GIRI TRUST, a Charitable Organization recognized by Animal Welfare Board of India."
                    
                    ;
            $lineCount=$lineCount-50;
            $pdf->ezSetY($lineCount);
            $pdf->ezText($msg,10,array('justification'=>'full','left'=>'35','right'=>'50'));
            $lineCount=$lineCount-30;
            
           
            
            $pdf->setLineStyle(1,'round','',array(0,1));
                $pdf->line(25,40,570,40);
             //   $pdf->addText(250+$offsetH,30+$offsetV,9,"VAT Registration No. 755878078",0,0);
            $pdf->addText(50+$offsetH,30+$offsetV,9,"Govardhana Giri Trust, Neelavara Goushala, Post Neelavara, Via Bramhavara, Udupi, 576101.",0,0);
            $pdf->addText(180+$offsetH,18+$offsetV,9,iconv("UTF-8", "ISO-8859-1", "©")." Pejawara Vishwa 2019 All Rights Reserved",0,0);
        
                
             

        $pdf->setLineStyle(1,'round','',array(0,1));
       // $pdf->line(25,$lineCount,570,$lineCount);
        $lineCount=$lineCount-100;
        $pdf->addText(15+$offsetH,$lineCount+$offsetV,10,"Yours sincerely",0,0);
        $sigcount=$lineCount-80;
        //$signature="emma.jpg";
        //$pdf->addJpegFromFile($signature,35,$sigcount,150,69);
        $lineCount=$lineCount-22;
        $pdf->addText(15+$offsetH,$lineCount+$offsetV,10,"Govardhana Giri Trust",0,0);
        $lineCount=$lineCount-40;
        $pdf->addText(15+$offsetH,$lineCount+$offsetV,10,"<i>This is a computer generated receipt and hence no signature is required.</i>",0,0);
        
        
if (!empty($d) && $d) {
    $pdfcode = $pdf->output(1);
    //$end_time = getmicrotime();
    $pdfcode = str_replace("\n","\n<br>",htmlspecialchars($pdfcode));
    echo '<html><body>';
    echo trim($pdfcode);
    echo '</body></html>';
}
else {
  // $pdf->stream();
    $pdfcode = $pdf->output();
    $fname = "uploads/donation_receipt.pdf";  
    $fp = fopen($fname,'w');  
    fwrite($fp,$pdfcode);  
    fclose($fp);
   

    
 

 $mail = new htmlMimeMail();
 
$text="Dear Mr / Mrs"
        . "We sincerly thank you for your valuable donation to the Govardhana Giri Trust and we wish you all the success in your future endeavor!"
        . ""
        . "Kind Regards,"
        . "Govardhana Giri Trust";
$html= "Dear Mr/Mrs ABCD<br/><br/>We sincerly thank you for your valuable donation to the Govardhana Giri Trust and we wish you all the success in your future endeavor!<br/><br/><br/>Kind Regards,<br/>Govardhana Giri Trust";

$from_address = "goushala@pejawaravishwa.com";
$to = "veekshith@atlanticdata.co.uk";

$attachment = $mail->getFile('uploads/donation_receipt.pdf');

$mail->setHtml($html, $text);
$mail->setReturnPath($from_address);
 
$mail->setFrom($from_address);
$mail->setSubject("Pejawara Vishwa Donation Receipt");
 
$mail->setHeader('X-Mailer', 'HTML Mime mail class');

$mail->addAttachment($attachment,'donation_receipt.pdf','uploads/');
 
$result = $mail->send(array($to), 'smtp');

}

?>
