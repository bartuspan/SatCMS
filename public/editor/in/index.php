<?php

/**
 * Login gate
 */

require '../../modules/core/loader.php';

    loader::bootstrap();
    core::get_instance(true);

    if (core::lib('auth')->logged_in()) {
        return functions::redirect('../');
    }

    $token = '<input type="hidden" name="x_token" value="' . core::lib('auth')->token() . '" />';
?>
<!DOCTYPE html>
<html>

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Панель управления сайтом</title>
<link href="/vendor/bootstrap/dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/vendor/toastr/toastr.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="/favicon.ico" type="image/x-icon" />


<style>

html,body {
    height:100%;
    background: url("/editor/templates/img/bg.png") repeat scroll 0 0 gray;
    margin:0;
    padding:0;
    overflow:hidden;
}

#frm-login {
    padding-top:30px;
    line-height:50px;
}

#user_cp_wrap {
    width:400px;
    height:420px;
    background:white;
    border-radius:10px;
    margin:200px auto;

    -webkit-box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.37);
    -moz-box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.37);
    box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.37);
}

#user_cp {

    width:100%;
    height:100%;

    padding:1px;
    margin:0;

    /*
    background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIxMDAlIiB5Mj0iMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzAwMDAwMCIgc3RvcC1vcGFjaXR5PSIwLjE0Ii8+CiAgICA8c3RvcCBvZmZzZXQ9IjExJSIgc3RvcC1jb2xvcj0iI2ZmZmZmZiIgc3RvcC1vcGFjaXR5PSIwLjE0Ii8+CiAgICA8c3RvcCBvZmZzZXQ9Ijg5JSIgc3RvcC1jb2xvcj0iI2ZmZmZmZiIgc3RvcC1vcGFjaXR5PSIwLjE1Ii8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiMwMDAwMDAiIHN0b3Atb3BhY2l0eT0iMC4xNSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
    background: -moz-linear-gradient(left,  rgba(0,0,0,0.14) 0%, rgba(255,255,255,0.14) 11%, rgba(255,255,255,0.15) 89%, rgba(0,0,0,0.15) 100%);
    background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(0,0,0,0.14)), color-stop(11%,rgba(255,255,255,0.14)), color-stop(89%,rgba(255,255,255,0.15)), color-stop(100%,rgba(0,0,0,0.15)));
    background: -webkit-linear-gradient(left,  rgba(0,0,0,0.14) 0%,rgba(255,255,255,0.14) 11%,rgba(255,255,255,0.15) 89%,rgba(0,0,0,0.15) 100%);
    background: -o-linear-gradient(left,  rgba(0,0,0,0.14) 0%,rgba(255,255,255,0.14) 11%,rgba(255,255,255,0.15) 89%,rgba(0,0,0,0.15) 100%);
    background: -ms-linear-gradient(left,  rgba(0,0,0,0.14) 0%,rgba(255,255,255,0.14) 11%,rgba(255,255,255,0.15) 89%,rgba(0,0,0,0.15) 100%);
    background: linear-gradient(to right,  rgba(0,0,0,0.14) 0%,rgba(255,255,255,0.14) 11%,rgba(255,255,255,0.15) 89%,rgba(0,0,0,0.15) 100%);
    */

    background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPHJhZGlhbEdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgY3g9IjUwJSIgY3k9IjUwJSIgcj0iNzUlIj4KICAgIDxzdG9wIG9mZnNldD0iMCUiIHN0b3AtY29sb3I9IiMwMDAwMDAiIHN0b3Atb3BhY2l0eT0iMC41Ii8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiMwMDAwMDAiIHN0b3Atb3BhY2l0eT0iMCIvPgogIDwvcmFkaWFsR3JhZGllbnQ+CiAgPHJlY3QgeD0iLTUwIiB5PSItNTAiIHdpZHRoPSIxMDEiIGhlaWdodD0iMTAxIiBmaWxsPSJ1cmwoI2dyYWQtdWNnZy1nZW5lcmF0ZWQpIiAvPgo8L3N2Zz4=);
    background: -moz-radial-gradient(center, ellipse cover,  rgba(0,0,0,0.5) 0%, rgba(0,0,0,0) 100%);
    background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,rgba(0,0,0,0.5)), color-stop(100%,rgba(0,0,0,0)));
    background: -webkit-radial-gradient(center, ellipse cover,  rgba(0,0,0,0.5) 0%,rgba(0,0,0,0) 100%);
    background: -o-radial-gradient(center, ellipse cover,  rgba(0,0,0,0.5) 0%,rgba(0,0,0,0) 100%);
    background: -ms-radial-gradient(center, ellipse cover,  rgba(0,0,0,0.5) 0%,rgba(0,0,0,0) 100%);
    background: radial-gradient(ellipse at center,  rgba(0,0,0,0.5) 0%,rgba(0,0,0,0) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#80000000', endColorstr='#00000000',GradientType=1 );


}

.form-control {
    margin: 0 auto;
}

</style>

<script type="text/javascript">
var _site_url = "/";
</script>

<script type="text/javascript" src="/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript" src="/vendor/jquery-form/jquery.form.js"></script>
<script type="text/javascript" src="/vendor/toastr/toastr.js"></script>

</head>
<body>

    <div id="user_cp" style="font-size:2em;text-align:center">
    <div id="user_cp_wrap">

            
    <form id="frm-login"
          method="post"
          action="/users/login/"
    >

    <h3>Панель управления</h3><br/>

    <div class="input-group-lg">
    <input required="required" style="width:300px;"
           class="form-control"
           name="login" type="text" value=""  placeholder="Логин"
           onfocus="this.value = '';"
           />   <br/>
    <input required="required" style="width:300px"
           class="form-control"
           name="password" type="password" value="" placeholder="Пароль"
           onfocus="this.value = '';"
           /> <br/>
    </div>

    <?=$token?>

    <input type="hidden" name="redirect" value="/editor/"/>
    <input type="submit" class="btn btn-primary btn-lg" value="Войти" />
    </form>
    
   
    


    </div>  
    </div>

<script>

    var lastAction = 0;
    var delay = 5000;

    $('#frm-login').on('submit', function(){

        var timer = (new Date()).getTime();

        if ($('input[name=login]').val().length < 3 || $('input[name=password]').val().length < 3) {
            toastr.error('Заполните поле логин+пароль');
            return false;
        }

        if (timer > (lastAction + delay)) {

            $('input[type=submit]').prop('disabled', true);
            lastAction = (new Date()).getTime();

            $(this).ajaxSubmit({dataType : 'json', success: function(data){
                $('input[type=submit]').prop('disabled', false);
                if (data.status) {
                    toastr.success(data.message);
                    window.location.href = data.redirect;
                } else {
                    toastr.error(data.message);
                }
            }});

            return false;
        } else {
            toastr.error('Подождите ' + Math.ceil((delay + lastAction - timer) / 1000) + ' секунд');
        }

        return false;
    });

</script>

</body>
</html>
