// 创建观察者对象
const observer = new MutationObserver(() => {
    // 观察者回调函数的逻辑
});

const wrapper = document.getElementById("wrapper");

// 将观察者对象与目标元素关联
observer.observe(wrapper, { childList: true, subtree: true });
  

// 定義需要顯示的欄位
const columnNames = [
    { id: 'productId', name: 'ID'},
    { id: 'productName', name: 'Name'},
    { id: 'productCode', name: 'Code'},
    { id: 'productType', name: 'Type'},
    { id: 'productCatelog', name: 'Catelog'},
    { id: 'productModel', name: 'Model'},
    { id: 'productBrand', name: 'Brand'},
];

// 渲染表格
function createGrid(data) {

    const wrapper = document.getElementById("wrapper");
   
    window.grid = new gridjs.Grid({
        sort: true,
        resizable: true,
        search: true,
        fixedHeader: true,
        height: '520px',
        columns: columnNames,
        pagination: {
            limit: 10
        },
        data: data,
    });

    return window.grid.render(wrapper);
}

// 刷新表格
async function refreshGrid() {
    try {

        const response = await fetch('/api/ajax-product');
        const data = await response.json();
        
        const wrapper = document.getElementById("wrapper");
        while (wrapper.firstChild) {
            wrapper.removeChild(wrapper.firstChild);
        }

        if (window.grid) {
            window.grid.destroy();
        }

        await createGrid(data);

        const observer = new MutationObserver(() => {
            observer.disconnect();
            editEventListener(); // 在观察器回调函数内调用editEventListener
        });

        observer.observe(document.getElementById("wrapper"), { childList: true, subtree: true });

    } catch (error) {
        console.error(error);
    }
}

document.addEventListener('DOMContentLoaded', async () => {
    await refreshGrid();
    editEventListener();
});

document.addEventListener('DOMContentLoaded', refreshGrid);
document.getElementById("refreshButton").addEventListener("click", refreshGrid);

function editEventListener() {
    var parentElement = document.querySelector('.gridjs-tbody');
  
    parentElement.addEventListener('dblclick', function(event) {
        
        if (event.target.classList.contains('gridjs-td')) {
            const rowData = {
            productId: event.target.parentNode.querySelector('[data-column-id="productId"]').textContent,
            productName: event.target.parentNode.querySelector('[data-column-id="productName"]').textContent,
            productCode: event.target.parentNode.querySelector('[data-column-id="productCode"]').textContent,
            productType: event.target.parentNode.querySelector('[data-column-id="productType"]').textContent,
            productCatelog: event.target.parentNode.querySelector('[data-column-id="productCatelog"]').textContent,
            productModel: event.target.parentNode.querySelector('[data-column-id="productModel"]').textContent,
            productBrand: event.target.parentNode.querySelector('[data-column-id="productBrand"]').textContent,
            // 其他列数据...
            };

            console.log(rowData);
    
            // 填充表单数据
            document.getElementById("productName").value = rowData.productName;
            document.getElementById("productCode").value = rowData.productCode;
            document.getElementById("productType").value = rowData.productType;
            document.getElementById("productCatelog").value = rowData.productCatelog;
            document.getElementById("productModel").value = rowData.productModel;
            document.getElementById("productBrand").value = rowData.productBrand;
            document.querySelector("button[data-button-type='delete']").value = rowData.productId;
    
            // 替换form action中的占位符
            const form = document.getElementById("productForm");
            const productID = rowData.productId;
            form.action = form.action.replace('__PRODUCT_ID__', productID);
    
            var modal = new bootstrap.Modal(document.querySelector("#productModal"));
            modal.show();
        }
    });
  }

//   var deleteBtn = document.querySelector('button[data-button-type="delete"]');

//   deleteBtn.addEventListener('click', () => {
//       var productId = deleteBtn.getAttribute('value');
//       // 发送AJAX请求到控制器的路由
//       var url = `/products/${productId}/delete`;
//       console.log(url);
//       var xhr = new XMLHttpRequest();
//       xhr.open('POST', url, true);
//       xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}'); // 如果使用了CSRF保护，请添加CSRF令牌
//       xhr.setRequestHeader('Content-Type', 'application/json');
//       xhr.onreadystatechange = function () {
//           if (xhr.readyState === 4 && xhr.status === 200) {
//               // 请求成功，执行相应操作
//               console.log(xhr.responseText);
//           }
//       };
//       xhr.send();
//   });
  
var deleteButton = document.querySelector('button[data-button-type="delete"]');

deleteButton.addEventListener('click', function () {
    var productId = deleteButton.getAttribute('value');
    var url = '/product/' + productId + '/delete';

    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var modal = document.getElementById('productModal');
            var modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();
            refreshGrid();
        }
    };
    xhr.send();
});
