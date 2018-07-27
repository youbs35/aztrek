$(document).ready(function(){
    
    $("select").select2();
    $("table").DataTable();
    $("textarea").summernote();
    
    // Confirmation sur suppression
    $(".form-delete").submit(function(event) {
        var reponse = confirm("Êtes-vous certain ?");
        if (!reponse) {
            event.preventDefault();
        }
    });
    
});