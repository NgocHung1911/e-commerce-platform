// Scroll to Top
window.onscroll = function() {
  const salecraft_ecommerce_button = document.querySelector('.back-to-top');
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    salecraft_ecommerce_button.style.display = "block";
  } else {
    salecraft_ecommerce_button.style.display = "none";
  }
};

document.querySelector('.back-to-top a').onclick = function(event) {
  event.preventDefault();
  window.scrollTo({top: 0, behavior: 'smooth'});
};

//  Single Product Link
document.addEventListener("click", function(e) {
  const salecraft_ecommerce_btn = e.target.closest(".main-banner-section .banner-left-btn");
  if (!salecraft_ecommerce_btn) return;

  const salecraft_ecommerce_productItem = salecraft_ecommerce_btn.closest(".main-banner-section .banner-left-bg");
  if (!salecraft_ecommerce_productItem) return;

  const salecraft_ecommerce_productLink = salecraft_ecommerce_productItem.querySelector("a[href*='/product/']");
  if (salecraft_ecommerce_productLink) {
    window.location.href = salecraft_ecommerce_productLink.getAttribute("href");
  }
});