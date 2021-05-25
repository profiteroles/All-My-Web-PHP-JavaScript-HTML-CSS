<!DOCTYPE html>

<html lang="en">

<head>
    <title>Dryad Resort - Update Guest</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
       // function to populate the input fields when a row in the table is clicked
       function popfields(x){
              var tabRows = document.getElementById("outTable").rows.length;
              for (var i = 1; i<tabRows; i++){
                     if (document.getElementById("outTable").rows[i].cells[0].innerHTML==x){
                            document.forms["inputform"]["id"].value = document.getElementById("outTable").rows[i].cells[0].innerHTML;
                            document.forms["inputform"]["fullname"].value = document.getElementById("outTable").rows[i].cells[1].innerHTML;
                            document.forms["inputform"]["address"].value = document.getElementById("outTable").rows[i].cells[2].innerHTML;
                            document.forms["inputform"]["stay_date"].value = document.getElementById("outTable").rows[i].cells[3].innerHTML;
                            document.forms["inputform"]["comment"].value = document.getElementById("outTable").rows[i].cells[4].innerHTML;
                     }
              }

       }
</script>
</head>

<body>
    <div class="container">

        <header class="row">
            <div class="col-lg-12">
                <h1 class="text-center">Dryad Resort - Update Guest</h1>
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
                    <h2>Update Guest</h2>
					<?php
					if(!isset($_POST['submit']))
					{
						?>
						<form name="inputform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
							<div class="form-group">
								<label for="id">Guest ID:</label>
								<input type="text" class="form-control" id="id" name="id" readonly>
							</div>
							<div class="form-group">
								<label for="fullname">Full Name:</label>
								<input type="text" class="form-control" id="fullname" name="fullname">
							</div>
							<div class="form-group">
								<label for="address">Address:</label>
								<input type="text" class="form-control" id="address" name="address">
							</div>
							<div class="form-group">
								<label for="stay_date">Date of Stay:</label>
								<input type="text" class="form-control" id="stay_date" name="stay_date">
							</div>
							<div class="form-group">
								<label for="comment">Comment:</label>
								<input type="text" class="form-control" id="comment" name="comment">
							</div>
							<button type="submit" id="submit" name="submit" class="btn btn-default">Submit</button>
						</form>
					
				</article>
                <article class="col-lg-12">
                    <h2>Guest List</h2>
                    <?php include 'listguest_scr.php'; ?>
                </article>
				<?php
					}
					else
					{
						
						?>
						<article class="col-lg-12">
							
						
						<?php
						//create connection
						require("connect.php");

						$id = $_POST["id"];
						$fullname = $_POST["fullname"];
						$address = $_POST["address"];
						$stay_date = $_POST["stay_date"];
						$comment = $_POST["comment"];

						$sql = "UPDATE person 
								SET 
								fullname = '$fullname', 
								address = '$address', 
								stay_date = '$stay_date', comment = '$comment' 
								WHERE id = '$id'";
						if ($conn->query($sql) === TRUE) 
						{
							echo "<p>Record updated successfully</p>
								  <p>Click <a href='updateguest.php'>here</a> to go back</p>";
						} 
						else 
						{
							echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
						}

						$conn->close();
					}
					?>
						</article>
            </main>

        </section>

    </div>
</body>

</html>