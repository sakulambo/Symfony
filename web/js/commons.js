/**
 * Created by kevin on 30/06/17.
 */
$(document).on("click", ".button_delete", function () {
    var clientIdUrl = $(this).data('client-id-url');    
    $("#formConfirmDelete").attr("action", clientIdUrl);
});








