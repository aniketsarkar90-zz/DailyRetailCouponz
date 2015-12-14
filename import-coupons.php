<?php
require_once("db_info.php"); //include the file containing database credentials called 'db_info.php'
mysql_connect($db_host,$db_username,$db_password,$db_name); //to authenticate the database information from db_info.php
mysql_select_db($db_name); //connecting to the database with the help of information fetched from db_info.php
if(isset($_POST["import"])){ //if the import inputis submitted in upload-coupons.php then the if clause will start
	echo $filename=$_FILES["file"]["tmp_name"]; //displaying the file name of the attached file
		 if($_FILES["file"]["size"] > 0)  //if the file has any content in it
		 {
		  	$file = fopen($filename, "r"); //fopen function opens a file or URL, in this case a file. the first parameter $filename is the name of the file to be opened, second parameter is mode is 'r' which means read only from the beginning
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)  //the fgetcsv function is used to parse a .csv file and takes parameter as filename, length of line and comma for field seperator.
	         {
	          //inserting a row in the coupon table from our csv file
	           $sql = "INSERT into coupon values('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]','$emapData[6]','$emapData[7]','$emapData[8]','$emapData[9]')";
	         //we are using mysql_query function. it returns a resource on true else False on error
	          $result = mysql_query( $sql);
				if(!$result) //if successfully inserted, notify the user
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"index.php\"
						</script>";
 
				}
 
	         }
	         fclose($file); //this function closes an open file
	         //throws a message if data successfully imported to mysql database from excel file
	         echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"index.php\"
					</script>";
		 }
	}	
else
{ echo "file size is greater";}	
?>	