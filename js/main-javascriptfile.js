function _(e){
  return document.getElementById(e);
}
new Vivus('BFP-animated', {
  type:"delayed",
  duration:200,
  animTimingFunction:Vivus.EASE
});
new Vivus('welcome-animated', {
  type:"delayed",
  duration:600,
  animTimingFunction:Vivus.EASE
});
var scrollY = 0, currentY = 0, distance = 100, speed = 27, scrollanimator;
function resetScroller(){
  currentY = window.pageYOffset;
  scrollanimator = setTimeout(resetScroller,speed);
  if(currentY > 0){
    scrollY = currentY-distance;
    window.scroll(0,scrollY);
  } else {
    clearTimeout(scrollanimator);
  }
}
function scrollhandler(){
  if(window.pageYOffset > 50){
    _("scrolltopbtn").style.display = "block";
  } else {
    _("scrolltopbtn").style.display = "none";
  }
}
window.addEventListener('scroll',scrollhandler);