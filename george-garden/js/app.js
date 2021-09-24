$(document).foundation();

let cartCounterDisplay = document.querySelector('#cart-counter');

cartCounterDisplay.innerHTML = `&nbsp;${cartCounter} - $ ${cartPrice}`;

$(function() {
  $('.searchbar')
    .bind('click', function(event) {
      $(".search-field").toggleClass("expand-search");
      $('.searchbar').toggleClass("active");
    })
});

function myMap() {
  var mapProp= {
    center:new google.maps.LatLng(51.508742,-0.120850),
    zoom:5,
  };
  var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
  }

