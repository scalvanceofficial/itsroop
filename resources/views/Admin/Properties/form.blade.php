@extends('layouts.admin')
@section('title')
    Properties Management
@endsection
@section('content')
    <form method="POST"
        action="{{ Route::is('admin.properties.create') ? route('admin.properties.store') : route('admin.properties.update', ['property' => $property->id]) }}"
        enctype="multipart/form-data" autocomplete="off" id="propertiesForm">
        @csrf
        {{ Route::is('admin.properties.create') ? '' : method_field('PUT') }}
        <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-header">
                        <h5> {{ Route::is('admin.properties.create') ? 'Create' : 'Edit' }} Property </h5>
                    </div>
                    <div class="card-body border-top">
                        <div class="row mt-4">
                            <div class="col-sm-12 col-md-4">
                                <label class="control-label col-form-label">
                                    Name
                                    <sup class="text-danger">*</sup>
                                </label>
                                <input type="text" class="form-control" placeholder="Enter name" name="name"
                                    value="{{ isset($property) ? $property->name : '' }}" />
                                <div id="name-error" style="color:red"></div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label class="control-label col-form-label">Label </label>
                                <input type="text" class="form-control" placeholder="Enter label" name="label"
                                    value="{{ isset($property) ? $property->label : '' }}" />
                                <div id="label-error" style="color:red"></div>
                            </div>
                            <div class="col-sm-12 col-md-4 mb-4">
                                <label class="control-label col-form-label">Is Colour (Reference With Property
                                    Name)<sup class="text-danger">*</sup></label>
                                <select class="form-control" name="is_color" id="isColor">
                                    <option value="" disabled selected>Select</option>
                                    <option value="YES"
                                        {{ isset($property) && $property->is_color == 'YES' ? 'selected' : '' }}>Yes
                                    </option>
                                    <option value="NO"
                                        {{ isset($property) && $property->is_color == 'NO' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                                <div id="is_color-error" style="color:red"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-9 d-flex justify-content-start">
                                <h5> {{ Route::is('admin.properties.create') ? 'Create' : 'Edit' }} Property Values</h5>
                            </div>
                            <div class="col-3 d-flex justify-content-end">
                                <a id="addValueBtn" style="margin-top:-1.5%;" class="btn btn-md btn-primary pull-right">
                                    Add Values <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-top" id="createValuesBody">
                        @if (isset($property))
                            @foreach ($property->propertyValues as $property_value)
                                <div class="row valueRow">
                                    <div class="col-md-12">
                                        <div id="whole-div-{{ $property_value->id }}"
                                            class="whole-div-{{ $property_value->id }}"
                                            data-value-id="{{ $property_value->id }}"
                                            style="border: 2px solid #5d87ff; padding: 13px 25px; margin-top: 13px; margin-bottom: 13px; border-radius: 10px;">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="text" name="names[{{ $property_value->id }}]"
                                                        value="{{ $property_value->name }}" class="form-control"
                                                        placeholder="Value" required />
                                                </div>

                                                @if ($property->is_color == 'YES' && $property_value->color)
                                                    <div class="col-md-3 color-input-field"
                                                        id="color-input-field-{{ $property_value->id }}">
                                                        <div class="form-group">
                                                            <input type="color" class="form-control form-control-color"
                                                                name="colors[{{ $property_value->id }}]"
                                                                value="{{ $property_value->color }}"
                                                                title="Choose your color" />
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-md-3"></div>
                                                @endif


                                                <div class="col-md-2">
                                                    <div class="form-check form-switch mt-2">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="status_{{ $property_value->id }}"
                                                            name="statuses[{{ $property_value->id }}]" value="ACTIVE"
                                                            {{ $property_value->status === 'ACTIVE' ? 'checked' : '' }}>
                                                    </div>
                                                </div>

                                                <div class="col-md-2 d-flex justify-content-end">
                                                    <input type="number" id="value_index_{{ $property_value->id }}"
                                                        name="indexes[{{ $property_value->id }}]"
                                                        value="{{ $property_value->index }}" class="form-control index"
                                                        placeholder="Index" required />
                                                </div>

                                                <div class="col-md-1 d-flex justify-content-end" style="padding:5px;">
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm float-right removeValueBtn">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="submit-btn">
                            <span class="spinner-span" role="status" aria-hidden="true"></span>
                            <span class="save-btn-text">Save</span>
                            &nbsp;
                            <i class="ti ti-device-floppy"></i>
                        </button>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{ route('admin.properties.index') }}" type="button" class="btn btn-danger">
                            Cancel
                            <i class="ti ti-arrow-back-up-double"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function(e) {

            $('#addValueBtn').click(function(e) {
                createValue();
            });

            $('#propertiesForm').submit(function(e) {
                e.preventDefault();
                $('#submit-btn').attr('disabled', true)
                $('.spinner-span').addClass('spinner-border spinner-border-sm')

                $('div[id$="-error"]').empty();

                var form = $(this);
                var url = form.attr('action');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        if (data.status == 'success') {
                            toastr.success(data.message, '', {
                                showMethod: "slideDown",
                                hideMethod: "slideUp",
                                timeOut: 1500,
                                closeButton: true,
                            });

                            setTimeout(function() {
                                window.location.href = "{!! route('admin.properties.index') !!}";
                            }, 100);

                        } else {
                            $('#submit-btn').attr('disabled', false);
                            $('.spinner-span').removeClass('spinner-border spinner-border-sm')
                            toastr.error('There is some error!!', '', {
                                showMethod: "slideDown",
                                hideMethod: "slideUp",
                                timeOut: 1500,
                                closeButton: true,
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $('#submit-btn').attr('disabled', false);
                        $('.spinner-span').removeClass('spinner-border spinner-border-sm')
                        toastr.error(xhr.responseJSON.message,
                            '', {
                                showMethod: "slideDown",
                                hideMethod: "slideUp",
                                timeOut: 1500,
                                closeButton: true,
                            });

                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('#' + key + '-error').html(value);
                        });

                        $('html, body').animate({
                            scrollTop: $('#' + Object.keys(xhr.responseJSON.errors)[0] +
                                    '-error')
                                .offset().top - 200
                        }, 500);
                    }
                });
            });
        });

        $(document).on('click', '.removeValueBtn', function() {
            $(this).closest('.valueRow').remove();
        });

        function createValue() {
            $.ajax({
                type: "POST",
                url: '/admin/properties/values/create',
                data: {
                    _token: '{{ csrf_token() }}',
                    is_color: $('#isColor').val()
                },
                success: function(data) {
                    $('#createValuesBody').prepend(data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    toastr.error(xhr.responseJSON.message, '');
                }
            });
        };
    </script>
@endsection
