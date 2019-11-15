<?php
    session_start();
     function null_session (){
    #cleaning all data associated to the current session.
    $_SESSION["array0"] =[];
    $_SESSION["array1"] =[];
    $_SESSION["array2"] =[];
    $_SESSION["array3"] =[];
    #header('Location:index.php', true);
    
}
    include 'keywordextractor.php';
    #include 'globalvars.php';
    $_SESSION["example"] = 0;
    if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
        $file1_contents = file_get_contents($_FILES['file1']['tmp_name']);
        #$file1_contents = file_get_contents('http://www.cnn.com/');        
        #$_SESSION["array1"] = explode(' ', trim(strtolower($file1_contents)));
        $_SESSION["array1"] = keywords_extract ($file1_contents);
        $globalarray1 = $_SESSION["array1"];
    }

    if (is_uploaded_file($_FILES['file2']['tmp_name'])
    ) {
        $file2_contents = file_get_contents($_FILES['file2']['tmp_name']);
        #$file2_contents = file_get_contents('http://www.cnn.com/');
        #$_SESSION["array2"]  = explode(' ', trim(strtolower($file2_contents)));
        $_SESSION["array2"]  = keywords_extract ($file2_contents);
    }

     $txtWebpage = $_POST['webpage'];
    if ( trim($txtWebpage) !=null)
    {
        $file3_contents = file_get_contents(trim($txtWebpage));
        $_SESSION["array3"]  = keywords_extract ($file3_contents);
        
    }
    
    /*if (is_uploaded_file($_FILES['file3']['tmp_name'])
    ) {
        $file3_contents = file_get_contents($_FILES['file3']['tmp_name']);
        #$_SESSION["array3"]  = explode(' ', trim(strtolower($file3_contents)));
        $_SESSION["array3"]  = keywords_extract ($file3_contents);
    } */

    $txtArea = $_POST['text1'];
    if ($txtArea != null) 
        {
        #$_SESSION["array0"]  = explode(' ', trim(strtolower($txtArea)));
        $_SESSION["array0"]  = keywords_extract ($txtArea);
    
        $_SESSION["text1"] = trim(strtolower($txtArea));
        
        /*foreach ( $_SESSION["array2"] as $item ) {
        echo $item . "<br/>"; 
    } */
    /*header('Location:index.php');*/
   }

   if (isset ($_POST['resetBtn'])){
       
    $_SESSION["array0"] =[];
    $_SESSION["array1"] =[];
    $_SESSION["array2"] =[];
    $_SESSION["array3"] =[];
       
   }
   if (isset($_POST['wordcloudBtn'])) {
$_SESSION["wordcloud"] =[];
    if (sizeof ( $_SESSION["array0"]) != 0)
          $_SESSION["wordcloud"] = $_SESSION["array0"];  
    if (sizeof ( $_SESSION["array1"]) != 0)
          $_SESSION["wordcloud"] = array_merge ($_SESSION["wordcloud"] , $_SESSION["array1"]); 
    if (sizeof ( $_SESSION["array2"]) != 0)
          $_SESSION["wordcloud"] = array_merge ($_SESSION["wordcloud"] , $_SESSION["array2"]);
    if (sizeof ( $_SESSION["array3"]) != 0)
          $_SESSION["wordcloud"] = array_merge ($_SESSION["wordcloud"] , $_SESSION["array3"]);
    header('Location:wordcloud.php');
    exit();
}

if (isset($_POST['topwordsBtn'])) {
    header('Location:chart.php');
    exit();
}

if (isset($_POST['searchBtn'])) {
    header('Location:search_page.php');
    exit();
}

if (isset($_POST['Example1Btn'])) {
    $_SESSION ["example"] = 1;
    header('Location:examples.php');
    exit();
}

if (isset($_POST['Example2Btn'])) {
    $_SESSION ["example"] = 2;
    $temp= $_SESSION["text1"];
    $_SESSION["example2keywords"] = keywords_extract ($temp);
    #$_SESSION["example2keywords"] = $_SESSION["array1"];
    #echo "in index" . sizeof ($keyword) . "<br>";
    
    header('Location:examples.php');
    exit();
}

if (isset($_POST['Assignment1Btn'])) {
    #$array_a = $_SESSION["array1"];
    #$array_b = $_SESSION["array2"];
    header('Location:assignments.php');
    exit();
}
if (isset($_POST['Assignment2Btn'])) {
    #require 'examples.php';
    $temp= $_SESSION["text1"];
    
    #$_SESSION["sss"] = keywords_extract ($temp);
    #non_repitetive_array ($_SESSION["sss"]);
    $ff= array_unique(keywords_extract ($temp));
    
    
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script language="javascript">
        $(function () {
            $('#uploadBtn').click(function(e) {
                e.preventDefault();
                var file_data1 = $('#file1').prop('files')[0];
                var file_data2 = $('#file2').prop('files')[0];
                /*var file_data3 = $('#file3').prop('files')[0];*/
                var webpage_txt = $('#webpage').val();
                var txt1 = $('#text1').val();

                var form_data = new FormData();
                form_data.append('file1',file_data1);
                form_data.append('file2', file_data2);
                /*form_data.append('file3', file_data3);*/
                form_data.append('webpage_txt', webpage_txt);
                form_data.append('txt1', txt1);
                $.ajax({
                    url: 'index.php',
                    datatype:"text",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post'
                });
            });

        });
    </script>
    <style>
        form {
            margin: 0 auto;
            width: 400px;
            padding: 1em;
            border: 1px solid #CCC;
            border-radius: 1em;
            background-color:#E6E6FA;
        }

        form div + div {
            margin-top: 1em;
        }

        label {
            display: inline-block;
            width: 90px;
        }

        input:focus, textarea:focus {
            border-color: #000;
        }

        textarea {
            vertical-align: top;
            height: 14em;
            resize: vertical;
            width: 99%;
            box-sizing: border-box;
            padding: 3%;
        }

        .button {
            padding-left: 55px;
                        position:relative;
            transition: .5s ease;
            left:8%
        }

        button {
            margin-left: .5em;
        }
        .button1 {
            padding-left: 40px;
            position:relative;
            transition: .5s ease;
            left:8%
        }

        button1 {
            margin-left: .5em;
        }
    </style>
</head>
<body>

<form id="form" action="index.php" enctype="multipart/form-data" method="post">

    <div>
        <label for="text1">Type text:</label>
        <textarea id="text1" name="text1" rows="15" cols="50" style="color: red; background-color: lightyellow">
        </textarea>
    </div>
    <div>
        <label for="file1">Text file 1:</label>
        <input id="file1" type="file" name="file1" value="" width="25"/>
    </div>
    <div>
        <label for="file2">Text file 2:</label>
        <input id="file2" type="file" name="file2" value="" width="25"/>
    </div>
    <div>
         <label for="webpage">Website Url:</label>
        <input type="text" name="webpage" style="width: 300px;background-color: beige; border:1px solid #336600"><br>
        <!--
        <label for="file3">Text file 3:</label>
        <input id="file3" type="file" name="file3" value="" width="25"/>
        -->
    </div>
    <div class="button">
        <input type="button" id="uploadBtn" name="uploadBtn" value="Upload inputs" style="color:white;background-color: orange; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;"></button>
        <input type="reset" name="resetBtn" value="Clear inputs" style="color:white;background-color: orange; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;" onclick="document.write('<?php null_session() ?>');"></button>
    </div>
    <hr> 
    <div class="button1">
        <input type="submit" name="wordcloudBtn" value="Word cloud" style="color:white;background-color: blue; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;"></button>
        <input type="submit" name="searchBtn" value="Search" style="color:white;background-color: blue; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;"></button>
        <input type="submit" name="topwordsBtn" value="Top words" style="color:white;background-color: blue; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;"></button>
    </div>
    <hr>
    <div class="button">
        <input type="submit" name="Example1Btn" value="Example 1" style="color:white;background-color: forestgreen; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;"></button>
        <input type="submit" name="Example2Btn" value="Example 2" style="color:white;background-color: forestgreen; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;"></button>
    </div>
    <hr>
     <div class="button">
        <input type="submit" name="Assignment1Btn" value="Assignment 1" style="color: #000;background-color: lightpink; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;"></button>
        <input type="submit" name="Assignment2Btn" value="Assignment 2" style="color: #000;background-color: lightpink; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;"></button>
     </div>
</form>
    
</body>
</html>
