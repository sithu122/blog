<?php 
  
 try{
    $sever_name="localhost";
    $dbname="blog";
    $dbuser="root";
    $dbpassword="";

    $dsn="mysql:host=$sever_name;dbname=$dbname";

    $conn=new PDO($dsn,$dbuser,$dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  //  echo "Connection success";

 }catch(PDOException $e){
    die("Connection fail:".$e->getMessage());
 }
?>

