<?php
//get data from form  

$name = $_POST['name'];
$number = $_POST['number'];
$email= $_POST['email'];
$message= $_POST['message'];
$to = "examsofficer@sevenskies.edu.my";
$subject = "Inquiry from IGCSE Registration Website";
$txt ="Name = ". $name . "\r\n  Email = " . $email . "\r\n Message =" . $message . "\r\n Number =" .$number;

$headers = "From: noreply@sevenskies.edu.my" . "\r\n" .
"CC: djohann.iskandar@sevenskies.edu.my";
"CC: alaa.mali@sevenskies.edu.my";
if($email!=NULL){
    mail($to,$subject,$txt,$headers);
}
//redirect
header("Location:thanks.php");
?>