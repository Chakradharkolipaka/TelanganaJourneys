<?php
require_once 'constants.php';
$conn = mysqli_connect('localhost','root','','tour',);
if($conn){
    // echo "DB Connected";
} else{
    echo "DB not connected";
}
?>