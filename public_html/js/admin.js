$(function () {
    var href = window.location.href;
    var i = 0;
    $.each($('.nav-main li a'), function (index, value) {
        if(href == value.href)
        {
            console.log(i);
            $('.nav-main li').eq(i - 1).addClass('open');
            $(value).addClass('active');
        }
        i++;
    });

});