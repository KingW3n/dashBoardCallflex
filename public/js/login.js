$('.formUser').submit(function(e){
    e.preventDefault();
    let emailValue = $('#InputEmail').val();
    let senhaValue = $('#InputPassword').val();
    let recaptchValue = grecaptcha.getResponse();
    let checkLembreMe = $("#customCheck").is(":checked");
    const token = document.querySelector(`input[name="_token"]`).value;
    let lbUrl = $('.lbUrl').html();
    let lbUrlHome = $('.lbUrlHome').html()

    if(validarEmail(emailValue) && recaptchValue !== "" && validarSenha(senhaValue)){
        let formDados = new FormData();
        formDados.append('email',emailValue);
        formDados.append('senha',senhaValue);
        formDados.append('recaptch',recaptchValue);
        formDados.append('check',checkLembreMe);
        formDados.append('_token',token);

        $.ajax({
            url:lbUrl,
            type:"post",
            data: $(this).serialize(),
            dataType: 'json',
            cache : false,
            processData: false,
            beforeSend: function () {
                $("#boxloadingTela").css({'display':'block'});
            },
            success:function(response) {
                $("#boxloadingTela").css({'display':'none'});
                if(response.login==true){
                    window.location.href=lbUrlHome;
                }else{
                    alertDanger(response.mensagem);
                }
            }

        })
    }

    //invalid email
    if(!validarEmail(emailValue) ){
        $('#InputEmail').addClass("is-invalid");
    }else{
        $('#InputEmail').removeClass("is-invalid");
    }

    //invalid recaptch
    if(recaptchValue === ""){
        alertDanger("Para prosseguir responda o reCAPTCHA")
    }

    //invalid senha
    if(!validarSenha(senhaValue)){
        $('#InputPassword').addClass("is-invalid");
    }else{
        $('#InputPassword').removeClass("is-invalid");
    }
})



    function validarEmail(field) {
        usuario = field.substring(0, field.indexOf("@"));
        dominio = field.substring(field.indexOf("@")+ 1, field.length);
        if ((usuario.length >=1) &&
            (dominio.length >=3) &&
            (usuario.search("@")==-1) &&
            (dominio.search("@")==-1) &&
            (usuario.search(" ")==-1) &&
            (dominio.search(" ")==-1) &&
            (dominio.search(".")!=-1) &&
            (dominio.indexOf(".") >=1)&&
            (dominio.lastIndexOf(".") < dominio.length - 1))
            {
                return true;
            }else{
                return false;
            }
    }
    function validarSenha(senha) {
        if(senha.length >6){
            return true;
        }else{
            return false;
        }
    }

    function alertDanger(mensagem) {
        $('.alert-danger p').html(mensagem);
            $('.alert-danger').css({'display':'block'});
        setTimeout(function(){
            $('.alert-danger p').html('');
            $('.alert-danger').css({'display':'none'});
        },4000)
    }
