@extends('layouts.app')

@section('title', 'Team Detail')

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
    
?>

<div class="min-h-screen bg-gray-100">
    <main class="py-10">
      <!-- Page header -->
      <div class="max-w-3xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between md:space-x-5 lg:max-w-7xl lg:px-8">
        <div class="flex items-center space-x-5">
          <div class="flex-shrink-0">
            <div class="relative">
              <img class="h-16 w-16 rounded-full" src="https://images.unsplash.com/photo-1463453091185-61582044d556?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80" alt="">
              <span class="absolute inset-0 shadow-inner rounded-full" aria-hidden="true"></span>
            </div>
          </div>
          <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $data->name }}</h1>
            <p class="text-sm font-medium text-gray-500">Made by : <a href="/profile/{{ $creator->id }}" class="text-gray-900">{{ $creator->name }}</a> on <time datetime="{{ date_format($data->created_at, 'Y-m-d') }}">{{ date_format($data->created_at, 'M d, Y') }}</time></p>
          </div>
        </div>
        <div class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-reverse sm:space-y-0 sm:space-x-3 md:mt-0 md:flex-row md:space-x-3">
          <button type="button" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
            Disqualify
          </button>
          <button type="button" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
            Advance to offer
          </button>
        </div>
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
              <div>
                <a href="#" class="block bg-gray-50 text-sm font-medium text-gray-500 text-center px-4 py-4 hover:text-gray-700 sm:rounded-b-lg">Read full application</a>
              </div>
            </div>
          </section>
  
          <!-- Comments-->
          <section aria-labelledby="notes-title">
            <div class="bg-white shadow sm:rounded-lg sm:overflow-hidden">
              <div class="divide-y divide-gray-200">
                <div class="px-4 py-5 sm:px-6">
                  <h2 id="notes-title" class="text-lg font-medium text-gray-900">Notes</h2>
                </div>
                <div class="px-4 py-6 sm:px-6">
                  <ul class="space-y-8">
                    <li>
                      <div class="flex space-x-3">
                        <div class="flex-shrink-0">
                          <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixqx=nkXPoOrIl0&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        </div>
                        <div>
                          <div class="text-sm">
                            <a href="#" class="font-medium text-gray-900">Leslie Alexander</a>
                          </div>
                          <div class="mt-1 text-sm text-gray-700">
                            <p>Ducimus quas delectus ad maxime totam doloribus reiciendis ex. Tempore dolorem maiores. Similique voluptatibus tempore non ut.</p>
                          </div>
                          <div class="mt-2 text-sm space-x-2">
                            <span class="text-gray-500 font-medium">4d ago</span>
                            <span class="text-gray-500 font-medium">&middot;</span>
                            <button type="button" class="text-gray-900 font-medium">Reply</button>
                          </div>
                        </div>
                      </div>
                    </li>
  
                    <li>
                      <div class="flex space-x-3">
                        <div class="flex-shrink-0">
                          <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixqx=nkXPoOrIl0&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        </div>
                        <div>
                          <div class="text-sm">
                            <a href="#" class="font-medium text-gray-900">Michael Foster</a>
                          </div>
                          <div class="mt-1 text-sm text-gray-700">
                            <p>Et ut autem. Voluptatem eum dolores sint necessitatibus quos. Quis eum qui dolorem accusantium voluptas voluptatem ipsum. Quo facere iusto quia accusamus veniam id explicabo et aut.</p>
                          </div>
                          <div class="mt-2 text-sm space-x-2">
                            <span class="text-gray-500 font-medium">4d ago</span>
                            <span class="text-gray-500 font-medium">&middot;</span>
                            <button type="button" class="text-gray-900 font-medium">Reply</button>
                          </div>
                        </div>
                      </div>
                    </li>
  
                    <li>
                      <div class="flex space-x-3">
                        <div class="flex-shrink-0">
                          <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-1.2.1&ixqx=nkXPoOrIl0&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        </div>
                        <div>
                          <div class="text-sm">
                            <a href="#" class="font-medium text-gray-900">Dries Vincent</a>
                          </div>
                          <div class="mt-1 text-sm text-gray-700">
                            <p>Expedita consequatur sit ea voluptas quo ipsam recusandae. Ab sint et voluptatem repudiandae voluptatem et eveniet. Nihil quas consequatur autem. Perferendis rerum et.</p>
                          </div>
                          <div class="mt-2 text-sm space-x-2">
                            <span class="text-gray-500 font-medium">4d ago</span>
                            <span class="text-gray-500 font-medium">&middot;</span>
                            <button type="button" class="text-gray-900 font-medium">Reply</button>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="bg-gray-50 px-4 py-6 sm:px-6">
                <div class="flex space-x-3">
                  <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=256&h=256&q=80" alt="">
                  </div>
                  <div class="min-w-0 flex-1">
                    <form action="#">
                      <div>
                        <label for="comment" class="sr-only">About</label>
                        <textarea id="comment" name="comment" rows="3" class="shadow-sm block w-full focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 rounded-md" placeholder="Add a note"></textarea>
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
                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                          Comment
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
        <section aria-labelledby="timeline-title" class="lg:col-start-3 lg:col-span-1">
          <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
            <h2 id="timeline-title" class="text-lg font-medium text-gray-900">Request Position</h2>
            <div class="col-span-6">
              <label for="position" class="block text-sm font-medium text-gray-700">Choose the position that you are interested in in this team </label>
              <div class="job-container py-2">
                {{-- <span class="job-list inline-flex items-center mx-0.5 my-1 px-4 pr-1 py-1 rounded-full text-sm font-medium text-indigo-800">
                  <span class="mr-3">{{ 'Article ' . $i }} </span>
                  <input type="hidden" name="employee_list[]" value="asd">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 opacity-0" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                  </svg>
                </span> --}}
              </div>

              <div class="mt-1 flex">
                <select id="position" name="position" autocomplete="position" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  @foreach (json_decode($data->position_list) as $key => $value)
                    <option value="{{ $value->id }}"> {{$position_list[array_search($value->id, $idx)]['name'] }} </option>
                  @endforeach
                </select>
              </div>
            </div>
            <form action="/team/{{ request()->id }}/insert" method="POST">
              @csrf
              <div class="mt-6 flex flex-col justify-stretch">
                  <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Request Position
                  </button>
              </div>
            </form>
          </div>
        </section>
      </div>
    </main>
  </div>  
@endsection