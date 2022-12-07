<?php
include("database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bincom - The Vote</title>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }

    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}

    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }

    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }

    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;}
    }

		th, td {
		  padding: 5px;
			border:1px solid black;
			Font-size:18;
			Font-Weight:bold
		}

  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Bincom Project</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="/lgaresult.php">LGA Result</a></li>
        <li><a href="storeresult.php">Store Result</a></li>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="./"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row content">
		<div class="col-sm-12">
    <div class="col-sm-2 sidenav">
			<div class="well">
				<img src="/assets/img/votecounts.jpg" class="img-responsive" alt="Vote Counts">
			</div>
			<div class="well">
				<img src="/assets/img/votematters.jpg" class="img-responsive" alt="Vote Matters">
			</div>
    </div>
    <div class="col-sm-8">
      <h1>Question 1 solution</h1>
							<form action="">
							  <div class="form-group">
							    <label for="pollingunit">Select Polling Unit:</label>
									<select class="form-control" name="pollingunit" onchange="showPollingResult(this.value)">
										<option value="">-- Select one --</option>
										 <?php
												$getpus = $con->query("SELECT * FROM polling_unit WHERE polling_unit_number !=''") or die(mysqli_error($con));
												while($mt = $getpus->fetch_assoc()){
														$puid = $mt['polling_unit_id'];
														$puname = $mt['polling_unit_name'];
														$punumber = $mt['polling_unit_number'];
										?>
										<option value="<?php echo $puid; ?>"><?php echo "$punumber - $puname"; ?></option>
									<?php } ?>
							  </select>
							  </div>
								<div id="txtHint">info will be listed here...</div>
				</form>
<script>
function showPollingResult(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("txtHint").innerHTML = this.responseText;
  }
  xhttp.open("GET", "getpollingresult.php?q="+str);
  xhttp.send();
}
</script>
      <hr>
      <h3>Individually</h3>
			<form action="">
				<div class="form-group">
					<label for="pollingunit">Select Polling Unit:</label>
					<select class="form-control" name="pollingunit" onchange="showPollingResultUser(this.value)">
						<option value="">-- Select one --</option>
						 <?php
								$getuserdet = $con->query("SELECT DISTINCT(entered_by_user) FROM announced_pu_results WHERE entered_by_user !=''") or die(mysqli_error($con));
								while($mts = $getuserdet->fetch_assoc()){
										$user= $mts['entered_by_user'];
						?>

						<option value="<?php echo $user; ?>"><?php echo $user; ?></option>
					<?php } ?>
				</select>
				</div>
				<div id="txtHints">info will be listed here...</div>
</form>
<script>
function showPollingResultUser(str) {
if (str == "") {
document.getElementById("txtHints").innerHTML = "";
return;
}
const xhttp = new XMLHttpRequest();
xhttp.onload = function() {
document.getElementById("txtHints").innerHTML = this.responseText;
}
xhttp.open("GET", "getpollingresultUser.php?s="+str);
xhttp.send();
}
</script>

    </div>
		<div class="col-sm-2 sidenav">
			<div class="well">
				<img src="/assets/img/votenowwisely.jpeg" class="img-responsive" alt="Vote wise">
			</div>
			<div class="well">
				<img src="/assets/img/votewisely.jpg" class="img-responsive" alt="Vote wisely">
			</div>
    </div>
	</div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>

</body>
</html>
