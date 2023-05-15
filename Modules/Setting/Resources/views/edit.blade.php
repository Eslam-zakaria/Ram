@extends('admin.layout.base')

@section('title')
    Edit a Setting ({{ $form->name }})
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form class="form" method="POST"  enctype="multipart/form-data" action="{{ route('admin.settings.update', ['setting' => $form->id]) }}">
                                @method('PUT')
                                @csrf

                                <div class="form-row">
                                    <div class="default-tab " style="width: 100%">
                                        <ul class="nav nav-tabs" role="tablist">
                                            @foreach(config('translatable.locales') as $locale)
                                                <li class="nav-item">
                                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-toggle="tab" href="#{{ $locale }}">  {{ trans('messages.'.$locale) }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content">
                                            @foreach(config('translatable.locales') as $locale)
                                                <div class="tab-pane fade {{ $loop->first ? "active show" : '' }}" id="{{ $locale }}" role="tabpanel">
                                                    <div class="pt-4">
                                                        @include('admin.layout.field', field('text', $locale.'[name]', 'Name', 6, $form->translate($locale), ['key' => 'name']))
                                                        @if($form->type == \App\Constants\SettingTypes::TEXT)
                                                            @include('admin.layout.field', field('textarea', $locale.'[value]', 'Value', 6, $form->translate($locale), ['key' => 'value']))
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>

                                    @include('admin.layout.field', field('disabled', 'key', 'Key', 6, $form))
{{--                                    @include('admin.layout.field', field('select', 'type', 'Type', 3, $form, \App\Constants\SettingTypes::getList()))--}}
                                    @if($form->type == \App\Constants\SettingTypes::IMAGE)
                                        @include('admin.layout.field', field('file', 'image', 'Image ', 12, $form))
                                    @endif
                                </div>

                                @if($form->type == \App\Constants\SettingTypes::IMAGE)
                                    @if($form->image)
                                        <div class="col-md-1 offset-md-4">
                                            <img class="p-4 width300" src="{{ $form->image }}"></img>
                                        </div>
                                    @endif
                                @endif

                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
