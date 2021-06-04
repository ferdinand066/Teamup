<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
      
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/layout/app.js') }}" defer></script>
  <script src="{{ asset('js/utility/notification.js') }}"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>

      // Enable pusher logging - don't include this in production
      Pusher.logToConsole = true;

      var pusher = new Pusher('439c1dae1bee91e496fa', {
        cluster: 'ap1'
      });

      var user = <?php echo (Auth::user() != null) ? "'" . Auth::user()->id . "'" : "''"; ?>;

      var channel = pusher.subscribe('my-channel-' + user);
      channel.bind('my-event', function(data) {
        var currentData = JSON.stringify(data);
        addNewNotification(data.type, data.title, data.text);
      });
    </script>
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout/app.css') }}" rel="stylesheet">
    @yield('style-script')
</head>
<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
  <nav class="bg-white shadow z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex">
          <div class="-ml-2 mr-2 flex items-center md:hidden">
            <!-- Mobile menu button -->
            <button type="button" class="nav-menu inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false">
              <span class="sr-only">Open main menu</span>
              <!--
                Icon when menu is closed.
  
                Heroicon name: outline/menu
  
                Menu open: "hidden", Menu closed: "block"
              -->
              <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
              <!--
                Icon when menu is open.
  
                Heroicon name: outline/x
  
                Menu open: "block", Menu closed: "hidden"
              -->
              <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <div class="flex-shrink-0 flex items-center">
            <a href="{{ url('/') }}" class="text-2xl font-bold text-indigo-600 no-underline">
                {{ config('app.name', 'Laravel') }}
            </a>
          </div>
          <div class="hidden md:ml-6 md:flex md:space-x-8">
            <!-- Current: "border-indigo-500 text-gray-900", Default: "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700" -->
            <a href="#" class="{{ request()->is('dashboard') ? 'border-indigo-500 text-gray-900 ' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 ' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
              Dashboard
            </a>
            <a href="{{ route('team') }}" class="{{ request()->is('team', 'team/view/*') ? 'border-indigo-500 text-gray-900 ' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 ' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
              Team
            </a>
            @auth
            <a href="{{ route('project') }}" class="{{ request()->is('project') ? 'border-indigo-500 text-gray-900 ' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 ' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
              Projects
            </a>
            @endauth
            <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
              Calendar
            </a>
          </div>
        </div>
        <div class="flex items-center">
          <div class="flex-shrink-0">
            @guest
            @else
            <a href="/team/create">
              <button type="button" class="relative inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <!-- Heroicon name: solid/plus -->
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                <span>New Team</span>
              </button>
            </a>
            @endguest
            
          </div>
          <div class="hidden md:ml-4 md:flex-shrink-0 md:flex md:items-center">
            {{-- Set Login Button --}}
            @guest
            <div class="md:flex-shrink-0">
              <a href="{{route('login')}}">
                <button type="button" class="relative inline-flex items-center px-4 py-2 border border-indigo-600 text-sm font-medium rounded-md text-indigo-600 bg-transparent focus:outline-none">
                  <!-- Heroicon name: login -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                  </svg>
                  <span>SIGN IN</span>
                </button>
              </a>
            </div>
            @else
            <a href="/notification">
              <button class="relative bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <span class="sr-only">View notifications</span>
                <!-- Heroicon name: outline/bell -->
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>

                <!-- Notif -->
                <span class="hidden notif-bullet absolute top-0 right-0 bg-red-500 px-1 py-0.5 text-white rounded-full border-white"></span>
              </button>
            </a>
            
  
            <!-- Profile dropdown -->
            <div class="ml-3 relative">
              <div>
                <button type="button" id="user-profile" class="bg-white rounded-full flex text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                  <span class="sr-only">Open user menu</span>
                  @if(Auth::user()->picture_path != null)
                  <img class="h-8 w-8 rounded-full" src=" {{ asset('images/profile/' . Auth::user()->picture_path) }}" alt="">
                  @else
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="rgba(55, 65, 81, var(--tw-bg-opacity))">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                  </svg>
                  @endif
                </button>
              </div>
  
              <!--
                Dropdown menu, show/hide based on menu state.
  
                Entering: "transition ease-out duration-200"
                  From: "transform opacity-0 scale-95"
                  To: "transform opacity-100 scale-100"
                Leaving: "transition ease-in duration-75"
                  From: "transform opacity-100 scale-100"
                  To: "transform opacity-0 scale-95"
              -->
              <div class="dropdown user-not-active-dropdown origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                <!-- Active: "bg-gray-100", Not Active: "" -->
                <a href="{{ route('profile', [Auth::user()->id]) }}" class="{{ request()->is('profile/' . Auth::user()->id) ? 'bg-gray-100 ' : '' }}block px-4 py-2 text-sm text-gray-700 menuitem" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                <a href="{{ route('team.search.leader', [Auth::user()->id]) }}" class="{{ request()->is('team/team-leader/' . Auth::user()->id) ? 'bg-gray-100 ' : '' }}block px-4 py-2 text-sm text-gray-700 menuitem" role="menuitem" tabindex="-1" id="user-menu-item-1">Created Team</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" class="{{ request()->is('logout') ? 'bg-gray-100 ' : '' }}block px-4 py-2 text-sm text-gray-700 menuitem" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
              </div>
            </div>
            @endguest
          </div>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            {{ csrf_field() }}
          </form>
          
        </div>
      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="md:hidden" id="mobile-menu">
      <div class="pt-2 pb-3 space-y-1">
        <!-- Current: "bg-indigo-50 border-indigo-500 text-indigo-700", Default: "border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700" -->
        <a href="#" class="{{ request()->is('dashboard') ? 'bg-indigo-50 border-indigo-500 text-indigo-700 ' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 ' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium sm:pl-5 sm:pr-6">Dashboard</a>
        <a href=" {{ route('team') }}" class="{{ request()->is('team', 'team/view/*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700 ' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 ' }} hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium sm:pl-5 sm:pr-6">Team</a>
        @auth
        <a href="{{ route('project') }}" class="{{ request()->is('project') ? 'bg-indigo-50 border-indigo-500 text-indigo-700 ' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 ' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium sm:pl-5 sm:pr-6">Projects</a>
        @endauth
        <a href="#" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium sm:pl-5 sm:pr-6">Calendar</a>
        @guest
        <a href="{{ route('login') }}" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium sm:pl-5 sm:pr-6">Sign in</a>
        @endguest
      </div>
      @guest
      @else
      <div class="pt-4 pb-3 border-t border-gray-200">
        <div class="flex items-center px-4 sm:px-6">
          <div class="flex-shrink-0">
            {{-- Real Image }}
            {{-- <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixqx=nkXPoOrIl0&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt=""> --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
            </svg>
          </div>
          <div class="ml-3">
            <div class="text-base font-medium text-gray-800">{{Auth::user()->name}}</div>
            <div class="text-sm font-medium text-gray-500">{{Auth::user()->email}}</div>
          </div>
          <a href="{{ route('notification') }}" class="ml-auto flex-shrink-0">
            <button class="relative ml-auto flex-shrink-0 bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              <span class="sr-only">View notifications</span>
              <!-- Heroicon name: outline/bell -->
              <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
              </svg>
              <span class="hidden notif-bullet absolute top-0 right-0 bg-red-500 px-1 py-0.5 text-white rounded-full border-white"></span>
            </button>
          </a>
        </div>
        <div class="mt-3 space-y-1">
          <a href="{{ route('profile', [Auth::user()->id]) }}" class="{{ request()->is('profile/' . Auth::user()->id) ? 'bg-indigo-50 border-indigo-500 text-indigo-700 ' 
            : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 ' }}block px-4 py-2 text-base font-medium sm:px-6">Your Profile</a>
          <a href="{{ route('team.search.leader', [Auth::user()->id])}}" class="{{ request()->is('team/team-leader/' . Auth::user()->id ) ? 'bg-indigo-50 border-indigo-500 text-indigo-700 ' 
            : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 ' }}
            block px-4 py-2 text-base font-medium sm:px-6">Created Team</a>
          <a href="{{ route('logout')}}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();" class="{{ request()->is('logout') ? 'bg-gray-100 ' : '' }}block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 sm:px-6">Sign out</a>
          </div>
      </div>
      @endguest
    </div>
  </nav>
  
  @yield('content')


  <div aria-live="assertive" class="border-none fixed inset-0 flex items-end px-4 py-6 pointer-events-none sm:p-6 sm:items-start">
    <div class="w-full flex flex-col items-center space-y-4 sm:items-end" id="notification-container">
      <!--
        Notification panel, dynamically insert this into the live region when it needs to be displayed
  
        Entering: "transform ease-out duration-300 transition"
          From: "translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
          To: "translate-y-0 opacity-100 sm:translate-x-0"
        Leaving: "transition ease-in duration-100"
          From: "opacity-100"
          To: "opacity-0"
      -->

    </div>
  </div>
</body>

</html>
