let url_base = window.location.pathname;
let dongXeTable = $('#dongXeTable').DataTable({
    // paging: false,    use to show all data
    responsive: true,
    dom: 'Blfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ],
    ajax: url_base + "/getdata",
    "columnDefs": [ {
        "searchable": false,
        "orderable": false,
        "targets": 0
    } ],
    "order": [
        [ 0, 'desc' ]
    ],
    lengthMenu:  [5, 10, 25, 50, 75, 100 ],
    columns: [
        { "data": null },
        { "data": "name" },
        {   
            "data": null,
            render: function(data, type, row) {                           
                if (row.isShow) {
                    return "<strong class='text-success'>Có</strong>"
                } else {
                    return "<strong class='text-danger'>Không</strong>"
                }
            } 
        },
        {   
            "data": null,
            render: function(data, type, row) {                           
                return row.created_at;  
            } 
        },
        { "data": "updated_at" },
        {
            "data": null,
            render: function(data, type, row) {                           
                return "<button id='getEditDongXe' data-id='"+row.id+"' data-toggle='modal' data-target='#editDongXeModal' class='btn btn-success btn-sm'><span class='fa fa-edit'></span></button>" + "&nbsp;" +
                "<button id='deleteDongXe' data-id='"+row.id+"' class='btn btn-warning btn-sm'><span class='fa fa-minus-circle'></span></button>";     
            }
        }
    ]
});
dongXeTable.on('order.dt search.dt', function () {
    dongXeTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
        dongXeTable.cell(cell).invalidate('dom');
    } );
} ).draw();

$("#taoDongXe").click(function(){   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#addDongXeForm").one("submit", submitFormFunction);
    function submitFormFunction(e) {
        e.preventDefault();   
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: url_base + "/post",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $("#taoDongXe").attr('disabled', true).html("Đang tạo dòng xe...");
            },
            success: (response) => {
                this.reset();
                Swal.fire("Thông báo", response.message, response.type);
                dongXeTable.ajax.reload();
                $('.close:visible').click();
                $("#taoDongXe").attr('disabled', false).html("Thêm");
            },
                error: function(response){
                Swal.fire("Thông báo", response.responseJSON.message, "error");
                $('.close:visible').click();    
                $("#taoDongXe").attr('disabled', false).html("Thêm");
            }
        });
    }
});

$(document).on('click','#deleteDongXe', function(){
    let id = $(this).data('id');
    let token = $('meta[name="csrf-token"]').attr('content');
    if (confirm("Bạn có chắc muốn xoá?")) {
        $.ajax({
            url: url_base + "/delete",
            type: "post",
            dataType: "json",
            data: {
                "_token": token,
                "id": id
            },
            success: function(response) {   
               Swal.fire("Thông báo", response.message, response.type);
               dongXeTable.ajax.reload();
            },
            error: function(response) {
               Swal.fire("Thông báo", response.responseJSON.message, "error");
            }
        });
    } 
});

$(document).on('click', '#getEditDongXe', function(){
    $("input[name=idEditDongXe]").val($(this).data('id'));
    let token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: url_base + "/getedit",
        type: "get",
        dataType: "json",
        data: {
            "_token": token,
            "id": $(this).data('id')
        },
        success: function(response) {
           $("input[name=etenDongXe]").val(response.data.name);
           $('#eisShow').prop('checked', response.data.isShow ? true : false);
           $("input[name=idEditDongXe]").val(response.data.id);
           dongXeTable.ajax.reload();
        },
        error: function(response) {
           Swal.fire("Thông báo", response.responseJSON.message, "error");
        }
    });
});

$("#editDongXe").click(function(){   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#editDongXeForm").one("submit", submitFormFunction);
    function submitFormFunction(e) {
        e.preventDefault();   
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: url_base + "/postedit",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $("#editDongXe").attr('disabled', true).html("Đang cập nhật...");
            },
            success: (response) => {
                this.reset();
                Swal.fire("Thông báo", response.message, response.type);
                dongXeTable.ajax.reload();
                $('.close:visible').click();
                $("#editDongXe").attr('disabled', false).html("Cập nhật");
            },
                error: function(response){
                Swal.fire("Thông báo", response.responseJSON.message, "error");
                $('.close:visible').click();    
                $("#editDongXe").attr('disabled', false).html("Cập nhật");
            }
        });
    }
});