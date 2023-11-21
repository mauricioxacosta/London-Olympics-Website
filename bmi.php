<!DOCTYPE html>
<html lang ="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width"/>

<title>BMI Results</title>
<style type="text/css">
body {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	background-color: bisque;
}
.center {
	text-align:center;
}
body,td,th {
	color: brown; 
}
.larger {
	font-size:larger;
	text-align:right;
}
table {
	margin-left:auto;
	margin-right:auto;
}
.fixed {
	font-family: Courier, monospace;
	white-space: pre;
	background-color:cornsilk;
}
</style>
</head>
<body>
<h3 class="center">COA123 - Web Programming</h3>
<h2 class="center">Individual Coursework - Olympic Cyclists</h2>
<h1 class="center">Task 1 - BMI (bmi.php)</h1>
  <table>
  <tr>
  <td>
<div class="fixed">~  __0
 _-\<,_
(*)/ (*)
</div>
  </td>
  </tr>
  </table>
  <br />
 
<?php
//Retrieving input values
$min_weight = $_GET['min_weight'];
$max_weight = $_GET['max_weight'];
$min_height = $_GET['min_height'];
$max_height = $_GET['max_height'];

//Initialising the table
echo "<table style='border-collapse: collapse;'>";
echo "<thead><tr><th style='border: 1px solid black;'>Height<br>→<br>↓<br>Weight</th>"; //Table header
for ($h = $min_height; $h <= $max_height; $h += 5) { //Adding height headers
    echo "<th style='border: 1px solid black;'>$h</th>";
}
echo "</tr></thead><tbody>";

//Calculating BMI values and adding values to the table
for ($w = $min_weight; $w <= $max_weight; $w += 5) { //Loop through weight values
    echo "<tr><th style='border: 1px solid black;'>$w</th>"; //Adding weight header
    for ($h = $min_height; $h <= $max_height; $h += 5) { //Loop through height values
        $bmi = ($w / (($h/100) * ($h/100))); //Calculating BMI value converting to meters
        echo "<td style='border: 1px solid black;'>" . round($bmi, 3) . "</td>"; //Adding BMI value with only 3 decimals to the table cell
    }
    echo "</tr>";
}

echo "</tbody></table>";
?>

</body>

</html>
