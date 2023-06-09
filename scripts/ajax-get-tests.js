$(document).ready(function(){
    $('body').on("click", "#find-test-submit", function(e){
        e.preventDefault();
        var data = {
            'test-to-find': $('#test-to-find').val()
        };
        showTests(data);
    });
    $('body').on("click", "#refresh-test-submit", function(e){
        e.preventDefault();
        var data = {
            'test-to-find': ""
        };
        showTests(data);
        $('#test-to-find').val("");
    });
    $('body').on("click", ".showQRCode", function(e){
        e.preventDefault();
        Swal.fire({
            title: 'QR-код тесту',
            imageUrl: 'https://api.qrserver.com/v1/create-qr-code/?data=' + $(this).attr('id') + '&amp;size=150x150',
            imageWidth: 200,
            imageHeight: 200,
            imageAlt: 'QR Code',
            confirmButtonText: 'Закрити'
          })
    });
});

function isEmpty(value) {
    return typeof value == 'string' && !value.trim() || typeof value == 'undefined' || value === null;
}

function showTests(_data) {
    var resultHTML = "Error!";
    $.ajax({
        type: "POST",
        url: 'utils/load-tests.php',
        data: _data,
        success: function(data) {               
            resultHTML = data;

            if(isEmpty(resultHTML))
                resultHTML = "<h3>Жодного тесту не зайдено</h3>";

            $('#tests_list').html(resultHTML).show();
        }
    }).done(function(){      
        $('#tests_list').html(resultHTML).show();
    });
}
function isEmpty(value) {
    return typeof value == 'string' && !value.trim() || typeof value == 'undefined' || value === null;
}

function showTestResults(_data) {
    var resultHTML = "Error!";
    $.ajax({
        type: "POST",
        url: 'utils/load-test-results.php',
        data: _data,
        success: function(data) {
            resultHTML = data;

            if(isEmpty(resultHTML))
                resultHTML = "<h3 class='first-item'>Жодного результату не зайдено</h3>";

            $('#test-results-list').html(resultHTML).show();
        }
    }).done(function(){
        $('#test-results-list').html(resultHTML).show();
    });
}