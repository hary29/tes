<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4">
                            <label for="formLogo" class="block text-gray-700 text-sm font-bold mb-2">path logo:</label>
                            <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="formLogo" wire:model="logo">

                             @error('logo') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <!-- <div class="mb-4">
                            <label for="formPath" class="block text-gray-700 text-sm font-bold mb-2">path url:</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="formpath" wire:model="path_url">
                            @error('path_url') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div> -->
                        <div class="mb-4">
                            <label for="formTitle" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="formTitle" wire:model="title">
                            @error('title') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="formPhoto" class="block text-gray-700 text-sm font-bold mb-2">path photo:</label>
                            <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="formPhoto" wire:model="photo">

                             @error('photo') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="mt-2 bg-white" wire:ignore>
                          <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                          <div
                               x-data
                               x-ref="quillEditor"
                               x-init="
                                 toolbarOptions = [
                                  ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                                  ['blockquote', 'code-block'],

                                  [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                                  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                                  [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                                  [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                                  [{ 'direction': 'rtl' }],                         // text direction

                                  [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                                  [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

                                  [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                                  [{ 'font': [] }],
                                  [{ 'align': [] }],

                                  ['clean']                                         // remove formatting button
                                ];
                                 quill2 = new Quill($refs.quillEditor, {
                                    theme: 'snow',
                                    modules: {
                                        toolbar: toolbarOptions
                                    }
                                });
                                 quill2.on('text-change', function () {
                                   $dispatch('input', quill2.root.innerHTML);
                                 });
                               "
                               wire:model.debounce.2000ms="description"
                          >
                            {!! $description !!}
                          </div>
                        </div>
                        <div class="mb-4 my-1">
                            <label for="formPublish" class="block text-gray-700 text-sm font-bold mb-2">Publish</label>
                            <select class="form-control rounded-md focus:shadow-outline-blue" wire:model="publish" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Pilih</option>
                                <option value="1">Publish</option>
                                <option value="2">UnPublish</option>
                            </select>
                            @error('publish') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <!-- <div class="mb-4">
                            <label for="formStatus" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                            <select class="form-control" wire:model="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Pilih</option>
                                <option value="1">Premium</option>
                                <option value="0">Free</option>
                            </select>
                            @error('status') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div> -->
                    </div>
                </div>
    
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Save
                        </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        
                        <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Cancel
                        </button>
                    </span>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>

