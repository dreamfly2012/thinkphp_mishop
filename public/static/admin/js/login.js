
//刷新验证码
$('.LoginForm-code img').click(function(){
    var src = "/captcha";
    $(this).attr('src', src + '?verify=' + Math.random());
});

//回车提交表单
$("input[name=iver]").keydown(function(event){
    if(event.keyCode == 13){

        $('.js-submit').trigger('click');
    };
});

//提交表单
$('.js-submit').click(function(){

    //检验用户名和密码是否为空
    var user = $('input.form-control.signin').val();
    var password = $('input[name="password"]').val();
    if(user == false || password == false){
        layer.msg('用户名或密码不能为空！', {icon:2, time:1500});
        return false;
    };

    //检验验证码是否为空
    var iver = $('input[name=iver]').val();
    if(iver == false){
        layer.msg('验证码不能为空！', {icon:2, time: 1500});
        return false;
    };

    //ajax提交表单
    $.ajax({
        url:"/admin/login/",
        type: "post",
        data: $('#myForm').serialize(),
        dataType: "json",
        success:function (data) {

            if(data.status == 200){

                layer.msg(data.msg, {icon: 1, time:1500, btnAlign: 'c'}, function(index){

                    layer.close(index);
                    location.href = data['url'];
                });
            }else{

                layer.msg(data,{icon:2, time:1500});

                $('.LoginForm-code img').trigger('click');
            }
        }

    });
});