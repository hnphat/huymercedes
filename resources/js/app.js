require('./bootstrap');
require('datatables.net');
require('datatables.net-bs4');

require('datatables.net-buttons-bs4');
require('datatables.net-buttons/js/buttons.colVis.js');
require('datatables.net-buttons/js/buttons.flash.js');
require('datatables.net-buttons/js/buttons.html5.js');
require('datatables.net-buttons/js/buttons.print.js');
require('datatables.net-responsive-bs4');

// require('datatables.net-autofill-bs4');
// require('datatables.net-colreorder-bs4');
// require('datatables.net-fixedcolumns-bs4');
// require('datatables.net-fixedheader-bs4');

// require('datatables.net-rowreorder-bs4');
// require('datatables.net-scroller-bs4');
// require('datatables.net-select-bs4');
// require('jszip');
// require('pdfmake/build/pdfmake.js');
// require('pdfmake/build/vfs_fonts.js');
const Swal = require('sweetalert2');
$(function(){
    require('./taikhoan');
    require('./dongxe');
    require('./tinxe');
    require('./xe');
    require('./tintuc');
    require('./slide');
    require('./cauhinh');
    require('./navi');
    require('./thuthap');
    require('./tuyendung');
    require('./vitrixe');
});