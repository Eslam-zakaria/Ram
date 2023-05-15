@if(in_array($type, ['text']))
    <div class="form-group col-md-{{$cols}} bmd-form-group  @error($name) has-danger @enderror">
        <label for="{{ $name }}"> {{ $label }}<span style="color: red">*</span></label>
        @php ($key = isset($options['key']) ? $options['key'] : $name )
        @php ($default = $form ? $form->$key : '' )
        <input name="{{ $name }}" id="{{ $name }}" type="{{ $type }}" value="{{ old($name, $default) }}" class="form-control">

        @error($name)
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
@endif

@if(in_array($type, ['datetime-local']))
    <div class="form-group col-md-{{$cols}} bmd-form-group  @error($name) has-danger @enderror">
        <label for="{{ $name }}"> {{ $label }}</label>
        @php ($key = isset($options['key']) ? $options['key'] : $name )
        @php ($default = $form ? $form->$key : '' )
        <input name="{{ $name }}" id="{{ $name }}" type="{{ $type }}" value="{{ old($name, $default) }}" class="form-control">
        @error($name)
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
@endif

@if(in_array($type, ['textarea']))
    <div class="form-group col-md-{{$cols}} bmd-form-group  @error($name) has-danger @enderror">
        <label for="{{ $name }}"> {{ $label }}<span style="color: red">*</span></label>
        @php ($key = isset($options['key']) ? $options['key'] : $name )
        @php ($default = $form ? $form->$key : '' )
        <textarea name="{{ $name }}" id="{{ $name }}"  class="form-control" rows="20">{{ old($name, $default) }}</textarea>
        @error($name)
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
@endif

@if(in_array($type, ['file']))
    <div class="form-group col-md-{{$cols}} custom-file bmd-form-group  @error($name) has-danger @enderror mt-3 mb-3">
        <label for="{{ $name }}" class="custom-file-label"> {{ $label }}<span style="color: red">*</span></label>
        @php ($key = isset($options['key']) ? $options['key'] : $name )
        @php ($default = $form ? $form->$key : '' )
        <input name="{{ $name }}" id="{{ $name }}" type="{{ $type }}" value="{{ old($name, $default) }}" class="form-control custom-file-input" >
        @error($name)
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
@endif

@if(in_array($type, ['disabled']))
    <div class="form-group col-md-{{$cols}}  bmd-form-group  @error($name) has-danger @enderror">
        <label for="{{ $name }}" > {{ $label }}</label>
        @php ($key = isset($options['key']) ? $options['key'] : $name )
        @php ($default = $form ? $form->$key : '' )
        <input name="{{ $name }}" id="{{ $name }}" type="text" disabled value="{{ old($name, $default) }}" class="form-control">
    </div>
@endif

@if(in_array($type, ['password']))
    <div class="form-group col-md-{{$cols}} bmd-form-group  @error($name) has-danger @enderror">
        <label for="{{ $name }}"> {{ $label }}</label>
        <input name="{{ $name }}" id="{{ $name }}" type="{{ $type }}" value="" class="form-control">
    </div>
@endif

@if(in_array($type, ['toggle']))
    <div class="form-group col-md-{{$cols}}">
        @php ($default = $form ? old($name, $form->$name) : old($name) )
        <input id="{{$name}}" @if($default) checked @endif type="checkbox"  value="1" class="form-check-input @error($name) has-danger @enderror" name="{{ $name }}">
        <label for="{{ $name }}" class="form-check-label @error($name) has-danger @enderror">{{ $label  }}</label>
    </div>
@endif

@if(in_array($type, ['select']))
    <div class="form-group bmd-form-group  col-md-{{$cols}} @error($name) has-danger @enderror">
        <label for="{{ $name }}"> {{ $label }}<span style="color: red">*</span></label>

        @php ($default = $form ? old($name, $form->$name) : old($name) )
        <select id="{{$name}}"  @if($required) required @endif @if($multiple) multiple @endif class="form-control @error($name) has-danger @enderror" name="{{ $name }}">
            @if(!$multiple)  \<option value="">--- Choose {{ $label }} ---</option>@endif
            @foreach($options as $key => $option)
                <option {{ $default == $key ? 'selected' : '' }} value="{{ $key }}">{{ $option }}</option>
            @endforeach
        </select>
    </div>
@endif


@if(in_array($type, ['hidden']))
    <div class="form-group col-md-{{$cols}}  @error($name) has-danger @enderror">
        @php ($default = $form ? $form : '' )
        <input name="{{ $name }}" type="hidden" value="{{ $default }}" class="form-control">
    </div>
@endif
