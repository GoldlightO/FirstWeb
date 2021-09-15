let r = document.getElementById("r");
let x = document.getElementById("x");
let y = document.getElementById("y");
let outputtable = document.getElementById("outputtable");

function isValuesValid() {
    let isOK = true
    if (x >= 5) {
        x.style.borderBottom = "1px solid red";
        $('#messageX').text("Некорректный ввод");
        isOK = false;
    } else if (x <= -3) {
        x.style.borderBottom = "1px solid red";
        $('#messageX').text("Некорректный ввод");
        isOK = false;
    }
    return isOK;
}

$(document).ready(function () {
    $('[data-submit]').on('click', function (e) {
        e.preventDefault();
        if (isValuesValid()) {
            $.ajax({
                url: "Script.php",
                async: true,
                type: "GET",
                data: {
                    "x": x.value,
                    "y": y.value,
                    "r": r.value
                },
                cache: false,
                success: function (response) {
                    let outputtable = document.getElementById("outputTable");
                    outputtable.insertAdjacentHTML('beforeend', response);
                },
                error: function (jqXHR, exception) {
                    let msg;
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status === 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status === 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    alert(msg);
                }
            });
        }
    })
});

$(document).ready(function () {
    $('[data-reset]').on('click', function (e) {
        e.preventDefault();
        console.log("here")
        $.ajax({
            url: "DeleteResult.php",
            async: true,
            type: "GET",
            data: {},
            cache: false,
            success: function () {
                outputtable.innerHTML = `
                <tr>
                    <th>X</th>
                    <th>Y</th>
                    <th>R</th>
                    <th>Результат</th>
                    <th>Время</th>
                </tr>
                `
            },
            error: function (xhr) {

            }
        });
    })
})

$(document).ready(function () {
    $.ajax({
        url: "Print.php",
        async: true,
        type: "GET",
        success: function (response){
            let table = document.getElementById("outputTable");
            table.insertAdjacentHTML('beforeend', response);
        }
    })
})