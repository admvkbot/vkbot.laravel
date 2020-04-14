@extends('layouts.app_admin')

@section('content')


    <section class="content-header">
        @component('bot.admin.components.breadcrumb')
            @slot('title') Categories @endslot
            @slot('parrent') Main page @endslot
            @slot('active') Categories @endslot
        @endcomponent
    </section>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name-csrf-token]').attr('content')
        }
    });

</script>
    <!-- main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($paginator as $category)
                                    @php $class = $category->title ? 'success' : '' @endphp
                                <tr class="{{ $class }}">
                                    <td>{{ $category->title }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td style="width: 60px">
                                        <a href="" data-toggle="modal" data-target="#overviewModal" data-action="edit"
                                           data-desc="{{ $category->description }}" data-title="{{ $category->title }}"
                                           data-url="{{ route('bot/admin.lists.categories.edit', $category->id) }}"
                                           data-id="{{ $category->id }}" title="Edit category"><i class="fa fa-fw fa-eye"></i>
                                        </a>
                                        <a href="" data-toggle="modal" data-target="#overviewModal" data-action="delete"
                                           data-desc="{{ $category->description }}" data-title="{{ $category->title }}"
                                           data-url="{{ route('bot/admin.lists.categories.update', $category->id) }}"
                                           data-id="{{ $category->id }}" title="Delete category">
                                            <i class="fa fa-fw fa-close text-danger deletedb"></i>
                                        </a>
                                    </td>
                                </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center" colspan="2"><h2>Categories table is empty</h2></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <p>{{ count($paginator) }} categories of {{ $countRows }}</p>
                            @if($paginator->total() > $paginator->count())
                                <br>
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                {{ $paginator->links() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--modal-->
    <div class="modal fade" id="overviewModal" role="dialog" aria-labelledby="overviewModalLabel" aria-hidden="true">
        <div class="modal-dialog box box-info" style="width: 50%" role="document">
            <div class="modal-content">
                <div class="modal-header box-header">
                    <h5 class="modal-title box-title" id="overviewModalLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <form id="modal-form">
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!--{{ route('bot/admin.lists.categories.edit', $category->id) }}-->
    <script>
        function drawEdit(name) {
            $('#modal-form').html('<table class="table table-bordered table-hover">'+
                '<tbody>'+
                '<tr class="success">'+
                '<td>Title</td>'+
                '<td>'+
                '<input type="text" value="" id="modal-category"  class="max-width" placeholder="Loading...">'+
                '</td>'+
                '</tr>'+
                '<tr class="success">'+
                '<td>Description</td>'+
                '<td>'+
                '<input type="text" value="" placeholder="Enter description here..." id="modal-desc" class="max-width">'+
                '</td>'+
                '</tr>'+
                '</tbody>'+
                '</table>'
                );
            $('.modal-footer').html('<button type="button" class="btn btn-secondary cancel-modal" data-dismiss="modal">Cancel</button> ' +
                '<button type="button" class="btn btn-primary ok-modal" data-dismiss="modal"> OK </button>');
            $('.modal-title').text('Edit category "' + name + '"')
        }
        function drawDelete(name) {
            $('#modal-form').html('Delete a category "'+name+'"?');
            $('.modal-footer').html('<button type="button" class="btn btn-secondary cancel-modal" data-dismiss="modal">Cancel</button> ' +
                '<button type="button" class="btn btn-danger ok-modal" data-dismiss="modal"> Delete </button>');
            $('.modal-title').text('Delete category "' + name + '"')
        }
        $('#overviewModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var action = button.data('action')
            var name = button.data('title')
            var description = button.data('desc')
            var url = button.data('url')
            var modal = $(this)
            if (action=='edit') {drawEdit(name)}
            if (action=='delete') {drawDelete(name)}
            $.ajax({url: url, success: function(result){
                modal.find('#modal-category').val(result.title);
                modal.find('#modal-desc').val(result.description);
                $('.ok-modal').on('click', function (event) {
                    var data={};
                    alert(action);
                    });
                }});
//            modal.find('.form-group div').text('Loading...')
            //getModalMesages(taskId, ownId, userId);

        });

        $('.ok-modals').on('click', function (event) {
            var data={};
            alert('OK');
/*            $('.input-modal').each(function(){
                data[this.id] = this.value;
            });
            data['_token'] = "{{ csrf_token() }}";
            $.ajax({
                url: "/admin/lists/categories/"+data.id+"/update",
                type: "POST",
                data: data,
                dataType: 'json',
                success: function(result) {
                    //hideRows(data.oid, data.uid, data.tid)
                },
                error: function(request, status, error) {
                    alert('Error: '+error);
                }
            });*/
            //event.preventDefault();
            //event.stopPropagation();
        });

    </script>
@endsection