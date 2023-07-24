
// 获取所有被选中的复选框的值
function getSelectedCheckboxValues() {
  const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
  const values = Array.from(checkboxes).map(checkbox => checkbox.value);
  return values;
}

// 使用 AJAX 将值发送到后端
function sendSelectedValuesToBackend(values) {
  const xhr = new XMLHttpRequest();
  const url = '/api/search-product';
  xhr.open('POST', url, true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      const productListDiv = document.querySelector('.product-list-section');
      productListDiv.innerHTML = '';

      response.forEach(product => {
        const productHTML = '<a href="' + product.detailLink + '">'
          + '<div class="product-list-box">'
          + '<div class="product-list-product-image">'
          + '<img class="product-img" src="' + product.imageSrc + '" alt="">'
          + '</div>'
          + '<div class="product-list-product-name">'
          + product.productCode
          + '</div>'
          + '</div>'
          + '</a>';

        productListDiv.insertAdjacentHTML('beforeend', productHTML);
      });
    } else {

    }
  };
  const data = JSON.stringify({ values: values });
  xhr.send(data);
}

// 获取所有被选中的复选框的值
// 发送值到后端
document.querySelector('.fetchButton').addEventListener('click',() =>{
  const selectedValues = getSelectedCheckboxValues();
  sendSelectedValuesToBackend(selectedValues);
})



const refreshButton = document.querySelector('.resetButton');

// 添加點擊事件處理函數
refreshButton.addEventListener('click', function() {
    location.reload(true); // 刷新當前頁面
});