let url_base = window.location.pathname;
function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

var DOCSO = function(){ 
    var t = ["không","một","hai","ba","bốn","năm","sáu","bảy","tám","chín"],r=function(r,n){var o="",a=Math.floor(r/10),e=r%10;return a>1?(o=" "+t[a]+" mươi",1==e&&(o+=" mốt")):1==a?(o=" mười",1==e&&(o+=" một")):n&&e>0&&(o=" lẻ"),5==e&&a>=1?o+=" lăm":4==e&&a>=1?o+=" tư":(e>1||1==e&&0==a)&&(o+=" "+t[e]),o},n=function(n,o){var a="",e=Math.floor(n/100),n=n%100;return o||e>0?(a=" "+t[e]+" trăm",a+=r(n,!0)):a=r(n,!1),a},o=function(t,r){var o="",a=Math.floor(t/1e6),t=t%1e6;a>0&&(o=n(a,r)+" triệu",r=!0);var e=Math.floor(t/1e3),t=t%1e3;return e>0&&(o+=n(e,r)+" ngàn",r=!0),t>0&&(o+=n(t,r)),o};return{doc:function(r){if(0==r)return t[0];var n="",a="";do ty=r%1e9,r=Math.floor(r/1e9),n=r>0?o(ty,!0)+a+n:o(ty,!1)+a+n,a=" tỷ";while(r>0);return n.trim()}}
}();
let viTriXeTable = $('#viTriXeTable').DataTable({
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
        { "data": 'tenXe' },
        {
            "data": null,
            render: function(data, type, row) {                           
                return formatNumber(row.giaBan);     
            }
        },
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
        {
            "data": null,
            render: function(data, type, row) {                           
                return "<button id='getEditViTriXe' data-id='"+row.id+"' data-toggle='modal' data-target='#editViTriXeModal' class='btn btn-success btn-sm'><span class='fa fa-edit'></span></button>" + "&nbsp;" +
                "<button id='deleteViTriXe' data-id='"+row.id+"' class='btn btn-warning btn-sm'><span class='fa fa-minus-circle'></span></button>";     
            }
        }
    ]
});
viTriXeTable.on('order.dt search.dt', function () {
    viTriXeTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
        viTriXeTable.cell(cell).invalidate('dom');
    } );
} ).draw();

$("#taoViTriXe").click(function(){   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#addViTriXeForm").one("submit", submitFormFunction);
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
                $("#taoViTriXe").attr('disabled', true).html("Đang tạo...");
            },
            success: (response) => {
                this.reset();
                Swal.fire("Thông báo", response.message, response.type);
                viTriXeTable.ajax.reload();
                $('.close:visible').click();
                $("#taoViTriXe").attr('disabled', false).html("Thêm");
            },
                error: function(response){
                Swal.fire("Thông báo", response.responseJSON.message, "error");
                $('.close:visible').click();    
                $("#taoViTriXe").attr('disabled', false).html("Thêm");
            }
        });
    }
});


$(document).on('click', '#getEditViTriXe', function(){
    $("input[name=viTriXeId]").val($(this).data('id'));
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
           $("select[name=echonXe]").val(response.data.idXe);
        },
        error: function(response) {
           Swal.fire("Thông báo", response.responseJSON.message, "error");
        }
    });
});

$("#editViTriXe").click(function(){   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#editViTriXeForm").one("submit", submitFormFunction);
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
                $("#editViTriXe").attr('disabled', true).html("Đang cập nhật...");
            },
            success: (response) => {
                this.reset();
                Swal.fire("Thông báo", response.message, response.type);
                viTriXeTable.ajax.reload();
                $('.close:visible').click();
                $("#editViTriXe").attr('disabled', false).html("Cập nhật");
            },
                error: function(response){
                Swal.fire("Thông báo", response.responseJSON.message, "error");
                $('.close:visible').click();    
                $("#editViTriXe").attr('disabled', false).html("Cập nhật");
            }
        });
    }
});

$(document).on('click','#deleteViTriXe', function(){
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
               viTriXeTable.ajax.reload();
            },
            error: function(response) {
               Swal.fire("Thông báo", response.responseJSON.message, "error");
            }
        });
    } 
});