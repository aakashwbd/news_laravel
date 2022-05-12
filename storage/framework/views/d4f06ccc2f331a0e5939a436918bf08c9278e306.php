<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $title = \App\Models\Setting::first();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <?php if($title && $title->logo): ?>
            <link rel="shortcut icon" type="image/jpg" href="<?php echo e(URL::to('/')); ?>/uploads/<?php echo e($title->logo); ?>" />
        <?php endif; ?>
        <?php if($title && $title->system_name): ?>
            <title><?php echo e($title->system_name); ?></title>
        <?php else: ?>
            <title>Radio App</title>
        <?php endif; ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://use.fontawesome.com/dcd31f63af.js"></script>
    <script src="https://kit.fontawesome.com/ab8915b796.js" crossorigin="anonymous"></script>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://code.iconify.design/2/2.0.4/iconify.min.js"></script>
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css"
        integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/filepond/4.30.3/filepond.min.css"
        integrity="sha512-Zgp/CdUqOMnAY0ReSgoyZ2rk7CBVP0TqF+nTxDRo/mS0WEfQ+GOAaQDgHemhvd/C4rNrACYF/wyDqEYxhSN9dQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/responsive.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">


</head>
<div id="preloader" class="d-none">
    <div id="status">
    </div>
</div>
<?php /**PATH /home/tausif/Desktop/rupom/mainProject/news_app/resources/views/layouts/default/header.blade.php ENDPATH**/ ?>