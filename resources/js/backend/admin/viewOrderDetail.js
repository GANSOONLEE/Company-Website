
/* ———————————————————— Update Order Status ———————————————————— */

$('#CompleteButton').click(function(event){
    let orderID = $(this).data('order-id');
    $.ajax({
        url: '/api/update-order-status',
        data: {'orderID': orderID},
        dataType: 'json',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            console.info(data)
            // location.reload();
        },
        error: function(xhr, status, error) {
            console.error(xhr,status,error)
        }
    });

});

/* ——————————————————————  —————————————————————— */

$('.order-list').click(function() {
    let quantity = $(this).find('p[data="quantity"]').text();
    let index = $(this).find('p[data="index"]').text();
    let category = $(this).find('p[data="category"]').text();
    let name = $(this).find('p[data="name"]').text();
    let brand = $(this).find('p[data="brand"]').text();

    $('#editModal').click(function(event){
        event.stopPropagation();
    })

    $('#editModal #index').empty();

    $('#editModal #index').text(index);
    $('#editModal #category').val(category);
    $('#editModal #name').val(name);
    $('#editModal #quantity').val(quantity);
    $('#editModal #brand').val(brand);

    // 显示模态框
    $('#backgroundModal').show();
});

$('#backgroundModalButton').click(function(){
    $('#backgroundModal').hide();
});
