<div class="modal-content">
    <div class="modal-title">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="bold">Report Details</h4>
    </div>

    <div class="modal-body">
        <span class="bold">Video Title&nbsp;:</span>&nbsp; {{ $target->video }} <br>
        <span class="bold">User Name&nbsp;:</span>&nbsp; {{ $target->user }}<br>

        <h5 class=" margin-top-20">Report &nbsp;:</h5>
        <div class="report-text margin-top-10">
            {{ $target->report }}
        </div>
    </div>

</div>
