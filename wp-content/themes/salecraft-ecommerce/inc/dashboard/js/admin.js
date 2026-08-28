/**
 * @package SaleCraft Ecommerce
 */

jQuery(document).ready(function ($) {
  $("#dashboard-changelog-button").click(function (e) {
    e.stopPropagation();
    $("#salecraft-ecommerce-dashboard-offcanvas").addClass("open");
    $(".wrap").addClass("overlay");
  });

  $("#dialog-close").click(function (e) {
    e.stopPropagation();
    $("#salecraft-ecommerce-dashboard-offcanvas").removeClass("open");
    $(".wrap").removeClass("overlay");
  });

  $(document).on("click", function (e) {
    if (
      !$("#salecraft-ecommerce-dashboard-offcanvas").is(e.target) &&
      $("#salecraft-ecommerce-dashboard-offcanvas").has(e.target).length === 0
    ) {
      $("#salecraft-ecommerce-dashboard-offcanvas").removeClass("open");
      $(".wrap").removeClass("overlay");
    }
  });
});

jQuery(document).ready(function ($) {
  var salecraft_ecommerce_adminUrl = salecraftecommerceRedirectDemoPage.admin_url;

  var salecraft_ecommerce_targetUrl = salecraft_ecommerce_adminUrl + "themes.php?page=salecraft-ecommerce";

  var salecraft_ecommerce_currentPage = window.location.href;

  $(".dashboard-header-nav ul li").each(function () {
    var pageURL = $(this).find("a").attr("href");
    $;
    if (salecraft_ecommerce_currentPage === pageURL) {
      $(this).addClass("active");
    }
  });

  if (salecraft_ecommerce_currentPage === salecraft_ecommerce_targetUrl) {
    $(".dashboard-header-nav ul li:first").addClass("active");
  }
});