$('.forgotUser').submit(function(e){
    e.preventDefault();
    let emailValue = $('#exampleInputEmail').val();
    const token = document.querySelector(`input[name="_token"]`).value;
    let lbUrl = $('.lbUrl').html();
    let formDados = new FormData();
    formDados.append('email',emailValue);
    formDados.append('_token',token);
    $.ajax({
        url:lbUrl,
        type:"post",
        data: $(this).serialize(),
        dataType: 'json',
        cache : false,
        processData: false,
        success:function(response) {
            if(response.login==true){
                window.location.href=lbUrlHome;
            }else{
                alertDanger(response.mensagem);
            }
        }
    })
})
