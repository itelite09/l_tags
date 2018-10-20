// form
<div class="form-group @if ($errors->has('image')) has-error @endif">
{!! Form::label('image', 'Imagen') !!}
{!! Form::file('image', ['class' => 'form-control margin', 'id' => 'image']) !!}
@if ($errors->has('image')) <p class="help-block">{{ $errors->first('image') }}</p> @endif
</div>


<!-- Title of Post Form Input -->
<div class="form-group @if ($errors->has('tags')) has-error @endif">
{!!  Form::label('tags','Select Category:') !!}     
                {!! Form::select('tags[]', 
                ($tagsDropDown), 
                null, 
                ['multiple'=>true,'class' => 'form-control margin']) !!}
    @if ($errors->has('tags')) <p class="help-block">{{ $errors->first('tags') }}</p> @endif
</div>



@push('scripts')
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
@endpush