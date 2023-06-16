// 创建观察者对象
const observer = new MutationObserver(() => {
    // 观察者回调函数的逻辑
});

const wrapper = document.getElementById("wrapper");

// 将观察者对象与目标元素关联
observer.observe(wrapper, { childList: true, subtree: true });


// 定義需要顯示的欄位
const columnNames = [
    "productId",
    "productName",
    "productCode",
    "productType",
    "productCatelog",
    "productModel",
    "productBrand",
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

        const response = await fetch('/ajax-product');
        const data = await response.json();
        
        const wrapper = document.getElementById("wrapper");
        while (wrapper.firstChild) {
            console.log('清空内容')
            wrapper.removeChild(wrapper.firstChild);
        }

        if (window.grid) {
            console.log('清空内容')
            window.grid.destroy();
        }

        // window.grid = new gridjs.Grid({
        //     sort: true,
        //     resizable: true,
        //     search: true,
        //     fixedHeader: true,
        //     height: '520px',
        //     columns: columnNames,
        //     pagination: {
        //         limit: 10
        //     },
        //     data: data,
        // });
        // window.grid.render(document.getElementById("wrapper"));

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

// observer.observe(document.getElementById("wrapper"), { childList: true, subtree: true });

function editEventListener(){
    var tr = document.getElementsByClassName("gridjs-tr");
    console.log('開始：', tr.length)
    for (let i = 0; i < tr.length; i++) {
        tr[i].addEventListener("dblclick", (event) => {
            console.log('中間：', event)
            const rowData = {
                productId: event.currentTarget.querySelector('[data-column-id="productId"]').textContent,
                productName: event.currentTarget.querySelector('[data-column-id="productName"]').textContent,
                productCode: event.currentTarget.querySelector('[data-column-id="productCode"]').textContent,
                productType: event.currentTarget.querySelector('[data-column-id="productType"]').textContent,
                productCatelog: event.currentTarget.querySelector('[data-column-id="productCatelog"]').textContent,
                productModel: event.currentTarget.querySelector('[data-column-id="productModel"]').textContent,
                productBrand: event.currentTarget.querySelector('[data-column-id="productBrand"]').textContent,
                // 其他列数据...
            };

            // 填充表单数据
            document.getElementById("productName").value = rowData.productName;
            document.getElementById("productCode").value = rowData.productCode;
            document.getElementById("productType").value = rowData.productType;
            document.getElementById("productCatelog").value = rowData.productCatelog;
            document.getElementById("productModel").value = rowData.productModel;
            document.getElementById("productBrand").value = rowData.productBrand;
            
            // 替换form action中的占位符
            const form = document.getElementById("productForm");
            const productID = rowData.productId;
            form.action = form.action.replace('__PRODUCT_ID__', productID);

            var modal = new bootstrap.Modal(document.querySelector("#productModal"));
            modal.show();
            console.log('結束：', event[rowData.productBrand])
        });
    }
}

// Bootstrap 5 Modal

