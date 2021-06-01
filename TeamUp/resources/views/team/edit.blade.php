@extends('layouts.app')

@section('title', 'Edit Team')
@section('style-script')
  <link rel="stylesheet" href="{{ asset('css/team/create.css') }}">
  <script src="{{ asset('js/team/create.js') }}"></script>
@endsection
@section('content')
<?php 
  $address = json_decode($data->address);

  $listed_position = json_decode($data->position_list);

  $position_id = array();

  foreach($position_list as $p){
    array_push($position_id, $p->id);
  }
?>

<form action="{{ route('team.edit.data', [request('id')]) }}" method="POST">
<div class="space-y-6 mt-6 px-2 sm:px-6">
    @csrf
    <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
          <h3 class="text-lg font-medium leading-6 text-gray-900">General</h3>
          <p class="mt-1 text-sm text-gray-500">
            Tell the public about the team you want to make in general.
          </p>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
          <div class="space-y-6" action="/team/create/insert-team" method="POST">
            <div class="grid grid-cols-3 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="name" class="block text-sm font-medium text-gray-700">
                  Team Name
                </label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" value="{{ $data->name }}" name="name" id="name" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300" placeholder="Your team name">
                </div>
              </div>
            </div>

            <div>
              <label for="short_description" class="block text-sm font-medium text-gray-700">
                Short Description
              </label>
              <div class="mt-1">
                <textarea id="short_description" name="short_description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Tell about the team">{{ $data->short_description }}</textarea>
              </div>
              <p class="mt-2 text-sm text-gray-500">
                Short description about your team.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
          <h3 class="text-lg font-medium leading-6 text-gray-900">Detail</h3>
          <p class="mt-1 text-sm text-gray-500">
            Provide details about your team so that people understand the goals of your team.
          </p>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
          <div>
            <div class="grid grid-cols-6 gap-6">
              <div class="col-span-6">
                <label for="full_description" class="block text-sm font-medium text-gray-700">
                  Full Description
                </label>
                <div class="mt-1">
                  <textarea id="full_description" name="full_description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Tell about the team">{{ $data->full_description }}</textarea>
                </div>
                <p class="mt-2 text-sm text-gray-500">
                  Tell the detail description about your team.
                </p>
              </div>

              <div class="col-span-6 sm:col-span-3">
                <div class="col-span-3 sm:col-span-2">
                  <label for="salary" class="block text-sm font-medium text-gray-700">
                    Salary
                  </label>
                  <div class="mt-1 flex rounded-md shadow-sm">
                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                      $
                    </span>
                    <input type="number" value="{{ $data->salary }}" name="salary" id="salary" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="Salary">
                  </div>
                </div>
              </div>
  
              <div class="col-span-6">
                <label for="position" class="block text-sm font-medium text-gray-700">Positon Required</label>
                <div class="job-container py-2">
                  @foreach ($listed_position as $l)
                    <span class="job-list inline-flex items-center mx-0.5 my-1 px-4 pr-1 py-1 rounded-full text-sm font-medium text-indigo-800">
                      <span class="mr-3"> {{ $position_list[array_search($l->id, $position_id)]->name }} </span>
                      <input type="hidden" name="position_list[]" value="{{ $l->id }}">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 opacity-0" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                      </svg>
                    </span>
                  @endforeach
                </div>
                
                <div class="mt-1 flex">
                  <select id="position" name="position" autocomplete="position" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @foreach ($position_list as $key => $value)
                      <option value="{{ $value->id }}"> {{ $value->name }} </option>
                    @endforeach
                  </select>
                  <button type="button" id="add-job" class="ml-1 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Add
                  </button>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
          <h3 class="text-lg font-medium leading-6 text-gray-900">Location</h3>
          <p class="mt-1 text-sm text-gray-500">
            Tell the location of your team so it's easier to communicate
          </p>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
          <div>
            <div class="grid grid-cols-6 gap-6">
              <div class="col-span-6">
                <label for="street" class="block text-sm font-medium text-gray-700">
                  Street address (Optional)
                </label>
                <div class="mt-1">
                  <textarea id="street" name="street" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Example Road, Near Example Tower or something else...">{{ $address->street }}</textarea>
                </div>
              </div>

              <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                <input type="text" value="{{ $address->city }}" name="city" id="city" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>
  
              <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                <label for="state" class="block text-sm font-medium text-gray-700">State / Province</label>
                <input type="text" value="{{ $address->state }}" name="state" id="state" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>
  
              <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                <label for="postal_code" class="block text-sm font-medium text-gray-700">ZIP / Postal (Optional)</label>
                <input type="text" value="{{ $address->postal_code }}" name="postal_code" id="postal_code" autocomplete="postal-code" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
{{--   
    <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
          <h3 class="text-lg font-medium leading-6 text-gray-900">Notifications</h3>
          <p class="mt-1 text-sm text-gray-500">
            Decide which communications you'd like to receive and how.
          </p>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
          <form class="space-y-6" action="#" method="POST">
            <fieldset>
              <legend class="text-base font-medium text-gray-900">By Email</legend>
              <div class="mt-4 space-y-4">
                <div class="flex items-start">
                  <div class="h-5 flex items-center">
                    <input id="comments" name="comments" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                  </div>
                  <div class="ml-3 text-sm">
                    <label for="comments" class="font-medium text-gray-700">Comments</label>
                    <p class="text-gray-500">Get notified when someones posts a comment on a posting.</p>
                  </div>
                </div>
                <div class="flex items-start">
                  <div class="flex items-center h-5">
                    <input id="candidates" name="candidates" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                  </div>
                  <div class="ml-3 text-sm">
                    <label for="candidates" class="font-medium text-gray-700">Candidates</label>
                    <p class="text-gray-500">Get notified when a candidate applies for a job.</p>
                  </div>
                </div>
                <div class="flex items-start">
                  <div class="flex items-center h-5">
                    <input id="offers" name="offers" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                  </div>
                  <div class="ml-3 text-sm">
                    <label for="offers" class="font-medium text-gray-700">Offers</label>
                    <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p>
                  </div>
                </div>
              </div>
            </fieldset>
            <fieldset>
              <div>
                <legend class="text-base font-medium text-gray-900">Push Notifications</legend>
                <p class="text-sm text-gray-500">These are delivered via SMS to your mobile phone.</p>
              </div>
              <div class="mt-4 space-y-4">
                <div class="flex items-center">
                  <input id="push_everything" name="push_notifications" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                  <label for="push_everything" class="ml-3 block text-sm font-medium text-gray-700">
                    Everything
                  </label>
                </div>
                <div class="flex items-center">
                  <input id="push_email" name="push_notifications" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                  <label for="push_email" class="ml-3 block text-sm font-medium text-gray-700">
                    Same as email
                  </label>
                </div>
                <div class="flex items-center">
                  <input id="push_nothing" name="push_notifications" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                  <label for="push_nothing" class="ml-3 block text-sm font-medium text-gray-700">
                    No push notifications
                  </label>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div> --}}
  
    <div class="flex justify-end pb-6">
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
</form>
@endsection