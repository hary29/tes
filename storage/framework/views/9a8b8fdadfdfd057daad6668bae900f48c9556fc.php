<?php $__env->startSection('tittle','Article Manage'); ?>
 <?php $__env->slot('header'); ?> 
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Data Article
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

            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Tambah Article</button>
            <?php if($isDetail): ?>
                <?php echo $__env->make('livewire.articleManage.detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php elseif($isModal): ?>
                <?php echo $__env->make('livewire.articleManage.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Publish</th>
                        <th class="px-4 py-2">Foto</th>
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Short Content</th>
                        <th class="px-4 py-2">Discription</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                    <tr class="">
                        <th class="border px-4 py-2"></th>
                        <th class="border px-4 py-2"></th>
                        <th class="border px-4 py-2"></th>
                        <th class="border px-4 py-2"><input type="search" name="searchTitle" placeholder="Search by title" class="bg-white rounded-full text-sm focus:outline-none border-green-500" wire:model="searchTitle"></th>
                        <th class="border px-4 py-2"><input type="search" name="searchContent" placeholder="Search by content" class="bg-white rounded-full text-sm focus:outline-none border-green-500" wire:model="searchContent"></th>
                        <th class="border px-4 py-2"><input type="search" name="searchDescription" placeholder="Search by description" class="bg-white rounded-full text-sm focus:outline-none border-green-500" wire:model="searchDescription"></th>
                        <th class="border px-4 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $pages = request()->get('page');
                    if ($page){
                        $page = ($page-1)*$pagination;
                    }else{
                        $page =  $pages;
                    }
                    ?>
                    <?php $__empty_1 = true; $__currentLoopData = $article; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr>
                            <td class="border px-4 py-2"><?php echo e($page+$index+1); ?></td>
                            <td class="border px-4 py-2"><button wire:click="switchPublish(<?php echo e($row->id_article); ?>)"><?php echo $row->publish_label; ?></button></td>

                            <td class="border px-4 py-2 w-3/12">
                                <img src="<?php echo e($row->getPhoto()); ?>" class="object-contain h-48" alt="">
                            </td>
                            <td class="border px-4 py-2"><?php echo e($row->title); ?></td>
                            <td class="border px-4 py-2"><?php echo $row->short_content; ?></td>
                            <?php $desc = strlen($row->description) > 50 ? substr($row->description,0,50)." ....." : $row->description; ?>
                            <td class="border px-4 py-2"><?php echo $desc; ?></td>
                            <td class="border px-4 py-2 content-center">
                                <button wire:click="edit(<?php echo e($row->id_article); ?>)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mb-1 rounded">Edit</button>
                                <button wire:click="detail(<?php echo e($row->id_article); ?>)" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mb-1 rounded">Detail</button>
                                <button wire:click="delete(<?php echo e($row->id_article); ?>)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mb-1 rounded">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td class="border px-4 py-2 text-center" colspan="7">Tidak ada data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php echo e($article->links('vendor.pagination.tailwind')); ?>

        </div>
    </div>
</div><?php /**PATH /var/www/html/php74/tes/resources/views/livewire/articleManage/article.blade.php ENDPATH**/ ?>