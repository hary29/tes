<?php $__env->startSection('tittle','Article'); ?>
<?php $__env->startSection('container'); ?>

<section>
<div class="container my-5 pt-3">
  <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="row my-2 shadow">
      <div class="col col-lg-3 pb-2">
        <a href="<?php echo e(url('article?id='.$row->id_article.'&title='.$row->title)); ?>">
          <img src="<?php echo e($row->getPhoto()); ?>" class="w-100" alt="">
        </a>
      </div>
      <div class="col mt-3 pb-2">
        <a href="<?php echo e(url('article?id='.$row->id_article.'&title='.$row->title)); ?>">
          <h2><?php echo $row->title; ?></h2>
        </a>
        <p class="text-secondary">
          Publish at <?php echo e(\Carbon\Carbon::parse($row->publish_date)->format('d F Y')); ?> | by <?php echo e($row->userCreated->name); ?>

        </p>
        <p><?php echo $row->short_description; ?></p>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="py-2 shadow text-center">
        <p>Tidak ada data</p>
    </div>
  <?php endif; ?>
</div>

<div class="d-flex justify-content-center">
    <?php echo $data->links(); ?>

</div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/php74/tes/resources/views/site/article-home.blade.php ENDPATH**/ ?>