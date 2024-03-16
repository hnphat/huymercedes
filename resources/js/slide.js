let url_base = window.location.pathname;
let sliderTable = $('#sliderTable').DataTable({
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
                return `<a id="openTin" href="#" data-idtin="${row.baiViet}" data-iscar="${row.isCar}" data-toggle="modal" data-target="#tinSlideShowModal">${row.name}</a>`;
            } 
        },
        {   
            "data": null,
            render: function(data, type, row) {                           
                if (row.image) {
                   return `<img class='picslide' src='./upload/slider/${row.image}' alt='name'/>`;
                } else {
                    return "";
                }
            } 
        },
        {   
            "data": null,
            render: function(data, type, row) {                           
                if (row.isCar) {
                    return "<strong class='text-info'>Tin xe</strong>";
                } else {
                    return "<strong class='text-primary'>Tin tức</strong>";
                }
            } 
        },
        {
            "data": null,
            render: function(data, type, row) {                           
                return "<button id='getEditSlide' data-toggle='modal' data-target='#sliderEditModal'  data-id='"+row.id+"' class='btn btn-success btn-sm'><span class='fa fa-edit'></span></button>" + "&nbsp;" +
                "<button id='deleteSlide' data-id='"+row.id+"' class='btn btn-warning btn-sm'><span class='fa fa-minus-circle'></span></button>";     
            }
        }
    ]
});
sliderTable.on('order.dt search.dt', function () {
    sliderTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
        sliderTable.cell(cell).invalidate('dom');
    } );
} ).draw();

$("#lienQuan").change(function(){
    if ($("#lienQuan").val() == 1) {
        $("#tinXeBoxShow").show();
        $("#tinTucBoxShow").hide();
    } else {
        $("#tinTucBoxShow").show();
        $("#tinXeBoxShow").hide();
    } 

});

$("#elienQuan").change(function(){
    if ($("#elienQuan").val() == 1) {
        $("#etinXeBoxShow").show();
        $("#etinTucBoxShow").hide();
    } else {
        $("#etinTucBoxShow").show();
        $("#etinXeBoxShow").hide();
    } 

});

$("#taoSlide").click(function(){   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#addSliderForm").one("submit", submitFormFunction);
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
                $("#taoSlide").attr('disabled', true).html("Đang thêm mới...");
            },
            success: (response) => {
                console.log(response);
                if (response.code == 200) {
                    this.reset();
                    $('.close:visible').click();
                    Swal.fire("Thông báo", response.message, response.type);
                    sliderTable.ajax.reload();
                } else {
                    Swal.fire("Thông báo", response.message, response.type);
                }
                $("#taoSlide").attr('disabled', false).html("Thêm");
            },
            error: function(response){
                console.log(response);
                Swal.fire("Thông báo lỗi", response.responseJSON.message, "error");
                $("#taoSlide").attr('disabled', false).html("Thêm");
            }
        });
    }
});

$(document).on('click','#deleteSlide', function(){
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
                sliderTable.ajax.reload();
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

$(document).on('click','#getEditSlide', function(){
    let idslide = $(this).data('id');
    $.ajax({
        type:'get',
        url: url_base + "/getedit",
        data: {
            "id": idslide
        },
        success: (response) => {
            console.log(response);  
            if(response.code == 200) {
                $("input[name=etenSlide]").val(response.data.name);
                $("select[name=elienQuan]").val(response.data.isCar);
                $("input[name=idSlide]").val(response.data.id);
                switch(response.data.isCar) {
                    case 1: {
                        $("#etinXeBoxShow").show();
                        $("#etinTucBoxShow").hide();
                        $("select[name=etinXe]").val(response.data.baiViet); 
                    }
                    break;
                    case 0: {
                        $("#etinXeBoxShow").hide();
                        $("#etinTucBoxShow").show();
                        $("select[name=etinTuc]").val(response.data.baiViet);
                    }
                    break;
                }
                $("#slideShowImage").attr("src","./upload/slider/" + response.data.image);
            } else {
                Swal.fire("Thông báo", response.message, response.type);
            }
        },
        error: function(response){
            console.log(response);
            Swal.fire("Thông báo lỗi", response.responseJSON.message, "error");
        }
    });
});

$("#capNhatSlide").click(function(){   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#editSliderForm").one("submit", submitFormFunction);
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
                $("#capNhatSlide").attr('disabled', true).html("Đang cập nhật...");
            },
            success: (response) => {
                console.log(response);
                if (response.code == 200) {
                    this.reset();
                    $('.close:visible').click();
                    Swal.fire("Thông báo", response.message, response.type);
                    $("#capNhatSlide").attr('disabled', false).html("Cập nhật");
                    sliderTable.ajax.reload();
                } else {
                    Swal.fire("Thông báo", response.message, response.type);
                }            
            },
            error: function(response){
                console.log(response);
                Swal.fire("Thông báo lỗi", response.responseJSON.message, "error");
                $("#capNhatSlide").attr('disabled', false).html("Cập nhật");
            }
        });
    }
});

$(document).on('click','#openTin', function(){
    let idTin = $(this).data('idtin');
    let isCar = $(this).data('iscar');
    $.ajax({
        type:'get',
        url: url_base + "/gettin",
        data: {
            "id": idTin,
            "isCar": isCar
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