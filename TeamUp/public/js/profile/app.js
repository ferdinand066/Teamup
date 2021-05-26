$(function () {
    $countComponent = 0;

    function getCountComponent(){
        var temp = $("label[for^='year-from-']");
        for (var i=0; i<temp.length; i++){
            $countComponent++;
        }
    }

    getCountComponent();

    $("button.new-experience").on('click', function(){
        var temp = $('.experience-list').append(`
        <div class="py-5 max-w-lg sm:border-t sm:border-gray-200">
           <div class="grid gap-y-6 gap-x-4 sm:grid-cols-6">
            <div class="col-span-3 sm:col-span-1">
                <label for="year-from-${$countComponent}" class="block text-sm font-medium text-gray-700">
                Year From
                </label>
                <div class="mt-1">
                <input type="text" name="year-from-${$countComponent}" id="year-from-${$countComponent}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
        
            <div class="col-span-3 sm:col-span-1">
                <label for="year-to-${$countComponent}" class="block text-sm font-medium text-gray-700">
                Year To
                </label>
                <div class="mt-1">
                <input type="text" name="year-to-${$countComponent}" id="year-to-${$countComponent}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
        
            <div class="col-span-6 sm:col-span-4">
                <label for="experience-${$countComponent}" class="block text-sm font-medium text-gray-700">
                Experience
                </label>
                <div class="mt-1">
                <input type="text" name="experience-${$countComponent}" id="experience-${$countComponent}" autocomplete="experience" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            </div>
        </div>`);
      
      $countComponent++;


    })
});