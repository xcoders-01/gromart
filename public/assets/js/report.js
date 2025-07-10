const matrix_options = [
    'report_options', 'daily_page', 'monthly_page', 'yearly_page',
]
const selectRadioCard = (cardNo) => {
    /**
     * Loop through all radio cards, and remove the class "selected" from those elements.
     */
    const allRadioCards = document.querySelectorAll('.radio-card');
    allRadioCards.forEach((element, index) => {
        element.classList.remove(['selected']);
    });
    /**
     * Add the class "selected" to the card which user has clicked on.
     */
    const selectedCard = document.querySelector('.radio-card-' + cardNo);
    console.log('.radio-card-' + cardNo);

    let opt = matrix_options[cardNo - 1];
    opt != 'report_options' ?
        selectedCard.classList.add(['selected']) : null;

    switch (opt) {
        case 'daily_page':
            break;
        case 'monthly_page':
            break;
        case 'yearly_page':
            break;

        default:
            break;
    }

    $.each(matrix_options, function (index, value) {
        value == opt ? $(`#${value}`).removeClass('d-none') : $(`#${value}`).addClass('d-none');
    });
}

function getReport(type) {
    let process = true;
    if (type == 'daily') {
        form_data = {
            type,
            date: $('#inpDailyDate').val(),
        }
        class_table = '.daily_table';
    } else if (type == 'monthly') {
        year = $('#inpYearId').val();
        month = $('#inpMonthId').val();
        $('#print_monthly_id').attr('disabled', true)
        form_data = {
            type,
            month,
            year
        }
        class_table = '.monthly_table';

        if (month == '' || month == null) Swal.fire("Informasi", "Silahkan pilih bulan terlebih dahulu !!!", "info");
        else if (year == '' || year == null) Swal.fire("Informasi", "Silahkan pilih tahun terlebih dahulu !!!", "info");
        if (month == '' || year == '' || month == null || year == null) process = false;
        if (process) $('#print_monthly_id').attr('disabled', false);
    } else if (type == 'yearly') {
        year = $('#inpYearRpt').val();
        $('#print_yearly_id').attr('disabled', true)
        form_data = {
            type,
            year
        }
        class_table = '.yearly_table';
        if (year == '' || year == null) {
            process = false;
            Swal.fire("Informasi", "Silahkan pilih tahun terlebih dahulu !!!", "info");
        }
        if (process) $('#print_yearly_id').attr('disabled', false);
    }

    if (process)
        $.ajax({
            url: `${base_url}report`,
            method: "POST",
            data: form_data,
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                $(`${class_table}`).html(response.data);
            }
        });
}