let droptarget = document.getElementById('drop');
let dropImageList = document.getElementById('dropImageList');
let imageQuantity = document.querySelector('.count');
let uploadButton = document.querySelector('#uploadButton');
let uploadImagesInput = document.querySelector('#imgUpload');

let fileArr = [];
let fileBlodArr = [];
let imagePaths = [];

uploadButton.addEventListener('change', (event) => {
  let files = event.target.files;

  // 遍历文件列表，将文件添加到 fileArr 数组中
  for (let file of files) {
    if (fileArr.length < 10) {
      fileArr.push(file);
      filesToBlod(file);
      
      droptarget.classList.remove('disable');
      document.querySelector('.note').innerText = "Add Image";
    } else {
      droptarget.classList.add('disable');
      document.querySelector('.note').innerText = "Max";
    }
  }

  

  // 重置 input 元素的值，清空选择的文件
  event.target.value = '';

  
})

function handleEvent(event) {
  event.preventDefault();
  if (event.type === 'drop' || event.type === 'click') {
    droptarget.classList.remove('active');
    for (let file of event.dataTransfer.files) {
      if(fileArr.length < 10){
        fileArr.push(file);
        filesToBlod(file); 
      }
    }
  } else if (event.type === 'dragleave') {
    droptarget.classList.remove('active');
  } else {
    droptarget.classList.add('active');
  }
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

  previousButton.addEventListener('click', moveScrollX('previous'));
  previousButton.addEventListener('click', moveScrollX('next'));

  