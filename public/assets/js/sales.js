$(function () {
    clock();
    let pc_order = ''; // product code order
    $('#product_code').trigger('focus');

    $("#payment_total").autoNumeric('init', {
        aSep: '.',
        aDec: ',',
        aPad: false,
    });
    $("#payment_change").autoNumeric('init', {
        aSep: '.',
        aDec: ',',
        aPad: false,
        vMin: '-9999999999.99',
        wEmpty: 'zero',
    });
});
// clock
function clock() {
    let clock_id = document.getElementById('clock');
    date = new Date();
    h = date.getHours(), m = date.getMinutes(), s = date.getSeconds();
    clock_id.innerHTML = (h < 10 ? "0" + h : h) + ":" + (m < 10 ? "0" + m : m) + ":" + (s < 10 ? "0" + s : s);
    setTimeout("clock()", 1000);
}

$('#product_qty').on('keyup', function (e) {
    let val = $(this).val();
    if (val == '') val = 1;
    else if (val.charAt(0) == '.') val = '0' + val;

    $(this).val(val);
});

$(document).on("keypress", function (e) {
    var key_code = e.keyCode || e.which;
    if (key_code == 43)
        addToCart();
    else if (key_code == 32)
        paymentCart();
    if (key_code == 45)
        clearShoppingCart();

});

function addToCart() {
    product = fetchProduct();
    if (product != null) {
        $.ajax({
            type: 'POST',
            url: `${base_url}cart`,
            async: false,
            data: $('#sales-form').serialize(),
            success: function (data) {
                if (!data.success) Swal.fire("Informasi", data.message + ' !!!', "info");
                else location.reload();
            }
        });

    }
}

function paymentCart() {
    $('#payment-modal').modal('show');
}

$('#payment-modal').on('shown.bs.modal', function () {
    $('#payment_total').trigger('focus');
})

function calculatePayment(grand_total) {
    let payment_total = parseFloat($("#payment_total").autoNumeric('get'));
    let payment_change = payment_total - grand_total;
    $("#payment_change").autoNumeric('set', payment_change);
}

function clearShoppingCart() {
    let item = $('#total_items').val();
    if (item == 0)
        Swal.fire("Informasi", "Silahkan tambah produk terlebih dahulu !!!", "info");
    else
        promptAction(`Apakah anda yakin untuk membersihkan daftar <b>belanja</b> ?`, 'clear');

}

function nextProcess(act) {
    $('#sales_method').val('DELETE');
    $('#sales-form').attr('action', `${base_url}cart/destroy`);
    $('#sales-form').submit();
}


function fetchProduct() {
    let product_code = $('#product_code').val();
    if (product_code == '')
        Swal.fire("Error", "Silahkan isi kode produk terlebih dahulu", "error");
    else {
        let products;
        $.ajax({
            type: 'POST',
            url: `${base_url}fetch-product`,
            async: false,
            data: { product_code },
            success: function (data) {
                products = data;
            }
        });

        if (products == null)
            Swal.fire("Error", "Produk tidak ditemukan", "error")

        return products;
    }
}

$('#product_code').keydown(function (e) {
    var key_code = e.keyCode || e.which;
    if (key_code == 13) {
        e.preventDefault();
        searchProduct();
    }
});


function selectProduct(product_code) {
    $('#product_code').val(product_code);
    searchProduct();
    $('.modal').modal('hide');
}

function searchProduct() {
    $('#product_code').trigger('focus');
    product = fetchProduct();
    if (product) {
        $('#product_qty').val(1).trigger('focus');
        $('#product_name').val(product.name);
        $('#product_unit').val(product.unit_name);
        $('#product_category').val(product.category_name);
        $('#product_selling_price').val(product.selling_price);
    } else
        $('#product_code').trigger('focus');

}


function clearAddForm() {
    pc_order = '';
    $('.nullable').val('');
    $('#product_code').trigger('focus');
}

function removeFromCart(product_code, product_name) {
    Swal.fire({
        title: "Anda yakin ?",
        html: `Hapus dari daftar belanja :<br> <b>${product_name}</b> ?`,
        icon: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#556EE6",
        cancelButtonColor: "#f46a6a",
        confirmButtonText: "Yes"
    }).then(function (t) {
        if (t.value) {
            $.post(`${base_url}sales/${product_code}`, { '_method': 'DELETE' })
                .done(function (data) {
                    if (data.success) location.reload();
                });
        }
    });
}

$('#payment-form').on('submit', function (e) {
    e.preventDefault();
    let item = $('#total_items').val();
    if (item == 0) {
        $('#product_code').trigger('focus');
        $('#payment-modal').modal('hide');
        Swal.fire("Informasi", "Silahkan tambah produk terlebih dahulu !!!", "info");

    }
    else {
        let payment_change = $("#payment_change").autoNumeric('get');
        if (payment_change < 0)
            Swal.fire("Informasi", "Nominal pembayaran masih kurang !!!", "info");
        $.ajax({
            type: 'POST',
            url: `${base_url}sales`,
            async: false,
            data: $(this).serialize(),
            success: function (data) {
                if (!data.success) Swal.fire("Informasi", data.message + ' !!!', "info");
                else {
                    location.reload();
                }
            }
        });

    }

})