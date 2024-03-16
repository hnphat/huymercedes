let url_base = window.location.pathname;
let navTable = $('#navTable').DataTable({
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
                if (row.hasSubMenu) {
                    let subMenu = row.subMenu;
                    let txt = "";
                    for (let i = 0; i < subMenu.length; i++) {
                        const ele = subMenu[i];
                        let isShow = (ele.isShow) ? `<span id='setOff' data-idsub='${ele.id}' class='fa fa-eye text-warning'></span>` : `<span id='setOn' data-idsub='${ele.id}' class='fa fa-eye-slash'></span>`;
                        txt += `<a target="_blank" href="${ele.isBaiViet ? './tin-tuc/' + ele.slugBaiViet : ele.link}">${ele.name}</a> <button id="deleteSubMenu" data-id="${ele.id}" class="btn btn-danger btn-xs">Xóa</button> &nbsp; ${isShow} &nbsp; <a id="getEditSubMenu" href="#" data-idsub='${ele.id}' data-toggle='modal' data-target='#subMenuEditModal'><span class='fa fa-edit text-primary'></span></a><br/>`;
                    }
                    return txt;
                } else {
                    return "<strong class='text-danger'>Không</strong>";
                }
            } 
        },
        {   
            "data": null,
            render: function(data, type, row) {                           
                if (row.link) {
                    return `<a href="${row.link}" target="_blank" class="btn btn-info btn-sm">Xem</a>`;
                } else {
                    return "<strong class='text-danger'>Không</strong>";
                }
            } 
        },
        {   
            "data": null,
            render: function(data, type, row) {                           
                if (row.baiViet) {
                    return `<a href="#" class="btn btn-primary btn-sm">Xem</a>`;
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
                let subMenu = "";
                if (row.hasSubMenu)
                    subMenu = "<button id='subMenuAdd' data-id='"+row.id+"' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#subMenuAddModal'>Sub Menu</button>";
                return subMenu + "<button id='getEditMenu' data-id='"+row.id+"' class='btn btn-success btn-sm' data-toggle='modal' data-target='#editMenuShowModal'><span class='fa fa-edit'></span></button>" 
                + "&nbsp;<button id='deleteMenu' data-id='"+row.id+"' class='btn btn-warning btn-sm'><span class='fa fa-minus-circle'></span></button>";    
            }
        }
    ]
});
navTable.on('order.dt search.dt', function () {
    navTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
        navTable.cell(cell).invalidate('dom');
    } );
} ).draw();

$("#hasSubMenu").change(function(){
    if ($("#hasSubMenu").val() == 1) {
        $("#menuAdvance").hide();
    } else {
        $("#menuAdvance").show();
    } 

});

$("#ehasSubMenu").change(function(){
    if ($("#ehasSubMenu").val() == 1) {
        $("#emenuAdvance").hide();
    } else {
        $("#emenuAdvance").show();
    } 

});

$("#isBaiViet").change(function(){
    if ($("#isBaiViet").val() == 1) {
        $("#linkShow").hide();
        $("#baiVietShow").show();
    } else {
        $("#linkShow").show();
        $("#baiVietShow").hide();
    } 

});

$("#eisBaiViet").change(function(){
    if ($("#eisBaiViet").val() == 1) {
        $("#elinkShow").hide();
        $("#ebaiVietShow").show();
    } else {
        $("#elinkShow").show();
        $("#ebaiVietShow").hide();
    } 

});

$("#isBaiVietSub").change(function(){
    if ($("#isBaiVietSub").val() == 1) {
        $("#linkShowSub").hide();
        $("#baiVietShowSub").show();
    } else {
        $("#linkShowSub").show();
        $("#baiVietShowSub").hide();
    } 

});

$("#eisBaiVietSub").change(function(){
    if ($("#eisBaiVietSub").val() == 1) {
        $("#elinkShowSub").hide();
        $("#ebaiVietShowSub").show();
    } else {
        $("#elinkShowSub").show();
        $("#ebaiVietShowSub").hide();
    } 

});


$("#taoMenu").click(function(){   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#addMenuForm").one("submit", submitFormFunction);
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
                $("#taoMenu").attr('disabled', true).html("Đang thêm mới...");
            },
            success: (response) => {
                console.log(response);
                if (response.code == 200) {
                    this.reset();
                    $('.close:visible').click();
                    Swal.fire("Thông báo", response.message, response.type);
                    $("#menuAdvance").hide();
                    $("#linkShow").hide();
                    $("#baiVietShow").show();
                    navTable.ajax.reload();
                } else {
                    Swal.fire("Thông báo", response.message, response.type);
                }
                $("#taoMenu").attr('disabled', false).html("Thêm");
            },
            error: function(response){
                console.log(response);
                Swal.fire("Thông báo lỗi", response.responseJSON.message, "error");
                $("#taoMenu").attr('disabled', false).html("Thêm");
            }
        });
    }
});

$(document).on('click','#getEditMenu', function(){
    let idMenu = $(this).data('id');
    $.ajax({
        type:'get',
        url: url_base + "/getedit",
        data: {
            "id": idMenu
        },
        success: (response) => {
            console.log(response);  
            if(response.code == 200) {
                $("input[name=idMenu]").val(response.data.id);
                $("select[name=eisBaiViet]").val(response.data.isBaiViet);
                $("select[name=ebaiViet]").val(response.data.baiViet);
                $("input[name=etenMenu]").val(response.data.name);
                $("select[name=ehasSubMenu]").val(response.data.hasSubMenu);
                $("input[name=idMenu]").val(response.data.id);
                if (!response.data.hasSubMenu) {
                    $("#emenuAdvance").show();
                    $("#elinkShow").hide();
                    $("#ebaiVietShow").show();
                } else {
                    $("#emenuAdvance").hide();
                    $("#elinkShow").hide();
                    $("#ebaiVietShow").show();
                }
                switch(response.data.isBaiViet) {
                    case 1: {
                        $("#elinkShow").hide();
                        $("#ebaiVietShow").show();
                        $("select[name=ebaiViet]").val(response.data.baiViet); 
                    }
                    break;
                    case 0: {
                        $("#elinkShow").show();
                        $("#ebaiVietShow").hide();
                        $("input[name=elink]").val(response.data.link);
                    }
                    break;
                }
                $('#eisShow').prop('checked', response.data.isShow ? true : false);
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

$(document).on('click','#getEditSubMenu', function(){
    let idSubMenu = $(this).data('idsub');
    $.ajax({
        type:'get',
        url: url_base + "/submenu/getedit",
        data: {
            "id": idSubMenu
        },
        success: (response) => {
            console.log(response);  
            if(response.code == 200) {
                $("input[name=idSubMenu]").val(response.data.id);
                $("select[name=eisBaiVietSub]").val(response.data.isBaiViet);
                $("select[name=ebaiVietSub]").val(response.data.baiViet);
                $("input[name=etenSubMenu]").val(response.data.name);
                switch(response.data.isBaiViet) {
                    case 1: {
                        $("#elinkShowSub").hide();
                        $("#ebaiVietShowSub").show();
                        $("select[name=ebaiVietSub]").val(response.data.baiViet); 
                    }
                    break;
                    case 0: {
                        $("#elinkShowSub").show();
                        $("#ebaiVietShowSub").hide();
                        $("input[name=elinkSub]").val(response.data.link);
                    }
                    break;
                }
                $('#eisShowSub').prop('checked', response.data.isShow ? true : false);
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

$(document).on('click','#deleteMenu', function(){
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
                navTable.ajax.reload();
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

$(document).on('click','#deleteSubMenu', function(){
    let id = $(this).data('id');
    let token = $('meta[name="csrf-token"]').attr('content');
    if (confirm("Bạn có chắc muốn xoá?")) {
        $.ajax({
            url: url_base + "/submenu/delete",
            type: "post",
            dataType: "json",
            data: {
                "_token": token,
                "id": id
            },
            success: function(response) {   
               if (response.code == 200) {
                Swal.fire("Thông báo", response.message, response.type);
                navTable.ajax.reload();
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

$("#capNhatMenu").click(function(){   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#editMenuForm").one("submit", submitFormFunction);
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
                $("#capNhatMenu").attr('disabled', true).html("Đang cập nhật...");
            },
            success: (response) => {
                console.log(response);               
                if (response.code == 200) {
                    $('.close:visible').click();
                    Swal.fire("Thông báo", response.message, response.type);     
                    navTable.ajax.reload();              
                } else {
                    Swal.fire("Thông báo", response.message, response.type);                    
                }
                $("#capNhatMenu").attr('disabled', false).html("Cập nhật");
            },
            error: function(response){
                console.log(response);
                Swal.fire("Thông báo lỗi", response.responseJSON.message, "error");
                $("#capNhatMenu").attr('disabled', false).html("Cập nhật");
            }
        });
    }
});

$(document).on('click','#subMenuAdd', function(){
    $("input[name=idParentMenu]").val($(this).data('id'));
});

$("#taoSubMenu").click(function(){   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#addSubMenuForm").one("submit", submitFormFunction);
    function submitFormFunction(e) {
        e.preventDefault();   
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: url_base + "/submenu/post",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $("#taoSubMenu").attr('disabled', true).html("Đang thêm mới...");
            },
            success: (response) => {
                console.log(response);
                if (response.code == 200) {
                    this.reset();
                    $('.close:visible').click();
                    Swal.fire("Thông báo", response.message, response.type);
                    // $("#menuAdvanceSub").hide();
                    $("#linkShowSub").hide();
                    $("#baiVietShowSub").show();
                    navTable.ajax.reload();
                } else {
                    Swal.fire("Thông báo", response.message, response.type);
                }
                $("#taoSubMenu").attr('disabled', false).html("Thêm");
            },
            error: function(response){
                console.log(response);
                Swal.fire("Thông báo lỗi", response.responseJSON.message, "error");
                $("#taoSubMenu").attr('disabled', false).html("Thêm");
            }
        });
    }
});

$(document).on('click','#setOff', function(){
    let id = $(this).data('idsub');
    let token = $('meta[name="csrf-token"]').attr('content');
    if (confirm("Xác nhận tắt hiển thị?")) {
        $.ajax({
            url: url_base + "/setoff",
            type: "post",
            dataType: "json",
            data: {
                "_token": token,
                "id": id
            },
            success: function(response) {   
               if (response.code == 200) {
                Swal.fire("Thông báo", response.message, response.type);
                navTable.ajax.reload();
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

$(document).on('click','#setOn', function(){
    let id = $(this).data('idsub');
    let token = $('meta[name="csrf-token"]').attr('content');
    if (confirm("Xác nhận mở hiển thị?")) {
        $.ajax({
            url: url_base + "/seton",
            type: "post",
            dataType: "json",
            data: {
                "_token": token,
                "id": id
            },
            success: function(response) {   
               if (response.code == 200) {
                Swal.fire("Thông báo", response.message, response.type);
                navTable.ajax.reload();
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


$("#capNhatSubMenu").click(function(){   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#editSubMenuForm").one("submit", submitFormFunction);
    function submitFormFunction(e) {
        e.preventDefault();   
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: url_base + "/submenu/postedit",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $("#capNhatSubMenu").attr('disabled', true).html("Đang cập nhật...");
            },
            success: (response) => {
                console.log(response);               
                if (response.code == 200) {
                    $('.close:visible').click();
                    Swal.fire("Thông báo", response.message, response.type);     
                    navTable.ajax.reload();              
                } else {
                    Swal.fire("Thông báo", response.message, response.type);                    
                }
                $("#capNhatSubMenu").attr('disabled', false).html("Cập nhật");
            },
            error: function(response){
                console.log(response);
                Swal.fire("Thông báo lỗi", response.responseJSON.message, "error");
                $("#capNhatSubMenu").attr('disabled', false).html("Cập nhật");
            }
        });
    }
});