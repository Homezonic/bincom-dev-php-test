<?php
include("database.php");
if (!empty($_GET['s'])){
$puid = $_GET['s'];

// SELECT announced_pu_results.polling_unit_uniqueid, announced_pu_results.party_score
// FROM announced_pu_results
// INNER JOIN polling_unit ON announced_pu_results.polling_unit_uniqueid = polling_unit.polling_unit_id;

// $getres = $con->query("SELECT result_id, entered_by_user, polling_unit_uniqueid, GROUP_CONCAT(DISTINCT party_abbreviation SEPARATOR ', ') AS parties, SUM(party_score) AS totalvotes  FROM announced_pu_results WHERE entered_by_user ='$puid' GROUP BY polling_unit_uniqueid") or die(mysqli_error($con));




$getres = $con->query("SELECT polling_unit.lga_id, polling_unit.polling_unit_id, announced_pu_results.polling_unit_uniqueid, SUM(announced_pu_results.party_score) AS tpartscores, GROUP_CONCAT(DISTINCT party_abbreviation SEPARATOR ', ') AS parties FROM announced_pu_results INNER JOIN polling_unit ON polling_unit.polling_unit_id = announced_pu_results.polling_unit_uniqueid WHERE lga_id = '$puid'") or die(mysqli_error($con));
while ($mt = $getres->fetch_assoc()){

    $lgaid = $mt['lga_id'];
    $puid = $mt['polling_unit_uniqueid'];
    $party = $mt['parties'];
    $totalscores = $mt['tpartscores'];

  }
if (!empty($lgaid)) {
  echo "<table>";
  echo "<tr>";
  echo "<th>LGA ID</th>";
  echo "<td>" . $lgaid . "</td>";
  echo "</tr>";
  echo "<th>Polling Unit id</th>";
  echo "<td>" . $puid . "</td>";
  echo "</tr>";
  echo "<th>Parties</th>";
  echo "<td>" . $party . "</td>";
  echo "</tr>";
  echo "<th>Total Votes</th>";
  echo "<td>" . number_format($totalscores) . "</td>";
  echo "</tr>";
  echo "</table>";
  echo "<br>";
  echo "<br>";
} else {
  echo "No Vote Result for your selection!";
}
} else {
  echo "Access Denied!";
  exit();
}
?>
