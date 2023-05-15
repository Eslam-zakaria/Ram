@extends('admin.layout.base')

@section('title')
    Edit a Booking ({{ $form->name }})
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.bookings.update', ['booking' => $form->id]) }}">
                                @method('PUT')
                                @csrf

                                <div class="form-row " style="margin-bottom:  10px">
                                    @include('admin.layout.field', field('text', 'name', 'Name', 4, $form))
                                    @include('admin.layout.field', field('text', 'phone', 'Phone', 4, $form))

                                    <div class="form-group col-md-4  bmd-form-gtroup">
                                        <label for="attendance_date"> Attendance Date  </label>
                                        <br>
                                        <input type="datetime" class="form-control"  name="attendance_date" value="{{$form->attendance_date}}" readonly>
                                    </div>
                                    @include('admin.layout.field', field('select', 'branche_id', 'Branch', 4, $form, $branches))
                                    
                                    <div class="form-group col-md-4  bmd-form-gtroup">
                                        <label for="attendance_date"> Speciality </label>
                                        <br>
                                        <input type="text" class="form-control"  value="{{ $form->speciality->name ? $form->speciality->name : ''}}" readonly>
                                    </div>
                                    @include('admin.layout.field', field('select', 'doctor_id', 'Doctor', 4, $form, $doctors))
                                    <div class="form-group col-md-6  bmd-form-gtroup">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="sent">
                                                <option value="">-- Select --</option>
                                                <option value="0" {{ $form->sent == '0' ? 'selected' : '' }}>Pending</option>
                                                <option value="1" {{ $form->sent == '1' ? 'selected' : '' }}>Confirmed</option>
                                                <option value="2" {{ $form->sent == '2' ? 'selected' : '' }}>Not Confirmed</option>
                                            </select>                                            
                                    </div>
                                    @include('admin.layout.field', field('textarea', 'notes', 'Notes', 6, $form))
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
