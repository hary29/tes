<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $__env->yieldContent('tittle'); ?></title>
        <!-- <meta name="description" content="<?php echo $__env->yieldContent('description'); ?>">
        <meta name="keywords" content="<?php echo $__env->yieldContent('keywords'); ?>"> -->

        <link rel="icon" href="<?php echo e(asset('/img/ps-logo/favicon.ico')); ?>" type="image/x-icon"/>

        <!-- bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <script src="<?php echo e(asset('/js/jquery-3.5.1.min.js')); ?>"></script>
        
        <script src="<?php echo e(asset('/js/custom.js')); ?>"></script>

        <link href="<?php echo e(asset('/css/style-landing.css')); ?>" rel="stylesheet">

        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    </head>

    <body>
        <script type="text/javascript">
            var APP_URL = <?php echo json_encode(url('/')); ?>

        </script>

        <!-- <div class="container"> -->
            <?php echo $__env->make('layout/menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('layout/modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->yieldContent('container'); ?>
            
        <!-- </div> -->
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
       
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <footer class="footer pt-3">
            <p>Created By: patungansedekah.com<br>
            <a href="mailto:admin@timpatungansedekah.com">admin@patungansedekah.com</a></p>
            <div class="text-center center-block">
                <a href="https://www.facebook.com" target="_blank"><i id="social-fb" class="fa fa-facebook fa-3x social"></i></a>
	            <a href="https://twitter.com" target="_blank"><i id="social-tw" class="fa fa-twitter fa-3x social"></i></a>
	            <a href="https://instagram.com" target="_blank"><i id="social-ig" class="fa fa-instagram fa-3x social"></i></a>
	            <a href="mailto:bootsnipp@gmail.com" target="_blank"><i id="social-em" class="fa fa-envelope fa-3x social"></i></a>
            </div>
        </footer>
    </body>
</html>
<?php /**PATH /var/www/html/php74/tes/resources/views/layout/main.blade.php ENDPATH**/ ?>