$(() => {
    var id = $('#monthPrice');
    id.change(function(e) {
        e.preventDefault();
        var price = id.children("option:selected").data('price');
        $('input[name="total_amount"]').val(price);
    });

    var serviceType = $('#serviceType');
    serviceType.change(function(e) {
        e.preventDefault();
        var no = serviceType.children("option:selected").data('number');
        $('input[name="account_number"]').val(no);
    });
    $('#ekedc_amount').focus(() => {
        $('form button').prop('disabled', true);
        if ($('#ekedc_account_number').val().length > 6) {
            var actno = $('#ekedc_account_number').val();
            var type = serviceType.children("option:selected").val();
            $.get(`/ekedc/${type}/${actno}`, (data) => {
                if (data.code == 200) {
                    $('form button').prop('disabled', false);
                    $('#fetcheddetails').html(`
                    <div class="alert alert-success">
                        <div class="container font-weight-bold">
                            <h6>Account Name: ${data.data.name}</h6>
                            <h6>Account No: ${data.data.accountNumber}</h6>
                            <h6>Address: ${data.data.address}</h6>
                        </div>
                    </div>
                    `);
                }
            });
        }
    });
})