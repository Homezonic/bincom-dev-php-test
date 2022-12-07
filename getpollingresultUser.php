<?php
include("database.php");
if (!empty($_GET['s'])){
$puid = $_GET['s'];

$getres = $con->query("SELECT result_id, entered_by_user, polling_unit_uniqueid, GROUP_CONCAT(DISTINCT party_abbreviation SEPARATOR ', ') AS parties, SUM(party_score) AS totalvotes  FROM announced_pu_results WHERE entered_by_user ='$puid' GROUP BY polling_unit_uniqueid") or die(mysqli_error($con));
while ($mt = $getres->fetch_assoc()){
    $pid = $mt['result_id'];
    $puid = $mt['polling_unit_uniqueid'];
    $party = $mt['parties'];
    $totalvotes = $mt['totalvotes'];
    $userpost = $mt['entered_by_user'];
  }
if (!empty($pid)) {
  echo "<table>";
  echo "<tr>";
  echo "<th>Result ID</th>";
  echo "<td>" . $pid . "</td>";
  echo "</tr>";
  echo "<th>Polling Unit id</th>";
  echo "<td>" . $puid . "</td>";
  echo "</tr>";
  echo "<th>Parties</th>";
  echo "<td>" . $party . "</td>";
  echo "</tr>";
  echo "<th>Total Votes</th>";
  echo "<td>" . number_format($totalvotes) . "</td>";
  echo "</tr>";
  echo "<th>Entered by</th>";
  echo "<td>" . $userpost . "</td>";
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
