$(document).ready(function(){
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
});