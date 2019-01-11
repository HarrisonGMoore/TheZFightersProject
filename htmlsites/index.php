<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Recipe Builder: Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css">
    <script src="main.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="container-fluid" id="header-footer">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <img class="mr-3" src="assets/recipe-builder-logo.png" alt="Recipe Builder" id="logo">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                <a class="nav-link" href="#">Create a New Recipe<span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                <a class="nav-link" href="">My Recipes</a>
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
    <div id="login-box">
        <form>
        Email:
        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="jsmith@johnsmith.com">
        Password:
        <input type="email" class="form-control" name="password" id="password" aria-describedby="emailHelp" placeholder="Don't share it!">
        <br>
        <button name= "Submit" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <?php
      if (isset($_POST['Submit'])) {
        // Check validity of login credentials using the supplied email and password
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);
        $stid=$conn->prepare("SELECT valid_user(?,?)") or die($conn->error);
        $stid->bind_param('ss', $email, $password) or die($stid->error);
        $stid->execute() or die($stid->error);
        $stid->bind_result($result);
        $stid->fetch();
        $stid->close();
        // // If valid login credentials, create session (login) and determine if the user is an admin
        if ($result === "1"){
          session_start();
          $_SESSION["email"] = $_POST['email'];
          $email = $conn->real_escape_string($_POST['email']);
          $perm=$conn->prepare("SELECT user_id, email from `APP_USERS` where email = UPPER(?)");
          $perm->bind_param('s', $email);
          $perm->execute() or die($perm->error);
          $fields = $perm->get_result();
          $user_id = -1;

          while ($row = $fields->fetch_assoc()) {
            $user_id = $row["user_id"];
          }

          $_SESSION["USER_ID"] = $user_id;

          //Redirect to the correct page
          header('Location: /user/index.php');

        }
        else {
          ?><div class="row" style="padding-top: 1rem"><div class="col-md-6"></div><div class="col-md-6"><?php print 'Invalid email/password. Please try again.';?></div></div><?php
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