/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/js/backend/admin/upload.js ***!
  \**********************************************/
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
var droptarget = document.getElementById('drop');
var dropImageList = document.getElementById('dropImageList');
var imageQuantity = document.querySelector('.count');
var uploadButton = document.querySelector('#uploadButton');
var uploadImagesInput = document.querySelector('#imgUpload');
var fileArr = [];
var fileBlodArr = [];
var imagePaths = [];
uploadButton.addEventListener('change', function (event) {
  var files = event.target.files;

  // 遍历文件列表，将文件添加到 fileArr 数组中
  var _iterator = _createForOfIteratorHelper(files),
    _step;
  try {
    for (_iterator.s(); !(_step = _iterator.n()).done;) {
      var file = _step.value;
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
  } catch (err) {
    _iterator.e(err);
  } finally {
    _iterator.f();
  }
  event.target.value = '';
});
function handleEvent(event) {
  event.preventDefault();
  if (event.type === 'drop' || event.type === 'click') {
    droptarget.classList.remove('active');
    var _iterator2 = _createForOfIteratorHelper(event.dataTransfer.files),
      _step2;
    try {
      for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
        var file = _step2.value;
        if (fileArr.length < 10) {
          fileArr.push(file);
          filesToBlod(file);
        }
      }
    } catch (err) {
      _iterator2.e(err);
    } finally {
      _iterator2.f();
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
droptarget.addEventListener('click', function () {
  if (fileArr.length < 10) {
    var _uploadButton = document.getElementById('uploadButton');
    _uploadButton.click();
    updateImageQuantityUploaded('remove', 'Add Image');
  } else {
    updateImageQuantityUploaded('add', 'Max');
  }
});
var fileInput = document.getElementById('fileInput');
fileInput.addEventListener('change', function (event) {
  fileArr.push(event.target.files[0]);
  filesToBlod(event.target.files[0]);
});
function upload() {
  fileInput.addEventListener('click', handleEvent);
}
function updateImageQuantityUploaded(type, text) {
  imageQuantity.innerText = '(' + fileArr.length + '/10)';
  type === "remove" ? droptarget.classList.remove('disable') : droptarget.classList.add('disable');
  document.querySelector('.note').innerText = text;
}
function filesToBlod(file) {
  if (fileArr.length > 10) {
    alert('Over limit');
  }
  var reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onload = function (e) {
    newFunction();
    function newFunction() {
      if (fileArr.length <= 10) {
        var updateUploadedImagesInput = function updateUploadedImagesInput(file) {
          uploadImagesInput.value += JSON.stringify(file);
        };
        fileBlodArr.push(e.target.result);
        var fileDiv = document.createElement('div');
        fileDiv.id = 'drop-image-box';
        fileDiv.classList.add('drop-image-box');

        // 文件名称
        // var fileName = document.createElement('p');
        // fileName.classList.add('drop-image-box-title');
        // fileName.innerHTML = file.name;
        // fileName.title = file.name;

        var deleteBtn = document.createElement('div');
        deleteBtn.classList.add('drop-image-delete');
        deleteBtn.innerText = 'Delete';

        // 顯示照片略縮圖
        var img = document.createElement('img');
        img.classList.add('thumble');
        img.draggable = true;
        img.src = e.target.result;
        updateUploadedImagesInput(e.target.result);
        fileDiv.appendChild(img);
        fileDiv.appendChild(deleteBtn);
        // fileDiv.appendChild(fileName);
        dropImageList.appendChild(fileDiv);
        updateImageQuantityUploaded('remove', 'Add Image');
        deleteBtn.addEventListener('click', function () {
          deleteFile(file);
          dropImageList.removeChild(fileDiv);
          updateImageQuantityUploaded('remove', 'Add Image');
        });
      }
    }
  };

  /**
   *  @method 更新數據
   *  @return string
   */

  reader.onerror = function () {
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
  var index = fileArr.indexOf(file);
  if (index > -1) {
    fileArr.splice(index, 1);
    fileBlodArr.splice(index, 1);
  }
}

/**
 *  定義作用域和變量
 */
/******/ })()
;