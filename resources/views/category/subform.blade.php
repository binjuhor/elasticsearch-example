@extends('layouts.app')

@section('header')
<a class="navbar-brand" href="{{action('TaxonomyController@index')}}">{{trans('taxonomies.list')}}</a>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <legend>Add new taxonomy</legend>
                    </div>
                    <div class="content">
                        <form id="form-taxonomy" action="{{action('TaxonomyController@updateSubCateory',[$taxitem->id])}}" method="post" class="form-horizontal">
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Taxonomy name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="taxname" value="@if(isset($taxitem)){{$taxitem->taxname}}@endif">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea  class="form-control" id="description" name="description">@if(isset($taxitem)){{$taxitem->description}}@endif</textarea>
                                        <span class="help-block">Short description for this taxonomy.</span>
                                    </div>
                                </div>
                            </fieldset>


                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Archive</label>
                                    <div class="col-sm-10">
                                        <label class="checkbox">
                                            <input type="checkbox" data-toggle="checkbox" name="archive" value="1">Enable archive
                                        </label>
                                    </div>
                                </div>
                            </fieldset>


                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Status</label>
                                    <div class="col-sm-5 row-no-padding">
                                        <label class="radio radio-inline">
                                            <input type="radio" data-toggle="radio" name="status" value="0" @if(isset($taxitem) ) @if($taxitem->status == 0) checked="checked" @endif @endif @if(!isset($taxitem))  checked="checked" @endif>Disabled
                                        </label>
                                        <label class="radio radio-inline">
                                            <input type="radio" data-toggle="radio" name="status" value="1" @if(isset($taxitem) ) @if($taxitem->status == 1) checked="checked" @endif @endif>Public
                                        </label>
                                        <label class="radio radio-inline">
                                            <input type="radio" data-toggle="radio" name="status" value="2" @if(isset($taxitem) ) @if($taxitem->status == 2) checked="checked" @endif @endif>Private
                                        </label>

                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Child category</label>
                                    <div class="col-sm-10 row-no-padding">

                                        <div class="select-parrentcate div-inline col-md-12">
                                            <select multiple data-title="Select child"  name="sublist[]" class="selectpicker" data-style="btn-info btn-block" data-menu-style="dropdown-blue">
                                                @foreach ($taxonomies as $taxonomy)
                                                    <option @if(isset($taxitem) && in_array($taxonomy->id, $sublist,TRUE)) selected @endif value="{{ $taxonomy->id }}">{{ $taxonomy->taxname }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Thumbs</label>
                                    <div class="col-sm-10">
                                        <input type="file" placeholder="" name="thumbs" value="@if(isset($taxitem)){{$taxitem->thumbs}}@endif" class="form-control">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <button class="btn btn-default btn-fill btn-wd">@if(isset($taxitem)) Update @else Create @endif</button>
                                    </div>
                                </div>
                            </fieldset>

                        </form>
                    </div>
                </div>  <!-- end card -->
            </div> <!-- end col-md-12 -->
        </div> <!-- end row -->
    </div>
@endsection


@section('extrajs')
<script src="/editor/ckeditor/ckeditor.js" type="text/javascript"></script>
<script>
    CKEDITOR.replace( 'description',{
        filebrowserBrowseUrl: '/editor/ckfinder/ckfinder.html',
        filebrowserUploadUrl: '/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    });

    (function($){
        "use strict";
        $(document).ready(function() {
            $('.root-or-sub').each(function(index, el) {
                if ($(this).hasClass('checked')) {
                   pic_checkSub($(this).attr('data-toggle'));
                   return false;
                }
            });
        });
        $('.root-or-sub').click(function(event) {
            var checkBox = $(this).attr('data-toggle');
            pic_checkSub(checkBox);
        });
    })(jQuery)
</script>
@endsection