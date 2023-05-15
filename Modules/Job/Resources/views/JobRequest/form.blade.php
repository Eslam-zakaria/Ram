<div class="modal fade" id="applyJob" tabindex="-1" aria-labelledby="applyJobLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                <svg class="icon">
                    <use xlink:href="assets/images/icons/kahhal-icons.svg#close-icon"></use>
                </svg>
            </button>
            <div class="modal-body jobRequestContainer text-center">
                <h5>
                    {{ __('messages.Apply For') }}
                    <span id="jobTitle"></span>
                </h5>
                <div class="apply__form">
                    <form method="post"  enctype="multipart/form-data" action="{{ route('api.job.requests.store') }}" class="form jobRequestForm">
                        @csrf

                        <input type="hidden" name="job_id" id="jobId" value="">

                        <div class="form-group">
                            <label class="sr-only" for="fullName">{{ __('messages.Full Name') }}</label>
                            <input type="text" required name="name" class="form-control" id="fullName" placeholder="{{ __('messages.Full Name') }}">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="emailAddress">{{ __('messages.Email Address') }}</label>
                            <input type="email"  required name="email" class="form-control" id="emailAddress" placeholder="{{ __('messages.Email Address') }}">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="phoneNumber">{{ __('messages.Phone Number') }}</label>
                            <input type="tel"  required name="phone"  class="form-control" id="phoneNumber" placeholder="{{ __('messages.Phone Number') }}">
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <label class="form-control custom-file-label" for="resume">{{ __('messages.Upload Your Resume') }}</label>
                                <input type="file" class="custom-file-input" name="resume"  id="resume" accept="application/pdf,application/vnd.ms-excel">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="notes">{{ __('messages.Notes') }}</label>
                            <textarea class="form-control" id="notes" name="notes" placeholder="{{ __('messages.Notes') }}"></textarea>
                        </div>
                        <button type="submit" class="btn btn-main btn-lg btn-block">{{__('messages.Send')}}</button>
                    </form>
                </div>
            </div>
            <!-- success -->
            <div class="sent d-flex align-items-center " style="display: none!important;">
                <svg class="icon">
                    <use xlink:href="/web/assets/images/icons/kahhal-icons.svg#sent"></use>
                </svg>
                <p class="lead">
                    {{ __('messages.Job Applied Success Message') }}
                </p>
            </div>
            <!-- // success -->
        </div>
    </div>
</div>

