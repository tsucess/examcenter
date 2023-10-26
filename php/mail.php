<?php 

    if(isset($_POST['btn-send']))
    {
       $UserName = $_POST['UName'];
       $Email = $_POST['Email'];
       $Subject = $_POST['Subject'];
       $Msg = $_POST['msg'];

       if(empty($UserName) || empty($Email) || empty($Subject) || empty($Msg))
       {
           header('location:index.php?error');
       }
       else
       {
           $to = "examsofficer@sevenskies.edu.my";
           $subject = "Inquiry from IGCSE Registration Website";
           $txt ="Name = ". $Username . "\r\n  Email = " . $Email . "\r\n Message =" . $Subject . "\r\n Number =" .$Msg;
           $headers = "From: noreply@sevenskies.edu.my" . "\r\n" .
           "CC: akande.sheriff@sevenskies.edu.my";
           "CC: alaa.mali@sevenskies.edu.my";
           "CC: djohann.iskandar@sevenskies.edu.my";


           if(mail($to,$Subject,$Msg,$Email))
           {
               header("location:index.php?success");
           }
       }
    }
    else
    {
        header("location:index.php");
    }
?>