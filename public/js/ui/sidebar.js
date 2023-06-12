
    // 获取当前页面的 URL
    var url = window.location.href;
  
    // 移除查询参数部分
    var cleanUrl = url.split('?')[0];
  
    // 修改浏览器的历史记录，使地址栏中不显示查询参数
    window.history.replaceState({}, document.title, cleanUrl);
