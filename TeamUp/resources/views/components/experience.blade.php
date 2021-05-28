<?php
          $single_data = json_decode($data);
?>
<div class="py-5 max-w-lg sm:border-t sm:border-gray-200">
    <div class="grid gap-y-6 gap-x-4 sm:grid-cols-6">
        <div class="col-span-3 sm:col-span-1">
            <label for="year-from-{{ $key }}" class="block text-sm font-medium text-gray-700">
            Year From
            </label>
            <div class="mt-1">
            <input 
                @cannot('update-profile', [$id, Auth::user()->id])
                    disabled
                @endcannot
            value="{{ $single_data->{'year-from'} }}" type="text" name="year-from[]" id="year-from-{{ $key }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
            </div>
        </div>
 
        <div class="col-span-3 sm:col-span-1">
            <label for="year-to-{{ $key }}" class="block text-sm font-medium text-gray-700">
            Year To
            </label>
            <div class="mt-1">
            <input 
                @cannot('update-profile', [$id, Auth::user()->id])
                    disabled
                @endcannot
                value="<?php echo ($single_data->{'year-to'} == date('Y')) ? 'Now' : $single_data->{'year-to'} ?>" type="text" name="year-to[]" id="year-to-{{ $key }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
            </div>
        </div>
    
        <div class="col-span-6 sm:col-span-4">
            <label for="experience-{{ $key }}" class="block text-sm font-medium text-gray-700">
            Experience
            </label>
            <div class="mt-1">
                <input 
                    @cannot('update-profile', [$id, Auth::user()->id])
                        disabled
                    @endcannot
                value="{{ $single_data->{'experience'} }}" type="text" name="experience[]" id="experience-{{ $key }}" autocomplete="experience" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
            </div>
        </div>
     </div>
</div>