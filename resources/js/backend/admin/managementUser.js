
let table = new DataTable('#myTable', {
    "order": [
        [3, "desc"],
    ]
});

$(document).ready(() => {
    $('.restoreButton').click((event)=>{
        const id = event.target.id;
        const operationID = $(event.currentTarget).data('operation-id');
        $.ajax({
            url: '/api/restore-record',
            data: {'id': id, 'operationID': operationID},
            dataType: 'json',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                // console.log(data)
                location.reload();
            },
            error: function(xhr, status, error) {
                // console.log(status, error)
                location.reload();
            }
        })
    });
});