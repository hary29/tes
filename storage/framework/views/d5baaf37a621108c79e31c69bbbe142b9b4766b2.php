  

  <?php $__env->startSection('tittle','Index'); ?>
  <?php $__env->startSection('container'); ?>
  
<section class="container-fluid mt-5 mb-3">
  <?php if($dataAbout) { ?>
    <div class="p-3 bg-white">
      <div class="row">
        <div class="col-lg-6 col-md-6 text-center my-5">
          <h2 class="title quicksand"><?php echo $dataAbout['title']; ?></h2>
          <?php echo $dataAbout['short_content']; ?>

        </div>
        <div class="col-lg-6 col-md-6 text-center my-5">
          <a href="<?php echo e(url('/about')); ?>"><img  class="w-75 logo-front" src="<?php echo e($dataAbout->getPhoto()); ?>" alt="logo"></a>
        </div>
      </div>
    </div>
  <?php } ?>
</section>

<div class="container-fluid">
  <?php echo $__env->make('layout/sliderHome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<?php if($dataArticleNew) { ?>
  <div class="container p-3 bg-white">
    <h1 style="text-align: center;" class="pb-4"><?php echo $dataArticleNew->title; ?></h1>
    <p><?php echo $dataArticleNew['description']; ?></p>
  </div> 
<?php } ?>

<div class="container-fluid my-3 py-2">
  <div class="text-center pb-4">
    <h2 class="my-2">Latest News</h2>
  </div>
  <div class="row justify-content-md-center">
    <?php if($dataArticle){ ?>
      <?php $__empty_1 = true; $__currentLoopData = $dataArticle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-sm-3">
          <div class="card shadow p-3 mb-5 bg-white rounded">
            <div class="card-body">
              <img  class="my-1 px-4 w-100" src="<?php echo e($row->getPhoto()); ?>" alt=""> 
              <h5 class="card-title"><?php echo $row->title; ?></h5>
              <p class="text-secondary">
                <small>
                  Publish at <?php echo e(\Carbon\Carbon::parse($row->publish_date)->format('d F Y')); ?> | by <?php echo e($row->userCreated->name); ?>

                </small>
              </p>
              <p class="card-text"><?php echo $row->short_description; ?></p>
              <div class="text-center">
                <a href="<?php echo e(url('article?id='.$row->id_article.'&title='.$row->title)); ?>" class="btn btn-primary modalMd" value="" title="Show Data" target="dialog" >
                  Go to article
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div class="py-2 shadow text-center">
        <p>Tidak ada data</p>
      </div>
      <?php endif; ?>
    <?php } ?>
  </div>

  <div class="text-center">
  
  <a href="<?php echo e(url('/article')); ?>" class="btn btn-success"><i class='fa fa-location-arrow'></i> More Article</a>
  </div>
</div>

<div class="container-fluid p-3 my-3">
  <div class="row btm-row-index">
    <div class="col-sm">
      <h2>Lorem ipsum</h2>
      <ul>
        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi nisi ipsam numquam, qui quis debitis architecto, nobis ex hic ipsa, iste magni assumenda obcaecati itaque ad est nostrum eos fuga.</li>
        <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus magnam consequuntur officiis corporis impedit quisquam incidunt laboriosam quasi quae, eius culpa, excepturi labore! Temporibus cum dolorum recusandae sunt quod similique.</li>
      </ul>
    </div>
    <div class="col-sm embed-responsive embed-responsive-16by9">
      <iframe width="560" height="315" class="py-3" src="https://www.youtube.com/embed/tgbNymZ7vqY" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
      </iframe>
    </div>
  </div>
</div>

  <?php $__env->stopSection(); ?>

  <script>
    
  // alert('tess')
  //     console.log('tess');
  </script>
<?php echo $__env->make('layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/php74/tes/resources/views/site/index.blade.php ENDPATH**/ ?>