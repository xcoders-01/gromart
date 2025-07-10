const csl = (e) => console.log(e);
// reset form base on id
const resetForm = (form) => $(form)[0].reset();

function promptAction(question, id, param = null, action = null, param2 = null) {
    Swal.fire({
        title: "Anda yakin ?",
        html: question,
        icon: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#556EE6",
        cancelButtonColor: "#f46a6a",
        confirmButtonText: "Yes"
    }).then(function (t) {
        if (t.value)
            action == null ?
                nextProcess(id) : nextProcess(id, param, action, param2);
    });
}

function isNumberKey(evt) {
    $bool = false;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    let arr_char = [46];
    for (let i = 48; i <= 57; i++)
        arr_char.push(i);

    if (arr_char.includes(charCode))
        $bool = true;
    else
        $bool = false;
    return $bool;
}