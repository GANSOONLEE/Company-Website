
/**
 *  Upload image
 *  @method droptarget // events fired on the drop targets
 *  @method dragenter // when the draggable element enters it
 *  @method dragleave // when the draggable element leaves it
 *  @method drop // prevent default action
 * 
 *  @url https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/drag_event
 * 
 *  @param imageThumble // this area are prepared to where image upload display their thumbnail
 *  @param imageInput // this area are the drag and drop valid area
 */

let imageThumble = document.querySelector('#images-thumble'); 
let imageInput = document.querySelector('#image-input');

  /**
   *  Add event-listener to the element we want
   *  @static
   */

  

  // prevent default action (open file explorer)
  function drop(){

  }


/**
 *  @method previousButton():void
 *  @method nextButton():void
 *   
 */

let scrollXList = document.querySelector('#images-thumble');

  /**
   *  @method helperFunction
   */

  function getScrollX(){ // Number
    return scrollXList.scrollLeft;
  }

  function getWidth(){ // Number
    return scrollXList.offsetWidth;
  }

  function displacement(){
    let X = (getWidth() / 2);
    return X;
  }

  /**
   *  @param object
   */

  let previousButton = document.querySelector('#previousButton');
  let nextButton = document.querySelector('#nextButton');

  // previousButton.addEventListener('click', moveScrollX('previous'));
  // previousButton.addEventListener('click', moveScrollX('next'));

  