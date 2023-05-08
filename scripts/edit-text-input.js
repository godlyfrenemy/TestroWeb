$(document).ready(function() {
    function modify(_tableName, _result, _condition){
        $.ajax({
            type: "POST",
            url: 'utils/modify-row.php',
            data: {
                tableName: _tableName,
                result: _result,
                condition: _condition
            }
        });
    }

    $(".editable-test-name").on("focusout", function(event){
        var _tableName = 'tests';
        var _result = {
            name: 'test_name',
            value: $(this).val()
        };
        var _condition = {
            name: 'test_id',
            value: $(this).attr('id')
        };

        modify(_tableName, _result, _condition);
    });

    $(".editable-test-name").on("keydown", function(event){
        if(event.key == "Enter") {
            $(".editable-test-name").trigger("focusout");
        };
    });
});