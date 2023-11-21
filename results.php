<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>General Comparison</title>
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
	  } catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		die();
	  }

	  //Getting user input
	  $country1 = strtoupper($_POST['country1']);
	  $country2 = strtoupper($_POST['country2']);
	  
	  //Validating whether the country exists
	  $validCountryCodes = array_column($pdo->query('SELECT iso_id FROM country')->fetchAll(), 'iso_id');

	  if (!in_array($country1, $validCountryCodes) || !in_array($country2, $validCountryCodes)) {
		echo "Error: Invalid country code.";
		die();
	  }

	  $rankingCriterion = $_POST['ranking_criterion'];

	  //Fetch data from the database based on the ranking criterion
	  if ($rankingCriterion === 'gold') {
		$sql = "SELECT iso_id, gold FROM country ORDER BY gold DESC";
	  } elseif ($rankingCriterion === 'cyclists') {
		$sql = "SELECT c.iso_id, COUNT(ci.cyclist_id) as cyclists FROM country c LEFT JOIN cyclist ci ON c.iso_id = ci.iso_id GROUP BY c.iso_id ORDER BY cyclists DESC";
	  } elseif ($rankingCriterion === 'avg_age') {
		//Set DATE for the start of the olympics in 2012
		$sql = "SELECT c.iso_id, ROUND(AVG(YEAR(DATE('2012-07-27')) - YEAR(ci.dob))) as avg_age FROM country c LEFT JOIN cyclist ci ON c.iso_id = ci.iso_id GROUP BY c.iso_id ORDER BY avg_age ASC";
	  } else {
		//Invalid ranking criterion
		echo "Error: Invalid ranking criterion.";
		die();
	  }

	  //Executing the SQL statement and fetching the results
	  $stmt = $pdo->prepare($sql);
	  $stmt->execute();
	  $rankedCountries = $stmt->fetchAll(PDO::FETCH_ASSOC);

	  //Assigning ranks to countries based on selected criterion
	  $rank = 1;
	  $prevValue = null;
	  foreach ($rankedCountries as &$country) {
		if ($country[$rankingCriterion] === $prevValue) {
		  //If value is the same as previous country, assign the same rank
		  $country['rank'] = $rank - 1;
		} else {
		  //Otherwise assign a new rank
		  $country['rank'] = $rank;
		  $rank++;
		}
		$prevValue = $country[$rankingCriterion];
	  }

	  //Getting the ranks for the selected countries
	  $rank1 = array_search($country1, array_column($rankedCountries, 'iso_id'));
	  $rank2 = array_search($country2, array_column($rankedCountries, 'iso_id'));

	    //Outputing results
		echo "<h2>Comparison:</h2>";
		echo "<table>";
		echo "<tr><th>Rank</th><th>Country</th><th>{$rankingCriterion}</th></tr>";
		echo "<tr><td>{$rankedCountries[$rank1]['rank']}</td><td>{$country1}</td><td>";
		if ($rankedCountries[$rank1][$rankingCriterion] === null) {
			echo "NOT PARTCIPANTS";
		} else {
			echo "{$rankedCountries[$rank1][$rankingCriterion]}";
		}
		echo "</td></tr>";
		echo "<tr><td>{$rankedCountries[$rank2]['rank']}</td><td>{$country2}</td><td>";
		if ($rankedCountries[$rank2][$rankingCriterion] === null) {
			echo "Not participated";
		} else {
			echo "{$rankedCountries[$rank2][$rankingCriterion]}";
		}
		echo "</td></tr>";
		echo "</table>";


	   echo "<h2>Ranking:</h2>";
	   echo "<table>";
	   echo "<tr><th>Rank</th><th>Country</th><th>{$rankingCriterion}</th></tr>";
		foreach ($rankedCountries as $rank => $country) {
			if (!is_null($country[$rankingCriterion])) {
				echo "<tr";
				if ($country['iso_id'] === $country1 || $country['iso_id'] === $country2) {
					echo " style='background-color: yellow'";
				}
				echo "><td>{$country['rank']}</td><td>{$country['iso_id']}</td><td>{$country[$rankingCriterion]}</td></tr>";
			}
		}
		echo "</table>";

	   //Closing the database connection
	   $pdo = null;
   ?>

</body>

</html>