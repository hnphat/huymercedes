let url_base = window.location.pathname;

function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

var DOCSO = function(){ 
    var t = ["không","một","hai","ba","bốn","năm","sáu","bảy","tám","chín"],r=function(r,n){var o="",a=Math.floor(r/10),e=r%10;return a>1?(o=" "+t[a]+" mươi",1==e&&(o+=" mốt")):1==a?(o=" mười",1==e&&(o+=" một")):n&&e>0&&(o=" lẻ"),5==e&&a>=1?o+=" lăm":4==e&&a>=1?o+=" tư":(e>1||1==e&&0==a)&&(o+=" "+t[e]),o},n=function(n,o){var a="",e=Math.floor(n/100),n=n%100;return o||e>0?(a=" "+t[e]+" trăm",a+=r(n,!0)):a=r(n,!1),a},o=function(t,r){var o="",a=Math.floor(t/1e6),t=t%1e6;a>0&&(o=n(a,r)+" triệu",r=!0);var e=Math.floor(t/1e3),t=t%1e3;return e>0&&(o+=n(e,r)+" ngàn",r=!0),t>0&&(o+=n(t,r)),o};return{doc:function(r){if(0==r)return t[0];var n="",a="";do ty=r%1e9,r=Math.floor(r/1e9),n=r>0?o(ty,!0)+a+n:o(ty,!1)+a+n,a=" tỷ";while(r>0);return n.trim()}}
}();

//--------- autoload giá xe
var cos = $('#giaBan').val();
$('#showGiaXe').text("(" + DOCSO.doc(cos) + ")");

var cos = $('#egiaBan').val();
$('#eshowGiaXe').text("(" + DOCSO.doc(cos) + ")");
// -------------------
let xeTable = $('#xeTable').DataTable({
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
                if (row.hinhAnh) {
                   return `<img class='picmini' src='./upload/xe/${row.hinhAnh}' alt='name'/>`;
                } else {
                    return "";
                }
            } 
        },
        { "data": "dongXe" },
        { "data": "loaiXe" },
        { "data": "hopSo" },
        { "data": "nhienLieu" },
        { "data": "choNgoi" },
        {   
            "data": null,
            render: function(data, type, row) {                           
                return formatNumber(row.giaBan);
            } 
        },
        {   
            "data": null,
            render: function(data, type, row) {                           
                return `<button id="openTinXe" class="btn btn-info btn-sm" data-idtinxe="${row.tinXe}" data-toggle="modal" data-target="#tinXeShowModal">Xem</button>`;
            } 
        },
        {   
            "data": null,
            render: function(data, type, row) {                           
                if (row.isNew) {
                    return "<strong class='text-success'>Có</strong>";
                } else {
                    return "<strong class='text-danger'>Không</strong>";
                }
            } 
        },
        {   
            "data": null,
            render: function(data, type, row) {                           
                if (row.isKhuyenMai) {
                    return "<strong class='text-success'>Có</strong>";
                } else {
                    return "<strong class='text-danger'>Không</strong>";
                }
            } 
        },
        {   
            "data": null,
            render: function(data, type, row) {                           
                if (row.isShow) {
                    return "<strong class='text-success'>Có</strong>";
                } else {
                    return "<strong class='text-danger'>Không</strong>";
                }
            } 
        },
        {   
            "data": null,
            render: function(data, type, row) {                           
               if (row.mauXe.length != 0) {
                   let arr = row.mauXe;
                   let txt = ``;
                   for (let i = 0; i < arr.length; i++) {
                    const ele = arr[i];
                    txt += `<strong id="colorCheck" data-id="${ele.id}" style="color: ${ele.maMau}" data-toggle='modal' data-target='#mauShowModal'>${ele.tenMau}</strong>` + `<br/>`
                   }
                   return txt;
                } 
                else 
               return "<strong class='text-secondary'>Chưa có</strong>"
            } 
        },
        {
            "data": null,
            render: function(data, type, row) {                           
                return "<button id='mauXe' data-id='"+row.id+"' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#mauXeShowModal'>Màu xe</button>"
                + "<button id='getEditXe' data-id='"+row.id+"' class='btn btn-success btn-sm'><span class='fa fa-edit'></span></button>" 
                + "&nbsp;<button id='deleteXe' data-id='"+row.id+"' class='btn btn-warning btn-sm'><span class='fa fa-minus-circle'></span></button>";    
            }
        }
    ]
});
xeTable.on('order.dt search.dt', function () {
    xeTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
        xeTable.cell(cell).invalidate('dom');
    } );
} ).draw();

$('#giaBan').keyup(function(){
    var cos = $('#giaBan').val();
    $('#showGiaXe').text("(" + DOCSO.doc(cos) + ")");
});

$('#egiaBan').keyup(function(){
    var cos = $('#egiaBan').val();
    $('#eshowGiaXe').text("(" + DOCSO.doc(cos) + ")");
});

$("#taoXe").click(function(){   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#addXeForm").one("submit", submitFormFunction);
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
                $("#taoXe").attr('disabled', true).html("Đang thêm mới...");
            },
            success: (response) => {
                console.log(response);
                if (response.code == 200) {
                    this.reset();
                    Swal.fire("Thông báo", response.message, response.type);
                } else {
                    Swal.fire("Thông báo", response.message, response.type);
                }
                $("#taoXe").attr('disabled', false).html("Thêm");
            },
            error: function(response){
                console.log(response);
                Swal.fire("Thông báo lỗi", response.responseJSON.message, "error");
                $("#taoXe").attr('disabled', false).html("Thêm");
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

$(document).on('click','#deleteXe', function(){
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
                xeTable.ajax.reload();
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

$(document).on('click','#getEditXe', function(){
    let idxe = $(this).data('id');
    open(url_base + "/getedit/" + idxe,'_blank');
});

$("#capNhatXe").click(function(){   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#editXeForm").one("submit", submitFormFunction);
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
                $("#capNhatXe").attr('disabled', true).html("Đang cập nhật...");
            },
            success: (response) => {
                console.log(response);
                Swal.fire("Thông báo", response.message, response.type);
                $("#capNhatXe").attr('disabled', false).html("Cập nhật");
                if (response.code == 200) {
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                }
            },
            error: function(response){
                console.log(response);
                Swal.fire("Thông báo lỗi", response.responseJSON.message, "error");
                $("#capNhatXe").attr('disabled', false).html("Cập nhật");
            }
        });
    }
});

$('#maMau').on('change',function(){
	$('#chonseColor').val($(this).val());
});

$(document).on('click','#mauXe', function(){
    idXe = $(this).data('id');
    console.log(idXe);
    $("input[name=idXe]").val(idXe);
});

$("#taoMauXe").click(function(){   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#addMauXeForm").one("submit", submitFormFunction);
    function submitFormFunction(e) {
        e.preventDefault();   
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: url_base + "/postmauxe",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $("#taoXe").attr('disabled', true).html("Đang thêm mới...");
            },
            success: (response) => {
                console.log(response);
                if (response.code == 200) {
                    this.reset();
                    $('.close:visible').click();
                    xeTable.ajax.reload();
                    Swal.fire("Thông báo", response.message, response.type);
                } else {
                    Swal.fire("Thông báo", response.message, response.type);
                }
                $("#taoXe").attr('disabled', false).html("Thêm");
            },
            error: function(response){
                console.log(response);
                Swal.fire("Thông báo lỗi", response.responseJSON.message, "error");
                $("#taoXe").attr('disabled', false).html("Thêm");
            }
        });
    }
});

$(document).on('click','#colorCheck', function(){
    let idMauXe = $(this).data('id');
    $('#deleteMauXe').data('id', idMauXe);
    $.ajax({
        type:'get',
        url: url_base + "/getmauxe",
        data: {
            "id": idMauXe
        },
        success: (response) => {
            console.log(response);  
            if(response.code == 200) {
                $("#stenMau").text(response.data.tenMau);     
                $("#stenMau").attr("style", "color: " + response.data.maMau);
                $("#smaMau").text(response.data.maMau);        
                $("#smaMau").attr("style", "color: " + response.data.maMau);
                $("#sHinhAnh").attr("src","./upload/mauxe/" + response.data.hinhAnh);  
            } else {
                $("#stenMau").text("");        
                $("#smaMau").text("");        
                $("#sHinhAnh").attr("src","#");  
            }
        },
        error: function(response){
            console.log(response);
        }
    });
});

$("#deleteMauXe").click(function(){
    let id = $(this).data('id');
    let token = $('meta[name="csrf-token"]').attr('content');
    if (confirm("Bạn có chắc muốn xoá?")) {
        $.ajax({
            url: url_base + "/deletemauxe",
            type: "post",
            dataType: "json",
            data: {
                "_token": token,
                "id": id
            },
            success: function(response) {   
               if (response.code == 200) {
                $('.close:visible').click();
                Swal.fire("Thông báo", response.message, response.type);
                xeTable.ajax.reload();
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