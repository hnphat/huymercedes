let url_base = window.location.pathname;
let tinTucTable = $('#tinTucTable').DataTable({
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
                return `<a id="openTinTuc" href="#" data-idtintuc="${row.id}" data-toggle="modal" data-target="#tinTucShowModal">${row.name}</a>`;
            } 
        },
        {   
            "data": null,
            render: function(data, type, row) {                           
                if (row.hinhAnh) {
                   return `<img class='picmini' src='./upload/tintuc/${row.hinhAnh}' alt='name'/>`;
                } else {
                    return "";
                }
            } 
        },
        { "data": "moTa" },
        {   
            "data": null,
            render: function(data, type, row) {                           
               switch(row.loaiTin) {
                case "KM":  return `<strong class="text-primary">Tin khuyến mãi</strong>`;break;
                case "HAGI":  return `<strong class="text-pink">Tin Hyundai An Giang</strong>`;break;
                case "KINHNGHIEM":  return `<strong class="text-info">Tin tức và chia sẽ kinh nghiệm</strong>`;break;
                case "KHAC":  return `<strong>Tin tuyển dụng</strong>`;break;
               }
            } 
        },
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
                if (row.show) {
                    return "<strong class='text-success'>Có</strong>";
                } else {
                    return "<strong class='text-danger'>Không</strong>";
                }
            } 
        },
        {
            "data": null,
            render: function(data, type, row) {                           
                return "<button id='getEditTinTuc' data-id='"+row.id+"' class='btn btn-success btn-sm'><span class='fa fa-edit'></span></button>" + "&nbsp;" +
                "<button id='deleteTinTuc' data-id='"+row.id+"' class='btn btn-warning btn-sm'><span class='fa fa-minus-circle'></span></button>";     
            }
        }
    ]
});
tinTucTable.on('order.dt search.dt', function () {
    tinTucTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
        tinTucTable.cell(cell).invalidate('dom');
    } );
} ).draw();

$("#taoTinTuc").click(function(){   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#addTinTucForm").one("submit", submitFormFunction);
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
                $("#taoTinTuc").attr('disabled', true).html("Đang thêm mới...");
            },
            success: (response) => {
                console.log(response);
                if (response.code == 200) {
                    this.reset();
                    Swal.fire("Thông báo", response.message, response.type);
                } else {
                    Swal.fire("Thông báo", response.message, response.type);
                }
                $("#taoTinTuc").attr('disabled', false).html("Thêm");
            },
            error: function(response){
                console.log(response);
                Swal.fire("Thông báo lỗi", response.responseJSON.message, "error");
                $("#taoTinTuc").attr('disabled', false).html("Thêm");
            }
        });
    }
});

$(document).on('click','#deleteTinTuc', function(){
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
                tinTucTable.ajax.reload();
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

$(document).on('click','#getEditTinTuc', function(){
    let idtintuc = $(this).data('id');
    open(url_base + "/getedit/" + idtintuc,'_blank');
});

$("#capNhatTinTuc").click(function(){   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#editTinTucForm").one("submit", submitFormFunction);
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
                $("#capNhatTinTuc").attr('disabled', true).html("Đang cập nhật...");
            },
            success: (response) => {
                console.log(response);
                Swal.fire("Thông báo", response.message, response.type);
                $("#capNhatTinTuc").attr('disabled', false).html("Cập nhật");
                if (response.code == 200) {
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                }
            },
            error: function(response){
                console.log(response);
                Swal.fire("Thông báo lỗi", response.responseJSON.message, "error");
                $("#capNhatTinTuc").attr('disabled', false).html("Cập nhật");
            }
        });
    }
});

$(document).on('click','#openTinTuc', function(){
    let idTinTuc = $(this).data('idtintuc');
    console.log(idTinTuc);
    $.ajax({
        type:'get',
        url: url_base + "/gettintuc",
        data: {
            "id": idTinTuc
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