/* global notify, textUtils */

var Script = function () {
    $().ready(function () {

        $.validator.addMethod("requiredPassword", function (value, element) {
            return !($.trim(value) !== "" && !(value.length >= 10));
        }, "Favor insira pelo menos 10 caracteres");

        $("#form").validate({
            rules: {
                "cpf": {
                    cpf: true
                },
                "nome": {
                    minlength: 3,
                    maxlength: 50
                },
                "email": {
                    minlength: 10,
                    maxlength: 50,
                    audax: true
                },
                "senha": {
                    requiredPassword: true
                }
            },
            messages: {
                "nome": {
                    required: "Favor preencher esse campo",
                    minlength: "Por favor preencher esse campo com a quantidade de caracteres mínimo",
                    maxlength: "Por favor preencher esse campo com a quantidade de caracteres máximo"
                },
                "email": {
                    required: "Favor preencher esse campo",
                    email: "Favor preencher o campo com um e-mail válido",
                    minlength: "Por favor preencher esse campo com a quantidade de caracteres mínimo",
                    maxlength: "Por favor preencher esse campo com a quantidade de caracteres máximo"
                },
                "cpf": {
                    required: "Favor preencher esse campo",
                    cpf: "CPF inválido"
                }
            }
        });
    });

}();


$('select').select2({
    theme: "bootstrap",
    language: "pt-BR",
    multiple: false
});

$("[name='cpf']").mask('000.000.000-00', {reverse: true});