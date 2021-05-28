$(function () {
    $("#user-profile").on('click', function() {
        var a = $($(this)).closest('.ml-3.relative').find('.dropdown');
        a.toggleClass('user-not-active-dropdown');
        a.toggleClass('user-active-dropdown');

    })

    $(".nav-menu").on('click', function(){
        var a = $(this).children('svg');
        for (var i=0; i< a.length; i++){
            $(a[i]).toggleClass('block');
            $(a[i]).toggleClass('hidden');
        }

        if ($(a[1]).hasClass('block')){
            $("#mobile-menu").addClass('block')
            $("#mobile-menu").removeClass('hidden')
        } else {
            $("#mobile-menu").addClass('hidden')
            $("#mobile-menu").removeClass('block')
        }

        
            
    })
});