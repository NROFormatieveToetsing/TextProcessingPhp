<?php
session_start();  

function simple_search ($k, $a)
        {
    $i = 0;
    for ($i=0; $i < sizeof($a); $i++){
     
                 if ($k == $a[$i]){
                    return true;
                 }
    }             
    return false;
}

/*
 def find_frequency_of_words (a):  #this function recieves array a and calculate the frequency of words in this array
      uarray = []  # includes all words sorted without repetions
      farray = []  # includes frequencies for each item of uarray
      index = 0
      i = 0
      while i < len(a):
          uarray.append (a[i])
          farray.append(1)
          cnt = 1
          j = i + 1
          if j >= len(a):
              break
          while ( j<len (a)):
              if a[i] == a[j]:
                j += 1
                cnt += 1
              else:
                 break
          farray [index]=cnt
          i = i + cnt
          index=index+1
      #print ("array uarray in find_frequency_of_words func:", uarray)
      #print ("array farray in find_frequency_of_words func:", farray)    
      return (uarray, farray) 
 */


function textlen ($t){
    $i = 0;

while ($t[$i] != '') {
  $i++;
}
return $i;
}


function cuttext ($t, $i, $len){
  $s="";
  for ($k = $i+1; $k < $len; $k++) {
     $s=$s. $t[$k];
}  
  return $s;   
}


function findnumber ($k){
    $s="";
    $len=textlen ($k);
   
    for ($j=0; $j < $len; $j++){
        
        if ($k[$j] >= '0' and $k[$j]<='9') {
           $s = $s.$k[$j];
        }   
       else {
           break;
       }
    }   
    return $s;   
}


function example1_main_routine($t){
         $i=0;
         $len=textlen ($t);         
         for ($i=0; $i < $len; $i++){
             if ($t[$i]=='#') {
                
                 $t1 = cuttext ($t, $i, $len);
                 
                 $number = findnumber ($t1);
               
                 if ($number != ""){
                     echo "Result"."<br>";
                     echo '#'. $number."<br>";
                 }               
             }
            }
} 
          
 function text_equals ($p,$q){           #this function tests two strings p and q are equal or not.
    if (textlen ($p) != textlen ($q)){
        #echo "in text equals: ". $p ."  ". $q . "<br>"; 
        
        return 0;
    }    
    $l = textlen ($p);
    
    for ($i=0; $i < $l; $i++){
         if (strtolower($p[$i]) != strtolower($q[$i])){
            return 0;
         } 
    }     
    return (1);
 }   
          
 
 
 function word_frequency_in_array ($p,$a){  #this function calculates the frequency of parameter p in array a and return it
      $freq=0; 
      #echo "size of array a". sizeof($a) . "<br>";
      for ($i=0; $i < sizeof($a); $i++){
     
                 if (text_equals ($p , $a[$i])== 1){
                    $freq++;
                 }
      }           
      return $freq;
 }      
 
 
 function example2_main_routine ($t){   /*this function receives array t and calculates its most frequent element*/
   
    $max_frequency = 0;
    $temp = "";
    $cnt = 0;
    for ($i=0; $i < sizeof($t); $i++){
        $cnt = word_frequency_in_array ($t[$i],$t);
        #echo "in main".$t[$i]. "    ". strval($cnt);
        if ($cnt > $max_frequency){
            $temp = $t[$i]; 
            $max_frequency = $cnt;     
        }
    }  
    echo "Most Frequent Term"."<br>";
    echo $temp."  -->  ". $max_frequency;
 }
 

 ?>  


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>

    
</head>
<body>

<div>
    <hr>
    <?php
    
    if ($_SESSION["example"]==1){
        $t = $_SESSION["text1"];
        example1_main_routine($t);
    }
    
    if ($_SESSION["example"]==2){
        $s = $_SESSION["example2keywords"];
        example2_main_routine($s);
    }
    #example1_main_routine();
    #$cars=array("Volvo","BMW","Toyota","BMW");
    #$t = $_SESSION["example2keywords"];
    #$tmparr = explode (" ", $t);
    
    #example2_main_routine($t);
    ?>
    <hr>
    </div>
</body>
</html>


