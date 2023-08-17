
/* ———————————————————— Update Order Status ———————————————————— */

$('#CompleteButton').click(function(event){
    let orderID = $(this).data('order-id');
    $.ajax({
        url: '/api/update-order-status',
        data: {'orderID': orderID, 'status' : 'complete'},
        dataType: 'json',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            location.reload();
        },
        error: function(xhr, status, error) {
            console.error(xhr,status,error)
        }
    });

});

$('#PendingButton').click(function(event){
    let orderID = $(this).data('order-id');
    $.ajax({
        url: '/api/update-order-status',
        data: {'orderID': orderID, 'status' : 'pending'},
        dataType: 'json',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            location.reload();
        },
        error: function(xhr, status, error) {
            console.error(xhr,status,error)
        }
    });
});

$('#InProcessButton').click(function(event){
    let orderID = $(this).data('order-id');
    $.ajax({
        url: '/api/update-order-status',
        data: {'orderID': orderID, 'status' : 'in process'},
        dataType: 'json',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            location.reload();
        },
        error: function(xhr, status, error) {
            console.error(xhr,status,error)
        }
    });
});

/* ———————————————————— Update own ———————————————————— */

$('#updateProductOwn').click(function(event){

    let cartID = $('#editModal #cartID').text();
    let orderID = $('#orderID').text();
    let quantity = $('#editModal #quantity').val();
    let own = $('#editModal #own').val();

    if(own >= quantity){
        return false;
    }

    console.log(cartID, orderID, own)

    $.ajax({
        url: '/api/update-cart-own',
        data: {'cartID': cartID, 'orderID': orderID, 'own':own},
        dataType: 'json',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            console.log(data)
            location.reload();
        },
        error: function(xhr, status, error) {
            console.error(xhr,status,error)
        }
    });
});

/* —————————————————————— Creating forms with data —————————————————————— */

$('.order-list').click(function() {
    let quantity = $(this).find('p[data="quantity"]').text();
    let index = $(this).find('p[data="index"]').text();
    let cartID = $(this).find('p[data="cartID"]').text();
    let category = $(this).find('p[data="category"]').text();
    let name = $(this).find('p[data="name"]').text();
    let brand = $(this).find('p[data="brand"]').text();
    let own = $(this).find('p[data="own"]').text();

    $('#editModal').click(function(event){
        event.stopPropagation();
    })

    $('#editModal #index').empty();
    $('#editModal #own').val('');

    $('#editModal #index').text(index);
    $('#editModal #cartID').text(cartID);
    $('#editModal #category').val(category);
    $('#editModal #name').val(name);
    $('#editModal #quantity').val(quantity);
    $('#editModal #own').val(own);
    $('#editModal #brand').val(brand);

    // 显示模态框
    $('#backgroundModal').show();
});

// Close the modal
$('#backgroundModalButton').click(function(){
    $('#backgroundModal').hide();
});

// Animation
$('#backgroundModal').click(function(){
    $('#editModal').addClass('shake');
    setTimeout(()=>{
        $('#editModal').removeClass('shake');
    }, 2000)
});
