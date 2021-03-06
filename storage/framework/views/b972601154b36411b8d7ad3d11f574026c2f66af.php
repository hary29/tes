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
                            <label for="formPhoto" class="block text-gray-700 text-sm font-bold mb-2">path url:</label>
                            <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="formPhoto" wire:model="photo">

                             <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- <div class="mb-4">
                            <label for="formPath" class="block text-gray-700 text-sm font-bold mb-2">path url:</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="formpath" wire:model="path_url">
                            <?php $__errorArgs = ['path_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div> -->
                        <div class="mb-4">
                            <label for="formTitle" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="formTitle" wire:model="title">
                            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                       <!--  <div class="mb-4">
                            <label for="formShortContent" class="block text-gray-700 text-sm font-bold mb-2">Short Content:</label>
                            <textarea class="ckeditor shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="formShortContent" wire:model="short_content"></textarea>
                            <?php $__errorArgs = ['short_content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div> -->

                        <!-- <div class="mb-4">
                            <label for="formDescription" class="block text-gray-700 text-sm font-bold mb-2">Discription:</label>
                            <textarea type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="formDescription" wire:model="description"></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div> -->
                        <div class="mt-2 bg-white" wire:ignore>
                          <label for="short_content" class="block text-gray-700 text-sm font-bold mb-2">Short Content:</label>
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
                                 quill1 = new Quill($refs.quillEditor, {
                                    theme: 'snow',
                                    modules: {
                                        toolbar: toolbarOptions
                                    }
                                });
                                 quill1.on('text-change', function () {
                                   $dispatch('input', quill1.root.innerHTML);
                                 });
                               "
                               wire:model.debounce.2000ms="short_content"
                          >
                            <?php echo $short_content; ?>

                          </div>
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
                            <?php echo $description; ?>

                          </div>
                        </div>
                        <div class="mb-4 my-1">
                            <label for="formPublish" class="block text-gray-700 text-sm font-bold mb-2">Publish</label>
                            <select class="form-control rounded-md focus:shadow-outline-blue" wire:model="publish" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Pilih</option>
                                <option value="1">Publish</option>
                                <option value="2">UnPublish</option>
                            </select>
                            <?php $__errorArgs = ['publish'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <!-- <div class="mb-4">
                            <label for="formStatus" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                            <select class="form-control" wire:model="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Pilih</option>
                                <option value="1">Premium</option>
                                <option value="0">Free</option>
                            </select>
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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

<?php /**PATH /var/www/html/php74/tes/resources/views/livewire/aboutManage/create.blade.php ENDPATH**/ ?>