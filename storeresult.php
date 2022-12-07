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
<style>
#hide1 , #hide2 , #hide3 , #hide4{
  display:none;
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
        <li><a href="#">Home</a></li>
        <li><a href="/lgaresult.php">LGA Result</a></li>
        <li class="active"><a href="storeresult.php">Store Result</a></li>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="./"><span class="glyphicon glyphicon-log-in"></span> Index</a></li>
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
      <h1>Question 3 solution</h1>
      <p>First create a table called "party_result" to store final result for each party</p>
      <?php if(!empty($_GET['ret'])) { echo '<div class="error">'.$_GET['ret'].'</div>'; }?>
              <?php
                if(!empty($ret)){
                  echo "<div class='alert alert-success'>";
                     echo "<span class='glyphicon glyphicon-remove'></span>&nbsp;".$ret."<br>";
                      echo "</div>";  }    ?>
							<form action="addresult.php" enctype="multipart/form-data" method="post">
							  <div class="form-group">
							    <label for="pollingunit">Select State:</label>
									<select class="form-control" name="states" required="required">
										<option value="">-- Select one --</option>
										 <?php
												$getstate = $con->query("SELECT * FROM states") or die(mysqli_error($con));
												while($mt = $getstate->fetch_assoc()){
														$stid = $mt['state_id'];
														$stname = $mt['state_name'];

										?>
										<option value="<?php echo $stname; ?>"><?php echo $stname; ?></option>
									<?php } ?>
							  </select>
							  </div>
                <div class="form-group" id="lga">
							    <label for="pollingunit">Select Party:</label>
									<select class="form-control" name="party" id="lga" required="required">
										<option value="">-- Select one --</option>
                    <?php
                       $getstate = $con->query("SELECT * FROM party") or die(mysqli_error($con));
                       while($mt = $getstate->fetch_assoc()){
                           $partyid = $mt['partyid'];
                           $partyname = $mt['partyname'];

                    ?>
                    <option value="<?php echo $partyname; ?>"><?php echo $partyname; ?></option>
                  <?php } ?>

							  </select>
							  </div>
                <div class="form-group" id="lga">
							    <label for="result">Enter Result:</label>
									<input class="form-control" type="text" name="result" required="required">
							  </div>
                <input type="submit" name="addResult"  class="btn btn-block btn-success">
				</form>

        <div class="col-xl-12 col-lg-7">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">RECENT RESULT ADDED</h6>

            </div>
            <!-- Card Body -->
            <div class="card-body">
              <div class="chart-area table-responsive" style="height:auto;">
               <table class="table table-striped table-hovered">
                    <thead style="background-color:green; color:white;">
                        <tr>
                        <th>id</th>
                        <th>State</th>
                        <th>Party</th>
                        <th>Result</th>
                        <th>Date</th>
                        </tr>

                    </thead>

                      <?php
                        $gethist = $con->query("SELECT * FROM party_result ORDER BY id DESC LIMIT 10") or die(mysqli_error($con));

                            while($gh = $gethist->fetch_assoc()){
                                $id = $gh['id'];
                                $state = $gh['state'];
                                $party = $gh['party'];
                                $result = $gh['result'];
                                $date = $gh['dated'];


                      ?>

                      <tbody>
                          <tr>
                          <td><?php echo $id; ?></td>
                        <td><?php echo $state; ?></td>
                        <td><?php echo $party; ?></td>
                        <td><?php echo number_format($result); ?></td>
                         <td><?php echo $date; ?></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
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
