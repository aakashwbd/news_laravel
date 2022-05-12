<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>





<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>

<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>















<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="<?php echo e(asset('assets/js/chips.min.js')); ?>"></script>



 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"
integrity="sha512-NqYds8su6jivy1/WLoW8x1tZMRD7/1ZfhWG/jcRQLOzV1k1rIODCpMgoBnar5QXshKJGV7vi0LXLNXPoFsM5Zg=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<?php echo Toastr::message(); ?>



<script type="text/javascript" src="<?php echo e(asset('assets/js/imageUpload.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/custom.js')); ?>"></script>

<script type="text/javascript">
    // $(document).ready(function() {
    //     $('select').niceSelect();
    // });
</script>
<script type="text/javascript">
    $(window).load(function() { // makes sure the whole site is loaded
        $('#status').fadeOut(); // will first fade out the loading animation
        $('#preloader').delay(50).fadeOut(100); // will fade out the white DIV that covers the website.
        $('body').delay(50).css({'overflow':'visible'});
    })
</script>
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "f45a0b83-4ebe-435d-971d-8fa9ed4dda6e",
      safari_web_id: "web.onesignal.auto.13f7d09c-87f4-478e-9a86-b96c3b883b5b",
      notifyButton: {
        enable: true,
      },
      allowLocalhostAsSecureOrigin: true,
    });
  });
</script>

<script>
 $('#close').click(function(){
      $('#sitebar').hide().css("transition","1s")
 })

$('#sideBarHide').click(function(){
    $('#sitebar').toggle(function(){
    //    $('.main-body').css('width','100%');
    })

})
</script>

<?php echo $__env->yieldPushContent("custom-js"); ?>
<?php /**PATH /home/projectx/Desktop/Dev-Project/news_app/resources/views/layouts/default/footerScript.blade.php ENDPATH**/ ?>