@extends('admin.layout')

@section('main')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header with-border">
                <h2 class="card-title">{{ $title_description??'' }}</h2>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ $url_action }}" method="post" accept-charset="UTF-8" class="form-horizontal" id="form-main"
                enctype="multipart/form-data">


                <div class="card-body">
                        @php
                        $descriptions = $maintain->descriptions->keyBy('lang')->toArray();
                        @endphp

                        @foreach ($languages as $code => $language)
                        <div class="card">
                            <div class="card-header with-border">
                                <h3 class="card-title">{{ $language->name }} {!! sc_image_render($language->icon,'20px','20px', $language->name) !!}</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                      <i class="fas fa-minus"></i>
                                    </button>
                                  </div>
                            </div>
                            <div class="card-body">
                                <div
                                    class="form-group {{ $errors->has('descriptions.'.$code.'.maintain_content') ? ' text-red' : '' }}">
                                    <label for="{{ $code }}__maintain_content"
                                        class="col-sm-2 col-form-label">{{ trans('store_maintain.admin.description') }}</label>
                                    <div class="col-sm-8">
                                        <textarea id="{{ $code }}__maintain_content" class="editor"
                                            name="descriptions[{{ $code }}][maintain_content]">{{ old('descriptions.'.$code.'.maintain_content',($descriptions[$code]['maintain_content']??'')) }}</textarea>
                                        @if ($errors->has('descriptions.'.$code.'.maintain_content'))
                                        <span class="form-text">
                                            <i class="fa fa-info-circle"></i> {{ $errors->first('descriptions.'.$code.'.maintain_content') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                </div>


                <!-- /.card-body -->

                <div class="card-footer row">
                    @csrf
                    <div class="col-md-2">
                    </div>

                    <div class="col-md-8">
                        <div class="btn-group float-right">
                            <button type="submit" class="btn btn-primary">{{ trans('admin.submit') }}</button>
                        </div>

                        <div class="btn-group float-left">
                            <button type="reset" class="btn btn-warning">{{ trans('admin.reset') }}</button>
                        </div>
                    </div>
                </div>

                <!-- /.card-footer -->
            </form>
        </div>
    </div>
</div>

@endsection

@push('styles')

@endpush

@push('scripts')
@include('admin.component.ckeditor_js')


<script type="text/javascript">
    $(document).ready(function() {
    $('.select2').select2()
});

</script>

<script type="text/javascript">
    $('textarea.editor').ckeditor(
    {
        filebrowserImageBrowseUrl: '{{ route('admin.home').'/'.config('lfm.url_prefix') }}?type=content',
        filebrowserImageUploadUrl: '{{ route('admin.home').'/'.config('lfm.url_prefix') }}/upload?type=content&_token={{csrf_token()}}',
        filebrowserBrowseUrl: '{{ route('admin.home').'/'.config('lfm.url_prefix') }}?type=Files',
        filebrowserUploadUrl: '{{ route('admin.home').'/'.config('lfm.url_prefix') }}/upload?type=file&_token={{csrf_token()}}',
        filebrowserWindowWidth: '900',
        filebrowserWindowHeight: '500'
    }
);
</script>

@endpush