let url_base = window.location.pathname;
$("#capNhatCauHinh").click(function(){   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#cauHinhForm").one("submit", submitFormFunction);
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
                $("#capNhatCauHinh").attr('disabled', true).html("Đang cập nhật...");
            },
            success: (response) => {
                console.log(response);
                if (response.code == 200) {
                    Swal.fire("Thông báo", response.message, response.type);
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                } else {
                    Swal.fire("Thông báo", response.message, response.type);
                }
                $("#capNhatCauHinh").attr('disabled', false).html("Cập nhật");
            },
            error: function(response){
                console.log(response);
                Swal.fire("Thông báo lỗi", response.responseJSON.message, "error");
                $("#capNhatCauHinh").attr('disabled', false).html("Cập nhật");
            }
        });
    }
  });