
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
      console.log(xhr.responseText)
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
