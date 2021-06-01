@extends('layouts.app')

@section('title', 'Teams')

@section('style-script')
  <link rel="stylesheet" href="{{ asset('css/team/index.css') }}">
  <script src="{{ asset('js/team/index.js') }}"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
@endsection

@section('content')
<?php 
    $position_list = array();
    $idx = array();
    foreach($position as $key => $value){
        $data['id'] = $value->id;
        $data['name'] = $value->name;
        array_push($position_list, $data);
        array_push($idx, $value->id);
    }
?>

<div class="px-2 sm:px-6">
  {{-- <div class="min-w-0 md:px-8 lg:px-0 xl:col-span-6 mt-5 sm:my-6">
    <div class="flex px-6 py-4 md:max-w-3xl md:mx-auto lg:max-w-none md:px-3 lg:px-32 xl:px-5">
      <select id="search_by" name="search_by" autocomplete="search_by" class="block w-40 py-2 px-3 border border-r-0 border-gray-300 bg-white rounded-none rounded-l-md shadow-sm focus:outline-none focus:ring-transparent focus:border-gray-300 sm:text-sm">
        <option value="team-name">Team Name</option>
        <option value="creator-name">Creator Name</option>
        <option value="position-name">Position Name</option>
      </select>
      <div class="w-full">
        <div class="relative h-full">
          <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center">
            <!-- Heroicon name: solid/search -->
            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
            </svg>
          </div>
          <input id="search" name="search" class="h-full block w-full bg-white border border-gray-300 rounded-none rounded-r-md py-2 pl-10 pr-3 text-sm placeholder-gray-500 focus:outline-none focus:text-gray-900 focus:placeholder-gray-400 focus:ring-transparent focus:border-gray-300 sm:text-sm" placeholder="Search" type="search">
        </div>
      </div>
      <button type="button" id="search-button" class="ml-1 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Search
      </button>
    </div>
  </div> --}}
    <div class="my-5 space-y-4 sm:space-y-0 sm:grid sm:grid-cols-2 sm:gap-6 lg:max-w-4xl lg:mx-auto xl:max-w-none xl:mx-0 xl:grid-cols-4">
        @if($team != null)
          @foreach ($team as $t)
            <x-team-card :t="$t" :idx="$idx" :position="$position_list"/>
          @endforeach
        @endif
    </div>
    <div class="p-3">
      <?php 
        if ($team == null) echo "";

        else if (request('team_name') != null){
          echo $team->appends(['team_name' => request('team_name')])->links();
        }

        else if (request('position_name')!= null){
          echo $team->appends(['position_name' => request('position_name')])->links();
        }

        else if (request('creator_name')!= null){
          echo $team->appends(['creator_name' => request('creator_name')])->links();
        }

        else {
          echo $team->links();
        }
      ?>  
    </div>
</div>
@endsection