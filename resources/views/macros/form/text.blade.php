@include('macros.form.base-head')
    <input type="text"
           class="form-control"
           data-track-changes="{{$app['form']->getValueAttribute($name, $value)}}"
           name="{{$name}}"
           id="{{$name}}_id"
           placeholder="{{$attributes['placeholder']}}"
           value="{{Form::getValueAttribute($name, $value)}}"
    />
@include('macros.form.base-foot')