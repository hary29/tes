<?php $__env->startSection('tittle','User Manage'); ?>
 <?php $__env->slot('header'); ?> 
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Data User
    </h2>
 <?php $__env->endSlot(); ?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="">
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

            <?php if($isDetail): ?>
                <?php echo $__env->make('livewire.userManage.detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php elseif($isModal): ?>
            	<?php echo $__env->make('livewire.userManage.edit-role', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

			<!-- This example requires Tailwind CSS v2.0+ -->
			<div class="flex flex-col">
			  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
			    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
			      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
			        <table class="min-w-full divide-y divide-gray-200">
			          <thead class="bg-gray-50">
			            <tr>
			              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
			                Name
			              </th>
			              <!-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
			                Title
			              </th> -->
			              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
			                Status
			              </th>
			              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
			                Role
			              </th>
			              <th scope="col" class="px-6 py-3 text-left text-xs text-center font-medium text-gray-500 uppercase tracking-wider">
			                Action
			              </th>
			            </tr>
			          </thead>
			          <tbody class="bg-white divide-y divide-gray-200">

			          	<?php $__empty_1 = true; $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
			            <tr>
			              <td class="px-6 py-4 whitespace-nowrap">
			                <div class="flex items-center">
			                  <div class="flex-shrink-0 h-10 w-10">
			                  	<button wire:click="detail(<?php echo e($row->id); ?>)">
			                    	<img class="h-10 w-10 rounded-full" src="<?php echo e($row->profile_photo_url); ?>" alt="">
			                    </button>
			                  </div>
			                  <div class="ml-4">
			                    <div class="text-sm font-medium text-gray-900">
			                      <?php echo e($row->name); ?>

			                    </div>
			                    <div class="text-sm text-gray-500">
			                      <?php echo e($row->email); ?>

			                    </div>
			                  </div>
			                </div>
			              </td>
			              <!-- <td class="px-6 py-4 whitespace-nowrap">
			                <div class="text-sm text-gray-900">Regional Paradigm Technician</div>
			                <div class="text-sm text-gray-500">Optimization</div>
			              </td> -->
			              <td class="px-6 py-4 whitespace-nowrap">
			              	<button wire:click="switchPublish(<?php echo e($row->id); ?>)">
				                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
				                  <?php echo $row->publish_label; ?>

				                </span>
				            </button>
			              </td>
			              <td class=" text-sm text-gray-500">
			                <?php echo $row->role_label; ?>

			              </td>
			              
			              <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <button wire:click="edit(<?php echo e($row->id); ?>)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit Role</button>
                                <button wire:click="detail(<?php echo e($row->id); ?>)" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Detail</button>
                                <button wire:click="delete(<?php echo e($row->id); ?>)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hapus</button>
                            </td>
			            </tr>
			            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium" colspan="5">Tidak ada data</td>
                        </tr>
                    <?php endif; ?>
			          </tbody>
			        </table>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
	</div>
</div><?php /**PATH /var/www/html/php74/tes/resources/views/livewire/userManage/manage.blade.php ENDPATH**/ ?>