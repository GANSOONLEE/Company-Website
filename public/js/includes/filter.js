
/**
 *  網址參數
 *  @return strings
 */
function updateURLParams() {
    // 获取所有选中的复选框元素
    var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');

    // 构建 URL 参数字符串
    var params = [];
    for (var i = 0; i < checkboxes.length; i++) {
      params.push("modal=" + checkboxes[i].value);
    }

    // 构建完整的 URL
    var url = "http://192.168.68.104/origin/catelog/Blower%20Motor";
    if (params.length > 0) {
      url += "?" + params.join("&");
    }

    // 更新浏览器地址栏中的 URL
    history.replaceState({}, "", url);

    $.ajax()
  }

/**
 *  Ajax
 *  @method 回傳網址參數給控制器
 */

document.querySelector('.fetchButton').addEventListener('click', fetchData)

function fetchData() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
    var modalValues = [];

    for (var i = 0; i < checkboxes.length; i++) {
        modalValues.push(checkboxes[i].value);
    }

    console.log(modalValues);

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    $.ajax({
        url: '/product/search/',
        method: 'POST',
        data: { modal: modalValues },
        success: function(response) {
            // 在这里处理控制器返回的数据
            console.log(response);
        },
        error: function(xhr, status, error) {
            // 处理错误情况
        }
    });
}

