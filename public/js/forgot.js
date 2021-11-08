$('.forgotUser').submit(function(e){
    e.preventDefault();
    let lbUrl = $('.lbUrl').html();
    let lbEnterCode= $('.lbEnterCode').html();
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
            if(response.email == false){
                alertDanger(response.mensagem)
            }else{
                window.location.href=lbEnterCode;
            }
            console.log(response);
        }

    })
})

//Form Verificar codigo
$('.FormVerificarCodigo').submit(function(e){
    e.preventDefault();
    let lbUrl = $('.lbUrl').html();
    let lbEnterCode= $('.lbEnterCode').html();
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
            if(response.email == false){
                alertDanger(response.mensagem)
            }else{
                window.location.href=lbEnterCode;
            }
            console.log(response);
        }

    })
})

function alertDanger(mensagem) {
    $('.alert-danger p').html(mensagem);
        $('.alert-danger').css({'display':'block'});
    setTimeout(function(){
        $('.alert-danger p').html('');
        $('.alert-danger').css({'display':'none'});
    },4000)
}
