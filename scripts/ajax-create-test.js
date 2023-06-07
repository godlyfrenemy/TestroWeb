$(document).ready(function(){

    function createTest(_data) {
        var test_id = -1;
        $.ajax({
            type: "POST",
            url: 'utils/create-test.php',
            data: _data,
            success: function(data) {               
                test_id = data;
            }
        }).done(function(){
            window.location.replace("test-page.php?testId=" + test_id);
        });
    }

    $('body').on("click", "#add-test-submit", function(e){
        e.preventDefault();
        createTest({});
    });
});