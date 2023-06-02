$(document).ready(function() {   
	$("#reg-log").on("click", function(event){
        $.cookie("on_register", $(this).is(":checked"));
    });

    $("#reg-log").prop("checked", $.cookie("on_register") === "true");
});