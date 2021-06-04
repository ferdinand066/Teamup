<li>
    <div class="flex space-x-3">
      <div class="flex-shrink-0">
          @if($forum->picture_path == null)
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="2 2 16 16" fill="rgba(55, 65, 81, var(--tw-bg-opacity))">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
            </svg>
          @else
            <img class="h-10 w-10 rounded-full" src="{{ asset('images/profile/' . $forum->picture_path) }}" alt="">
          @endif
      </div>
      <div>
        <div class="text-sm">
          <a href="{{ route('profile', $forum->user_id) }}" class="font-medium text-gray-900">{{$forum->name}}</a>
        </div>
        <div class="mt-1 text-sm text-gray-700">
          <p>{{$forum->content}}</p>
        </div>
        <div class="mt-2 text-sm space-x-2">
          <span class="text-gray-500 font-medium">{{ time_elapsed_string($forum->created_at) }}</span>
          <span class="text-gray-500 font-medium">&middot;</span>
          <button type="button" class="text-gray-900 font-medium">Reply</button>
        </div>
      </div>
    </div>
  </li>