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
        <div class="modal fade" id="overviewModal" role="dialog" aria-labelledby="overviewModalLabel" aria-hidden="true">
            <div class="modal-dialog box box-info" style="width: 50%" role="document">
                <div class="modal-content">
                    <div class="modal-header box-header">
                        <h5 class="modal-title box-title" id="overviewModalLabel">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <div style="overflow: auto; height: 350px; background-color: #eee;" id="messages_text"></div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="3" id="message_text"></textarea>
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
            $('#overviewModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var recipient = button.data('user'); // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var own = button.data('owns');
                var modal = $(this)
                modal.find('.modal-title').text('Conversation with ' + recipient)
                modal.find('.form-group div').text('Loading...')
                $.ajax({url: "/admin/cruds/"+recipient+"/type/messages/id/"+own, success: function(result){
                    var out='<table><tbody>';
                    $.each(result.data, function (key, value) {
                        var cls = value.direction?"messout":"messin";
                        if (value.status==1){cls="messprep";}
                        out+='<tr><td><div class="mess '+cls+'">'+value.message+'</div></td></tr>';
                    });
                    out+='</tbody></table>';
                    $('#message_text').focus();
                    modal.find('.form-group div').html(out);
                    $('#messages_text').scrollTop(9999);
                }});
/*                setInterval(function(){
                    $('#messages_text').scrollTop = 9999;
                }, 100);*/
            })
        </script>

@endsection
