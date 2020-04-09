@extends('layouts.app_admin')

@section('content')


    <section class="content-header">
        @component('bot.admin.components.breadcrumb')
            @slot('title') Communication @endslot
            @slot('parrent') Main page @endslot
            @slot('active') Communication @endslot
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
        function hideRow(id,type,taskId, flag=1){
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
                    if (flag) {loadMessages('cl'+taskId);}
                }
            });
        }
    </script>

    <!-- main content -->
    <section class="content" id="ch">
        <div class="box box-info">
            <div class="box-header">

        <div class="dropdown" id="tabl-width" style="overflow: auto;">
            <form >
                @foreach ($tasks as $value)
            <ul class="dropdown"><li class="tabl tabl-top">
                    {{$value->name}}<span class="tabl-right-3">Friends: <strong><span id="friends-{{ $value->id }}">0</span></strong></span>
                    <span class="tabl-right-2 badge" id="new-friends-{{ $value->id }}"></span>
                                <button class="btn btn-default dropdown-toggle caret-right nobutton cl" type="button"
                                        data-toggle="dropdown" id="cl{{ $value->id }}">
                                        <span class="caret"></span></button>
            <ul class="tabl-ul dropdown dropdown-menu" >
                @foreach ($value->data as $val)
                <!-- start account -->
                <li class="dropdown">
                    <a class="cl test tabl li-own-{{ $value->id }}" tabindex="-1" href="#" id="{{ $val->own_id }}">{{ $val->login }}<span class="caret caret-right2"></span></a>
                    <ul class="tabl-ul tabl2" id="own">
                        <li style="color:#bbb" id="allmessage{{$value->id}}-{{ $val->own_id }}">Loading ...</li>
                    </ul>
                </li>
                <!-- end account -->
                @endforeach
            </ul>
                </li>
            </ul>
                    @endforeach
            </form>
        </div>
            </div>
        </div>

        <script>
            var he=$(document).height();
            var click=0;

            function loadMessages(rawId){
                if (rawId.substr(0,2) != 'cl') {return 0}
                var id = rawId.substr(2)*1;
                var countNewFriends = 0;
                var countFriends = 0;
                var tt = 0;
                $('.li-own-'+id).each(function (key, value) {
                    tt = 9;
// -- get all messages
                    var start = 0;
                    $.ajax({url: "/admin/cruds/0/type/allmessages/id/"+value.id, success: function(result){
                        start?out=$('#allmessage'+id+'-'+value.id).html():out='';
                        start=1;
                        var row = 2;
                        $.each(result.data, function (k, v) {
                            row==1?row=2:row=1;
                            out+='<li class="row-'+row+'" id="user-'+id+'-'+v.user_id+'"><a tabindex="-1" href="">'+v.message+'</a> ' +
                                '<span class="tabl-right-3 badge new-friend-'+v.own_id+'-'+v.user_id+'"></span>' +
                                '<a href="" class="hide-row">' +
                                '<span class="label label-default tabl-right-2 find-row-'+v.own_id+'-'+v.user_id+'" style="margin-top: 3px;" id="hide-row-'+id+'-'+v.id+'-m">hide</span></a>' +
                                '<input type="checkbox"  class="tabl-right-1"></li>';
                        });
                        out+='';
                        $('#allmessage'+id+'-'+value.id).html(out);
                    }});
//                    alert(start);
// -- get info about all friends
                    $.ajax({url: "/admin/cruds/0/type/allfriends/id/"+value.id, success: function(result){
                        var row = 2;
                        $.each(result.data, function (k2, v2) {
                            var tmpRow='.find-row-'+v2.own_id+'-'+v2.user_id;

                            if (v2.status == 0) {
                                countNewFriends++;  //подсчет всех новых другей текущего own_id
                                var rowId=$(tmpRow).attr('class', function(e){
                                    return $(tmpRow).attr('class');
                                }).each(function(){
                                    $('#'+this.id).attr('id', this.id+'f-'+v2.id);
                                });
                                $('.new-friend-'+v2.own_id+'-'+v2.user_id).text('new');
                            } else {
                                $('.new-friend-'+v2.own_id+'-'+v2.user_id).text('');
                                //тут нужно вернуть ID к старому виду
                            }
                            countFriends++; //подсчет всех друзей
                            if (!$('#user-'+id+'-'+v2.user_id).height() && v2.status == 0) {
                                row==1?row=2:row=1;
                                var html = $('#allmessage'+id+'-'+value.id).html();
                                var frCode = '<li class="row-'+row+'0" id="user-'+id+'-'+v2.user_id+'"><a tabindex="-1" href="">' +
                                    '<span class="txt-grey">No messages</span></a> ' +
                                    '<span class="tabl-right-3 badge">new</span>' +
                                    '<a href="" class="hide-row">' +
                                    '<span class="label label-default tabl-right-2" style="margin-top: 3px" id="hide-row-'+id+'-'+v2.id+'-f">OK</span></a>' +
                                    '<input type="checkbox"  class="tabl-right-1"></li>';
                                $('#allmessage'+id+'-'+value.id).html(frCode+html);
                            }
                        });
                        $('#friends-'+id).text(countFriends);
                        if (countNewFriends){$('#new-friends-'+id).text(countNewFriends+' new');}
                        else {$('#new-friends-'+id).text('');}
                    }});
//                    start=0;
                });
            }

            $(document).ready(function(){
                $('.cl').on("click", function(e){
                    $('.tabl-ul').width($('#tabl-width').width()-50);
                    $('.tabl2').width($('.tabl-ul').width()-55);
                    $('#tabl-width').height(he*3);
                    loadMessages(e.currentTarget.id);
//                    e.stopPropagation();
                    e.preventDefault();
                });
                $('.dropdown a.test').on("click", function(e){
                    $(this).next('ul').toggle();
                    e.stopPropagation();
                    e.preventDefault();
                });
                $('.tabl-ul li').on("click", ".hide-row", function(e){
                    var tmp=e.target.id;
                    e.stopPropagation();
                    e.preventDefault();
                    var regex=/(\d+)-(\d+)-(\w+)-?(\d*)/g;
                    var out=regex.exec(tmp);
                    var taskId=out[1];
                    var id=out[2];
                    var type=out[3];
//                    alert(out[3]);
                    if (type=='m') {hideRow(id,'message',taskId)}
                    else if (type=='f') {hideRow(id,'friend',taskId)}
                    else if (type=='mf') { hideRow(out[4],'friend',taskId, 0); hideRow(id,'message',taskId);}
                });
            });

        </script>
        <!-- END OF CONTENET -->



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
                                <div style="overflow: scroll; height: 350px; background-color: #eee;" id="messages_text"></div>
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
