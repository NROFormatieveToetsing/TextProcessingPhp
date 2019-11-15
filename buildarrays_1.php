<?php
    session_start();

if (isset($_POST['uploadBtn'])) {
    
    if ($_FILES['file1']['error'] == UPLOAD_ERR_OK
        && is_uploaded_file($_FILES['file1']['tmp_name'])
    ) {
        $file1_contents = file_get_contents($_FILES['file1']['tmp_name']);
        $_SESSION["array1"] = explode(' ', trim(strtolower($file1_contents)));
    }

    if ($_FILES['file2']['error'] == UPLOAD_ERR_OK
        && is_uploaded_file($_FILES['file2']['tmp_name'])
    ) {
        $file2_contents = file_get_contents($_FILES['file2']['tmp_name']);
        $_SESSION["array2"]  = explode(' ', trim(strtolower($file2_contents)));
    }

    if ($_FILES['file3']['error'] == UPLOAD_ERR_OK
        && is_uploaded_file($_FILES['file3']['tmp_name'])
    ) {
        $file3_contents = file_get_contents($_FILES['file3']['tmp_name']);
        $_SESSION["array3"]  = explode(' ', trim(strtolower($file3_contents)));
    }

    $txtArea = $_POST['text1'];
    if ($txtArea != null) {
        $_SESSION["array0"]  = explode(' ', trim(strtolower($txtArea)));
        /*foreach ( $_SESSION["array2"] as $item ) {
        echo $item . "<br/>"; 
    } */
    }
    header('Location:index.php');
}

if (isset($_POST['wordcloudBtn'])) {
    header('Location:wordcloud.php');
}

if (isset($_POST['topwordsBtn'])) {
    header('Location:chart.php');
}
?>
<html>
<head>
    <style>
        .search {
            margin: 0 auto;
            width: 400px;
            padding: 1em;
            border: 1px solid #CCC;
            border-radius: 1em;
        }

        label {
            display: inline-block;
            text-align: left;
            padding: 1%;
            width: 40%;
        }

        input:focus {
            border-color: #000;
        }
        div {
            margin-top: 1em;
        }
        .button input{
            margin-left: 15%;
        }

    </style>
</head>
<body>
<div class="search">
    <h3>Enter your list of words to search</h3>
    <form action="chart_search.php" method="post">
        <div>
            <label for="txt1">First word to search:</label>
            <input type="text" name="txt1" value="" width="35"/>
        </div>
        <div>
            <label for="txt2">Second word to search:</label>
            <input type="text" name="txt2" value="" width="35"/>
        </div>
        <div>
            <label for="txt3">Third word to search:</label>
            <input type="text" name="txt3" value="" width="35"/>
        </div>
        <div>
            <label for="txt4">Fourth word to search:</label>
            <input type="text" name="txt4" value="" width="35"/>
        </div>
        <div>
            <label for="txt5">Fifth word to search:</label>
            <input type="text" name="txt5" value="" width="35"/>
        </div>
        <div class="button">
            <input type="submit" name="searchBtn" value="Search the pattern"></button>
            <input type="reset" name="resetBtn" value="Clear entries"></button>
        </div>
    </form>

</div>
</body>
</html>

