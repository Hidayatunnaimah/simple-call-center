$(document).ready(function () {
    let table = $('#resultdataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url + "Result/get_data",
            type: "POST",
            data: function (d) {
                d.start_date = $('input[type="date"]').eq(0).val();
                d.end_date = $('input[type="date"]').eq(1).val();
                d.result = $('#resultSelect').val();
                d.status = $('#statusSelect').val();
            }
        },
        columns: [
            { data: 'no' },
            { data: 'report_code' },
            { data: 'customer_name' },
            { data: 'address' },
            { data: 'phone1' },
            { data: 'phone2' },
            { data: 'real_name' },
            { data: 'result' },
            { data: 'bill' },
            { data: 'note' }
        ]
    });

    $('#result-filters').on('click', function (e) {
        e.preventDefault();
        table.ajax.reload();
    });
});
