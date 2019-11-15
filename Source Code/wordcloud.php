<?php
session_start();
function mytagcloud (){
require('cloud.php');
#include 'globalvars.php';
#$arraytemp = $_SESSION["array1"];
#$arraytemp = $_SESSION["array3"];
#$arraytemp = $globalarray1;
$arraytemp = $_SESSION["wordcloud"];
$text_content = implode(" ",$arraytemp);


$cloud = new PTagCloud(100);
    $cloud->addTagsFromText($text_content); 
   
    $cloud->setWidth("500px");
    $cloud->setBackgroundColor("olive");
    $cloud->setBackgroundImage("images/clouds.jpg");
    echo $cloud->emitCloud();
    /* my adding*/
    #session_destroy();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
}
?>

<html>
<head>
   
    <title></title>
    <style>
        .box{
    width: 550px;
    height: 300px;
    background-color: white;
    border: solid 0px white;
    position: relative;
    left: 30%;
    top: 20%;
}
    </style>
   
</head>
<body>
    <div class="box">
        <p align="center" style="font-size:36px;color:blue" > Word Cloud   </p>
         <?php
    mytagcloud();
    ?>
       
    </div>
   
</body>
</html>
