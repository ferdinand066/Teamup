$(function () {
    $("#search-button").on('click', function(){
        var search = $("#search").val().trim();
        if(search == "") window.location.href = '/team';
        
        else if($("#search_by").val() == "team-name"){
            var a = new URLSearchParams({
                team_name: search
            })
            window.location.href = '/team?' + a.toString();
        } else if ($("#search_by").val() == "position-name"){
            var a = new URLSearchParams({
                position_name: search
            })
            window.location.href = '/team?' + a.toString();
        } else if ($("#search_by").val() == "creator-name"){
            var a = new URLSearchParams({
                creator_name: search
            })
            window.location.href = '/team?' + a.toString();
        }
        
    })


    $(".team-card").hover(function(){
        $(this).toggleClass('animate__animated').toggleClass('animate__headShake');
    })
});