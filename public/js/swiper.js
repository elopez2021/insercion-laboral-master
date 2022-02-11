document.querySelector('.swiper-btn').onclick = () =>{
    accountForm.classList.add('active');
  }

var swiper = new Swiper(".home-slider", {
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
    loop:true,
    grabCursor:true,
  });