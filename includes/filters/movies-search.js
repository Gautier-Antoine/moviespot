$ = jQuery;
var moviesSearch = $("#search-movies");
var searchForm = moviesSearch.find("form");
function loadPosts(e) {
  if (e) {
    e.preventDefault();
  }
  var data = {
    action: "movies_search",
    publisher: moviesSearch.find("#publisher").val(),
    genre: moviesSearch.find("#genre").val(),
    years: moviesSearch.find("#year").val(),
    ratings: moviesSearch.find("#rating").val(),
    sortby: moviesSearch.find("#sortby").val(),
    sort: moviesSearch.find("#sort").val(),
  };
  console.log(data);
  $.ajax({
    url: ajax_url,
    data: data,
    success: function (response) {
      moviesSearch.find(".results").empty();
      if (!response.length) {
        var html = "<div class='result'> No results !</div>";
        moviesSearch.find(".results").append(html);
      } else {
        for (var i = 0; i < response.length; i++) {
          var rating = response[i].rating;
          if (rating != "") {
            rating = rating + "/5<br>";
          }

          // BUILD DIV RESULT
          var html =
            "<a href=" +
            response[i].permalink +
            ">" +
            "<div class='result'>" +
            "<h2>" +
            response[i].title +
            "</h2>" +
            response[i].excerpt +
            "<br>" +
            rating +
            "<span>More Details </span>" +
            "</div>" +
            "</a>";
          moviesSearch.find(".results").append(html);
          $(".result").hide();
          $(".result").slice(0, 8).show();
          if ($(".result:hidden").length !== 0) {
            moviesSearch.find("button").show();
          }
        }
      }
    },
  });
}
$(".submit").click(function () {
  searchForm.submit();
});
$(window).on("load", loadPosts);
searchForm.submit(loadPosts);
searchForm.on("change", "select", loadPosts);
searchForm.on("change", "input#sort", loadPosts);
searchForm.on("change", "input#sort", function () {
  this.value = this.checked.toString();
});
searchForm.on("change", "select#sortby", (e) => {
  console.log(e.target.value);
  if (e.target.value === "rating") {
    var button = document.createElement("input");
    button.type = "checkbox";
    button.name = "sort";
    button.id = "sort";
    searchForm.append(button);
    var label = document.createElement("label");
    label.htmlFor = "sort";
    label.textContent = "From Top/Bottom";
    searchForm.append(label);
  } else {
    searchForm.find("input").remove();
    searchForm.find("label").remove();
  }
});
moviesSearch.find("button").on("click", function () {
  moviesSearch.find(".result:hidden").slice(0, 6).show();
  if ($(".result:hidden").length == 0) {
    moviesSearch.find("button").hide();
  }
});
// searchForm.addEventListener('DOMContentLoaded', loadPosts, false);​
