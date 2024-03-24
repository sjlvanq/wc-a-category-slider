//https://www.w3schools.com/w3css/w3css_slideshow.asp

function wpwcacs_currentDiv(n) {
  wpwcacs_showDivs(slideIndex = n);
  //wpwcacs_scrollToSlider();
}

function wpwcacs_showDivs(n) {
  var x = document.getElementsByClassName("catslide");
  if (x.length === 0) {return}
  for (let i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  x[slideIndex].classList.add("animate-right");
  x[slideIndex].style.display = "block";
  //console.log("wpwcacs-slider");
}

function wpwcacs_scrollToSlider(){

}

var slideIndex = 0;
window.addEventListener("load", function(){wpwcacs_currentDiv(0)});
