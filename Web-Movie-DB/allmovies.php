<!DOCTYPE html>

<html lang="en">

<head>
<title>South Metro Pictures</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--this is html comment-->
</head>

<body>
    <div class="row">
        <header class="col-lg-12 bg-info">
            <img class="col-lg-3" src="logo.gif" alt="logo" />
            <h1 class="col-lg-9">All Movies Under One Roof</h1>
        </header>
    </div>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li> <a href="index.php">Home Page</a> </li>
                <li><a href="top10.php" class="active">Top 10 Movies</a> </li>
                <li> <a href="allmovies.php" class="active">All Movies</a> </li>
        </div>
    </nav>
    <div class="row">
        <main class="col-lg-9">
            <section class="row">
                <div class="col-lg-3">
                    <nav class="sidebar-nav">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="search.php" class="active">Search</a></li>
                            <li><a href="top10.php">Top 10 Movies</a></li>
                        </ul>
                    </nav>
                </div>
                <main class="col-lg-9">
                    <article class="col-lg-12">
                        <h2>All The Movies</h2>
                        <?php include 'results.php'; ?>
                    </article>
                </main>
            </section>
        </main>
    </div>

</body>

</html>