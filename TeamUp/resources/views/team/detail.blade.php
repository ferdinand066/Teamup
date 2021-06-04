@extends('layouts.app')

@section('title', 'Team Detail')

@section('style-script')
  <link rel="{{ asset('css/team/detail.css') }}" href="style.css">
  <script src="{{ asset('js/team/detail.js') }}"></script>
  <script src="{{ asset('js/team/forum.js') }}"></script>
@endsection

@section('content')
<?php 
    $position_list = array();
    $idx = array();
    foreach($position as $key => $value){
        $x['id'] = $value->id;
        $x['name'] = $value->name;
        array_push($position_list, $x);
        array_push($idx, $value->id);
    }

    $address = json_decode($data->address);

    $view_request_box = true;
    
    if(Auth::user() != null){
      foreach ($member as $m) {
        if ($m->user_id == Auth::user()->id){
          $view_request_box = false;
          break;
        }
      }
    }
  
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $now->setTimeZone(new DateTimeZone('Asia/Bangkok'));

        $ago = new DateTime($datetime, new DateTimeZone('Asia/Bangkok'));

        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

?>

<div class="min-h-screen bg-gray-100">
    <main class="py-10">
      <!-- Page header -->
      <input type="hidden" name="team_id" id="team_id" value="{{ request('id') }}">
      <div class="max-w-3xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between md:space-x-5 lg:max-w-7xl lg:px-8">
        <div class="flex items-center space-x-5">
          <div class="flex-shrink-0">
            <div class="relative">
              <a href="{{ route('profile', [$creator->id]) }}">
                @if($creator->picture_path != null)
                  <img class="h-16 w-16 rounded-full" src="{{ asset('images/profile/' . $creator->picture_path) }}" alt="">
                @else
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" viewBox="0 0 18 18" fill="rgba(55, 65, 81, var(--tw-bg-opacity))">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                </svg>
                @endif
                <span class="absolute inset-0 shadow-inner rounded-full" aria-hidden="true"></span>
              </a>
              
            </div>
          </div>
          <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $data->name }}</h1>
            <p class="text-sm font-medium text-gray-500">Made by : <a href="{{ route('profile', [$creator->id]) }}" class="text-gray-900">{{ $creator->name }}</a> on <time datetime="{{ date_format($data->created_at, 'Y-m-d') }}">{{ date_format($data->created_at, 'M d, Y') }}</time></p>
          </div>
        </div>
        @auth
          @can('update-profile', [$creator->id, Auth::user()->id])
            @if(!$data->is_closed)
              <div class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-reverse sm:space-y-0 sm:space-x-3 md:mt-0 md:flex-row md:space-x-3">
                <a href="{{ route('team.edit', request('id')) }}">
                  <button type="button" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
                    Edit Team
                  </button>
                </a>
                <form action="{{ route('team.close', request('id')) }}" method="post">
                  @csrf
                  <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
                    Close the Team</form>
                  </button>
                </form>
              </div>
            @endif
          @endcan
        @endauth
      </div>
  
      <div class="mt-8 max-w-3xl mx-auto grid grid-cols-1 gap-6 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense">
        <div class="space-y-6 lg:col-start-1 lg:col-span-2">
          <!-- Description list-->
          <section aria-labelledby="applicant-information-title">
            <div class="bg-white shadow sm:rounded-lg">
              <div class="px-4 py-5 sm:px-6">
                <h2 id="applicant-information-title" class="text-lg leading-6 font-medium text-gray-900">
                  General
                </h2>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                  General information about the team
                </p>
              </div>
              <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">
                      Position Needed
                    </dt>
                    @foreach (json_decode($data->position_list) as $key => $value)
                    <dd class="mt-1 text-sm text-gray-900 flex space-x-3 my-2.5">
                        <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span>{{$position_list[array_search($value->id, $idx)]['name'] }}</span>
                    </dd>
                    @endforeach
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">
                      Email address
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      {{ $creator->email }}
                    </dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">
                      Salary expectation
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ '$'. number_format($data->salary) }}
                    </dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">
                      Phone
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ $creator->phone }}
                    </dd>
                  </div>
                  <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">
                      About
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ $data->full_description}}
                    </dd>
                  </div>
                </dl>
              </div>
              <div id="expanded" class="hidden">
                <div class="px-4 py-5 sm:px-6">
                  <h2 id="applicant-information-title" class="text-lg leading-6 font-medium text-gray-900">
                    Detail
                  </h2>
                  <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Location and person in this team
                  </p>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                  <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-3">
                    <div class="sm:col-span-3">
                      <dt class="text-sm font-medium text-gray-500">
                        Street
                      </dt>
                      <dd class="mt-1 text-sm text-gray-900">
                        {{ $address->street }}
                      </dd>
                    </div>
                    <div class="sm:col-span-1">
                      <dt class="text-sm font-medium text-gray-500">
                        City
                      </dt>
                      <dd class="mt-1 text-sm text-gray-900">
                        {{ $address->city }}
                      </dd>
                    </div>
                    <div class="sm:col-span-1">
                      <dt class="text-sm font-medium text-gray-500">
                        State
                      </dt>
                      <dd class="mt-1 text-sm text-gray-900">
                          {{ $address->state }}
                      </dd>
                    </div>
                    <div class="sm:col-span-1">
                      <dt class="text-sm font-medium text-gray-500">
                        Postal Code
                      </dt>
                      <dd class="mt-1 text-sm text-gray-900">
                          {{ $address->postal_code }}
                      </dd>
                    </div>
                    <div class="sm:col-span-3">
                      <dd class="mt-1 text-sm text-gray-900">
                        <div class="bg-white">
                          <div class="mx-auto py-12 px-4 text-center sm:px-6 lg:px-8 lg:py-24">
                            <div class="space-y-8 sm:space-y-12">
                              <div class="space-y-5 sm:mx-auto sm:max-w-xl sm:space-y-4 lg:max-w-5xl">
                                <h2 class="text-3xl font-extrabold tracking-tight sm:text-4xl">The People</h2>
                                <p class="text-xl text-gray-500">These are person(s) who joined in this team</p>
                              </div>
                              <ul id="user-list-container" class="mx-auto grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 md:gap-x-6 lg:max-w-5xl lg:gap-x-8 lg:gap-y-12 xl:grid-cols-4">
                                <li>
                                  <div class="space-y-4">
                                    {{-- <img class="mx-auto h-20 w-20 rounded-full lg:w-20 lg:h-20" src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80" alt=""> --}}
                                    @if($creator->picture_path != null)
                                      <img class="h-20 w-20 mx-auto rounded-full" src="{{ asset('images/profile/' . $creator->picture_path) }}" alt="">
                                    @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto" viewBox="2 2 16 16" fill="rgba(55, 65, 81, var(--tw-bg-opacity))">
                                      <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                                    </svg>
                                    @endif
                                    <div class="space-y-2">
                                      <div class="text-xs font-medium lg:text-sm">
                                        <h3>{{ $creator->name }}</h3>
                                        <p class="text-indigo-600">Team Maker</p>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                                @foreach ($member as $m)
                                  @if($m->is_accepted)
                                  <li>
                                    <div class="space-y-4">
                                      @if($m->picture_path != null)
                                        <img class="h-20 w-20 mx-auto rounded-full" src="{{ asset('images/profile/' . $m->picture_path) }}" alt="">
                                      @else
                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto" viewBox="2 2 16 16" fill="rgba(55, 65, 81, var(--tw-bg-opacity))">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                                      </svg>
                                      @endif
                                      <div class="space-y-2">
                                        <div class="text-xs font-medium lg:text-sm">
                                          <h3>{{ $m->member_name }}</h3>
                                          <p class="text-indigo-600">{{ $m->position_name }}</p>
                                        </div>
                                      </div>
                                    </div>
                                  </li>
                                  @endif
                                @endforeach
                              </ul>
                            </div>
                          </div>
                        </div>
                      </dd>
                    </div>
                  </dl>
                </div>
              </div>

              <div id="expanded-button">
                <p class="block cursor-pointer bg-gray-50 text-sm font-medium text-gray-500 text-center px-4 py-4 hover:text-gray-700 sm:rounded-b-lg">Read the detail</p>
              </div>
            </div>
          </section>
  
          <!-- Comments-->
          <section aria-labelledby="notes-title">
            <div class="bg-white shadow sm:rounded-lg sm:overflow-hidden">
              <div class="divide-y divide-gray-200">
                <div class="px-4 py-5 sm:px-6">
                  <h2 id="notes-title" class="text-lg font-medium text-gray-900">Comments</h2>
                </div>
                <div class="px-4 py-6 sm:px-6">
                  <ul id="forum-container" class="space-y-8">
                    @if($forums != null)
                      @foreach ($forums as $forum)
                        <x-forum :forum="$forum"/>
                      @endforeach
                    @endif
                  </ul>
                </div>
              </div>
              <div class="bg-gray-50 px-4 py-6 sm:px-6">
                @auth
                <div class="flex space-x-3">
                  <div class="flex-shrink-0" id="picture-comment">
                    @if(!Auth::user()->picture_path)
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="2 2 16 16" fill="rgba(55, 65, 81, var(--tw-bg-opacity))">
                          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                      </svg>
                    @else
                      <img class="h-10 w-10 rounded-full" src="{{ asset('images/profile/' . Auth::user()->picture_path) }}" alt="">
                    @endif  
                  </div>
                  <div class="min-w-0 flex-1">
                    <form action="{{ route('forum.add') }}" method="POST">
                      @csrf
                      <input type="hidden" name="team_id" value="{{ request('id') }}">
                      <div>
                        <label for="content" class="sr-only">About</label>
                        <textarea id="content" name="content" rows="3" class="shadow-sm block w-full focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 rounded-md" placeholder="Add a note"></textarea>
                      </div>
                      <div class="mt-3 flex items-center justify-between">
                        <a href="#" class="group inline-flex items-start text-sm space-x-2 text-gray-500 hover:text-gray-900">
                          <!-- Heroicon name: solid/question-mark-circle -->
                          <svg class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                          </svg>
                          <span>
                            Some HTML is okay.
                          </span>
                        </a>
                        <button type="button" id="submit-comment-button" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                          Comment
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
                @else
                <div class="flex justify-end">
                  <a href="{{ route('login') }}">
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                      Login to Comment
                    </button>
                  </a>
                </div>
                @endauth
              </div>
            </div>
          </section>
        </div>

        <section aria-labelledby="request-position" class="lg:col-start-3 lg:col-span-1 space-y-8">
          @auth
            @cannot('update-profile', [$creator->id, Auth::user()->id])
              @if(!$data->is_closed && $view_request_box)
              <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
                <h2 id="timeline-title" class="text-lg font-medium text-gray-900">Request Position</h2>
                <div class="col-span-6">
                  <form action="{{ route('team.insert.detail', [request()->id]) }}" method="POST">
                    <label for="position" class="block text-sm font-medium text-gray-700">Choose the position that you are interested in in this team </label>
                    @error(['position', 'id'])
                    <p class="block text-sm font-medium text-red-500">{{ $message }}</p>
                    @enderror
                    <div class="mt-1 flex">
                      <select id="position" name="position" autocomplete="position" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach (json_decode($data->position_list) as $key => $value)
                          <option value="{{ $value->id }}"> {{$position_list[array_search($value->id, $idx)]['name'] }} </option>
                        @endforeach
                      </select>
                    </div>
                    
                </div>
                
                @csrf
                <div class="mt-6 flex flex-col justify-stretch">
                  <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Request Position
                  </button>
                </div>
                </form>
              </div>
              @endif
            @else
              <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
                <h2 id="timeline-title" class="text-lg font-medium text-gray-900">Candidate List</h2>
                <div class="col-span-6">
                  <label for="position" class="block text-sm font-medium text-gray-700">Choose the person who interest with your team</label>
                  @foreach ($member as $m)
                    @if(!$m->is_accepted)
                    <div class="mt-3 grid grid-column-1 card-container">
                      <div class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                        <div class="picture-container flex-shrink-0">
                          @if($m->picture_path != null)
                          <img class="h-10 w-10 rounded-full" src="{{ asset('images/profile/' . $m->picture_path) }}" alt="">
                          @else
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="2 2 16 16" fill="rgba(55, 65, 81, var(--tw-bg-opacity))">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                          </svg>
                          @endif
                        </div>
                        <div class="flex-1 w-32">
                          <a href="{{ route('profile', $m->user_id) }}" class="focus:outline-none">
                            <p class="member-name text-sm font-medium text-gray-900 truncate">
                              {{ $m->member_name }}  
                            </p>
                            <p class="member-position text-sm text-gray-500 truncate">
                              {{ $m->position_name }}
                            </p>
                          </a>
                        </div>
                        <div class="flex-shrink-0 flex flex-row space-x-3">
                          <input type="hidden" name="user_id" value="{{ $m->user_id }}">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 accept-btn cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                          </svg>
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 remove-btn cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                          </svg>
                        </div>
                      </div>
                    </div>
                    @endif
                  @endforeach
                </div>
              </div>
            @endcannot          
          @else
          <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
            <h2 id="timeline-title" class="text-lg font-medium text-gray-900">Request Position</h2>
            <div class="col-span-6">
              <label for="position" class="block text-sm font-medium text-gray-700">Choose the position that you are interested in in this team </label>
              <div class="mt-1 flex">
                <select id="position" name="position" autocomplete="position" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  @foreach (json_decode($data->position_list) as $key => $value)
                    <option value="{{ $value->id }}"> {{$position_list[array_search($value->id, $idx)]['name'] }} </option>
                  @endforeach
                </select>
              </div>
            </div>
            <form action="{{ route('login') }}" method="GET">
              @csrf
              <div class="mt-6 flex flex-col justify-stretch">
                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  Login to Request
                </button>
              </div>
            </form>
          </div>
          @endauth
        </section>
      </div>
    </main>
  </div>  
@endsection