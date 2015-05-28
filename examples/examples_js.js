// Javascript for examples page

$(document).ready(function(){
    $('.show-output').click(function(){
        var caret = $(this).children('i');
        var pre = $(this).parent();
        if(caret.hasClass('fa-caret-down')){
            caret.removeClass('fa-caret-down').addClass('fa-caret-up');
            pre.css('border-radius', '4px 4px 0 0');
            pre.next('pre').slideDown();
        } else {
            pre.next('pre').slideUp(400, function(){
                caret.removeClass('fa-caret-up').addClass('fa-caret-down');
                pre.css('border-radius', '4px');
            });
        }
    });
});
