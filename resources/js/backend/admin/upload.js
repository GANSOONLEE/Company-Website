let droptarget = document.getElementById('drop');
let dropImageList = document.getElementById('dropImageList');

let fileArr = [];
let fileBlodArr = [];

function handleEvent(event) {
  event.preventDefault();
  if (event.type === 'drop') {
    droptarget.classList.remove('active');
    for (let file of event.dataTransfer.files) {
      fileArr.push(file);
      filesToBlod(file);
    }
  } else if (event.type === 'dropleave') {
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

let fileInput = document.getElementById('fileInput');
fileInput.addEventListener('change', (event) => {
  fileArr.push(event.target.files[0]);
  filesToBlod(event.target.files[0]);
});

function upload() {
  fileInput.click();
}

function filesToBlod(file) {
  let reader = new FileReader();
  reader.readAsDataURL(file);

  reader.onload = (e) => {
    fileBlodArr.push(e.target.result);

    let fileDiv = document.createElement('div');
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
    img.src = e.target.result;

    fileDiv.appendChild(img);
    fileDiv.appendChild(deleteBtn);
    fileDiv.appendChild(fileName);
    dropImageList.appendChild(fileDiv);

    deleteBtn.addEventListener('click', () => {
      deleteFile(file);
      dropImageList.removeChild(fileDiv);
    });
  };

  reader.onerror = () => {
    switch (reader.error.code) {
      case '1':
        alert('Can\'find the file');
      case '2':
        alert('Security Error!');
      case '3':
        alert('Read interrupted');
      case '4':
        alert('Can\'read the file');
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
