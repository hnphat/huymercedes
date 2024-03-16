$('.dropdown-toggle').click(function(e) {
    if ($(document).width() > 768) {
      e.preventDefault();  
      var url = $(this).attr('href');           
      if (url !== '#') {      
        window.location.href = url;
      }  
    }
});

$("input[name=nguon]").val(window.location);
$("input[name=nguonNhapEmail]").val(window.location);
$("input[name=nguonXinBaoGia]").val(window.location);
$("input[name=nguonDangKyLaiThu]").val(window.location);

setTimeout(() => {
  $("#openBaoGiaMain").click();
}, 5000);

$(document).on('click','#onclickcolor', function(){
  let srcImage = $(this).data('anhmau');
  $("#mauxeshow").attr("src", srcImage);
});
