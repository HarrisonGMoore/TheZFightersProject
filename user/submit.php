<?php
  include('validate.php');
  include('../connect.php');
  $recipe_name = $conn->real_escape_string($_POST['recipe_name']);
  $total_calories = intval($_POST['total_calories']);
  $data = $_POST['data'];
  print_r($data);

  for ($i = 1; $i < count($data); $i++) {
    $ingredient = $conn->real_escape_string($data[$i][0]);
    $amount = $conn->real_escape_string($data[$i][1]);
    $calories = $conn->real_escape_string($data[$i][2]);
    echo $ingredient . " " . $amount . " " . $calories . " ";

    $result = $conn->query("SELECT INGREDIENT_ID FROM INGREDIENT WHERE INGREDIENT_NAME = '$ingredient'");
    if ($result->num_rows == 0 && $ingredient !== "") {
      $sql_ingredient = "INSERT INTO INGREDIENT (INGREDIENT_NAME)
      VALUES ('$ingredient')";

      if ($conn->query($sql_ingredient) === TRUE) {
      } else {
        echo "Error: " . $sql_ingredient . "<br>" . $conn->error;
      }
    }

    $email = $_SESSION['email'];
    $query = "SELECT * from APP_USERS where email = '$email'";
    $result = $conn->query($query);
    $row = $result->fetch_array();
    $user_id = intval($row['USER_ID']);
    echo $user_id;

    $result = $conn->query("SELECT RECIPE_ID FROM RECIPE WHERE RECIPE_NAME = '$recipe_name'");
    if ($result->num_rows == 0 && $recipe_name !== "") {
      $sql_recipe = "INSERT INTO RECIPE (RECIPE_NAME, TOTAL_CALORIES , USER_ID)
      VALUES ('$recipe_name', '$total_calories' ,'$user_id')";

      if ($conn->query($sql_recipe) === TRUE) {
        $recipe_id = mysqli_insert_id($conn);
      } else {
        echo "Error: " . $sql_recipe . "<br>" . $conn->error;
      }
    }

  
    $query = "SELECT * from INGREDIENT where ingredient_name = '$ingredient'";
    $result = $conn->query($query);
    $row = $result->fetch_array();
    $ingredient_id = $row['INGREDIENT_ID'];
    
    $sql_ingredients = "INSERT INTO INGREDIENTS (INGREDIENT_ID, RECIPE_ID, CALORIES, AMOUNT)
    VALUES ('$ingredient_id', '$recipe_id', '$calories', '$amount')";

    if ($conn->query($sql_ingredients) === TRUE) {
    } else {
      echo "Error: " . $sql_ingredients . "<br>" . $conn->error;
    }
  }
?>