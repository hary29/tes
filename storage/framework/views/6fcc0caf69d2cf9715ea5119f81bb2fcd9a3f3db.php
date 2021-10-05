<?php $__env->startSection('tittle','Gallery Manage'); ?>
 <?php $__env->slot('header'); ?> 
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Data Gallery
    </h2>
 <?php $__env->endSlot(); ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl overflow-x-auto sm:rounded-lg px-4 py-4">
            <?php if(session()->has('success-message')): ?>
                <div class="bg-green-200 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm"><?php echo e(session('success-message')); ?></p>
                        </div>
                    </div>
                </div>
            <?php elseif(session()->has('error-message')): ?>
            	<div class="bg-red-200 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm"><?php echo e(session('error-message')); ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Tambah Photo Event</button>
            <?php if($isDetail): ?>
                <?php echo $__env->make('livewire.galleryManage.detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php elseif($isModal): ?>
                <?php echo $__env->make('livewire.galleryManage.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            
            <!-- component -->
            <div class="flex justify-end text-gray-600 mb-2">
              <input type="search" name="serch" placeholder="Search by name" class="bg-white h-10 px-5 pr-10 rounded-full text-sm focus:outline-none border-green-500" wire:model="searchNameTerm">
            </div>
            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Publish</th>
                        <th class="px-4 py-2">name</th>
                        <th class="px-4 py-2">Url</th>
                        <th class="px-4 py-2">Description</th>
                        <th class="px-4 py-2">Event Time</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo e($index+1); ?></td>
                            <td class="border px-4 py-2"><button wire:click="switchPublish(<?php echo e($row->id_gallery); ?>)"><?php echo $row->publish_label; ?></button></td>
                            <td class="border px-4 py-2"><?php echo e($row->name); ?></td>
                            <td class="border px-4 py-2"><?php echo e($row->url); ?></td>
                            <td class="border px-4 py-2"><?php echo e($row->description); ?></td>
                            <td class="border px-4 py-2"><?php echo e($row->event_time); ?></td>
                            <td class="border px-4 py-2 content-center">
                                <button wire:click="edit(<?php echo e($row->id_gallery); ?>)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mb-1 rounded">Edit</button>
                                <button wire:click="detail(<?php echo e($row->id_gallery); ?>)" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mb-1 rounded">Detail</button>
                                <button wire:click="delete(<?php echo e($row->id_gallery); ?>)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mb-1 rounded">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td class="border px-4 py-2 text-center" colspan="7">Tidak ada data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php echo e($content->links()); ?>

        </div>
    </div>
</div>
<?php /**PATH /var/www/html/php74/tes/resources/views/livewire/galleryManage/manage.blade.php ENDPATH**/ ?>