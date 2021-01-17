<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">

        <div class="rounded rounded-t-lg overflow-hidden shadow pt-1">
            <div class="text-right">
              <button wire:click="closeModalDetail()"class="text-red-500 hover:text-red-700 text-right text-3xl font-black pr-1">&times;
              </button>
            </div>
          	<!-- <img src="https://i.imgur.com/dYcYQ7E.png" class="w-full" /> -->
            <div class="flex justify-center -mt-8">
                <img src="{{ $photo }}" class="h-40 w-40 rounded-full">		
            </div>
        	<div class="text-center px-3 pb-6 pt-2">
        		<h3 class="text-black text-sm bold font-sans">{{ $name }}</h3>
            <h4 class="text-black text-sm bold font-sans">{!! $role_label !!}</h4>
        		<p class="mt-2 font-sans font-light text-grey-dark">{{ $email }}</p>
            <p class="mt-2 font-sans font-light">{!! $publish_label !!}</p>
        	</div>
          	<div class="flex justify-center pb-3 text-grey-dark">
              <div class="text-center mr-3 border-r pr-3">
                <h2>Created at</h2>
                <span>{{ $created_at }}</span>
              </div>

              @if($updated_at)
              <div class="text-center">
                <h2>Update at</h2>
                <span>{{ $updated_at }}</span>
              </div>
          	</div>
            @endif
        </div>
        <div class="bg-gray-50 px-4 py-3 text-center">
          <span class="mt-3 rounded-md shadow-sm"> 
            <button wire:click="closeModalDetail()" type="button" class="justify-center rounded-md border border-red-300 px-4 py-2 bg-red-500 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-700">
            close
            </button>
          </span>
        </div>
    </div>
  </div>
</div>