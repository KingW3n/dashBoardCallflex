<div id="boxloadingTela">
    <div class="c-loader"></div>
    <img src="{{asset('img/LogoCallflex verde.png')}}">
</div>
<style>
    #boxloadingTela{position: fixed;top: 0;width: 100%;height: 100vh;background-color: rgb(0, 0, 0,0.4);z-index: 999; display: none;}
    #boxloadingTela img{position: absolute;top: calc(50% - 35px);left: calc(50% - 50px);width: 100px;}
    .c-loader {border: 6px solid #e5e5e5;border-top-color: #017B80;height: 100px;width: 100px;position: absolute;top: calc(50% - 75px);left: calc(50% - 75px); }
    .c-loader {animation: is-rotating 1s infinite;border: 6px solid #e5e5e5;border-radius: 50%;border-top-color: #017B80;height: 150px;width: 150px;}
    @keyframes is-rotating{to{transform: rotate(1turn);}}
</style>
