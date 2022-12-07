<?php
include("database.php"); //call database
$dated = date("jS F Y h:i:s A");

      if(isset($_POST['addResult'])){ // Fetching variables of the form which travels in URL
        $state = mysqli_real_escape_string($con, $_POST['states']);
        $party = mysqli_real_escape_string($con, $_POST['party']);
        $result = mysqli_real_escape_string($con, $_POST['result']);
      {
      //Insert Query of SQL
      $let = "INSERT INTO `party_result` (`state`, `party`, `result`, `dated`) VALUES ('$state', '$party', '$result', '$dated')";
      if ($con->query($let) == TRUE) {
        $success = '<label>Added Successfully... </label>';
        header("Location: storeresult.php?ret=$success");
      } else {

          header("Location: storeresult.php?ret=Error!!");
      }

      }
    }

?>
