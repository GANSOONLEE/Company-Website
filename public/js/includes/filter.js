
$(document).ready(() => {
  $('.fetchButton').click(()=>{
    selectChecked()
  });
});

function selectChecked() {
  let checkedTypeArray = [];
  let checkedModelArray = [];

  let checkboxTypeArray = document.querySelectorAll('[type="checkbox"][data-type="type"].checkbox-display');
  let checkboxModelArray = document.querySelectorAll('[type="checkbox"][data-type="model"].checkbox-display');

  checkboxTypeArray.forEach(element => {
    if (element.checked) {
      checkedTypeArray.push(element.id);
    }
  });

  checkboxModelArray.forEach(element => {
    if (element.checked) {
      checkedModelArray.push(element.id);
    }
  });

  sendFilter(checkedTypeArray, checkedModelArray);
}

function sendFilter(checkedTypeArray, checkedModelArray) {

  let currentURL = window.location.href;
  let urlParts = currentURL.split('/');
  const catelogName = urlParts[urlParts.length - 1];
  
  FormData = {
    'productType' : checkedTypeArray,
    'productName' : checkedModelArray,
  }

  $.ajax({
    url: `${catelogName}`,
    data: FormData,
    type: 'get',
    dataType: 'json',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (data) {
      console.log(data);
    },
    error: function (xhr, status, error) {
      // 处理错误
    }
  });
}




const refreshButton = document.querySelector('.resetButton');

// 添加點擊事件處理函數
refreshButton.addEventListener('click', function() {
    location.reload(true); // 刷新當前頁面
});

