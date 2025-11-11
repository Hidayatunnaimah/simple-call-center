$(document).ready(function () {
	$("#search-task").on("click", function () {
		var date = $('input[type="date"]').val();
        
        $.ajax({
            url: "Task/search",
            type: 'POST',
            data: {date: date},
            dataType: 'json',
            success: function(data) {
                var tbody = '';
                var no = 1;
                $.each(data, function(i, item) {
                    tbody += '<tr>'+
                                '<td>'+ no++ +'</td>'+
                                '<td>'+ item.report_code +'</td>'+
                                '<td>'+ item.customer_name +'</td>'+
                                '<td>'+ item.address +'</td>'+
                                '<td>'+ item.phone_1 +'</td>'+
                                '<td>'+ item.phone_2 +'</td>'+
                                '<td>'+ item.emergency_contact +'</td>'+
                                '<td>'+ item.emergency_contact_number +'</td>'+
                                '<td>'+ item.bill +'</td>'+
                                '<td>'+ item.desc +'</td>'+
                             '</tr>';
                });
                $('#dataTable tbody').html(tbody);
            }
        });
	});

	var today = new Date().toISOString().split('T')[0];
    $('input[type="date"]').val(today);
});
