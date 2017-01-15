<!DOCTYPE html>
<html>
<head>
	<title> Pharmacy News </title>
	<link rel = "stylesheet" href = "pharmacynews.css" /> 
	
</head>

<body>
		
	<div class = "notice">
		<!--h2> News >> </h2-->
		<div id = "MyDivName" class = "scroll"> 
			<?php
	
				require("../db/db.php");
				
				//Retrieve Data
				$sql = "SELECT * FROM news ORDER BY  date DESC";
				//$sql = "SELECT DISTINCT username FROM user";
				$res = mysqli_query($db , $sql);
					
				if($res){
					while($row = mysqli_fetch_array($res)){
						/*echo $row['postnews']."<br>".$row['date']."<br/><br/>";*/
						echo $row['date']."<br>".$row['postnews']."<br/><br/>";
					}
				}
				else{
					echo "Error : " . mysqli_error($db); 
				}
				
				//Close connectionection
				mysqli_close($db);
			?>
		</div>
	</div>
	
	<div class = "reg">
	
		<div class = "news1">
			<p> Anura Pharmacy opens Everyday </br> Except poya days </p>
			<p> From 9.00 am </br> To 10.00 pm</p>
		</div>
		
		<!--div class = "news2">
			<p> Open at 8.00 am </br> Close at 8.00 pm</p>
		</div-->
		
		<div class = "news3">
			<!--p> Do you love to deal </br> with pharmaceutical drugs? </p>
			<p> Have a dream to become </br> a pharmacist? </p-->
			<p> Vacancy at </br> Anura Pharmacy (Pvt) Ltd </p>
			<!--input class = "button" type = "submit" name = "submit" value = "Register Now"-->
			<a href="vacancy.html"><button class="button" style="align:center;">Apply Now</button></a>
		</div>
		
	</div>
		
</body>

</html>

<script language="javascript">
ScrollRate = 100;

function scrollDiv_init() {
	DivElmnt = document.getElementById('MyDivName');
	ReachedMaxScroll = false;
	
	DivElmnt.scrollTop = 0;
	PreviousScrollTop  = 0;
	
	ScrollInterval = setInterval('scrollDiv()', ScrollRate);
}

function scrollDiv() {
	
	if (!ReachedMaxScroll) {
		DivElmnt.scrollTop = PreviousScrollTop;
		PreviousScrollTop++;
		
		ReachedMaxScroll = DivElmnt.scrollTop >= (DivElmnt.scrollHeight - DivElmnt.offsetHeight);
	}
	else {
		ReachedMaxScroll = (DivElmnt.scrollTop == 0)?false:true;
		
		DivElmnt.scrollTop = PreviousScrollTop;
		PreviousScrollTop--;
	}
}

function pauseDiv() {
	clearInterval(ScrollInterval);
}

function resumeDiv() {
	PreviousScrollTop = DivElmnt.scrollTop;
	ScrollInterval    = setInterval('scrollDiv()', ScrollRate);
}
</script>