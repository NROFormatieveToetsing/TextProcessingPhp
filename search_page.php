
<html>
<head>
    <style>
        .search {
            margin: 0 auto;
            width: 300px;
            padding: 1em;
            border: 1px solid #CCC;
            border-radius: 1em;
             background-color:#E6E6FA;
        }

        label {
            display: inline-block;
            text-align: right;
            padding: 1%;
            width: 40%;
        }

        input:focus {
            border-color: #000;
            background-color: beige; 
            
        }
        div {
            margin-top: 1em;
        }
        .button input{
            margin-left: 10%;
        }

    </style>
</head>
<body>
<div class="search">
    <h3>Enter your search pattern</h3>
    <form action="chart_search.php" method="post">
        <div>
            <label for="txt1">First word:</label>
            <input type="text" name="txt1" value="" width="35"/>
        </div>
        <div>
            <label for="txt2">Second word:</label>
            <input type="text" name="txt2" value="" width="35"/>
        </div>
        <div>
            <label for="txt3">Third word:</label>
            <input type="text" name="txt3" value="" width="35"/>
        </div>
        <div>
            <label for="txt4">Fourth word:</label>
            <input type="text" name="txt4" value="" width="35"/>
        </div>
        <div>
            <label for="txt5">Fifth word:</label>
            <input type="text" name="txt5" value="" width="35"/>
        </div>
        <div class="button">
            <input type="submit" name="searchBtn" value="Search the pattern" style="color:white;background-color: orange; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;"></button>
            <input type="reset" name="resetBtn" value="Clear entries" style="color:white;background-color: orange; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;"></button>
        </div>
    </form>

</div>
</body>
</html>

