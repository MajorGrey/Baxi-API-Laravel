$(() => {
    var id = $('#monthPrice');
    id.change(function(e) {
        e.preventDefault();
        var price = id.children("option:selected").data('price');
        $('input[name="total_amount"]').val(price);
    });
})