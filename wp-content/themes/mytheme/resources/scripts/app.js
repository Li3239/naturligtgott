document.addEventListener("DOMContentLoaded", function () {
  var burgerMenuDiv = document.querySelector(".burger-menu-div");
  var mobileMenu = document.querySelector(".mobile-menu");

  // Open mobile menu when burger menu is clicked
  burgerMenuDiv.addEventListener("click", function (event) {
    mobileMenu.classList.toggle("show");
    event.stopPropagation(); // Prevents the click event from reaching the document body
  });

  // Close mobile menu when clicking outside of it
  document.body.addEventListener("click", function (event) {
    if (
      !mobileMenu.contains(event.target) &&
      !burgerMenuDiv.contains(event.target)
    ) {
      mobileMenu.classList.remove("show");
    }
  });

  jQuery(document).ready(function ($) {
    // Toggle the search input visibility on click
    $(".main_search").on("click", function () {
      $(".search_input").fadeToggle();
    });

    // Hide the search input initially
    $(".search_input").hide();

    // Show the search input when focused
    $("#keyword").on("focus", function () {
      $(".search_input").fadeIn();
    });

    // Hide the search input when blurred and input is empty
    $("#keyword").on("blur", function () {
      if ($(this).val().trim().length === 0) {
        $(".search_input").fadeOut();
      }
    });

    // Hide the search input when clicking outside of it
    $(document).on("click", function (e) {
      if (
        !$(e.target).closest(".main_search").length &&
        !$(e.target).closest(".search_input").length
      ) {
        $(".search_input").fadeOut();
      }
    });
  });
});
