
$(document).ready(() => {
  $('#fetchButton').click(()=>{
    selectChecked()
  });
});

function selectChecked() {
  let checkedTypeArray = [];
  let checkedModelArray = [];

  let checkboxTypeArray = document.querySelectorAll('[type="checkbox"][data-type="type"].checkbox-display');
  let checkboxModelArray = document.querySelectorAll('[type="checkbox"][data-type="model"].checkbox-display');

  console.log('type有：',checkboxTypeArray);
  console.log('model有：',checkboxModelArray);

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

function sendFilter(type, model) {

  // 获取当前页面的URL
  var currentUrl = window.location.href;

  // 使用字符串分割方法获取最后一个字段
  var segments = currentUrl.split('/');
  var lastSegment = segments.pop();

  FormData = {
    'productCategory' : decodeURIComponent(lastSegment),
    'productType' : type,
    'productName' : model,
  }

  console.log(FormData)

  $.ajax({
    url: '/api/search-product',
    data: FormData,
    type: 'post',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (data) {
      document.open();
      document.write(data);
      document.close();
      console.log(data)
    },
    error: function (xhr, status, error) {
      
    }
  });
}

