$("#submit").on("click", function( event ) {
  event.preventDefault();
  console.log("hi");
  var ingredient = $("#add-ingredient").val().trim();
  console.log(ingredient);
  $("#ingredients-list").append(ingredient +"\n");
});
