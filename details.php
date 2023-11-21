<!DOCTYPE html>
<html lang ="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width"/>

<title>Details Results</title>
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
	text-align:left;
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
<h1 class="center">Task 3 - Details (details.php)</h1>
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
$servername = "sci-mysql";
$username = "coa123cycle";
$password = "bgt87awx!@2FD";
$dbname = "coa123cdb";
$conn = mysqli_connect($servername, $username, $password, $dbname);

//Retrieving the date range from the GET parameters using object oriented style function
$date1_str = mysqli_real_escape_string($conn, $_GET['date_1']);
$date2_str = mysqli_real_escape_string($conn, $_GET['date_2']);

//Parse the date strings and converting them to the intented format
$date1 = DateTime::createFromFormat('d/m/Y', $date1_str)->format('Y-m-d');
$date2 = DateTime::createFromFormat('d/m/Y', $date2_str)->format('Y-m-d');

//Constructing the SQL query
$query = "SELECT DISTINCT cyclist.name AS name, country.country_name AS country, cyclist.dob AS dob
          FROM cyclist
          JOIN country ON cyclist.iso_id = country.iso_id
          JOIN event ON cyclist.cyclist_id = event.cyclist_id
          WHERE cyclist.dob BETWEEN '$date1' AND '$date2'
          ORDER BY cyclist.dob DESC";

//Executing the query and retrieve the results
$result = mysqli_query($conn, $query);

//Constructing an array of the results
$cyclists = array();
while ($row = mysqli_fetch_assoc($result)) {
    //Converting the date string to the desired format
    $dob = DateTime::createFromFormat('Y-m-d', $row['dob'])->format('d-m-Y');
    $row['dob'] = $dob;
    $cyclists[] = $row;
}

//Converting the array to JSON and echo it
echo json_encode($cyclists);

mysqli_close($conn);
?>

</body>

</html>