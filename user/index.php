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
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
    <div class="row">
      <div class="col-md-6">
        <form>
          <div class="form-group">
          <input class="form-control" list="add-ingredient" id="ingredient">
            <datalist id="add-ingredient">
            </datalist> 
            <br>
            <button type="submit" id="submit" class="btn btn-primary mb-2">Add Ingredient</button>
          </div>
          <div class="form-group">
            <label for="ingredients-list">List of Ingredients</label>
            <textarea class="form-control" id="ingredients-list" rows="20"></textarea>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="col-form-label"><button name="Submit" type="submit" id="add-recipe" class="btn btn-primary">Add Recipe</button></div>
      </div>
    </div>

    <div class="container fixed-bottom">
        <footer class="page-footer font-small">
            <div class="footer-copyright text-center py-3">© 2018 Copyright:
            <a href="https://mdbootstrap.com/education/bootstrap/"> RecipieBuilder.com</a>
            </div>
        </footer>
    </div>

    <script src="../assets/javascript/index.js"></script>

    <?php
    // takes form data and inserts it into the database
      // if (isset($_POST['Submit'])) {
      //   $project_name = $conn->real_escape_string($_POST['project_name']);
      //   $stid=$conn->prepare("INSERT INTO INGREDIENTS(ingredient) VALUES (?)");
      //   $stid->bind_param('s', $ingredient) or die($stid->error);
      //   $stid->execute();
      //   $stid->fetch();
      // }
    ?>
</div>
</body>
</html>
