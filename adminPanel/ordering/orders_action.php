<?php

//importing db.php in the db folder
require("../../db/db.php");
//getting the values from the ordering form through post method
//getting the values from th
$nic = $_POST["NIC"];
$dp = $_POST["DP"];
 
$time = $_POST["DPTime"];
$tele = $_POST["Tele"];
$mail = $_POST["Email"];
if(isset($_POST["Address"])) {
    $address = $_POST["Address"];
}
else{
    $address="-";
}
    
$image1 =$_FILES['Image1']['tmp_name'];
$image_name1 = addslashes($_FILES['Image1']['name']);
$images1=getimagesize($_FILES['Image1']['tmp_name']);
$imagetype1=$images1['mime'];
$path1='photo/'.$image_name1; //appending the file name to the folder name to provide the path


if(isset($_FILES['Image2']['tmp_name'])) {
    $image2 =$_FILES['Image2']['tmp_name'];
    $image_name2 = addslashes($_FILES['Image2']['name']);
$images2=getimagesize($_FILES['Image2']['tmp_name']);
$imagetype2=$images2['mime'];
$path2='photo/'.$image_name2; //appending the file name to the folder name to provide the path
    (move_uploaded_file($image2,'photo/'.$_FILES['Image2']['name']));
}
else{
    $path2="No copy";
    $image_name2=" ";
    $imagetype2=" ";
}

if(isset($_FILES['Image3']['tmp_name'])) {
    
    $image3 =   $_FILES['Image3']['tmp_name'];
    $image_name3 = addslashes($_FILES['Image3']['name']);
    $images3=getimagesize($_FILES['Image3']['tmp_name']);
    $imagetype3=$images3['mime'];
    $path3= 'photo/'.$image_name3; //appending the file name to the folder name to provide the path
    (move_uploaded_file($image3,'photo/'.$_FILES['Image3']['name']));
    }
    

else{
    $path3="No copy";
     $image_name3=" ";
    $imagetype3=" ";
}


if((move_uploaded_file($image1,'photo/'.$_FILES['Image1']['name']))  ){ //there should be atleast one image submitted from a form
    
$sql1="INSERT INTO `order` (NIC,DP,Address,DPTime,Telephone,Email,Image1,ImageName1,Image1Type,Image2,ImageName2,Image2Type,Image3,ImageName3,Image3Type) VALUES ('$nic ','$dp','$address','$time','$tele','$mail','$path1','$image_name1','$imagetype1','$path2','$image_name2','$imagetype2','$path3','$image_name3','$imagetype3')"; //sql query to transfer data to the order table

$sql2="INSERT INTO reportorder(Email,date)  VALUES ('$mail',CURDATE())"; sql query to transfer data to the reportorder table

$result1 = mysqli_query($db,$sql1); exectuion of queries
$result2 = mysqli_query($db,$sql2);

 if (!$result1 and !$result2) //If queries are unsuccessful following alert box is triggered
{
     
    echo '<script language="javascript">
 alert("Order not placed properly please try again ")
window.location.href="orders.php";
 </script>';
}
else
{
      
 $results=mysqli_query($db,"SELECT * FROM `order` ORDER BY `OrderNo.` DESC LIMIT 1") or die(mysqli_error($db)); //query to select maximum order number from the order table

 while($row=mysqli_fetch_assoc($results)){ //fetching the results of the query as an associate array
 
    echo '<script>
    
alert("Order placed successfully! Your Order number is ' . $row['OrderNo.'] . '") //displaying order number
window.location.href="orders.php";
</script> ';
  
if(isset($_POST['submit'])) 
{

$message=
'Your order has been placed successfully! Your order number is ' . $row['OrderNo.'].' Thank you!<br>
Anura Pharmacy';
    
    require "phpmailer/class.phpmailer.php"; //include phpmailer class(To send the email notification)
      
    // Instantiate Class  
    $mail = new PHPMailer();  
      
    // Set up SMTP  
    $mail->IsSMTP();                // Sets up a SMTP connection  
    $mail->SMTPAuth = true;         // Connection with the SMTP does require authorization    
    $mail->SMTPSecure = "ssl";      // Connect using a TLS connection  
    $mail->Host = "smtp.gmail.com";  //Gmail SMTP server address
    $mail->Port = 465;  //Gmail SMTP port
    $mail->Encoding = '7bit';
    
    // Authentication  
    $mail->Username   = "sunethpereraucsc@gmail.com"; // Your full Gmail address
    $mail->Password   = "ucsc123456789"; // Your Gmail password
      
    // Compose
    $mail->SetFrom($_POST['emailid'], "Anura pharmacy");
    $mail->AddReplyTo($_POST['emailid'], $_POST['fullname']);
    $mail->Subject = "Pharmacy order confirmaton";      // Subject (which isn't required)  
    $mail->MsgHTML($message);
 
    // Send To  
    $mail->AddAddress($_POST["Email"], "Recipient Name"); // Where to send it - Recipient
    $result = $mail->Send();		// Send!  
	$message = $result ? 'Successfully Sent!' : 'Sending Failed!';      
	unset($mail);

}     
     
 }
    
}
}

?>