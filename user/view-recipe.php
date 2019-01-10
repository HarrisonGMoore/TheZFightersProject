<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <?php include 'validate.php'; ?>
    <?php include('../connect.php'); ?>
    <?php  $user_id = $_SESSION["USER_ID"]; ?>
    <?php  $recipe_id = $_GET["id"]; ?>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">RecipeBuilder.com</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Build Recipe <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="my-recipes.php">Your Recipies</a>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <a class="nav-link" href="/">Log Out <span class="sr-only"></span></a>
            </form>
        </div>
    </nav>
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
    </div>
</body>

</html>