<!DOCTYPE html>

<html lang="en">

<head>
    <title>Dryad Resort - Guest</title>
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
                <h1 class="text-center">Dryad Resort - Guest</h1>
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
                    <h2>Guest List</h2>
                    <?php include 'listguest_scr.php'; ?>
                </article>
            </main>

        </section>

    </div>
</body>

</html>