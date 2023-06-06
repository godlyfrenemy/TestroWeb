$(document).ready(function(){
    function changeAnswers(_data){
        $.ajax({
            type: "POST",
            url: 'utils/ajax-change-correct-answer.php',
            data: _data
        }).done(function(){
            showAnswers(_data);
        });
    }

    function addAnswer(_data){
        $.ajax({
            type: "POST",
            url: 'utils/add-question-answer.php',
            data: _data
        }).done(function(){
            showAnswers(_data);
        });
    }

    function showAnswers(_data) {
        var resultHTML = "Error!";
        $.ajax({
            type: "POST",
            url: 'utils/ajax-print-answers.php',
            data: _data,
            success: function(data) {               
                resultHTML = data;
                $('#answers-' + _data['question']).html(resultHTML).show()
            }
        }).done(function(){      
            $('#answers-' + _data['question']).html(resultHTML).show();
        });
    }

    $('body').on("click", ".assign-answer", function(e){
        e.preventDefault();
        var data = {
            'answer': $(this).val(), 
            'question': $("#question-answer-" + $(this).val()).val() 
        };
        changeAnswers(data);
    });

    $('body').on("click", ".add-answer", function(e){
        e.preventDefault();
        var data = {
            'question_id': $(this).attr("id"),
            'question': $(this).attr("id")
        };
        addAnswer(data);
    });
});