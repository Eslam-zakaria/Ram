@extends('admin.layout.base')

@section('title')
    Show a Booking ({{ $form->name }})
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.offer-bookings.update', ['offer_booking' => $form->id]) }}">
                                @method('PUT')
                                @csrf

                                <div class="form-row " style="margin-bottom:  10px">

                                    <div class="form-group col-md-4  bmd-form-gtroup">
                                        <label for="attendance_date"> Order Number </label>
                                        <br>
                                        <input type="text" class="form-control"  value="{{$form->order_reference}}" readonly>
                                    </div>
                                    <div class="form-group col-md-8  bmd-form-gtroup">
                                    </div>

                                    <div class="form-group col-md-4  bmd-form-gtroup">
 
                                    <label for="attendance_date"> Client Name </label>
                                        <br>
                                        <input type="text" class="form-control"  value="{{$form->name}}" readonly>
                                    </div>

                                    <div class="form-group col-md-4  bmd-form-gtroup">
 
                                    <label for="attendance_date"> Client Email </label>
                                        <br>
                                        <input type="text" class="form-control"  value="{{$form->email}}" readonly>
                                    </div>

                                    <div class="form-group col-md-4  bmd-form-gtroup">
 
                                    <label for="attendance_date"> Client Phone </label>
                                        <br>
                                        <input type="text" class="form-control"  value="{{$form->phone}}" readonly>
                                    </div>

                                    <div class="form-group col-md-6  bmd-form-gtroup">
                                        <label for="attendance_date"> Offer Name </label>
                                        <br>
                                        <input type="text" class="form-control"  value="{{$form->offer->name}}" readonly>
                                    </div>

                                    <div class="form-group col-md-6  bmd-form-gtroup">
                                        <label for="attendance_date"> Offer Branche </label>
                                        <br>
                                        <input type="text" class="form-control"  value="{{$form->offer->branche->name}}" readonly>
                                    </div>

                                    <div class="form-group col-md-6  bmd-form-gtroup">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status">
                                                <option value="">-- Select --</option>
                                                <option value="0" {{ $form->status == '0' ? 'selected' : '' }}>Pending</option>
                                                <option value="1" {{ $form->status == '1' ? 'selected' : '' }}>Confirmed</option>
                                                <option value="2" {{ $form->status == '2' ? 'selected' : '' }}>Not Confirmed</option>
                                            </select>                                            
                                    </div>

                                    @include('admin.layout.field', field('textarea', 'notes', 'Notes', 12, $form))
                                </div>

                                <button type="submit" class="btn btn-primary pull-right">Save</button>
                                <button type="button" onclick="parent.history.back();" class="btn btn-danger">Back</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
