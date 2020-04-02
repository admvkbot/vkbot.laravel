@extends('layouts.app_admin')

@section('content')


    <section class="content-header">
        @component('bot.admin.components.breadcrumb')
            @slot('title') Overview @endslot
            @slot('parrent') Main page @endslot
            @slot('active')  @endslot
        @endcomponent
    </section>

    <script>
        //$('#datatable').DataTable();
        //$('.myid').hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN' : $('meta[name-csrf-token]').attr('content')
            }
        });
        viewData();
        function viewData(messages,friends) {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/admin/cruds",
                success: function (response) {
                    printMessages(response.last_messages);
                    printFriends(response.last_friends);
                }
            })
        }
        function hideRow(id,type){
            $.ajax({
                type:'PUT',
                dataType: "json",
                url:'/admin/cruds/'+id+'/type/'+type,
                data: {
                    id:id,
                    type:type,
                    _token:"{{ csrf_token() }}"
                },
                success:function(response){
                    viewData();
                }
            });
        }
    </script>

    <!-- main content -->
    <section class="content">

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-purple-gradient">
                    <div class="inner">
                        <h4>Friends:</h4>
                        <p><a href="#" style="color: #fff"><span style="text-decoration: underline">New:</span>&nbsp;&nbsp;<span style="color: red"><strong>{{$countNewFriends}}</strong></span></a>&nbsp</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-happy-outline"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green-gradient">
                    <div class="inner">
                        <h4>Messages:</h4>
                        <p><a href="#" style="color: #fff"><span style="text-decoration: underline">Unread:</span>&nbsp;&nbsp;<span style="color: red"><strong>{{$countUnreadMessages}}</strong></span></a>&nbsp</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-paper-airplane"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua-gradient">
                    <div class="inner">
                        <h4>Tasks:&nbsp;&nbsp;&nbsp;{{$countTasks}}</h4>
                        <p><a href="#" style="color: #fff"><span style="text-decoration: underline">Active:</span>&nbsp;&nbsp;<span style="color: green"><strong>{{$countActiveTasks}}</strong></span></a></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-compose"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h4>Processes</h4>
                        <p>Active</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-power"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            @include('bot.admin.main.include.ajaxRecently')
        </div>
    <div class="col-md-6">
        @include('bot.admin.main.include.ajaxMessages')
    </div>
        <!--modal-->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog box box-info" style="width: 50%" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Recipient:</label>
                                <input type="text" class="form-control" id="recipient-name" />
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Message:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send message</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#exampleModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('whatever') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('New message to ' + 'USER')
                modal.find('.modal-body input').val(recipient)
            })
        </script>
        <!--end of modal -->

    </section>

@endsection
