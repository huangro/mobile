/**
 * actions
 */

var count = 0;
var secs = 30;
var total = 0;
var max = 10;
var timer_id = null;
var resumes = null;

function display() {
    if (total > 0) {
        var index = Math.ceil(Math.random()*total) - 1;
        var obj = resumes[index];
        fill(obj);
        /*if (count > secs) {
            stop();
        }*/
        count += 1;
    }
}

function fill(obj) {
    $('.display').text(obj.name + '        ' + obj.mobile.substring(0,3)+'****'+obj.mobile.substring(7,11));
}

function stop() {
    if (timer_id != null) {
        clearInterval(timer_id);
    }
    timer_id = null;
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

function make_draw() {
    var url = '/chinahr/gateway.php?method=get_unhits';
    if ($('.content .record').length >= max) {
        show_msg('抽奖名额已满');
        return false;
    }
    $.getJSON(url, function(data){
        total = data.length;
        if (total == 0) {
            show_msg('抽奖名额不足');
            return false;
        }
        resumes = data;
        if (timer_id == null) {
            timer_id = setInterval(function(){
                display();
            }, 100);
        }
    });
}

function append_hit_item(item) {
    var record = '<div class="record"><div class="c1"><span class="value">';
    record += item.name;
    record += '</span></div><div class="c2"><span class="value">';
    record += item.mobile.substring(0,3)+'****'+item.mobile.substring(7,11);
    record += '</span></div></div>';
    $('.content').append(record);
}

function get_hit_list() {
    var url = '/chinahr/gateway.php?method=get_hits';
    $.getJSON(url, function(data){
        $.each(data, function(i, item){
            append_hit_item(item);
        });
    });
}

function get_draw_record() {
    var url = '/chinahr/gateway.php?method=draw';
    $.getJSON(url, function(data){
        if (data.code == '-1') {
            if (data.msg == 'max') {
                show_msg('抽奖名额已满');
            }
            else {
                show_msg('抽奖名额不足');
            }
            return false;
        }
        stop();
        fill(data);
        append_hit_item(data);
    });
}

function init() {
    get_hit_list();
}

$(function(){
    $('#start_btn').click(function(){
        stop();
        timer_id = null;
        resumes = null;
        count = 0;
        total = 0;
        make_draw();
        return false;
    });
    $('#stop_btn').click(function(event) {
        if (timer_id != null) {
            get_draw_record();
        }
    });

    init();
});
