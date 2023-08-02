
var uploadFiles = [];

function uploadImage (ev) {
  var e = ev || event;
  var files = e.target.files;
  if (!files.length) {
    return;
  }

  if (!verifyType(files)) {
    alert('请上传图片格式的文件');
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
    alert('请选择文件');
    return;
  }

  var formData = new FormData();
  uploadFiles.forEach(item => {
    formData.append('uploadFiles[]', item);
  });

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
      alert('上传成功');
    },
    error: function(xhr, status, error) {
      alert('上传失败');
      console.log(status, error)
    }
  });
}

  /**
   * Initialize Function
   */

  
  window.onload = function init(){
    var upload = document.querySelector('#file')
    upload.addEventListener('change', uploadImage);

    var button = document.querySelector('#submit');
    button.addEventListener('click', submitFormData);
  }