<?php

//importing db.php in the includes folder
require("includes/db.php");


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
$path1='photo/'.$image_name1;


if(isset($_FILES['Image2']['tmp_name'])) {
    $image2 =$_FILES['Image2']['tmp_name'];
    $image_name2 = addslashes($_FILES['Image2']['name']);
$images2=getimagesize($_FILES['Image2']['tmp_name']);
$imagetype2=$images2['mime'];
$path2='photo/'.$image_name2;
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
    $path3= 'photo/'.$image_name3;
    (move_uploaded_file($image3,'photo/'.$_FILES['Image3']['name']));
    }
    

else{
    $path3="No copy";
     $image_name3=" ";
    $imagetype3=" ";
}


   




if((move_uploaded_file($image1,'photo/'.$_FILES['Image1']['name']))  ){ 
    
$sql="INSERT INTO `order` (NIC,DP,Address,DPTime,Telephone,Email,Image1,ImageName1,Image1Type,Image2,ImageName2,Image2Type,Image3,ImageName3,Image3Type) VALUES ('$nic ','$dp','$address','$time','$tele','$mail','$path1','$image_name1','$imagetype1','$path2','$image_name2','$imagetype2','$path3','$image_name3','$imagetype3')";



$result = mysqli_query($db,$sql);





 if (!$result) 
{
    echo "Order not properly place! Please place again!";
}
else
{
    echo "Order placed successfully ";
}
}

?>