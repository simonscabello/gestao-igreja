$('#street').attr('readonly', true).css('background-color', '#f5f5f5');
$('#neighborhood').attr('readonly', true).css('background-color', '#f5f5f5');
$('#city').attr('readonly', true).css('background-color', '#f5f5f5');
$('#state').attr('readonly', true).css('background-color', '#f5f5f5');
$('#number').attr('readonly', true).css('background-color', '#f5f5f5');
$('#complement').attr('readonly', true).css('background-color', '#f5f5f5');

function limpaFormularioCep() {
    $("#street").val("").attr('readonly', true).css('background-color', '#f5f5f5');
    $("#neighborhood").val("").attr('readonly', true).css('background-color', '#f5f5f5');
    $("#city").val("").attr('readonly', true).css('background-color', '#f5f5f5');
    $("#state").val("").attr('readonly', true).css('background-color', '#f5f5f5');
    $('#number').attr('readonly', true).css('background-color', '#f5f5f5');
    $('#complement').attr('readonly', true).css('background-color', '#f5f5f5');
}

$("#zipcode").blur(function () {
    let cep = $(this).val().replace(/\D/g, '');
    if (cep !== "") {
        let validacep = /^[0-9]{8}$/;
        if (validacep.test(cep)) {
            $("#street").val("...");
            $("#neighborhood").val("...");
            $("#city").val("...");
            $("#state").val("...");

            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {
                if (!("erro" in dados)) {
                    $("#street").val(dados.logradouro).attr('readonly', false).css('background-color', '#ffffff');
                    $("#neighborhood").val(dados.bairro).attr('readonly', false).css('background-color', '#ffffff');
                    $("#city").val(dados.localidade).attr('readonly', false).css('background-color', '#ffffff');
                    $("#state").val(dados.uf).attr('readonly', false).css('background-color', '#ffffff');
                    $('#number').attr('readonly', false).css('background-color', '#ffffff').focus();
                    $('#complement').attr('readonly', false).css('background-color', '#ffffff');
                } else {
                    limpaFormularioCep();
                    swal.fire({
                        title: 'Ocorreu um erro!',
                        text: "Formato de CEP inválido",
                        type: 'warning',
                    });
                }
            });
        } else {
            limpaFormularioCep();
            swal.fire({
                title: 'Ocorreu um erro!',
                text: "Formato de CEP inválido",
                type: 'warning',
            });
        }
    } else {
        swal.fire({
            title: 'Ocorreu um erro!',
            text: "Formato de CEP inválido",
            type: 'warning',
        });
        limpaFormularioCep();
    }
});
