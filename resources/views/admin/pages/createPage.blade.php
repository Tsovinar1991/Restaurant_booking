@extends('layouts.admin')

@section('css')
    <style>

        /*.hidden{display:none;}*/
        iframe {
            min-height: 200px;
        }
    </style>
@endsection

@section('page', 'Create Page')

@section('content')

    <form class="form-horizontal" role="form" method="POST" action="{{url('admin/pages')}}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name_ru') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Name Ru</label>
            <div class="col-md-10">
                <input id="name" type="text" class="form-control" name="name_ru" value="{{ old('name_ru') }}" required
                       autofocus>
                @if ($errors->has('name_ru'))
                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('name_ru') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('name_am') ? ' has-error' : '' }}">
            <label for="name_am" class="col-md-4 control-label">Name Am</label>
            <div class="col-md-10">
                <input id="name_am" type="text" class="form-control" name="name_am" value="{{ old('name_am') }}"
                       required autofocus>
                @if ($errors->has('name_am'))
                    <span class="help-block  text-danger">
                                        <strong>{{ $errors->first('name-am') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('name_en') ? ' has-error' : '' }}">
            <label for="name_en" class="col-md-4 control-label">Name En</label>
            <div class="col-md-10">
                <input id="name_en" type="text" class="form-control" name="name_en" value="{{ old('name_en') }}"
                       required autofocus>
                @if ($errors->has('name_en'))
                    <span class="help-block  text-danger">
                                        <strong>{{ $errors->first('name_en') }}</strong>
                                    </span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('description_ru') ? ' has-error' : '' }}">
            <label for="description" class="col-md-4 control-label">Description Ru</label>
            <div class="col-md-10">
                <textarea id="description" class="form-control mytextarea"
                          name="description_ru">{{ old('description_ru') }}</textarea>
                <input name="image" type="file" id="id" class="hidden" onchange="">

                @if ($errors->has('description_ru'))
                    <span class="help-block  text-danger">
                                        <strong>{{ $errors->first('description_ru') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('description_am') ? ' has-error' : '' }}">
            <label for="description_am" class="col-md-4 control-label">Description Am</label>
            <div class="col-md-10">
                <textarea id="description_am" class="form-control mytextarea"
                          name="description_am">{{ old('description_am') }}</textarea>
                <input name="image" type="file" id="upload" class=" hidden" onchange="">
                @if ($errors->has('description_am'))
                    <span class="help-block  text-danger">
                                        <strong>{{ $errors->first('description_am') }}</strong>
                                    </span>
                @endif

            </div>
        </div>

        <div class="form-group{{ $errors->has('description_en') ? ' has-error' : '' }}">
            <label for="description_en" class="col-md-4 control-label">Description En</label>
            <div class="col-md-10">
                <textarea id="description_en" class="form-control mytextarea"
                          name="description_en">{{ old('description_en') }}</textarea>
                <input name="image" type="file" id="upload" class="hidden" onchange="">
                @if ($errors->has('description_en'))
                    <span class="help-block  text-danger">
                                        <strong>{{ $errors->first('description_en') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-outline-success">
                    Submit
                </button>
            </div>
        </div>
    </form>


@endsection

@section('js')

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>



    <script>
        $(document).ready(function () {
            tinymce.init({
                selector: "textarea",
                theme: "modern",
                paste_data_images: true,
                plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
                ],
                toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                toolbar2: "print preview media | forecolor backcolor emoticons",
                image_advtab: true,
                file_picker_callback: function (callback, value, meta) {
                    if (meta.filetype == 'image') {
                        $('#upload').trigger('click');
                        $('#upload').on('change', function () {
                            var file = this.files[0];
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                callback(e.target.result, {
                                    alt: ''
                                });
                            };
                            reader.readAsDataURL(file);
                        });
                    }
                },
                templates: [{
                    title: 'Test template 1',
                    content: 'Test 1'
                }, {
                    title: 'Test template 2',
                    content: 'Test 2'
                }]
            });
        });
    </script>


@endsection