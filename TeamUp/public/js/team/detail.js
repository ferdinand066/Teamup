$(function () {
    $("#expanded-button").on('click', function(){
        var a = $($(this).children('p')[0]);
        if (a.html() == 'Read the detail'){
            a.html('Hide the detail');
        } else a.html('Read the detail');
        
        $("#expanded").toggleClass('hidden');
    })

    $('.remove-btn').on('click', function(){
        Setup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var container = $(this).closest('.card-container');

        var team_id = $("#team_id").val();
        var user_id = $(this).closest('div').find('input').val();

        $.ajax({
            type: "POST",
            url: "/team/detail/remove-member",
            data: {
                'team_id': team_id,
                'user_id': user_id
            },
            success: function (response) {
                if (response.status == 'Successfully decline the user'){
                    container.remove();
                    addNewNotification('Success', 'Successfully Remove', 'Your response will be sent to the applicant');
                }
            }
        });
    })

    $('.accept-btn').on('click', function(){
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var image_status = $(this).closest('.card-container').find('.picture-container').children()[0].nodeName;

        console.log(image_status);

        var userlist_container = $('#user-list-container');
        var container = $(this).closest('.card-container');

        var team_id = $("#team_id").val();
        var user_id = $(this).closest('div').find('input').val();

        var data = `<li>
        <div class="space-y-4">
            ${ (image_status == 'svg') ? 
            `<svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto" viewBox="2 2 16 16" fill="rgba(55, 65, 81, var(--tw-bg-opacity))">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
            </svg>` : 
            `<img class="h-20 w-20 mx-auto rounded-full" src="${ $(this).closest('.card-container').find('.picture-container').children()[0].src() }" alt="">` }
          <div class="space-y-2">
            <div class="text-xs font-medium lg:text-sm">
              <h3>${ $(this).closest('.card-container').find('.member-name').html() }</h3>
              <p class="text-indigo-600">${ $(this).closest('.card-container').find('.member-position').html() }</p>
            </div>
          </div>
        </div>
      </li>
        `

        $.ajax({
            type: "POST",
            url: "/team/detail/accept-member",
            data: {
                'team_id': team_id,
                'user_id': user_id
            },
            success: function (response) {
                userlist_container.append(data);

                container.remove();
                
                alert(response.status);
            }
        });
    })

});