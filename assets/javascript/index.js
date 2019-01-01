var isIngredient = false;

$("#ingredient").on("keydown", function () {
  var ingredient = $("#ingredient").val().trim();
  if (ingredient.length > 2) {
    let dropdown = $('#add-ingredient');
    dropdown.empty();

    dropdown.append('<option selected="true" disabled>Choose Ingredient</option>');
    dropdown.prop('selectedIndex', 0);

    var url = "https://apibeta.nutritionix.com/v2/search?q=" + ingredient + "&appId=5046f269&appKey=b98cd96564773ae253d3510e0f580572";

    $.getJSON(url, function (data) {
      console.log(data.exact);
      $.each(data.results, function (key, entry) {
        if(key >= 14) return false;
        dropdown.append($('<option></option>').attr('value', entry.item_name).text("brand: " + entry.brand_name));
      })
    });
  }
});

$("#submit").on("click", function (event) {
  event.preventDefault();
  $("#ingredient").val("");
  if (!isIngredient) {
    console.log("hi");
    var ingredient = $("#ingredient").val().trim();
    console.log(ingredient);
    $("#ingredients-list").append(ingredient + "\n");
  }
});