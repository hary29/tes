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
              <button wire:click="closeModal()"class="text-red-500 hover:text-red-700 text-right text-3xl font-black pr-1">&times;
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
            <!-- <p class="mt-2 font-sans font-light">{!! $publish_label !!}</p> -->
        	</div>
          <form>
            <div class="bg-white px-1 pt-5 pb-4 sm:p-6 sm:pb-4">
              <div class="text-center">
                <div class="mb-4">
                    <label for="formPublish" class="block text-gray-700 text-sm font-bold mb-2">Publish</label>
                    <select class="form-control rounded-md focus:shadow-outline-blue" wire:model="publish" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Pilih</option>
                        <option value="1">Publish</option>
                        <option value="2">UnPublish</option>
                    </select>
                    @error('publish') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
              	<div class="mb-4">
                    <label for="formIsAdmin" class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                    <select class="form-control rounded-md focus:shadow-outline-blue" wire:model="is_admin" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Pilih</option>
                        <option value="0">No Acces</option>
                        <option value="1">Super Admin</option>
                        <option value="2">Admin</option>
                    </select>
                    @error('is_admin') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
              </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
              <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                  <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                  Save
                  </button>
              </span>
              <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                  <button wire:click="closeModal()" type="button" class="justify-center rounded-md border border-red-300 px-4 py-2 bg-red-500 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-700">
                  close
                  </button>
              </span>
            </div>
          </form>
    </div>
  </div>
</div>