<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Recipe Builder: My Recipes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css">
    <script src="main.js"></script>
    <?php include('validate.php'); ?>
    <?php include('..connect.php'); ?>
</head>
<body>
<?php include 'connect.php'; ?>
    <div class="container-fluid" id="header-footer">
        <nav class="navbar navbar-expand-lg">
            <img class="mr-3" src="assets/css/recipe-builder-logo.png" alt="Recipe Builder" id="logo">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                <a class="nav-link" href="index.php">Create a New Recipe<span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                <a class="nav-link" href="my-recipes.php">My Recipes</a>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <a class="nav-link" href="#">Login<span class="sr-only"></span></a>
                <a class="nav-link" href="TheZFightersProject/index.html">Signup<span class="sr-only">(current)</span></a>
            </form>
            </div>
        </nav>
    </div>

    <!-- MAIN PAGE CONTENT GOES INBETWEEN HERE -->
    <div class="container-fluid" style="width: 95em;" id="my-recipes-main-box">
            <br>
            <table class="table table-striped" id="my-recipes-striped">
                <thead>
                    <tr>
                        <th>Recipe Name</th>
                        <th>Total Calories</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query = "SELECT * FROM RECIPE WHERE user_id = '$user_id'";
                        $result = $conn->query($query);
                        while($row = $result->fetch_array()){
                            print '<tr>';
                            print '<td>' . $row["RECIPE_NAME"] . '</td><td><a href="view-recipe.php?id=' . $row["RECIPE_ID"] . '">View</a></td>';
                            print '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    <!-- MAIN PAGE CONTENT ENDS HERE -->

    <div class="container-fluid fixed-bottom" id="header-footer">
        <footer class="page-footer font-small">
            <div class="footer-copyright text-center py-3">© 2018 Copyright:
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">TheZFighters</a>
            </div>
        </footer>
    </div>
</div>
</body>
</html>