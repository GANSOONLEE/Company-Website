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

// 拖拽事件绑定
droptarget.addEventListener('dragenter', handleEvent);
droptarget.addEventListener('dragover', handleEvent);
droptarget.addEventListener('drop', handleEvent);
droptarget.addEventListener('dragleave', handleEvent);
droptarget.addEventListener('click', ()=>{
  if(fileArr.length < 10){
    let uploadButton = document.getElementById('uploadButton');
    uploadButton.click();
    updateImageQuantityUploaded('remove','Max1')
  }else{
    updateImageQuantityUploaded('add','Max2')
  }
  
})

let fileInput = document.getElementById('fileInput');
fileInput.addEventListener('change', (event) => {
  fileArr.push(event.target.files[0]);
  filesToBlod(event.target.files[0]);
});

function upload() {
  fileInput.addEventListener('click', handleEvent);
}

function updateImageQuantityUploaded(type, text){
  imageQuantity.innerText = '(' + fileArr.length + '/10)';
  type === "remove" ? droptarget.classList.remove('disable') : droptarget.classList.add('disable');
  document.querySelector('.note').innerText = text;
} 

function filesToBlod(file) {

  if (fileArr.length > 10) {
    alert('Over limit');
  }

  let reader = new FileReader();
  reader.readAsDataURL(file);

  reader.onload = (e) => {
    newFunction();

    function newFunction() {
      if (fileArr.length <= 10) {
        fileBlodArr.push(e.target.result);

        let fileDiv = document.createElement('div');
        fileDiv.id = 'drop-image-box';
        fileDiv.classList.add('drop-image-box');


        // 文件名称
        let fileName = document.createElement('p');
        fileName.classList.add('drop-image-box-title');
        fileName.innerHTML = file.name;
        fileName.title = file.name;

        let deleteBtn = document.createElement('div');
        deleteBtn.classList.add('drop-image-delete');
        deleteBtn.innerText = 'Delete';

        // 顯示照片略縮圖
        let img = document.createElement('img');
        img.classList.add('thumble');
        img.draggable = true;
        img.src = e.target.result;
        updateUploadedImagesInput(e.target.result);

        function updateUploadedImagesInput(file) {
          uploadImagesInput.value += JSON.stringify(file);
        }

        fileDiv.appendChild(img);
        fileDiv.appendChild(deleteBtn);
        fileDiv.appendChild(fileName);
        dropImageList.appendChild(fileDiv);
        updateImageQuantityUploaded('remove','Add Image3')

        deleteBtn.addEventListener('click', () => {
          deleteFile(file);
          dropImageList.removeChild(fileDiv);
          updateImageQuantityUploaded('remove','Add Image4')
        });

        
      }
    }
  };

  /**
   *  @method 更新數據
   *  @return string
   */

  

  reader.onerror = () => {
    switch (reader.error.code) {
      case '1':
        alert("Can't find the file");
      case '2':
        alert('Security Error!');
      case '3':
        alert('Read interrupted');
      case '4':
        alert("Can't read the file");
      case '5':
        alert('Read file failure');
    }
  };
}

function deleteFile(file) {
  let index = fileArr.indexOf(file);
  if (index > -1) {
    fileArr.splice(index, 1);
    fileBlodArr.splice(index, 1);
  }
}

/**
 *  定義作用域和變量
 */
