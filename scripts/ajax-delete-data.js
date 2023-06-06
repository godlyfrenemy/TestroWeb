$(document).ready(function() {   
    function deleteData(object, name, _tableName, _condition, afterSuccess) {
        Swal.fire({
          title: 'Ви впевнені?',
          text: name + " буде неможливо відновити!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Так, видаліть вже його!',
          cancelButtonText: 'Відмінити'
        }).then((result) => {
            if (result.isConfirmed){
                $.ajax({
                    type: "POST",
                    url: 'utils/delete-row.php',
                    data: {
                        tableName: _tableName,
                        condition: _condition
                    },
                    success: afterSuccess
                });
            }
        });
    }

    $(".delete-question").on("click", function(event){
        var _tableName = 'questions';
        var _condition = {
            name: 'question_id',
            value: $(this).attr('id')
        };

        var message = "Запитання";
        deleteData($(this), message, _tableName, _condition, function() {
            window.location.reload();
        });
    });

    $(".delete-test").on("click", function(event){
        var _tableName = 'tests';
        var _condition = {
            name: 'test_id',
            value: $(this).attr('id')
        };

        var message = "Тест";
        deleteData($(this), message, _tableName, _condition, function(){
            window.location.replace("cabinet.php");
        });
    });

    $('body').on("click", ".delete-answer", function(e){
        e.preventDefault();

        var elementToDelete = "#answer-element-" + $(this).val();
        var questionId = $(this).closest(".question-data").attr('id').replace("answers-", "");

        $.ajax({
            type: "POST",
            url: 'utils/delete-row.php',
            data: {
                tableName: 'answers',
                condition: {
                    name: 'answer_id',
                    value: $(this).val()
                }
            },
            success: function(data) {
                console.log(questionId);
                var data = {
                    'question': questionId
                };
                showAnswers(data);
            }
        });
    });
});