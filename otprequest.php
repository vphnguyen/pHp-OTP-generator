<?php
include ("database_connect.php"); //Contain $con allow you login your DB.
    //===================== CLEANING IN DataBase, do it again when your check your OTP from Client, you can change time in minute, hour or day.
    $sqlqr= "DELETE FROM verification WHERE TIMESTAMPDIFF(MINUTE,`ngay`,NOW()) > 5";
    $result = mysqli_query($con,$sqlqr);
    //===================== CREATE SESSION, insert user ID, mail or phone numbers, timestamp on your DB server
    $sqlqr="INSERT INTO `verification` (`tenKH`, `ngay`, `HASH`, `EMAIL`) VALUES ('".$_GET["tenKH"]."', current_timestamp(), '', '".$_GET["EMAIL"]."')";
    $result = mysqli_query($con,$sqlqr);
    //===================== TIME, now we get that time on above into $row.
   $sqlqr1="SELECT `ngay`FROM `verification` WHERE `tenKH`=\"".$_GET["tenKH"]."\"";
   $result = mysqli_query($con,$sqlqr1);
   $time;
   if($result->num_rows >0){
       $row = $result->fetch_assoc();
   }
   //====================== HASH GENERATION,create MD5 hash by using ID and salt(your timestamp), we could need more salt by depend on your taste.
    $salt = $row["ngay"];
    $HASH= md5($_GET["tenKH"]. $salt);
   //echo $HASH."<br>";
   $count=0;$OTP="";
   //====================== OTP, you can select 4-6 first or last number of that hash
   for ($i = 0; $i < strlen($HASH); $i++){
        if(is_numeric($HASH[$i])){
        $count++;
        if($count==7)break;
            $OTP.=$HASH[$i];
        }
    }
    echo $OTP;
    //====================== SAVE, save it back to HASH column on your DB identified by ID 
    $sqlqr= "UPDATE `verification` SET `HASH`=".$OTP." WHERE `tenKH`=\"".$_GET["tenKH"]."\"";
    $result = mysqli_query($con,$sqlqr);
   

?>
