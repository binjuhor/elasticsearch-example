@extends('layouts.app')

@section('header')
<a class="navbar-brand" href="{{action('TaxonomyController@index')}}">{{trans('taxonomies.list')}}</a>
@endsection

@section('content')

 <div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>

                <table id="bootstrap-table" class="table">
                    <thead>
                        <th data-field="state" data-checkbox="true"></th>
                        <th data-field="id" class="text-center">ID</th>
                        <th data-field="name" data-sortable="true">Name</th>
                        <th data-field="author" data-sortable="true">Author</th>
                        <th data-field="actions" class="td-actions text-right" data-events="operateEvents" data-formatter="operateFormatter">Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr id="tax-{{ $item['_source']['id'] }}" data-id="{{ $item['_source']['id'] }}">
                                <td></td>
                                <td>{{ $item['_source']['id'] }}</td>
                                <td><a href="{{ action('ItemsController@edit', [$item['_source']['id']]) }}">{{ $item['_source']['name'] }}</a></td>
                                <td>{{ $item['_source']['author'] }}</td>
                                <td></td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>

            </div><!--  end card  -->
        </div> <!-- end col-md-12 -->
    </div> <!-- end row -->

</div>

@endsection


@section('extrajs')
<script type="text/javascript">
    var $table = $('#bootstrap-table');

    function operateFormatter(value, row, index) {
        return [
            '<a rel="tooltip" title="View" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">',
                '<i class="fa fa-image"></i>',
            '</a>',
            '<a rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon table-action edit" href="javascript:void(0)">',
                '<i class="fa fa-edit"></i>',
            '</a>',
            '<a rel="tooltip" title="Remove" class="btn btn-simple btn-danger btn-icon table-action remove" href="javascript:void(0)">',
                '<i class="fa fa-remove"></i>',
            '</a>'
        ].join('');
    }

    $().ready(function(){
        window.operateEvents = {
            'click .view': function (e, value, row, index) {
                $.ajax({
                    url: "/items/view/"+row.id,
                }).done(function(result) {
                    console.log(result);
                    swal({  title: 'Theme detail',
                        html:
                            '<div class="row"><div class="col-sm-3 text-right">Theme name:</div><div class="col-sm-9 text-left"> <strong><a target="_blank" href="http://themeforest.net/'+result.items.sourceurl+'">' + result.items.name+'</a></strong></div></div>'+
                            '<div class="row"><div class="col-sm-3 text-right">Author: </div><div class="col-sm-9 text-left"><strong><a target="_blank" href="https://themeforest.net/user/'+result.items.author+'">' + result.items.author+'</a></strong></div></div>'+
                            '<div class="row"><div class="col-sm-3 text-right">Sales: </div><div class="col-sm-9 text-left"><strong>' + result.itemInfo.salesdate+'</strong></div></div>'+
                            '<div class="row"><div class="col-sm-3 text-right">Total sales: </div><div class="col-sm-9 text-left"><strong>' + result.itemInfo.sales+'</strong></div></div>'+
                            '<div class="row"><div class="col-sm-3 text-right">Created at: </div><div class="col-sm-9 text-left"><strong>' + result.items.uploaded+'</strong></div></div>'+
                            '<div class="row"><div class="col-sm-3 text-right">Last update: </div><div class="col-sm-9 text-left"><strong>' + result.itemInfo.upload_update+'</strong></div></div>'+
                            '<div class="row"><div class="col-sm-3 text-right">Tags:</div><div class="col-sm-9 text-left " style="word-break:break-all;">' + result.items.tags+'</div></div>'
                    });
                });

            },
            'click .edit': function (e, value, row, index) {
                window.location = "/items/edit/"+row.id;
            },
            'click .remove': function (e, value, row, index) {
                console.log(row);
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel plx!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },function(isConfirm){
                    if (isConfirm){
                        $.ajax({
                            url: "/items/destroy/"+row.id,
                        }).done(function(result) {
                            console.log(result);
                            swal(
                              'Good job!',
                              'You deleted the item and all data of it!',
                              'success'
                            );
                            $table.bootstrapTable('remove', {
                                field: 'id',
                                values: [row.id]
                            });
                        });
                    }else{
                        swal("Cancelled", "Your item is safe :)", "error");
                    }
                });
            }
        };

        $table.bootstrapTable({
            toolbar: ".toolbar",
            clickToSelect: true,
            showRefresh: true,
            search: true,
            showToggle: true,
            showColumns: true,
            pagination: true,
            searchAlign: 'left',
            pageSize: 8,
            clickToSelect: false,
            pageList: [8,10,25,50,100],
            formatShowingRows: function(pageFrom, pageTo, totalRows){
                //do nothing here, we don't want to show the text "showing x of y from..."
            },
            formatRecordsPerPage: function(pageNumber){
                return pageNumber + " rows visible";
            },
            icons: {
                refresh: 'fa fa-refresh',
                toggle: 'fa fa-th-list',
                columns: 'fa fa-columns',
                detailOpen: 'fa fa-plus-circle',
                detailClose: 'fa fa-minus-circle'
            }
        });

        //activate the tooltips after the data table is initialized
        $('[rel="tooltip"]').tooltip();

        $(window).resize(function () {
            $table.bootstrapTable('resetView');
        });

    });

</script>
@endsection