<?php
include 'examples.php';
#asort ($a);    receives array a and sort it.
#simple_search ($k, $arr); checks whether value k exists in array arr and return true or false.
#sizeof ($arr)  returns the length of array arr.
#word_frequency_in_array ($p,$arr)  calculates the frequency of word p in array arr.
#array_unique ($arr)   receive array arr and remove its duplicate elements and return an array with non-duplicate elements

function assignment1 ($a , $b)  #inputs: arrays a and b
{
 $len_a = sizeof ($a); # size of array a or the number of its words   
 $len_b = sizeof ($b); # size of array b or the number of its words  
 $similarity = 0; 
  /*
   
  write your code here
   
   */  
 
 echo $similarity . "%";
 
    
}

?>

<!DOCTYPE html>
<html>
<head>
   
    <title></title>
    <style>
        .box{
    width: 550px;
    height: 200px;
    background-color: blanchedalmond;
    border: solid 2px purple;
    position: relative;
    left: 30%;
    top: 30%;
}
    </style>
   
</head>
<body>
    <div class="box">
        <p align="center" style="font-size:36px;color:blue" >   Similarity Percentage 
         <p align="center" style="font-size:36px;color:red" >
            <?php
            $s = $_SESSION["array1"];
            $t = $_SESSION["array2"];
            assignment1 ($s , $t)
         ?>
       </p>
    </div>
   
</body>
</html>






