let url_base = window.location.pathname;
let tinXeTable = $('#tinXeTable').DataTable({
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
        {   
            "data": null,
            render: function(data, type, row) {                           
                return `<a id="openTinXe" href="#" data-idtinxe="${row.id}" data-toggle="modal" data-target="#tinXeShowModal">${row.name}</a>`;
            } 
        },
        // { "data": "slugName" },
        {   
            "data": null,
            render: function(data, type, row) {                           
                if (row.hinhAnh) {
                   return `<img class='picmini' src='./upload/tinxe/${row.hinhAnh}' alt='name'/>`;
                } else {
                    return "";
                }
            } 
        },
        { "data": "moTa" },
        {   
            "data": null,
            render: function(data, type, row) {                           
                if (row.thuThap) {
                    return "<strong class='text-success'>Có</strong>";
                } else {
                    return "<strong class='text-danger'>Không</strong>";
                }
            } 
        },
        {   
            "data": null,
            render: function(data, type, row) {                           
                if (row.quangCaoRamdom) {
                    return "<strong class='text-success'>Có</strong>";
                } else {
                    return "<strong class='text-danger'>Không</strong>";
                }
            } 
        },
        {   
            "data": null,
            render: function(data, type, row) {                           
                if (row.thongSoKyThuat) {
                    return `<strong><a href='./upload/tinxe/thongsokythuat/${row.thongSoKyThuat}' target='_blank'>Xem</a></strong>`;
                } else {
                    return "";
                }
            } 
        },
        {
            "data": null,
            render: function(data, type, row) {                           
                return "<button id='getEditTinXe' data-id='"+row.id+"' class='btn btn-success btn-sm'><span class='fa fa-edit'></span></button>" + "&nbsp;" +
                "<button id='deleteTinXe' data-id='"+row.id+"' class='btn btn-warning btn-sm'><span class='fa fa-minus-circle'></span></button>";     
            }
        }
    ]
});
tinXeTable.on('order.dt search.dt', function () {
    tinXeTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
        tinXeTable.cell(cell).invalidate('dom');
    } );
} ).draw();

$("#taoTinXe").click(function(){   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#addTinXeForm").one("submit", submitFormFunction);
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
                $("#taoTinXe").attr('disabled', true).html("Đang thêm mới...");
            },
            success: (response) => {
                console.log(response);
                if (response.code == 200) {
                    this.reset();
                    Swal.fire("Thông báo", response.message, response.type);
                } else {
                    Swal.fire("Thông báo", response.message, response.type);
                }
                $("#taoTinXe").attr('disabled', false).html("Thêm");
            },
            error: function(response){
                console.log(response);
                Swal.fire("Thông báo lỗi", response.responseJSON.message, "error");
                $("#taoTinXe").attr('disabled', false).html("Thêm");
            }
        });
    }
});

$(document).on('click','#deleteTinXe', function(){
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
               if (response.code == 200) {
                Swal.fire("Thông báo", response.message, response.type);
                tinXeTable.ajax.reload();
               } else {
                Swal.fire("Thông báo", response.message, response.type);
               }
              
            },
            error: function(response) {
               Swal.fire("Thông báo lỗi", response.responseJSON.message, "error");
            }
        });
    } 
});

$(document).on('click','#getEditTinXe', function(){
    let idtinxe = $(this).data('id');
    open(url_base + "/getedit/" + idtinxe,'_blank');
});

$("#capNhatTinXe").click(function(){   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#editTinXeForm").one("submit", submitFormFunction);
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
                $("#capNhatTinXe").attr('disabled', true).html("Đang cập nhật...");
            },
            success: (response) => {
                console.log(response);
                Swal.fire("Thông báo", response.message, response.type);
                $("#capNhatTinXe").attr('disabled', false).html("Cập nhật");
                if (response.code == 200) {
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                }
            },
            error: function(response){
                console.log(response);
                Swal.fire("Thông báo lỗi", response.responseJSON.message, "error");
                $("#capNhatTinXe").attr('disabled', false).html("Cập nhật");
            }
        });
    }
});

$(document).on('click','#openTinXe', function(){
    let idTinXe = $(this).data('idtinxe');
    console.log(idTinXe);
    $.ajax({
        type:'get',
        url: url_base + "/gettinxe",
        data: {
            "id": idTinXe
        },
        success: (response) => {
            console.log(response);  
            if(response.code == 200) {
                $("#tieuDeShow").text(response.tieuDe);        
                $("#moTaShow").text(response.moTa);        
                $("#noiDungShow").html(response.noiDung);  
            } else {
                $("#tieuDeShow").text("");        
                $("#moTaShow").text("");        
                $("#noiDungShow").html("");  
            }
        },
        error: function(response){
            console.log(response);
        }
    });
});