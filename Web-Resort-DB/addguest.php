<!DOCTYPE html>

<html lang="en">

<head>
    <title>Dryad Resort - Add Guest</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
</head>

<body>
    <div class="container">

        <header class="row">
            <div class="col-lg-12">
                <h1 class="text-center">Dryad Resort - Add Guest</h1>
            </div>
        </header>

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><a href="guest.php">Guest</a></li>

                </ul>
            </div>
        </nav>

        <section class="row">
            <div class="col-lg-3">
                <nav class="sidebar-nav">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="addguest.php">Add Guest</a></li>
                        <li><a href="updateguest.php">Update Guest</a></li>
                        <li><a href="showguest.php">Guest Details</a></li>
                    </ul>
                </nav>
            </div>
            <main class="col-lg-9">
                <article class="col-lg-12">
				<?php
				 //check if the form has been submitted
                    //if not, show the form
                    if(!isset($_POST['submit']))//this must be the name of the submit button on the form
                    {
					?>
						<h2>Add Guest</h2>
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
							<div class="form-group">
								<label for="fullname">Full Name:</label>
								<input type="text" class="form-control" id="fullname" name="fullname">
							</div>
							<div class="form-group">
								<label for="address">Address:</label>
								<input type="text" class="form-control" id="address" name="address">
							</div>
							 <div class="form-group">
								<label for="web">Web Address:</label>
								<input type="text" class="form-control" id="web" name="web">
							</div>
							<div class="form-group">
								<label for="stay_date">Date of Stay:</label>
								<input type="text" class="form-control" id="stay_date" name="stay_date">
							</div>
							<div class="form-group">
								<label for="comment">Comment:</label>
								<input type="text" class="form-control" id="comment" name="comment">
							</div>
							<button type="submit" name="submit" class="btn btn-default">Submit</button>
						</form>
					<?php
					}
					else
					{
						
						//create connection
						require("connect.php");

						//get the POST data from the form
						$fullname = $_POST["fullname"];
						$address = $_POST["address"];
						$stay_date = $_POST["stay_date"];
						$comment = $_POST["comment"];
						
						//create the query 
						$sql = "INSERT INTO person 
								(fullname,address,stay_date,comment) 
								VALUES 
								('$fullname','$address','$stay_date','$comment')";
								
						//run the query
						if($qry = mysqli_query($conn, $sql))
						{
							echo "<h1>Success!</h1><p>$fullname added<p>";
						}
						else
						{
							echo "<h1>Error!</h1><p>$fullname not added, click <a href='addguest.php'>here</a> to try again.<p>";
						}
						
						
					}
					?>
                </article>
                <article class="col-lg-12">
                    <!--<h2>Guest List</h2>-->
                    <?php include 'listguest_scr.php'; ?>
                </article>
            </main>

        </section>

    </div>
</body>

</html>