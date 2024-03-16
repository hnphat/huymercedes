let url_base = window.location.pathname;
let thuThapTable = $('#thuThapTable').DataTable({
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
        { "data": "ngayTao" },
        { "data": "hoTen" },
        { "data": "soDienThoai" },
        { "data": "diaChi" },
        { "data": "xeYeuCau" },
        { "data": "linkReg" },
        { "data": "yeuCauKhachHang" },
        {
            "data": null,
            render: function(data, type, row) {                           
                return "";     
            }
        }
    ]
});
thuThapTable.on('order.dt search.dt', function () {
    thuThapTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
        thuThapTable.cell(cell).invalidate('dom');
    } );
} ).draw();