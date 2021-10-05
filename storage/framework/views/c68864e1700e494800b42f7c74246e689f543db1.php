<?php $__env->startSection('tittle','Article'); ?>
<?php $__env->startSection('container'); ?>

<section class="container my-5 pt-3">
    <div class="text-center pt-3">
      <img  class="" src="<?php echo e($data->getPhoto()); ?>" alt="" class="w-100" width="500px">   
    </div>
    <h2><?php echo $data['title']; ?></h2>
    <p class="text-secondary">
      Publish at <?php echo e(\Carbon\Carbon::parse($data['publish_date'])->format('d F Y')); ?> | by <?php echo e($data->userCreated->name); ?>

    </p>
    <p class="text-justify"><?php echo $data['description']; ?></p>
    
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/php74/tes/resources/views/site/detail-article.blade.php ENDPATH**/ ?>