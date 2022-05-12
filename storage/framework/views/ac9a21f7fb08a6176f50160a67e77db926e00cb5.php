<div class="modal-content">
    <div class="modal-title">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="bold">Report Details</h4>
    </div>

    <div class="modal-body">
        <span class="bold">Video Title&nbsp;:</span>&nbsp; <?php echo e($target->video); ?> <br>
        <span class="bold">User Name&nbsp;:</span>&nbsp; <?php echo e($target->user); ?><br>

        <h5 class=" margin-top-20">Report &nbsp;:</h5>
        <div class="report-text margin-top-10">
            <?php echo e($target->report); ?>

        </div>
    </div>

</div>
<?php /**PATH /home/tausif/Desktop/rupom/mainProject/news_app/resources/views/report/reportShow.blade.php ENDPATH**/ ?>