let url_base = window.location.pathname;
let tuyenDungTable = $('#tuyenDungTable').DataTable({
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
        { "data": "hoTen" },
        { "data": "ngaySinh" },
        { "data": "soDienThoai" },
        { "data": "hinhAnh" },
        { "data": "CV" },
        { "data": "trinhDo" },
        { "data": "viTriUngTuyen" },
        { "data": "cauHoiUngVien" },
        {
            "data": null,
            render: function(data, type, row) {                           
                return "";     
            }
        }
    ]
});
tuyenDungTable.on('order.dt search.dt', function () {
    tuyenDungTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
        tuyenDungTable.cell(cell).invalidate('dom');
    } );
} ).draw();