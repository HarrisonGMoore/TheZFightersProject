<?php
  echo $_POST['ingredient'] ."<br />";
  echo $_POST['amount'] ."<br />";
  echo $_POST['calories'] ."<br />";
  $ingredient = $conn->real_escape_string($_POST['ingredient']);
  $amount = $conn->real_escape_string($_POST['amount']);
  $calories = $conn->real_escape_string($_POST['calories']);
  // $result = $conn->query("SELECT INGREDIENT_ID FROM INGREDIENT WHERE NAME = '$ingredient'");
  // if ($result->num_rows == 0 && $ingredient !== "") {
  //   $sql = "INSERT INTO INGREDIENT (NAME)
  //   VALUES ('$ingredient')";

  //   if ($conn->query($sql) === TRUE) {
  //     echo "New record created successfully";
  //   } else {
  //     echo "Error: " . $sql . "<br>" . $conn->error;
  //   }
  // }
?>