@extends('admin.layout.base')

@section('title')
    Edit a Lead ({{ $form->name }})
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.leads.update', ['lead' => $form->id]) }}">
                                @method('PUT')
                                @csrf

                                <div class="form-row " style="margin-bottom:  10px">
                                    @include('admin.layout.field', field('text', 'name', 'Name', 4, $form))
                                    @include('admin.layout.field', field('text', 'email', 'Email', 4, $form))
                                    @include('admin.layout.field', field('text', 'phone', 'Phone', 4, $form))
                                    <div class="form-group col-md-4  bmd-form-gtroup">
                                        <label for="attendance_date"> Branche </label>
                                        <br>
                                        <input type="text" class="form-control"  value="{{ $form->branche->name ? $form->branche->name : ''}}" readonly>
                                    </div>
                                    <div class="form-group col-md-4  bmd-form-gtroup">
                                        <label for="attendance_date"> Speciality </label>
                                        <br>
                                        <input type="text" class="form-control"  value="{{ $form->speciality->name ? $form->speciality->name : ''}}" readonly>
                                    </div>
                                    <div class="form-group col-md-4  bmd-form-gtroup">
                                        <label for="attendance_date"> Doctor </label>
                                        <br>
                                        <input type="text" class="form-control"  value="{{ $form->doctor->name ? $form->doctor->name : ''}}" readonly>
                                    </div>
                                    @if($form->source == "installment")
                                    @include('admin.layout.field', field('select', 'company', 'Company', 4, $form, \Modules\Lead\Constants\InstallmentCompany::getList()))
                                    @endif
                                    @if($form->source == "rates")
                                    <div class="form-group col-md-6 ">
                                        <label for="rating"> Rating </label>
                                        <br>
                                        <textarea type="text" class="form-control" rows="10" readonly>
                                            @foreach($rates as $rate) 
                                            {{ preg_replace("/\r|\n/", " ", $rate) }}
                                            @endforeach
                                        </textarea>
                                    </div>
                                    @endif
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
