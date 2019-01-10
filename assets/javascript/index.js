$("#ingredient").on("keyup", function () {
  var ingredient = $("#ingredient").val().trim();
  if (ingredient.length > 2) {
    let dropdown = $('#add-ingredient');
    dropdown.empty();

    dropdown.append('<option selected="true" disabled>Choose Ingredient</option>');
    dropdown.prop('selectedIndex', 0);

    var url = "https://apibeta.nutritionix.com/v2/search?q=" + ingredient + "&appId=5046f269&appKey=b98cd96564773ae253d3510e0f580572&limit=10";

    $.getJSON(url, function (data) {
      console.log(data.exact);
      $.each(data.results, function (key, entry) {
        //if (key > 8) return false;
        dropdown.append($('<option></option>').attr('value', entry.item_name).text("brand: " + entry.brand_name).attr('data-index-number', key));
        console.log(key);
      })
    });
  }
});

var ingredient_string = "";
$("#submit-ingredient").on("click", function (event) {
  event.preventDefault();
  console.log("hi");
  var ingredient = $("#ingredient").val().trim();
  var url_ingredient = ingredient;
  var amount = $("#amount").val().trim();
  if (ingredient.includes("%")) {
    url_ingredient = ingredient.replace(/%/g, "%25");
  }
  var ingredient_url = "https://apibeta.nutritionix.com/v2/search?q=" + url_ingredient + "&appId=5046f269&appKey=b98cd96564773ae253d3510e0f580572";

  $.ajax({
    url: ingredient_url,
    method: "GET"
  }).then(function (response) {
    var calories = response.results[0].nutrient_value + " per " + response.results[0].serving_uom;
    console.log(ingredient);
    if (ingredient !== "" && amount !== "") {
      $("#rows").append("<tr><td>" + ingredient + "</td><td>" + amount + "</td><td>" + calories + "</td><tr>");
    }

    $("#ingredient").val("");
  });
  if (ingredient_string === "") {
    ingredient_string = ingredient;
  }
  else {
    ingredient_string = ingredient_string + "," + ingredient;
  }
  var recipe_url = "https://api.edamam.com/search?q=" + ingredient_string + "&app_id=5452f6ef&app_key=28579f5271bcb880b21ca0931120f5d3";
  console.log(recipe_url);

  $.ajax({
    url: recipe_url,
    method: "GET"
  }).then(function (response) {
    appendSimilar(response);
  });
});

$("#submit-recipe").on("click", function () {
  console.log("hi");
  var data = getTableData();
  var recipe_name = $("#recipe-name").val().trim();
  console.log(data);
  $.post("submit.php", { data: data, recipe_name: recipe_name },
    // function(data) {
    //   $('#results').append(data);
    // }
  );
});

function getTableData() {
  var data = [];
  $("#table").find('tr').each(function (rowIndex, r) {
    var cols = [];
    $(this).find('th,td').each(function (colIndex, c) {
      cols.push(c.textContent);
    });
    if (cols.length !== 0) {
      data.push(cols);
    }
  });
  return data;
}

function appendSimilar(response) {
  $("#similar").html("");
  for (var i = 0; i < 5; i++) {
    var recipe = response.hits[i].recipe.label;
    var image_url = response.hits[i].recipe.image;
    var url = response.hits[i].recipe.url;
    console.log(url);
    $("#similar").append(
      "<div class='card' style='width: 18rem;'>" +
      "<img class='card-img-top' src=" + image_url + " alt='Card image cap' style='height: 10rem'>" +
      "<div class='card-body'>" +
      "<h5 class='card-title'><a href=" + url + "><span>" + recipe + "</span></a></h5>" +
      "</div>" +
      "</div>"
    );
  }
}