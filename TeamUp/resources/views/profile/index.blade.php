@extends('layouts.app')

@section('title', 'Profile')

@section('style-script')
  <script src="{{ asset('js/profile/app.js') }}"></script>
@endsection

@section('content')
<main class="sm:container sm:mx-auto sm:max-w-lg sm:mt-10 flex justify-center">
<form class="space-y-8 divide-y divide-gray-200" method="POST" enctype="multipart/form-data" 
  action="{{ route('profile.update', [$data->id]) }}">
    @csrf
    <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
      <div>
        <div class="flex justify-center">
            <div class="flex items-center flex-col">
              <span id="image-pivot" class="mt-5 h-56 w-56 rounded-full overflow-hidden bg-gray-100">
                @if ($data->picture_path == null)
                <svg id="no-image" class="h-full w-full text-gray-300 rounded-full" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                @else
                  <img id="image-container" class="object-fill w-full h-full rounded-full" src=" {{ asset('images/profile/' . $data->picture_path) }}" alt="">
                @endif
              </span>

              @auth
                @can('update-profile', [$data->id, Auth::user()->id])
                <div class="mt-2" id="input-pivot">
                  <button type="button" id="change-picture" class="bg-white my-5 py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Change Picture
                  </button>
                  <input type="file" name="picture-insert" id="picture-insert" class="hidden" accept="image/png, image/gif, image/jpeg">
                  @if($data->picture_path != null)
                    <button type="button" id="delete-picture" class="bg-white my-5 py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                      Delete Picture
                    </button>
                  @endif
                </div>
                @endcan
              @endauth
            </div>
        </div>
        <div>
          <h3 class="text-lg leading-6 font-medium text-gray-900">
            Profile
          </h3>
          @auth
            @can('update-profile', [$data->id, Auth::user()->id])
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
              This information will be displayed publicly so be careful what you share.
            </p>
            @endcan
          @endauth
        </div>
  
        <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
          <div class="@error('name') border-red-500 @enderror sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
              Full Name
            </label>
            <div class="mt-1 sm:mt-0 sm:col-span-2">
              <div class="max-w-lg flex rounded-md shadow-sm flex-col">
                <input 
                  @auth
                    @cannot('update-profile', [$data->id, Auth::user()->id])
                      disabled
                    @endcan 
                  @else
                    disabled
                  @endauth
                  
                  value="{{ $data->name }}" type="text" name="name" id="name" autocomplete="name" class="flex-1 block w-full focus:ring-indigo-500 focus:border-indigo-500 min-w-0 rounded-md sm:text-sm border-gray-300">
                  @error('name')
                  <p class="text-red-500 text-xs italic mt-4">
                      {{ $message }}
                  </p>
                  @enderror

                </div>
            </div>
          </div>

          <div class="@error('phone') border-red-500 @enderror sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="phone" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
              Phone Number
            </label>
            <div class="mt-1 sm:mt-0 sm:col-span-2 flex flex-col">
              <input 
              @auth
                @cannot('update-profile', [$data->id, Auth::user()->id])
                  disabled
                @endcan 
              @else
                disabled
              @endauth
              value="{{ $data->phone }}" id="phone" name="phone" type="text" autocomplete="phone" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md disabled:opacity-50">
              
              @error('phone')
              <p class="text-red-500 text-xs italic mt-4">
                  {{ $message }}
              </p>
              @enderror
            </div>
          </div>

          <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="email" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
              Email address
            </label>
            <div class="mt-1 sm:mt-0 sm:col-span-2">
              <input value="{{ $data->email }}" id="email" name="email" type="email" autocomplete="email" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md disabled:opacity-50" disabled>
            </div>
          </div>

          <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="role" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
              Role
            </label>
            <div class="mt-1 sm:mt-0 sm:col-span-2">
              <input value="{{ $data->role }}" id="role" name="role" type="text" autocomplete="role" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md disabled:opacity-50" disabled>
            </div>
          </div>

          @auth
            @can('update-profile', [$data->id, Auth::user()->id])
            <div class="@error('balance') border-red-500 @enderror sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
              <label for="balance" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                Balance
              </label>
              <div class="mt-1 sm:mt-0 sm:col-span-2 flex flex-col">
                <div class="max-w-lg flex rounded-md shadow-sm">
                  <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                    $
                  </span>
                  <input 
                    disabled
                    value="{{ $data->balance }}" id="balance" name="balance" type="number" autocomplete="email" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-none rounded-r-md">
                </div>
                @error('balance')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
                @enderror
              </div>
            </div>
            @endcan
          @endauth
      </div>
    </div>
    
    <?php
      $experience_list = json_decode($data->experience);
    ?>
    <div class="pt-5">
      <h3 class="text-lg leading-6 font-medium text-gray-900">
        Experience
      </h3>
      <?php if ($experience_list == null){ ?>
        @auth
          @cannot('update-profile', [$data->id, Auth::user()->id])
          <p class="mt-1 max-w-2xl text-sm text-gray-500">
            This person hasn't added any specific experiences yet.
          </p>           
          @endcan
        @else
          <p class="mt-1 max-w-2xl text-sm text-gray-500">
            This person hasn't added any specific experiences yet.
          </p>    
        @endauth
        
      <?php } ?>
      @error('year-from.*')
      <p class="text-red-500 text-xs italic mt-4">
          {{ $message }}
      </p>
      @enderror
      @error('year-to.*')
      <p class="text-red-500 text-xs italic mt-4">
          {{ $message }}
      </p>
      @enderror
      @error('experience.*')
      <p class="text-red-500 text-xs italic mt-4">
          {{ $message }}
      </p>
      @enderror
    </div>
    <div class="experience-list border-none">
      <?php
        if ($experience_list != null){
          foreach($experience_list as $key => $datas){
            ?>
              <x-experience :key="$key" :data="$datas" :id="$data->id"/>
            <?php
          }
        }
        
      ?>
      
    </div>
    @auth
      @can('update-profile', [$data->id, Auth::user()->id])
        <div class="pt-5" style="margin: 0">
          <button type="button" class="new-experience relative inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <!-- Heroicon name: solid/plus -->
            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            <span>New Experience</span>
          </button>
        </div>
        <div class="py-5">
          <div class="flex justify-end">
            <a href="/">
              <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cancel
              </button>
            </a>
            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              Save
            </button>
          </div>
        </div>
      @else
      <div class="py-5"></div>
      @endcan 
    @endauth
  </form>  

@endsection