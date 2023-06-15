const columnNames = [
    "productId",
    "productName",
    "productCode",
    "productType",
    "productCatelog",
    "productModel",
    "productBrand",
];

function createGrid(data) {
    const grid = new gridjs.Grid({
        sort: true,
        resizable: true,
        search: true,
        fixedHeader: true,
        height: '580px',
        columns: columnNames,
        pagination: {
            limit: 15
        },
        data: data,
    });

    grid.render(document.getElementById("wrapper"));
}

function refreshGrid() {
    fetch('/ajax-product')
        .then(response => response.json())
        .then(data => {
            const wrapper = document.getElementById("wrapper");
            while (wrapper.firstChild) {
                wrapper.removeChild(wrapper.firstChild);
            }
            createGrid(data);
        })
        .catch(error => {
            console.error(error);
        });
}

document.addEventListener('DOMContentLoaded', refreshGrid);
document.getElementById("refreshButton").addEventListener("click", refreshGrid);
