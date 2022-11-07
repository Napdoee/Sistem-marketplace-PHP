$(document).ready(function() {
    $('.qty').on('input', function() {
        $subTotal = 0;

        $('.qty').each(function() {
            $subTotal += parseInt($(this).val())
        })

        $('#qtyTotal').val($subTotal);

        console.log("Berhasil quantity")
    })
})