/**********************
 * Carousel
 **********************/
const allContentSlider = document.querySelectorAll(".contentSlider");
allContentSlider.forEach( el => {
    const slides        = el.querySelector(".slides");
    const allSlides     = el.querySelectorAll(".slide");
    const slider        = el.querySelector(".slider");
    const slidesLength  = allSlides.length;
    const slideWidth    = allSlides[0].offsetWidth + 10;
    const prev          = el.querySelector(".prev");
    const next          = el.querySelector(".next");

    let posX1, 
        posX2, 
        initialPosition, 
        finalPosition, 
        canISlide = true;

    const dragStart = function(e) {
      e.preventDefault();
      initialPosition = slides.offsetLeft;
      if (e.type == "touchstart") {
        posX1 = e.touches[0].clientX;
      } else {
        posX1 = e.clientX;
        el.onmouseup = dragEnd;
        el.onmousemove = dragMove;
      }
    }

    const dragMove = function(e) {
      if (e.type == "touchmove") {
        posX2 = posX1 - e.touches[0].clientX;
        posX1 = e.touches[0].clientX;
      } else {
        posX2 = posX1 - e.clientX;
        posX1 = e.clientX;
      }
      slides.style.left = `${slides.offsetLeft - posX2}px`;
    }

    const dragEnd = function() {
      finalPosition = slides.offsetLeft;
      if (finalPosition - initialPosition < 0) {
        switchSlide("next", "dragging");
      } else if (finalPosition - initialPosition > 0) {
        switchSlide("prev", "dragging");
      } else {
        slides.style.left = `${initialPosition}px`;
      }
      el.onmouseup = null;
      el.onmousemove = null;
    }

    const switchSlide = function(arg, arg2) {
      slides.classList.add("transition");
      if (canISlide) {
        if (!arg2) initialPosition = slides.offsetLeft;        
        if (arg == "next") {
            slides.style.left = `${initialPosition - slideWidth}px`;
        } else {
            slides.style.left = `${initialPosition + slideWidth}px`;
        }
      }
      canISlide = false;
    }

    const checkIndex = function() {
      slides.classList.remove("transition");
      const widthSlider = slider.getBoundingClientRect();
      let pxInNum   = parseInt(slides.style.left.replace('px', ''));
      let steps     = widthSlider.width / slideWidth;
      let endOffset = (slidesLength - steps ) * slideWidth;

      if( slidesLength > steps ){
        if ( pxInNum < -endOffset) slides.style.left = `-${endOffset}px`;
        if ( pxInNum > 0) slides.style.left = '0px';
      }else{
        slides.style.left = '0px';
      }
      canISlide = true;
    }

    next.addEventListener("click", () => switchSlide("next"));
    prev.addEventListener("click", () => switchSlide("prev"));
    slides.addEventListener("transitionend", checkIndex);
    slides.addEventListener("mousedown", dragStart);
    slides.addEventListener("touchstart", dragStart);
    slides.addEventListener("touchmove", dragMove);
    slides.addEventListener("touchend", dragEnd);
});
/**********************
 * Ajax to update carousel
 **********************/

const btnsUpdates = document.querySelectorAll(".btnUpdate");

btnsUpdates.forEach( btnUpdate => btnUpdate.addEventListener("click", () => ajaxUpdate(btnUpdate) ) );

function ajaxUpdate(btnUpdate){
  btnUpdate.setAttribute("disabled",'');

  const content   = btnUpdate.parentElement;
  const slides    = content.querySelector(".slides");
  const spinner   = document.createElement("div");
  const formData  = new FormData();
  const cats      = content.getAttribute("cats");
  const limit     = content.getAttribute("limit");

  spinner.id = "rbPreloader";
  spinner.innerHTML = '<div class="lds-ring"><div></div><div></div><div></div><div></div></div>' ;
  
  content.insertAdjacentElement("afterbegin", spinner);

  formData.append( 'action', ajax.action );
  formData.append( 'nonce', ajax.nonce );
  formData.append( 'cats', cats );
  formData.append( 'limit', limit );

  fetch(ajax.url, {
    method: 'POST',
    body: formData
  })
  .then( res => res.json() )
  .then( data => {
      if(data.r)slides.innerHTML = data.html;
      btnUpdate.removeAttribute("disabled");
      const preloader = document.getElementById("rbPreloader");
      content.removeChild(preloader);
  } )
  .catch( err => console.log( err ) );
}