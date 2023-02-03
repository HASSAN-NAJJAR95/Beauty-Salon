<?php 
/*For Products*/
@$con= mysqli_connect('localhost','makeup','root','makeup');
if(!$con){
    echo 'fail: '.mysqli_connect_error();
}

@$conn= mysqli_connect('localhost','form','root','makeup');
if(!$conn){
    echo 'fail: '.mysqli_connect_error();
}