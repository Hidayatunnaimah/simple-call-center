$(document).ready(function() {
    $('.call-section button').on('click', function() {
        const phoneNumber = $(this).data('phone');
        const custName = document.getElementById('cust-name').value; 

        const btn = $(this);
        // btn.prop('disabled', true).text('Calling...');

        $.ajax({
            url: BASE_URL + 'call',
            type: 'POST',
            dataType: 'json',
            data: {
                phone_number: phoneNumber,
                customer_name: custName
            },
            success: function(response) {
                if (response.status) {
                    console.log(response.data)
                } else {
                    console.log('Error')
                    console.log(response.data)
                }
            },
            error: function() {
                console.log('error')
            },
            complete: function() {
                btn.prop('disabled', false).text('Call');
            }
        });
    });
});
