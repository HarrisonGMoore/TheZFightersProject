<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Recipe Builder: Build Recipe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css">
    <script src="main.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="container-fluid" id="header-footer">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <img class="mr-3" src="assets/css/recipe-builder-logo.png" alt="Recipe Builder" id="logo">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                <a class="nav-link" href="#">Create a New Recipe<span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                <a class="nav-link" href="#">My Recipes</a>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <a class="nav-link" href="#">Login<span class="sr-only"></span></a>
                <a class="nav-link" href="#">Signup<span class="sr-only">(current)</span></a>
            </form>
            </div>
        </nav>
    </div>

    <!-- MAIN PAGE CONTENT GOES INBETWEEN HERE -->
    <div class="container-fluid" style="width: 95em;">
            <br>
            <div class="card form-group" style="width:50%">
                <div class="card-header" id="card-header">
                    <?php
                        $query = "SELECT * FROM RECIPE WHERE recipe_id = '$recipe_id'";
                        $result = $conn->query($query);
                        $row = $result->fetch_array();
                        echo $row["RECIPE_NAME"]
                    ?>
                </div>
                <div class="card-body" id="ingredients-list">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Ingredient</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Calories</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = "SELECT * FROM RECIPE_INFO WHERE user_id = '$user_id' and recipe_id = '$recipe_id'";
                                $result = $conn->query($query);
                                while($row = $result->fetch_array()){
                                    print '<tr>';
                                    print '<td>' . $row["INGREDIENT_NAME"] . '</td><td>' . $row["AMOUNT"] . '</td><td>' . $row["CALORIES"] . '</td>';
                                    print '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
    
            <form method="post" action="">
                <button name="Delete" type="submit" class="btn btn-primary">Delete Recipe</button>
            </form>
    
            <?php
                if (isset($_POST['Delete'])){
                    // delete selected contact from database
                    $stid=$conn->prepare("DELETE FROM RECIPE WHERE recipe_id = ?");
                    $stid->bind_param('i', $recipe_id) or die($stid->error);
                    $success = $stid->execute();
                    if($success){
                        ob_start();
                        echo "<script>document.location.href='my-recipes.php'</script>";
                        ob_end_flush();
                    }
                }
            ?>
    <!-- MAIN PAGE CONTENT ENDS HERE -->

    <div class="container-fluid fixed-bottom" id="header-footer">
        <footer class="page-footer font-small">
            <div class="footer-copyright text-center py-3">© 2018 Copyright:
            <a href="">TheZFighters</a>
            </div>
        </footer>
    </div>
</div>
</body>
</html>