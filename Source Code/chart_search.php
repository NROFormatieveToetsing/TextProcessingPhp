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


if (isset($_POST['searchBtn'])) {
    $array1 = $_SESSION["array1"];
    $array2 = $_SESSION["array2"];
    $array3 = $_SESSION["array3"];
    $array0 = $_SESSION["array0"];
     /*my code
    foreach ( $array0 as $item ) {
        echo $item . "<br/>"; 
    } */

    $txt1 = trim(strtolower($_POST['txt1']));
    $txt2 = trim(strtolower($_POST['txt2']));
    $txt3 = trim(strtolower($_POST['txt3']));
    $txt4 = trim(strtolower($_POST['txt4']));
    $txt5 = trim(strtolower($_POST['txt5']));


       $data1 = array(search($array1, $txt1), search($array2, $txt1), search($array3, $txt1), search($array0, $txt1));
       $jsonData1 = json_encode($data1, JSON_PRETTY_PRINT);
    

       $data2 = array(search($array1, $txt2), search($array2, $txt2), search($array3, $txt2), search($array0, $txt2));
       $jsonData2 = json_encode($data2, JSON_PRETTY_PRINT);
    

       $data3 = array(search($array1, $txt3), search($array2, $txt3), search($array3, $txt3), search($array0, $txt3));
       $jsonData3 = json_encode($data3, JSON_PRETTY_PRINT);
    

       $data4 = array(search($array1, $txt4), search($array2, $txt4), search($array3, $txt4), search($array0, $txt4));
       $jsonData4 = json_encode($data4, JSON_PRETTY_PRINT);
    
    

       $data5 = array(search($array1, $txt5), search($array2, $txt5), search($array3, $txt5), search($array0, $txt5));
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
                labels: ["File 1", "File 2", "Web Page", "Text Box"],
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
            /* my adding*/
            /*session_destroy (); */
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
<body onload="displayLineChart();">
<div id="container">
    
        <table align="center">  
            <tr>
                <td align="center">  
                    <div class="box">
        <h4>Search Result</h3>
        <canvas id="lineChart" height="450" width="800" style="border: 1px solid grey; padding: 2%"></canvas>
               </div>
                    
                    </td>
        </tr>
        </table>
        <div id="js-legend" class="chart-legend" style="position: absolute;top: 15%;left: 20%"></div>
    
    
</div>
</body>
</html>