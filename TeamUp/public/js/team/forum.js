$(function () {
    $("#submit-comment-button").on('click', function(){
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var container = $("#forum-container");

        var team_id = $("#team_id").val();
        var user_picture = $("#picture-comment").html();
        var content = $("#content").val();

        console.log(team_id)
        console.log(user_picture)
        console.log(content)
        $.ajax({
            type: "POST",
            url: '/team/forum/add',
            data: {
                'team_id': team_id,
                'content': content
            },
            success: function (response) {
                if (response.status == 'Successfully insert the comment'){
                    alert(response);
                    container.append(`
                    <li>
                    <div class="flex space-x-3">
                      <div class="flex-shrink-0">
                        ${ user_picture }
                      </div>
                      <div>
                        <div class="text-sm">
                          <a href="/profile/${user}" class="font-medium text-gray-900">${ response.name }</a>
                        </div>
                        <div class="mt-1 text-sm text-gray-700">
                          <p>${content}</p>
                        </div>
                        <div class="mt-2 text-sm space-x-2">
                          <span class="text-gray-500 font-medium">${ response.date }</span>
                          <span class="text-gray-500 font-medium">&middot;</span>
                          <button type="button" class="text-gray-900 font-medium">Reply</button>
                        </div>
                      </div>
                    </div>
                  </li>
                    `)

                    // addNewNotification('Success', 'Successfully Remove', 'Your response will be sent to the applicant');
                }
            }
        });
    })
});