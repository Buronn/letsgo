// When the user scrolls the page, execute myFunction
window.onscroll = function() {myFunction()};

// Get the navbar
var navbar = document.getElementById("navbuttons");

// Get the offset position of the navbar
var pegajoso = navbar.offsetTop;

// Add the pegajoso class to the navbar when you reach its scroll position. Remove "pegajoso" when you leave the scroll position
function myFunction() {
  if (window.pageYOffset >= pegajoso) {
    navbar.classList.add("pegajoso")
  } else {
    navbar.classList.remove("pegajoso");
  }
}