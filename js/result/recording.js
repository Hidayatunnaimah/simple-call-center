$(document).ready(function () {
	let table = $("#recordingDataTable").DataTable({
		processing: true,
		serverSide: false,
		ajax: {
			url: base_url + "Audio/get_recording_data",
			type: "POST",
			dataSrc: "data",
		},
		columns: [
			{ data: "no" },
			{ data: "calldate" },
			{ data: "src" },
			{ data: "duration" },
			{ data: "billsec" },
			{ data: "disposition" },
			{ data: "dst" },
			{
				data: "userfield",
				render: function (data, type, row) {
					return `
                    <button class="btn btn-success btn-sm btn-listen" data-source="${data}">
                        <i class="fa fa-play"></i>
                    </button>
                    <button class="btn btn-primary btn-sm btn-download" data-source="${data}">
                        <i class="fa fa-download"></i>
                    </button>
                `;
				},
			},
		],
	});

	$("#recordingDataTable").on("click", ".btn-listen", function () {
		const source = $(this).data("source");

		$.ajax({
			url: base_url + "Audio/convert_to_mp3",
			type: "POST",
			data: { source: source },
			dataType: "json",
			success: function (res) {
				if (res.status) {
					const file = res.data;
					console.log(file);
					const mp3Url =
						base_url + "Audio/play?filename=" + encodeURIComponent(file);
					const audio = document.getElementById("audioPlayer");
					const source = audio.querySelector("source");

					source.src = mp3Url;
					audio.load();
					audio.play();

					$("#audioModal").modal("show");
				} else {
					alert(res.data || "Gagal memuat audio.");
				}
			},

			error: function (xhr, status, error) {
				console.log("Status:", status);
				console.log("Error:", error);
				console.log("ResponseText:", xhr.responseText);
			},
		});
	});

	$("#recordingDataTable").on("click", ".btn-download", function () {
		const source = $(this).data("source");

		const form = document.createElement("form");
		form.method = "POST";
		form.action = base_url + "Audio/download_file";

		const input = document.createElement("input");
		input.type = "hidden";
		input.name = "source";
		input.value = source;

		form.appendChild(input);
		document.body.appendChild(form);

		form.submit();
		document.body.removeChild(form);
	});

	$(".close").on("click", function () {
		const audio = document.getElementById("audioPlayer");
		if (audio) {
			audio.pause();
			audio.currentTime = 0;
		}
	});
});
