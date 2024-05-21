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
