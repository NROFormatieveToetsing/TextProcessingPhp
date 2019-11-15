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

if (isset($_POST['searchBtn'])) {
    $array1 = $_SESSION["array1"];
    $array2 = $_SESSION["array2"];
    $array3 = $_SESSION["array3"];
    $array4 = $_SESSION["array4"];

    $txt1 = $_POST['txt1'];
    $txt2 = $_POST['txt2'];
    $txt3 = $_POST['txt3'];
    $txt4 = $_POST['txt4'];
    $txt5 = $_POST['txt5'];

    $data1 = array(search($array1, $txt1), search($array2, $txt1), search($array3, $txt1), search($array4, $txt1));
    $jsonData1 = json_encode($data1, JSON_PRETTY_PRINT);
    $data2 = array(search($array1, $txt2), search($array2, $txt2), search($array3, $txt2), search($array4, $txt2));
    $jsonData2 = json_encode($data2, JSON_PRETTY_PRINT);
    $data3 = array(search($array1, $txt3), search($array2, $txt3), search($array3, $txt3), search($array4, $txt3));
    $jsonData3 = json_encode($data3, JSON_PRETTY_PRINT);
    $data4 = array(search($array1, $txt4), search($array2, $txt4), search($array3, $txt4), search($array4, $txt4));
    $jsonData4 = json_encode($data4, JSON_PRETTY_PRINT);
    $data5 = array(search($array1, $txt5), search($array2, $txt5), search($array3, $txt5), search($array4, $txt5));
    $jsonData5 = json_encode($data5, JSON_PRETTY_PRINT);
}
?>

<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Line Chart Test</title>
    <script language="JavaScript" src="js/Chart.min.js"></script>
    <script language="JavaScript">
        function displayLineChart() {
            var data = {
                labels: ["source1", "source2", "source3", "source4"],
                datasets: [
                    {
                        fillColor: "rgba(220,220,220,0)",
                        strokeColor: "#33A2E8",
                        pointColor: "#33A2E8",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "#33A2E8",
                        data: <?php echo $jsonData1; ?>
                    },
                    {
                        fillColor: "rgba(220,220,220,0)",
                        strokeColor: "#39E833",
                        pointColor: "#39E833",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "#39E833",
                        data: <?php echo $jsonData2; ?>
                    },
                    {
                        fillColor: "rgba(220,220,220,0)",
                        strokeColor: "#E83354",
                        pointColor: "#E83354",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "#E83354",
                        data: <?php echo $jsonData3; ?>
                    },
                    {
                        fillColor: "rgba(220,220,220,0)",
                        strokeColor: "#E8D833",
                        pointColor: "#E8D833",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "#E8D833",
                        data: <?php echo $jsonData4; ?>
                    },
                    {
                        fillColor: "rgba(220,220,220,0)",
                        strokeColor: "#E833DF",
                        pointColor: "#E833DF",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "#E833DF",
                        data: <?php echo $jsonData5; ?>
                    }
                ]
            };
            data.datasets[0].label = "<?php echo $txt1; ?>";
            data.datasets[1].label = "<?php echo $txt2; ?>";
            data.datasets[2].label = "<?php echo $txt3; ?>";
            data.datasets[3].label = "<?php echo $txt4; ?>";
            data.datasets[4].label = "<?php echo $txt5; ?>";

            var ctx = document.getElementById("lineChart").getContext("2d");
            var options = {
                segmentShowStroke: false,
                animateRotate: true,
                animateScale: false,
                multiTooltipTemplate: "<%%=datasetLabel%> : <%%= value %>"
            };
            var lineChart = new Chart(ctx).Line(data, options);
            document.getElementById('js-legend').innerHTML = lineChart.generateLegend();
        }

        function displayWordsInInput1() {
            var data = {
                labels: <?php echo json_encode(most_frequent_value_in_array($array1), JSON_PRETTY_PRINT); ?>
                ,
                datasets: [
                    {
                        fillColor: "rgba(220,220,220,0)",
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
                        fillColor: "rgba(220,220,220,0)",
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
                        fillColor: "rgba(220,220,220,0)",
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
                labels: <?php echo json_encode(most_frequent_value_in_array($array4), JSON_PRETTY_PRINT); ?>
                ,
                datasets: [
                    {
                        fillColor: "rgba(220,220,220,0)",
                        strokeColor: "#33A2E8",
                        pointColor: "#33A2E8",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "#33A2E8",
                        data: <?php echo json_encode(array_total_count_values_of($array4), JSON_PRETTY_PRINT); ?>
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
<body onload="displayLineChart();displayWordsInInput1();displayWordsInInput2();displayWordsInInput3();displayWordsInInput4(); ">
<div id="container">
    <div class="box" style="position: relative">
        <h3>Search Result</h3>
        <canvas id="lineChart" height="450" width="800" style="border: 1px solid grey; padding: 2%"></canvas>
        <div id="js-legend" class="chart-legend" style="position: absolute;top: 15%;left: 4%"></div>
    </div>
    <h3>Most Common Words In Input1</h3>
    <canvas id="input1" height="450" width="800" style="border: 1px solid grey; padding: 2%"></canvas>

    <h3>Most Common Words In Input2</h3>
    <canvas id="input2" height="450" width="800" style="border: 1px solid grey; padding: 2%"></canvas>

    <h3>Most Common Words In Input3</h3>
    <canvas id="input3" height="450" width="800" style="border: 1px solid grey; padding: 2%"></canvas>

    <h3>Most Common Words In Input4</h3>
    <canvas id="input4" height="450" width="800" style="border: 1px solid grey; padding: 2%"></canvas>
</div>
</body>
</html>
