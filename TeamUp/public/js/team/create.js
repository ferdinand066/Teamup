$(function () {
    // $('.job-list').on('mouseenter', function(){
    //     $(this).width(($(this).width() + 20) + 'px');
    //     $(this).find('svg').toggleClass('hidden');
    // }).on('mouseleave', function(){
    //     $(this).width(($(this).width() - 20) + 'px');
    //     $(this).find('svg').toggleClass('hidden');
    // })

    // $('.job-list').hover(function(){
    //     $(this).find('svg').toggleClass('opacity-0');
    // });

    $('.job-container').delegate( '.job-list', 'mouseenter', function(){
        $(this).find('svg').toggleClass('opacity-0');
    }).delegate( '.job-list', 'mouseleave', function(){
        $(this).find('svg').toggleClass('opacity-0');
    });


    $('body').delegate('svg.h-5.w-5.mr-1', 'click', function(){
        $(this).closest('.job-list').remove();
    })

    $('#add-job').on('click', function(){
        var job_name = $("#position").find(":selected").text();
        var job_id = $("#position").find(":selected").val();

        var datas = $('input[name^="employee_list"]');

        for (var i=0; i < datas.length; i++){
            if($(datas[i]).val() == job_id) return;
        }

        $('.job-container').append(`
        <span class="job-list inline-flex items-center mx-0.5 my-1 px-4 pr-1 py-1 rounded-full text-sm font-medium text-indigo-800">
            <span class="mr-3"> ${ job_name } </span>
            <input type="hidden" name="position_list[]" value="${ job_id }">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 opacity-0" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </span>
        `);

    })
});