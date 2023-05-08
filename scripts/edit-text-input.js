$(document).ready(function() {
    $(".editable-test-name").on("focusout", function(event){
        var _tableName = 'tests';
        var _result = {
            name: 'test_name',
            value: $(".editable-test-name").val()
        };
        var _condition = {
            name: 'test_id',
            value: $('#test-id').val()
        };

        $.ajax({
            type: "POST",
            url: 'utils/modify-row.php',
            data: {
                tableName: _tableName,
                result: _result,
                condition: _condition
            }
        });
    });

    $(".editable-test-name").on("keydown", function(event){
        if(event.key == "Enter") {
            $(".editable-test-name").trigger("focusout");
        };
    });
});