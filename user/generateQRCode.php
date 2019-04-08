<?php 
    session_start();
    include'../common/SqlConnection.php';

    $visitorId=$_SESSION['visitorId'];
    include'../user/phpqrcode/qrlib.php'; 
    
    
    if($_POST['action'] == 'call_this') {
        // call removeday() here
     
    
    $visitorinfo=mysqli_query($conn, "SELECT * FROM visitor WHERE id='$visitorId'");
    
    $visitorData = mysqli_fetch_assoc($visitorinfo);
   
    $visitorName=$visitorData["name"];
    $visitorAddress=$visitorData["address"];
    $visitorMobile=$visitorData["mobile"];
    $visitorEmail=$visitorData["email"];
    $visitorWhomtoMeet=$visitorData["whomtomeet"];
    $visitorCompany=$visitorData["fromwhichcompany"];
    $visitorPhoto=$visitorData["photo"];

        
    $tempDir = 'qrcodeimages/';   
    if (!file_exists($tempDir))
        mkdir($tempDir);
    // we building raw data 
    // $codeContents  = 'BEGIN:VCARD'."\n"; 
    // $codeContents .= 'FN:'.$visitorName."\n"; 
    // $codeContents .= 'TEL;WORK;VOICE:'.$visitorMobile."\n"; 
    // $codeContents .= 'PHOTO;JPEG;ENCODING=BASE64:'.base64_encode(file_get_contents($visitorPhoto))."\n"; 
    // $codeContents .= 'END:VCARD'; 

    $codeContents=$visitorName;
    $fileName     = 'qr_'.md5($codeContents).'.png';
 
    $pngAbsoluteFilePath = $tempDir.$fileName;

    $urlRelativeFilePath = 'qrcodeimages/' . $fileName;
 
    if (!file_exists($pngAbsoluteFilePath)) {
        QRcode::png($codeContents, $pngAbsoluteFilePath,"L", 4, 4);

       echo QRcode::png($codeContents, $pngAbsoluteFilePath);
    }
    else {
       echo "Not working!";
    }
 
    echo '<img src="'.$urlRelativeFilePath.'" />';

} 