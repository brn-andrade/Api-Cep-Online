<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>API CEP Online!</title>
        <link rel="stylesheet" type="text/css" href="resource/css/style.min.css">
    </head>
    <body>
        <div class="container">
            <br>
            <br>
            <h1>Busca Cep Online</h1>
            <hr>
            <br>
            <form class="form-horizontal">
                <div id="divCep" class="form-group">
                    <label class="col-md-2 control-label">CEP</label>
                    <div class="col-md-5">
                        <input id="cep" name="cep" type="text" placeholder="Ex: 00000-000" class="form-control" required>
                    </div>
                    <a type="button" id="buscaCep" onclick="buscaCep()" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Pesquisando" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Buscar CEP</a>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Endereço</label>
                    <div class="col-md-5">
                        <input id="logradouro" name="endereco" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Complemento </label>
                    <div class="col-md-2">
                        <input id="Complemento" name="complemento" placeholder="Ex: bl 6 Ap 33" type="text" class="form-control">
                    </div>
                    <label class=" col-md-1 control-label">Número</label>
                    <div class="col-md-2">
                        <input id="numero" maxlength="5" name="numero" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Bairro</label>
                    <div class="col-md-5">
                        <input id="bairro" name="bairro" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Cidade </label>
                    <div class="col-md-3">
                        <input id="cidade" name="cidade" type="text" class="form-control">
                    </div>
                    <label class=" col-md-1 control-label">Estado</label>
                    <div class="col-md-1">
                        <input id="estado" maxlength="5" name="estado" type="text" class="form-control">
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
<script type="text/javascript" src="resource/js/script.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#cep').keypress(function (e) {
            if (e.which == 13) {
                buscaCep();
                return false;
            }
        });
        $('#cep').mask('99999-999');
    });

    function buscaCep() {
        var cep = $('#cep').val().replace('-', '');
        if (!cep){
            return validaCep()
        }else {
            $('#buscaCep').button('loading');
            $.ajax({
                url: 'http://correiosapi.apphb.com/cep/'+cep,
                dataType: 'jsonp',
                crossDomain: true,
                contentType: "application/json",
                statusCode: {
                    200: function(response) {
                        $("#logradouro").val(response.logradouro);
                        $("#estado").val(response.estado);
                        $("#bairro").val(response.bairro);
                        $("#cidade").val(response.cidade);
                        $("#logradouro").prop('disabled', true);
                        $("#estado").prop('disabled', true);
                        $("#bairro").prop('disabled', true);
                        $("#cidade").prop('disabled', true);
                        $("#divCep").removeClass('has-error');
                        $('#buscaCep').button('reset')
                    }
                    ,400: function() {
                        swal('Erro!','Erro na busca do CEP.','error');
                        $('#buscaCep').button('reset')
                    }
                    ,404: function() {
                        $("#cep").focus();
                        swal('Erro!', 'CEP não encontrado.', 'error');
                        $("#divCep").addClass('has-error');
                        $('#buscaCep').button('reset')
                    }

                }
            });
        }
    }

    function validaCep() {
        $("#cep").focus();
        $("#divCep").addClass('has-error');
        swal('Erro!', 'Digite um CEP', 'error')
    }

    function pesquisar() {
        $('#buscaCep').on('click', function() {
            var $this = $(this);
            $this.button('loading');
            setTimeout(function() {
                $this.button('reset');
            }, 5000);
        });
    }





</script>