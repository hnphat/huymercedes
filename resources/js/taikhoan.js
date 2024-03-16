let url_base = window.location.pathname;
let taiKhoanTable = $('#taiKhoanTable').DataTable({
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
        { "data": "email" },
        { "data": "created_at" },
        { "data": "updated_at" },
        {
            "data": null,
            render: function(data, type, row) {                           
                return "<button id='getEditTaiKhoan' data-id='"+row.id+"' data-toggle='modal' data-target='#editTaiKhoanModal' class='btn btn-success btn-sm'><span class='fa fa-edit'></span></button>" + "&nbsp;" +
                "<button id='deleteTaiKhoan' data-id='"+row.id+"' class='btn btn-warning btn-sm'><span class='fa fa-minus-circle'></span></button>";     
            }
        }
    ]
});
taiKhoanTable.on( 'order.dt search.dt', function () {
    taiKhoanTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
        taiKhoanTable.cell(cell).invalidate('dom');
    } );
} ).draw();

$("#taoTaiKhoan").click(function(){   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#addTaiKhoanForm").one("submit", submitFormFunction);
    function submitFormFunction(e) {
        e.preventDefault();   
        if ($("input[name=matKhau]").val() != $("input[name=nhapLaiMatKhau]").val()) {
            $("#thongBaoTaiKhoan").text("Mật khẩu không trùng khớp!");
        } else {
            var formData = new FormData(this);
            $.ajax({
                type:'POST',
                url: url_base + "/post",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#taoTaiKhoan").attr('disabled', true).html("Đang tạo tài khoản...");
                },
                success: (response) => {
                    this.reset();
                    Swal.fire("Thông báo", response.message, response.type);
                    taiKhoanTable.ajax.reload();
                    $('.close:visible').click();
                    $("#taoTaiKhoan").attr('disabled', false).html("Tạo tài khoản");
                    console.log(response);
                },
                    error: function(response){
                    Swal.fire("Thông báo", response.responseJSON.message, "error");
                    $('.close:visible').click();    
                    $("#taoTaiKhoan").attr('disabled', false).html("Tạo tài khoản");
                    console.log(response);
                }
            });
        }
    }
});

$(document).on('click','#deleteTaiKhoan', function(){
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
               console.log(response);
               Swal.fire("Thông báo", response.message, response.type);
               taiKhoanTable.ajax.reload();
            },
            error: function(response) {
               Swal.fire("Thông báo", response.responseJSON.message, "error");
            }
        });
    } 
});

$(document).on('click', '#getEditTaiKhoan', function(){
    $("input[name=idEditTaiKhoan]").val($(this).data('id'));
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
           console.log(response);
           $("input[name=etenDangNhap]").val(response.data.name);
           $("input[name=eemail]").val(response.data.email);
           $("input[name=idEditTaiKhoan]").val(response.data.id);
           taiKhoanTable.ajax.reload();
        },
        error: function(response) {
           Swal.fire("Thông báo", response.responseJSON.message, "error");
        }
    });
});

$("#editTaiKhoan").click(function(){   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#editTaiKhoanForm").one("submit", submitFormFunction);
    function submitFormFunction(e) {
        e.preventDefault();   
        if ($("input[name=ematKhau]").val() != $("input[name=enhapLaiMatKhau]").val()) {
            $("#thongBaoEditTaiKhoan").text("Mật khẩu không trùng khớp!");
        } else {
            var formData = new FormData(this);
            $.ajax({
                type:'POST',
                url: url_base + "/postedit",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#editTaiKhoan").attr('disabled', true).html("Đang cập nhật...");
                },
                success: (response) => {
                    this.reset();
                    Swal.fire("Thông báo", response.message, response.type);
                    taiKhoanTable.ajax.reload();
                    $('.close:visible').click();
                    $("#editTaiKhoan").attr('disabled', false).html("Cập nhật");
                    console.log(response);
                },
                    error: function(response){
                    Swal.fire("Thông báo", response.responseJSON.message, "error");
                    $('.close:visible').click();    
                    $("#editTaiKhoan").attr('disabled', false).html("Cập nhật");
                    console.log(response);
                }
            });
        }
    }
});