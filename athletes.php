<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">

<title>Athletes Results</title>
<style>
body {
	font-family: Verdana, Arial, Helvetica, sans-serif;
    background-color: bisque;
    color: brown;
}
.center {
    text-align: center;
}
.larger {
    font-size: larger;
    text-align: left;
}
table {
    margin: 0 auto;
    border-collapse: collapse;
}
th, td {
    border: 2px solid #ddd;
    padding: 10px;
}
.fixed {
    font-family: Courier, monospace;
    white-space: pre;
    background-color: cornsilk;
}
</style>
</head>
<body>
<h3 class="center">COA123 - Web Programming</h3>
<h2 class="center">Individual Coursework - Olympic Cyclists</h2>
<h1 class="center">Task 2 - Athletes (athletes.php)</h1>
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
//Establishing the connection
$servername = "sci-mysql";
$username = "coa123cycle";
$password = "bgt87awx!@2FD";
$dbname = "coa123cdb";

$conn = new mysqli($servername, $username, $password, $dbname);

//Checking connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Retrieving input values from GET request
$country_id = strtoupper($_GET['country_id']);
$part_name = strtoupper($_GET['part_name']);

//Preparing SQL query to retrieve cyclist names and number of participated events
$sql = "SELECT cyclist.name, COUNT(event.record_id) AS events_attended
        FROM cyclist
        INNER JOIN event ON cyclist.cyclist_id = event.cyclist_id
        INNER JOIN country ON cyclist.iso_id = country.iso_id
        WHERE cyclist.name LIKE '%$part_name%' AND country.iso_id = '$country_id'
        GROUP BY cyclist.cyclist_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    //Outputing the table headers
    echo "<table>";
    echo "<tr><th>Cyclist Name</th><th>Events Attended</th></tr>";

    //Outputing each row of the table
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["name"]."</td><td>".$row["events_attended"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

//Closing the connection
$conn->close();
?>

</body>

</html>