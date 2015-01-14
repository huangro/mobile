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

function check_address() {
    var address = $('#address').val();
    if (address.length < 1) {
        $('#address').css('border-color', '#ff0000');
        return false;
    }
    else {
        return true;
    }
}

function check_tel() {
    var mobile = $('#tel').val();
    if (mobile.length < 1) {
        $('#tel').css('border-color', '#ff0000');
        return false;
    }
    else {
        return true;
    }
}

function check_qq() {
    var qq = $('#qq').val();
    if (qq.length < 1) {
        $('#qq').css('border-color', '#ff0000');
        return false;
    }
    else {
        return true;
    }
}

function check_business() {
    var business = $('#business').val();
    if (business.length < 1) {
        $('#business').css('border-color', '#ff0000');
        return false;
    }
    else {
        return true;
    }
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

$(function(){
    $('#sign_btn').click(function(){
        var res = check_name();
        if (!res) {
            show_msg('请输入银行名称！');
            return false;
        }
        else {
            $('#name').css('border-color', '#dad1ce');
        }
        res = check_address();
        if (!res) {
            show_msg('请输入机构通信地址！');
            return false;
        }
        res = check_tel();
        if (!res) {
            show_msg('请输入电话号码！');
            return false;
        }
        else {
            $('#tel').css('border-color', '#dad1ce');
        }
        res = check_qq();
        if (!res) {
            show_msg('请输入QQ号码！');
            return false;
        }
        else {
            $('#qq').css('border-color', '#dad1ce');
        }
        res = check_business();
        if (!res) {
            show_msg('请输入业务范围！');
            return false;
        }
        else {
            $('#business').css('border-color', '#dad1ce');
        }
        $('#register').submit();
    });
});
