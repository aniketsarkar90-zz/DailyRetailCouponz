<?php
   $dbhost = 'localhost';
   $dbuser = 'grabxgvz_dev1c';
   $dbpass = 'dev1couponz';
   $conn = mysql_connect($dbhost, $dbuser, $dbpass);
   
   if(! $conn )
   {
      die('Could not connect: ' . mysql_error());
   }
   
   echo 'Connected successfully';
   
   $sql = 'CREATE TABLE employee( '.
      'emp_id INT NOT NULL AUTO_INCREMENT, '.
      'emp_name VARCHAR(20) NOT NULL, '.
      'emp_address  VARCHAR(20) NOT NULL, '.
      'emp_salary   INT NOT NULL, '.
      'primary key ( emp_id ))';
	  
	  
   mysql_select_db('grabxgvz_dev2couponz');
   $retval = mysql_query( $sql, $conn );
   
   if(! $retval )
   {
      die('Could not create table: ' . mysql_error());
   }
   
   echo "Table employee created successfully\n";
   
   mysql_close($conn);
?>