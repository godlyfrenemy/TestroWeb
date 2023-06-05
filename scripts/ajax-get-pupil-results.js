$(document).ready(function(){
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

    $('body').on("click", "#find-pupil-results-submit", function(e){
        e.preventDefault();
        var data = {
            'test-id' : $('#test-id').val(),
            'pupil-to-find': $('#pupil-to-find').val()
        };
        showTestResults(data);
    });
    $('body').on("click", "#refresh-pupil-results-submit", function(e){
        e.preventDefault();
        var data = {
            'test-id' : $('#test-id').val(),
            'pupil-to-find': ""
        };
        showTestResults(data);
        $('#pupil-to-find').val("");
    });
});