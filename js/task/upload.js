$(document).ready(function () {
	$("#templateFile").on("change", function () {
		let file_data = $("#templateFile").prop("files")[0];
		if (!file_data) return;

		if (file_data.size > 10 * 1024 * 1024) {
			showError("File terlalu besar (maksimal 10MB)");
			return;
		}

		let form_data = new FormData();
		form_data.append("file", file_data);

		$.ajax({
			url: BASE_URL + "UploadController/read_csv",
			type: "POST",
			data: form_data,
			contentType: false,
			processData: false,
			beforeSend: function () {
				showInfo("Sedang memproses file...");
			},
			success: function (res) {
				try {
					let data = JSON.parse(res);
					if (data.status === "success") {
						showSuccess("File berhasil dibaca! " + data.message);
                        file_data='';
						// console.table(data.rows);
					} else {
						showError(data.message);
					}
				} catch (e) {
					showError("Terjadi kesalahan saat membaca respons server.");
				}
			},
			error: function (msg) {
				showError("Upload gagal." + msg);
			},
		});
	});

	function showError(msg) {
		$(".error-upload").html(`
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            ${msg}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        `);
	}

	function showInfo(msg) {
		$(".error-upload").html(`<div class="alert alert-info">${msg}</div>`);
	}

	function showSuccess(msg) {
		$(".error-upload").html(`
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            ${msg}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        `);
	}

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
                                '<td>'+ item.emergency_number +'</td>'+
                                '<td>'+ item.bill +'</td>'+
                                '<td>'+ item.description +'</td>'+
                             '</tr>';
                });
                $('#dataTable tbody').html(tbody);
            }
        });
	});

	var today = new Date().toISOString().split('T')[0];
    $('input[type="date"]').val(today);
});
