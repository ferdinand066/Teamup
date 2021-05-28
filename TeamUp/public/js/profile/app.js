$(function () {
    $countComponent = 0;

    $("#change-picture").on('click', function(){
        $("#picture-insert").click();
    });

    $("#delete-picture").on('click', function(){
        $('#picture-insert').remove();
        $('#input-pivot').append(
            `<input type="file" name="picture-insert" id="picture-insert" class="hidden" accept="image/png, image/gif, image/jpeg">`
        );
        $("#image-container").remove();
        $("#image-pivot").append(`
        <svg id="no-image" class="h-full w-full text-gray-300 rounded-full" fill="currentColor" viewBox="0 0 24 24">
            <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        `);
    })

    $("#picture-insert").on('change', function(){
        var file = $("#picture-insert").prop('files');
        if (file){
            if($("#no-image").length){
                $("#no-image").remove();
                $("#image-pivot").append(`
                <img id="image-container" class="object-fill w-full h-full rounded-full" src="${ URL.createObjectURL(file[0]) }" alt="">
                `)
            } else $("#image-container").attr('src', URL.createObjectURL(file[0]));
        }
    })

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
                <input type="text" name="year-from[]" id="year-from-${$countComponent}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
        
            <div class="col-span-3 sm:col-span-1">
                <label for="year-to-${$countComponent}" class="block text-sm font-medium text-gray-700">
                Year To
                </label>
                <div class="mt-1">
                <input type="text" name="year-to[]" id="year-to-${$countComponent}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
        
            <div class="col-span-6 sm:col-span-4">
                <label for="experience-${$countComponent}" class="block text-sm font-medium text-gray-700">
                Experience
                </label>
                <div class="mt-1">
                <input type="text" name="experience[]" id="experience-${$countComponent}" autocomplete="experience" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            </div>
        </div>`);
      
      $countComponent++;


    })
});