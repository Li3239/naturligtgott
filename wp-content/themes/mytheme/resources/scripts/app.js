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

var lastScrollTop = 0;
var isMobile = window.matchMedia("only screen and (max-width: 768px)").matches;

window.addEventListener("scroll", function () {
  var header = document.getElementById("stickyheading");
  var currentScroll = window.pageYOffset || document.documentElement.scrollTop;

  if (currentScroll > lastScrollTop) {
    // Scroll down
    if (!isMobile || currentScroll > 50) {
      header.style.top = "-100px"; // Adjust this value to ensure the header moves out of view
    }
  } else {
    // Scroll up
    header.style.top = "0px";
    adjustForAdminBar(); // Adjust header position when scrolling up
  }
  lastScrollTop = currentScroll;
});

function adjustForAdminBar() {
  var adminBar = document.getElementById("wpadminbar");
  var header = document.getElementById("stickyheading");
  if (adminBar) {
    var adminBarHeight = adminBar.offsetHeight;
    header.style.top = adminBarHeight + "px";
  } else {
    header.style.top = "0px";
  }
}

window.addEventListener("load", adjustForAdminBar);
window.addEventListener("resize", adjustForAdminBar);


document.addEventListener('DOMContentLoaded', function() {
  /* -------------------------------------------------------- */

  function updateReadMoreLinks() {
    // Select all 'wp-block-post-excerpt' elements
    var excerptDivs = document.querySelectorAll('.wp-block-post-excerpt');
    
    excerptDivs.forEach(function(excerptDiv) {
      // Find the empty link element and the "Läs mer…" link within each excerpt
      var emptyLink = excerptDiv.querySelector('.wp-block-post-excerpt__more-link');
      var readMoreButton = excerptDiv.querySelector('.wp-block-post-excerpt__more-text a:last-of-type');
      
      if (emptyLink && readMoreButton) {
        // Get the URL from the empty link and set it to the "Läs mer…" button
        var postLink = emptyLink.getAttribute('href');
        readMoreButton.setAttribute('href', postLink);
      }
    });
  }

  updateReadMoreLinks();

  /* --------------------------------------------------------------------- */
  function translateShippingText() {
    var shippingHeaders = document.querySelectorAll('th');

    shippingHeaders.forEach(function(header) {
      if (header.textContent.trim() === 'Shipping') {
        header.textContent = 'Frakt';
        console.log('Shipping header found and changed to Frakt');
      }
    });

    var shippingDataTitles = document.querySelectorAll('td[data-title="Shipping"], td[data-title="Frakt"]');
    
    shippingDataTitles.forEach(function(td) {
      td.setAttribute('data-title', 'Frakt');
      console.log('Shipping data-title found and changed to Frakt');
    });

    // Change the label text for shipping method
    var shippingLabels = document.querySelectorAll('label[for^="shipping_method_"]');
    shippingLabels.forEach(function(label) {
      if (label.textContent.trim() === 'Free shipping') {
        label.textContent = 'Fri frakt';
        console.log('Shipping label found and changed to Fri frakt');
      }
    });


    // Additional log for debugging
    if (shippingHeaders.length === 0) {
      console.log('No table headers found.');
    }
    if (shippingDataTitles.length === 0) {
      console.log('No table data cells with data-title="Shipping" found.');
    }
    if (shippingLabels.length === 0) {
      console.log('No shipping labels found.');
    }
  }

  translateShippingText();
});
