var req = null;
var total_calories = 0;
$("#ingredient").on("change keyup", function () {
  var ingredient = $("#ingredient").val().trim();
  if (ingredient.length > 2) {
    let dropdown = $('#add-ingredient');
    
    if (req != null) req.abort();
    dropdown.empty();

    dropdown.append('<option selected="true" disabled>Choose Ingredient</option>');
    dropdown.prop('selectedIndex', 0);

    var url = "https://apibeta.nutritionix.com/v2/search?q=" + ingredient + "&appId=d4d504c5&appKey=69f0aa47633e46b412afc68d05a07e37&search_type=grocery&offset=0&limit=10";

    req = $.getJSON(url, function (data) {
      console.log(data.exact);
      var unit = data.results[0].serving_uom;
      if (unit[unit.length - 1] !== "s") {
        unit += "s";
      }
      $("#amountLabel").html("Amount of " + unit + ": ");
      $.each(data.results, function (key, entry) {
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
  if (ingredient.includes("%")) {
    url_ingredient = ingredient.replace(/%/g, "%25");
  }
  var ingredient_url = "https://apibeta.nutritionix.com/v2/search?q=" + url_ingredient + "&appId=d4d504c5&appKey=69f0aa47633e46b412afc68d05a07e37";

  $.ajax({
    url: ingredient_url,
    method: "GET"
  }).then(function (response) {
    var unit = response.results[0].serving_uom;
    if (unit[unit.length - 1] !== "s" && $("#amount").val().trim() > 1) {
      unit += "s";
    }
    else if (unit[unit.length - 1] === "s" && $("#amount").val().trim() == 1) {
      unit = unit.substring(0, unit.length - 1);
    }
    var amount = $("#amount").val().trim() + " " + unit;
    var calories = response.results[0].nutrient_value * $("#amount").val().trim();
    total_calories = total_calories + parseInt(calories);
    console.log(total_calories);
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
  console.log(parseInt(total_calories));
  $.post("submit.php", { data: data, recipe_name: recipe_name, total_calories: total_calories },
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