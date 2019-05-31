<?php
require_once('../../config.php');
require_once(DBAPI);

session_start();

$db = open_database();

$user_check=$_SESSION['inputID'];
 
$sql = mysqli_query($db,"SELECT ID FROM autenticacao WHERE ID ='$user_check' ");
 
$row=mysqli_fetch_array($sql,MYSQLI_ASSOC);
 
$login_user=$row['ID'];
 
if(!isset($user_check))
{
header("Location: ../../login/");
}
?>