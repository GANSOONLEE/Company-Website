
var uploadFiles = [];

function uploadImage (ev) {
  var e = ev || event;
  var files = e.target.files;
  if (!files.length) {
    return;
  }

  if (!verifyType(files)) {
    alert('Please upload the correct format!');
    return;
  }

  Array.prototype.push.apply(uploadFiles, files);

  objectURLPreview(files);
}

/**
 * 检验上传文件类型
 * @param {FileList} files - 此次选择上传的文件列表
 */

function verifyType (files) {
  for (var i = 0; i < files.length; i++) {
    if (!/^image\//.test(files[i].type)) {
      return false;
    }
  }
  return true;
}

function objectURLPreview (files) {
  // IE9（含9）以下不支持createObjectURL
  var index = uploadFiles.length - files.length;
  for (var i = 0; i < files.length; i++) {
    var url = window.URL.createObjectURL(files[i]);
    createPreviewWrap(url, index + i, function (){
      URL.revokeObjectURL(url);
    });
  }
}

function createPreviewWrap (url, index, cb) {
  var imgWrap = document.createElement('div');
  var image = new Image();
  imgWrap.className = 'img-wrap';
  image.src = url;
  cb && (image.onload = cb);
  imgWrap.appendChild(image);
  const deleteIcon = document.createElement('span');
    deleteIcon.onclick = () => {deleteFile(index, imgWrap);}
    const icon = document.createElement('i');
    icon.classList.add('fa-solid', 'fa-xmark');
    deleteIcon.append(icon);

  imgWrap.appendChild(deleteIcon);
  document.getElementById('img-container').appendChild(imgWrap);
}

function deleteFile (index, imgWrap) {
  uploadFiles.splice(index, 1);
  document.getElementById('img-container').removeChild(imgWrap);
}

function submitFormData () {
  if (uploadFiles.length === 0) {
    alert('Please upload image');
    return;
  }

  var formData = new FormData();
  uploadFiles.forEach(item => {
    formData.append('uploadFiles[]', item);
  });

  const loadingOverlay = document.querySelector('.loading-screen');
  loadingOverlay.classList.add('show');

  $.ajax({
    type: 'post',
    dataType: 'json',
    data: formData,
    processData: false,
    contentType: false,
    url: '/api/create-product',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(data) {
      // console.log(data)
    },
    error: function(xhr, status, error) {
      // console.log(status, error)
    }
  });
  loadingOverlay.classList.remove('show');
}

  /**
   * Initialize Function
   */

  
  window.onload = function init(){
    var upload = document.querySelector('#file')
    upload.addEventListener('change', uploadImage);

    var button = document.querySelector('#submit');
    button.addEventListener('click', submitFormData);

    let resetButton = document.querySelector('#resetButton');
    resetButton.addEventListener('click', resetConfirm);

    alertonload();
  }

/**
 *  Reset Confirm
 *  @param {Element} resetButton - reset
 *  @return {void}
 */


function resetConfirm(event){
  // 阻止默认行为
  event.preventDefault();

  const content = document.querySelector('.content');

  // 创建模态框的 DOM 元素
  const modalElement = document.createElement('div');
  modalElement.classList.add('modal', 'fade');
  modalElement.setAttribute('tabindex', '-1');
  modalElement.setAttribute('role', 'dialog');

  modalElement.innerHTML = `
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <p class="modal-title">
            <i class="fa-solid fa-triangle-exclamation" style="color: #ffc800;"></i>
            Confirm operation
          </p>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Do you really to reset it?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          <button type="button" class="btn btn-danger" id="confirmReset">Yes, reset it</button>
        </div>
      </div>
    </div>
  `;

  // 添加模态框到 body 中
  content.appendChild(modalElement);

  // 创建模态框对象
  const modal = new bootstrap.Modal(modalElement);

  // 监听确认重置按钮的点击事件
  const confirmResetButton = modalElement.querySelector('#confirmReset');
  confirmResetButton.addEventListener('click', function () {
    // 执行表单的 reset 操作
    const form = document.querySelector('#newProductForm'); // 替换成您的表单ID
    form.reset();

    // 隐藏模态框
    modal.hide();

    // 移除模态框的 DOM 元素
    if (modalElement) {
      modalElement.parentNode.removeChild(modalElement);
    }
  });

  const closeButton = modalElement.querySelectorAll('button[aria-label="Close"]');
  for(i=0; i<closeButton.length; i++){
    closeButton[i].addEventListener('click', function(){
      if (modalElement) {
        modalElement.parentNode.removeChild(modalElement);
      }
    })
  }

  // 显示模态框
  modal.show();
  ;
}

function alertonload(){
  let alertForm = document.querySelector('#alertForm')
  let bsAlert = new bootstrap.Alert(alertForm)
  setTimeout(function() {
      bsAlert.close();
  }, 3000);
}