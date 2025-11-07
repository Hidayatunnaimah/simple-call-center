$(document).ready(function(){

    $('.btn-primary').click(function(){
        const transaction_id = $(this).data('id');
        const result = $('#inputState').val();
        const note = $('#resultNotes').val();

        if(!result){
            alert('Pilih result terlebih dahulu!');
            return;
        }

        $.ajax({
            url: BASE_URL + 'CallScreen/submit_result',
            type: 'POST',
            data: {
                transaction_id: transaction_id,
                result: result,
                note: note,
            },
            dataType: 'json',
            success: function(res){
                if(res.status === 'success'){
                    alert('Result berhasil disimpan!');
                    location.reload();
                } else {
                    alert('Gagal menyimpan result!');
                }
            }
        });
    });

});
