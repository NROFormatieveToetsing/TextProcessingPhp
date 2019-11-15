<?php
session_start();

function search($array, $keyword)
{
    $count = 0;
    foreach ($array as $string) {
        if ($string == $keyword)
            $count++;
    }
    return $count;
}

function array_count_values_of($value, $array)
{
    $counts = array_count_values($array);
    return $counts[$value];
}

function most_frequent_value_in_array($array)
{
    $values = array_count_values($array);
    arsort($values);
    return array_slice(array_keys($values), 0, 50, true);
}

function array_total_count_values_of($array)
{
    $index = 0;
    foreach (most_frequent_value_in_array($array) as $item) {
        $newArray[$index] = array_count_values_of($item, $array);
        $index++;
    }
    return $newArray;
}


    $array1 = $_SESSION["array1"];
    $array2 = $_SESSION["array2"];
    $array3 = $_SESSION["array3"];
    $array0 = $_SESSION["array0"];
    
   foreach ($array1 as $item) {
        echo $item;
    } 

?>

<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Line Chart Test</title>
    <script language="JavaScript" src="js/Chart.min.js"></script>
    <script language="JavaScript">
        
        function displayWordsInInput1() {
            var data = {
                labels: <?php echo json_encode(most_frequent_value_in_array($array1), JSON_PRETTY_PRINT); ?>
                ,
                datasets: [
                    {
                        fillColor: "rgba(0,220,220,0)",
                        strokeColor: "#33A2E8",
                        pointColor: "#33A2E8",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "#33A2E8",
                        data: <?php echo json_encode(array_total_count_values_of($array1), JSON_PRETTY_PRINT); ?>
                    }
                ]
            };
            data.datasets[0].label = "input1";

            var ctx = document.getElementById("input1").getContext("2d");
            var options = {};
            var lineChart = new Chart(ctx).Line(data, options);
        }

        function displayWordsInInput2() {
            var data = {
                labels: <?php echo json_encode(most_frequent_value_in_array($array2), JSON_PRETTY_PRINT); ?>
                ,
                datasets: [
                    {
                        fillColor: "rgba(220,0,220,0)",
                        strokeColor: "#33A2E8",
                        pointColor: "#33A2E8",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "#33A2E8",
                        data: <?php echo json_encode(array_total_count_values_of($array2), JSON_PRETTY_PRINT); ?>
                    }
                ]
            };
            data.datasets[0].label = "input2";

            var ctx = document.getElementById("input2").getContext("2d");
            var options = {};
            var lineChart = new Chart(ctx).Line(data, options);
        }

        function displayWordsInInput3() {
            var data = {
                labels: <?php echo json_encode(most_frequent_value_in_array($array3), JSON_PRETTY_PRINT); ?>
                ,
                datasets: [
                    {
                        fillColor: "rgba(220,220,0,0)",
                        strokeColor: "#33A2E8",
                        pointColor: "#33A2E8",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "#33A2E8",
                        data: <?php echo json_encode(array_total_count_values_of($array3), JSON_PRETTY_PRINT); ?>
                    }
                ]
            };
            data.datasets[0].label = "input3";

            var ctx = document.getElementById("input3").getContext("2d");
            var options = {};
            var lineChart = new Chart(ctx).Line(data, options);
        }

        function displayWordsInInput4() {
            var data = {
                labels: <?php echo json_encode(most_frequent_value_in_array($array0), JSON_PRETTY_PRINT); ?>
                ,
                datasets: [
                    {
                        fillColor: "rgba(100,220,220,0)",
                        strokeColor: "#33A2E8",
                        pointColor: "#33A2E8",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "#33A2E8",
                        data: <?php echo json_encode(array_total_count_values_of($array0), JSON_PRETTY_PRINT); ?>
                    }
                ]
            };
            data.datasets[0].label = "input4";

            var ctx = document.getElementById("input4").getContext("2d");
            var options = {};
            var lineChart = new Chart(ctx).Line(data, options);
        }

    </script>
    <style>
        h3 {
            text-align: center;
            margin: 20px auto;
        }

        .chart-legend li span {
            display: inline-block;
            width: 12px;
            height: 12px;
            margin-right: 5px;
        }

        .chart-legend ul {
            list-style: none;
        }
    </style>
</head>
<body onload="displayWordsInInput1();displayWordsInInput2();displayWordsInInput3();displayWordsInInput4(); ">

    <h3>Most Common Words In Input1</h3>
    <canvas id="input1" height="450" width="800" style="border: 1px solid grey; padding: 2%"></canvas>

    <h3>Most Common Words In Input2</h3>
    <canvas id="input2" height="450" width="800" style="border: 1px solid grey; padding: 2%"></canvas>

    <h3>Most Common Words In Input3</h3>
    <canvas id="input3" height="450" width="800" style="border: 1px solid grey; padding: 2%"></canvas>

    <h3>Most Common Words In Input4</h3>
    <canvas id="input4" height="450" width="800" style="border: 1px solid grey; padding: 2%"></canvas>

</body>
</html>
