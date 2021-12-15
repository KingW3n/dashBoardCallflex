//Abrir modal convidar user
function funConvidarUser(){
    $('#modalConvidarUsuarios').modal('show');
}

function alertDanger(mensagem) {
    $('.alert-danger p').html(mensagem);
        $('.alert-danger').css({'display':'block'});
    setTimeout(function(){
        $('.alert-danger p').html('');
        $('.alert-danger').css({'display':'none'});
    },4000)
}
function alertSucess(mensagem) {
    $('.alert-success p').html(mensagem);
        $('.alert-success').css({'display':'block'});
    setTimeout(function(){
        $('.alert-success p').html('');
        $('.alert-success').css({'display':'none'});
    },4000)
}


//enviar e-mail convite
$('.formModalConvidarFuncionario').submit(function(e){
    e.preventDefault();
    let email = $("#emailConvdar").val();
    if(email.includes('@callflex.net.br')){
        alert($("#emailConvdar").val() +"sim");
        $.ajax({
            url: $("#LinkBaseSite").val()+'/convite',
            type:"POST",
            data: $(this).serialize(),
            dataType: 'json',
            cache : false,
            beforeSend: function() {
                $("#boxloadingTela").css({'display':'block'});
            },
            success:function(response) {
                if(response.status == true){
                    $("#idCategoria").val("");
                    alertSucess(response.mensagem)
                }else{
                    alertDanger(response.mensagem)
                }
                $("#boxloadingTela").css({'display':'none'});
            }
        })
    }else{
        alertDanger("O usuario Não foi convidado o acesso dever ser do domino @callfelx.net.br");
    }
})


//Form cadastrar senha
$('.formNovaSenha').submit(function(e){
    e.preventDefault();
    if(verifiqueSenha($('#inputSenha').val()) && $("#inputConfirmarSenha").val() === $('#inputSenha').val()){
        let lbUrl = $('.lbUrl').val();
        let lbEnterCode= $('.lbEnterCode').val();
        $.ajax({
            url:lbUrl,
            type:"post",
            data: $(this).serialize(),
            dataType: 'json',
            cache : false,
            processData: false,
            beforeSend: function() {
                $("#boxloadingTela").css({'display':'block'});
            },
            success:function(response) {
                $("#boxloadingTela").css({'display':'none'});
                if(response.validacao == false){
                    alertDanger(response.mensagem);
                }else{
                    window.location.href=lbEnterCode;
                }
                console.log(response);
            }

        })
    }else{
        alertDanger("Verifique se a senha se enquadra no padrão e tente novamente. ")
    }

})

$('#inputSenha').keyup(function() {
    if(verifiqueSenha($('#inputSenha').val())){
        $('#inputSenha').removeClass("is-invalid");
    }else{
        $('#inputSenha').addClass("is-invalid");
    }
})

$('#inputConfirmarSenha').keyup(function() {
    if($("#inputConfirmarSenha").val() === $('#inputSenha').val()){
        $('#inputConfirmarSenha').removeClass("is-invalid");
    }else{
        $('#inputConfirmarSenha').addClass("is-invalid");
    }
})

function verifiqueSenha(value) {
    let resposta = true;
    if(! /[a-z]/gm.test(value)){
        resposta = false;
      }
      if(! /[0-9]/gm.test(value)){
       resposta = false;
      }
      if(! /[A-Z]/gm.test(value)){
       resposta = false
      }
      if(! /[!@#$%*()_+^&{}}:;?.]/gm.test(value)){
       resposta = false;
      }
      if(value.length<8){
          resposta = false;
      }

      return resposta;
}

function alertDanger(mensagem) {
    $('.alert-danger p').html(mensagem);
        $('.alert-danger').css({'display':'block'});
    setTimeout(function(){
        $('.alert-danger p').html('');
        $('.alert-danger').css({'display':'none'});
    },4000)
}
