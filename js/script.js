//let searchForm = document.querySelector('.search-form');

// document.querySelector('#search-btn').onclick = () =>{
//     searchForm.classList.toggle('active');
//     cart.classList.remove('active');
//     loginForm.classList.remove('active');
//     navbar.classList.remove('active');
// }

// let cart = document.querySelector('.shopping-cart');

// document.querySelector('#cart-btn').onclick = () =>{
//     cart.classList.toggle('active');
//     searchForm.classList.remove('active');
//     loginForm.classList.remove('active');
//     navbar.classList.remove('active');
// }

// let loginForm = document.querySelector('.login-form');

// document.querySelector('#login-btn').onclick = () =>{
//     loginForm.classList.toggle('active');
//     searchForm.classList.remove('active');
//     cart.classList.remove('active');
//     navbar.classList.remove('active');
// }

// let navbar = document.querySelector('.navbar');

// document.querySelector('#menu-btn').onclick = () =>{
//     navbar.classList.toggle('active');
//     searchForm.classList.remove('active');
//     cart.classList.remove('active');
//     loginForm.classList.remove('active');
// }

// window.onscroll = () =>{
//     searchForm.classList.remove('active');
//     cart.classList.remove('active');
//     loginForm.classList.remove('active');
//     navbar.classList.remove('active');
// }

// let slides = document.querySelectorAll('.home .slides-container .slide');
// let index = 0;

// function next(){
//     slides[index].classList.remove('active');
//     index = (index + 1) % slides.length;
//     slides[index].classList.add('active');
// }

// function prev(){
//     slides[index].classList.remove('active');
//     index = (index - 1 + slides.length) % slides.length;
//     slides[index].classList.add('active');
// }



let navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

let profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   profile.classList.remove('active');
   navbar.classList.remove('active');
}