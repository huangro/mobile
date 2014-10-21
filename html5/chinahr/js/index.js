function check_name() {
    var name = $('#name').val();
    if (name.length < 1) {
        $('#name').css('border-color', '#ff0000');
        return false;
    }
    else {
        return true;
    }
}

function check_mobile() {
    var res = true;
    var mobile = $('#mobile').val();
    if (mobile.length != 11) {
        res = false;
    }
    if (!res) {
        $('#mobile').css('border-color', '#ff0000');
    }
    return res;
}

function show_msg(content) {
    var d = dialog({
        title: '提示', 
        content: content, 
        okValue: '确定', 
        ok: function() {
            this.close().remove();
            return false;
        }
    });
    d.showModal();
}

function check_mobile_exists() {
    var mobile = $('#mobile').val();
    var url = '/chinahr/gateway.php?method=check_mobile&mobile='+mobile;
    $.getJSON(url, function(data){
        if (data.code == '1') {
            $('#mobile').css('border-color', '#ff0000');
            show_msg('该手机号已经存在');
        }
        else {
            $('#register').submit();       
        }
    });
}

$(function(){
    $('#sign_btn').click(function(){
        var res = check_name();
        if (!res) {
            show_msg('请输入姓名！');
            return false;
        }
        else {
            $('#name').css('border-color', '#dad1ce');
        }
        var res = check_mobile();
        if (!res) {
            show_msg('请输入手机号码！');
            return false;
        }
        else {
            $('#mobile').css('border-color', '#dad1ce');
        }
        check_mobile_exists();
    });
});
