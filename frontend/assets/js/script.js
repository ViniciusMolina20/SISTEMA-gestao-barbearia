$(document).ready(function() {
    $("#adicionarClienteForm").submit(function(e) {
        e.preventDefault(); 

        $.ajax({
            type: "POST",
            url: "../../../ backend/adicionar-cliente.php", 
            data: $(this).serialize() + "&ajax=true", 
            success: function(response) {
                $("#mensagemServidor").html(response);
            },
            error: function(error) {
                console.log(error);
                $("#mensagemServidor").html("Erro ao processar a solicitação.");
            }
        });
    });
});
