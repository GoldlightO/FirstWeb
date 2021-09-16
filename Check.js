let table = document.getElementById("tbody");
$(document).ready(function() {
    $('[data-submit]').on('click', function(e) {
        let x = document.getElementById("x");
        let y = document.getElementById("y").value;
        let r = document.getElementById("r").value;
        function isValuesValid() {
            let isOK = true
            if (x.value >= 5) {
                alert("X выходит за пределы!");
                isOK = false;
            }else if (x.value <= -3) {
                alert("X выходит за пределы!");
                isOK = false;
            }else if (x.value === null) {
                alert("X выходит за пределы!");
                isOK = false;
            }else if(!x.value){
                alert("X не введён!");
                isOK = false;
            }
            return isOK;
        }
        e.preventDefault();
        if (isValuesValid()===true) {
            $.ajax({
                url: "Script.php",
                async: true,
                type: "GET",
                data: {
                    "x": x.value,
                    "y": y,
                    "r": r
                },
                cache: false,
                success: function (response) {
                    let table = document.getElementById("tbody");
                    table.insertAdjacentHTML('beforeend', response);
                },
                error: function (jqXHR, exception) {
                    var msg;
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
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
        $.ajax({
            url: "DeleteResult.php",
            async: true,
            type: "GET",
            data: {},
            cache: false,
            success: function() {
                table.innerHTML = `
                <tr class="tbodyheader">
                    <th>X</th>
                    <th>Y</th>
                    <th>R</th>
                    <th>Результат</th>
                    <th>Время</th>
                </tr>
                `
            },
            error: function(xhr) {

            }
        });
    })
})
