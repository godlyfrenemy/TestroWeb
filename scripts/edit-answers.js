$(document).ready(function(){
    function changeAnswers(data){
        $.post('utils/remove-answers.php', data);
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
            $('#answers').html(resultHTML).show();
        });
    }

    $('#answers').on("click", ".assign-answer", function(e){
        e.preventDefault();
        var data = {
            'answer': $(this).val(), 
            'question': $("#question-" + $(this).val()).val() 
        };
        console.log(data);
        changeAnswers(data);
        showAnswers(data);
    });
});