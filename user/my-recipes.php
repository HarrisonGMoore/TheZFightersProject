<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <?php include 'validate.php'; ?>
    <?php include('../connect.php'); ?>
    <?php  $user_id = $_SESSION["USER_ID"]; ?>
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
        <table class="table table-striped" style="width:50%">
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
                        print '<td>' . $row["RECIPE_NAME"] . '</td><td>' . $row["TOTAL_CALORIES"] . '</td><td><a href="view-recipe.php?id=' . $row["RECIPE_ID"] . '">View</a></td>';
                        print '</tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
    </div>
</body>

</html>