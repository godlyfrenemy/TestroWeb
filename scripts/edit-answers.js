$(document).ready(function(){
    function changeAnswers(data){
        $.post('utils/ajax-change-correct-answer.php', data);
    }

    function showAnswers(_data) {
        var resultHTML = "Error!";
        $.ajax({
            type: "POST",
            url: 'utils/ajax-print-answers.php',
            data: _data,
            success: function(data) {               
                resultHTML = data;
            }
        }).done(function(){      
            $('#answers-' + _data['question']).html(resultHTML).show();
        });
    }

    $('body').on("click", ".assign-answer", function(e){
        e.preventDefault();
        console.log('start');
        var data = {
            'answer': $(this).val(), 
            'question': $("#question-answer-" + $(this).val()).val() 
        };
        console.log(data);
        changeAnswers(data);
        showAnswers(data);
    });
});