<?php $__env->startSection('tittle','Testimony Manage'); ?>
 <?php $__env->slot('header'); ?> 
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Data testimony
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

            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Tambah Testimony</button>
            
            <?php if($isDetail): ?>
                <?php echo $__env->make('livewire.testimonyManage.detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php elseif($isModal): ?>
                <?php echo $__env->make('livewire.testimonyManage.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>


            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Publish</th>
                        <th class="px-4 py-2">Photo</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Position</th>
                        <th class="px-4 py-2">Location</th>
                        <th class="px-4 py-2">Content Testimony</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo e($index+1); ?></td>
                            <td class="border px-4 py-2"><button wire:click="switchPublish(<?php echo e($row->id_testimony); ?>)"><?php echo $row->publish_label; ?></button></td>

                            <td class="border px-4 py-2 w-3/12">
                                <img src="<?php echo e($row->getPhoto()); ?>" class="object-contain h-48" alt="">
                            </td>
                            <td class="border px-4 py-2"><?php echo e($row->name); ?></td>
                            <td class="border px-4 py-2"><?php echo e($row->position); ?></td>
                            <td class="border px-4 py-2"><?php echo e($row->location); ?></td>
                            <td class="border px-4 py-2"><?php echo $row->content_testimony; ?></td>
                            <td class="border px-4 py-2 content-center">
                                <button wire:click="edit(<?php echo e($row->id_testimony); ?>)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mb-1 rounded">Edit</button>
                                <button wire:click="detail(<?php echo e($row->id_testimony); ?>)" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mb-1 rounded">Detail</button>
                                <button wire:click="delete(<?php echo e($row->id_testimony); ?>)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mb-1 rounded">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td class="border px-4 py-2 text-center" colspan="8">Tidak ada data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php echo e($data->links()); ?>

        </div>
    </div>
</div>
<?php /**PATH /var/www/html/php74/tes/resources/views/livewire/testimonyManage/manage.blade.php ENDPATH**/ ?>