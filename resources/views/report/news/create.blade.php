<div class="modal-content single-vido-modal">
    <div class="modal-body">
        <div class="report-box">

            <form id="reportCreateForm" method="POST" enctype="multipart/form-data">
                <div class="text-center">
                    <img src="{{ URL::to('/') }}/uploads/report.png" alt="" /> <br><br>
                    <span class="report-title">Report Movie ?</span>
                </div>

                <input type="hidden" name="video_id" value="{{ $request->video_id }}">
                <div class="form-group margin-top-40">
                    <textarea class="form-control report-create-form" id="report" name="report" rows="10"
                        placeholder="Tell us exactly why you felt like reporting the movie"></textarea>
                </div>

                <div class="actions margin-top-40">
                    <div class="row report-action">
                        <div class="col-md-6 text-center">
                            <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-md-6 text-center">
                            <button type="submit" class="report-submit" id="createReport">Report</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
