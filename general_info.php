<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Ranking Comparison</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
  <?php
     //Establishing database connection
     $host = 'sci-mysql';
     $dbname = 'coa123cdb';
     $username = 'coa123cycle';
     $password = 'bgt87awx!@2FD';

     try {
       $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     } catch(PDOException $e) {
       echo "Error: " . $e->getMessage();
       die();
     }

     // Getting user input
     $country1 = strtoupper($_POST['country1']);
     $country2 = strtoupper($_POST['country2']);

     // SQL query database for country information
     $sql = "SELECT * FROM country WHERE iso_id = ? OR iso_id = ?";
     $stmt = $pdo->prepare($sql);
     $stmt->execute([$country1, $country2]);

     $countries = $stmt->fetchAll(PDO::FETCH_ASSOC);

     if(count($countries) < 2) {
       echo "Error: Invalid country codes.";
       die();
     }

     // SQL query database for cyclist information for country1
     $sql1 = "SELECT c.*, e.event_name, co.country_name FROM cyclist c 
             JOIN event e ON c.cyclist_id = e.cyclist_id 
             JOIN country co ON c.iso_id = co.iso_id 
             WHERE c.iso_id = ?";
     $stmt1 = $pdo->prepare($sql1);
     $stmt1->execute([$country1]);

     $cyclists1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

     // SQL query database for cyclist information for country2
     $sql2 = "SELECT c.*, e.event_name, co.country_name FROM cyclist c 
             JOIN event e ON c.cyclist_id = e.cyclist_id 
             JOIN country co ON c.iso_id = co.iso_id 
             WHERE c.iso_id = ?";
     $stmt2 = $pdo->prepare($sql2);
     $stmt2->execute([$country2]);

     $cyclists2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

     // Calculating the counts of medals for each country
     $medals = [
       $countries[0]['gold'] + $countries[0]['silver'] + $countries[0]['bronze'],
       $countries[1]['gold'] + $countries[1]['silver'] + $countries[1]['bronze']
     ];

	 //Displaying results
	 echo "<h2>Medal count:</h2>";
	 echo "<table>";
	 echo "<tr><th>Country</th><th>Gold</th><th>Silver</th><th>Bronze</th><th>Total</th></tr>";
	 echo "<tr><td>{$countries[0]['country_name']}</td><td>{$countries[0]['gold']}</td><td>{$countries[0]['silver']}</td><td>{$countries[0]['bronze']}</td><td>{$medals[0]}</td></tr>";
	 echo "<tr><td>{$countries[1]['country_name']}</td><td>{$countries[1]['gold']}</td><td>{$countries[1]['silver']}</td><td>{$countries[1]['bronze']}</td><td>{$medals[1]}</td></tr>";
	 echo "</table>";

	 echo "<h2>List of Cyclists for Country 1:</h2>";
	 echo "<table>";
	 echo "<tr><th>Name</th><th>Height (cm)</th><th>Weight (kg)</th><th>Gender</th><th>Date of Birth</th><th>Sport</th><th>Country</th></tr>";
	 if(count($cyclists1) === 0) {
		echo "<tr><td colspan='7'>NO CYCLISTS FOUND FOR THIS COUNTRY</td></tr>";
	 } else {
	   foreach($cyclists1 as $cyclist) {
		 echo "<tr><td>{$cyclist['name']}</td><td>{$cyclist['height']}</td><td>{$cyclist['weight']}</td><td>{$cyclist['gender']}</td><td>{$cyclist['dob']}</td><td>{$cyclist['event_name']}</td><td>{$cyclist['country_name']}</td></tr>";
	   }
	 }
	 echo "</table>";

	 echo "<h2>List of Cyclists for Country 2:</h2>";
	 echo "<table>";
	 echo "<tr><th>Name</th><th>Height (cm)</th><th>Weight (kg)</th><th>Gender</th><th>Date of Birth</th><th>Sport</th><th>Country</th></tr>";
	 if(count($cyclists2) === 0) {
		echo "<tr><td colspan='7'>NO CYCLISTS FOUND FOR THIS COUNTRY</td></tr>";
	 } else {
	   foreach($cyclists2 as $cyclist) {
		 echo "<tr><td>{$cyclist['name']}</td><td>{$cyclist['height']}</td><td>{$cyclist['weight']}</td><td>{$cyclist['gender']}</td><td>{$cyclist['dob']}</td><td>{$cyclist['event_name']}</td><td>{$cyclist['country_name']}</td></tr>";
	   }
	 }
	 echo "</table>";

	 //Closing the database connection
	 $pdo = null;
   ?>

</body>

</html>