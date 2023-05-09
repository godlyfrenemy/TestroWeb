$(document).ready(function() {  
    function setColorDamping(object, color){
        object.css({'border-color': color + "0)"});
        setTimeout(() => { 
            object.css({'border-color': color + "255)"});
        }, 500);
    } 

    function colorDamping(object, color, originalColor){
        setColorDamping(object, color);
        setTimeout(() => { 
            setColorDamping(object, originalColor);
        }, 2500);
    }

    function modify(object, _tableName, _result, _condition){
        $.ajax({
            type: "POST",
            url: 'utils/modify-row.php',
            data: {
                tableName: _tableName,
                result: _result,
                condition: _condition
            },
            success: function(data){
                colorDamping(object, 'rgba(133,224,133,', 'rgba(0,0,0,');               
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

        modify($(this), _tableName, _result, _condition);
    });

    $(".editable-test-name").on("keydown", function(event){
        if(event.key == "Enter") {
            $(this).blur();
        };
    });

    $(".editable-answer-name").on("focusout", function(event){
       var _tableName = 'answers';
        var _result = {
            name: 'text',
            value: $(this).val()
        };
        var _condition = {
            name: 'answer_id',
            value: $(this).attr('id')
        };

        modify($(this), _tableName, _result, _condition);
    });

    $(".editable-answer-name").on("keydown", function(event){
        if(event.key == "Enter") {
           $(this).blur();
        };
    });

    $(".editable-question-name").on("focusout", function(event){
        var _tableName = 'questions';
        var _result = {
            name: 'question_name',
            value: $(this).val()
        };
        var _condition = {
            name: 'question_id',
            value: $(this).attr('id')
        };

        modify($(this), _tableName, _result, _condition);
    });

    $(".editable-question-name").on("keydown", function(event){
        if(event.key == "Enter") {
            $(this).blur();
        };
    });

    $(".close-module-window-button").on("click", function(event){
        window.location.reload();
    });
});