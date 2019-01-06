<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <?php include('validate.php'); ?>
    <?php include('../connect.php'); ?>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">RecipieBuilder.com</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Your Recipies</a>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <a class="nav-link" href="/">Log Out <span class="sr-only"></span></a>
            </form>
        </div>
    </nav>
    <div class="container-fluid" style="width: 95em;">
        <!-- MAIN PAGE CONTENT GOES INBETWEEN HERE -->
        <br>
        <form method="post" class="form-row">
            <div class="col-md-4">
                <label for="ingredient">Ingredient:</label>
                <input class="form-control" list="add-ingredient" id="ingredient">
            </div>
            <div class="col-md-2">
                <label for="amount">Amount:</label>
                <input class="form-control" id="amount">
            </div>
            <div class="col-md-1">
                <label for="submit-ingredient">&nbsp;</label>
                <button name="submit-ingredient" type="submit" id="submit-ingredient" class="btn btn-primary mb-2">Add
                    Ingredient</button>
            </div>
            <datalist id="add-ingredient">
            </datalist>
        </form>
        <form method="post" action="">
            <div class="row">
                <div class="col-md-7">
                    <label for="recipe-name">Recipe Name:</label>
                    <input class="form-control" id="recipe-name">
                    <br>
                </div>
                <div class="col-md-7">
                    <div class="card form-group">
                        <div class="card-header" id="card-header">
                            Ingredients List
                        </div>
                        <div class="card-body" id="ingredients-list">
                            <table class="table table-hover" id="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Ingredient</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Calories</th>
                                    </tr>
                                </thead>
                                <tbody id="rows">
                                    <tr>
                                        <td>salt</td>
                                        <td>4 cups</td>
                                        <td>40 per cup</td>
                                    </tr>
                                    <tr>
                                        <td>peanut</td>
                                        <td>1</td>
                                        <td>2 per ounce</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <button name="submit-recipe" id="submit-recipe" type="button" class="btn btn-primary">Save Recipe</button>
                </div>
            </div>
        </form>
        <div id="results">
            <!-- All data will display here  -->
        </div>
        <div class="container fixed-bottom">
            <footer class="page-footer font-small">
                <div class="footer-copyright text-center py-3">© 2018 Copyright:
                    <a href="https://mdbootstrap.com/education/bootstrap/"> RecipieBuilder.com</a>
                </div>
            </footer>
        </div>

        <script src="../assets/javascript/index.js"></script>
    </div>
</body>

</html>