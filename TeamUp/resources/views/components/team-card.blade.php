<div class="team-card border border-gray-200 rounded-lg shadow-sm divide-y divide-gray-200">
    <div class="p-6">
      <h2 class="text-lg sm:text-xl leading-6 font-medium text-gray-900 font-semibold">{{ $t->name }}</h2>
      <p class="text-gray-800 text-sm">{{ $t->creator_name }}</p>
      <p class="mt-4 text-sm text-gray-500">{{ $t->short_description }}</p>
      <p class="mt-8">
        <span class="text-4xl font-extrabold text-gray-900"> {{ '$'. number_format($t->salary) }}</span>
        <span class="text-base font-medium text-gray-500">/mo</span>
      </p>
      <a href="/team/view/{{ $t->id }}" class="mt-8 block w-full bg-indigo-500 border rounded-md py-2 text-sm font-semibold text-white text-center hover:bg-indigo-700">View Detail</a>
    </div>
    <div class="pt-6 pb-8 px-6">
      <h3 class="text-xs font-medium text-gray-900 tracking-wide uppercase">Position Needed</h3>
      <ul class="mt-6 space-y-4">
          @foreach (json_decode($t->position_list) as $key => $value)
          <li class="flex space-x-3">
              <!-- Heroicon name: solid/check -->
              <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
              </svg>
              <span class="text-sm text-gray-500">{{$position[array_search($value->id, $idx)]['name'] }}</span>
            </li>
          @endforeach
      </ul>
    </div>
  </div>