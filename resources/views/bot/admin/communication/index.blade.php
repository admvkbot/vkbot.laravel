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
        function hideRows(ownId,userId,taskId){
            $.ajax({
                type:'PUT',
                dataType: "json",
                url:'/admin/cruds/'+taskId+'/type/hiderows',
                data: {
                    uid:userId,
                    oid:ownId,
                    _token:"{{ csrf_token() }}"
                },
                success:function(response){
                    loadMessages('cl'+taskId);
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
            <ul class="dropdown">
                <li class="tabl tabl-top">{{$value->name}}
                    <img src="/images/icons/generator.gif" width="20" height="20" class="loading loading-{{ $value->id }}">
                    <span class="tabl-right-5">
                        <strong><span id="messages-{{ $value->id }}">0</span> messages</strong>
                        <span class="badge" id="new-messages-{{ $value->id }}"></span>
                    </span>
                    <span class="tabl-right-3">
                        <strong><span id="friends-{{ $value->id }}">0</span> friends</strong>
                        <span class="badge" id="new-friends-{{ $value->id }}"></span>
                    </span>
                    <button class="btn btn-default dropdown-toggle caret-right nobutton cl" type="button"
                            data-toggle="dropdown" id="cl{{ $value->id }}">
                        <span class="caret"></span>
                    </button>
                    <ul class="tabl-ul dropdown-menu" >
                        @foreach ($value->data as $val)
                        <!-- start account -->
                        <li class="dropdown">
                            <a class="cl test tabl li-own-{{ $value->id }}" tabindex="-1" href="#" id="{{ $val->own_id }}">
                                @php $val->description?print($val->description):print($val->login) @endphp
                                <span class="caret caret-right2"></span></a>
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

            function getTaskIds () {
                var tasks = new Object();
                @foreach ($tasks as $value)
                    tasks[{{ $value->id }}] = "{{ $value->name }}";
                @endforeach
                return tasks;
            }

            function startLoad() {
                var tasks = getTaskIds();
                var total = 0;
                $.each(tasks, function (key, task) {
                    total++;
                });
                var i=0;
                $.each(tasks, function (key, task) {
                    i++;
                    $('.loading-'+key).css("visibility", "visible");
                    $.ajax({url: "/admin/cruds/0/type/countbytask/id/"+key, success: function(result){
                        if (result.m){$('#new-messages-'+key).text(result.m+' new')};
                        $('#messages-'+key).text(result.am);
                        if (result.f){$('#new-friends-'+key).text(result.f+' new')};
                        $('#friends-'+key).text(result.af);
                        if (i==total) {$('.loading-'+key).css("visibility", "hidden");}
                    }});
                });
            }

            function loadMessages(rawId){
                if (rawId.substr(0,2) != 'cl') {return 0}
                var id = rawId.substr(2)*1;
                var countNewFriends = 0;
                var countNewMessages = 0;
                var countFriends = 0;
                var tt = 0;
                var total = 0;
                $('.li-own-'+id).each(function (key, task) {
                    total++;
                });
                var i=0;
                $('.li-own-'+id).each(function (key, value) {
                    i++;
                    tt = 9;
// -- get all messages
                    var start = 0;
                    $('.loading-'+id).css("visibility", "visible");
                    $.ajax({url: "/admin/cruds/0/type/allmessages/id/"+value.id, success: function(result){
//                        $('.loading-'+id).css("visibility", "hidden");
                        start?out=$('#allmessage'+id+'-'+value.id).html():out='';
                        start=1;
                        var row = 2;
                        $.each(result.data, function (k, v) {
                            row==1?row=2:row=1;
                            countNewMessages++;  //подсчет всех новых сообщений текущего own_id
                            var userName=v.description?v.description:v.login;
                            if (v.message.length > 103) {
                                v.message = v.message.substring(0,100)+'...';
                            }
                            out+='<li class="row-'+row+'" id="user-'+id+'-'+v.own_id+'-'+v.user_id+'">' +
                                '<a tabindex="-1" href="" data-toggle="modal" data-desc="'+v.description+'" ' +
                                'data-target="#overviewModal" data-user="'+v.account_id+'"' +
                                ' data-uid="'+v.user_id+'" data-oid="'+v.own_id+'"' +
                                'data-own="'+v.login+'" data-task="'+id+'">'+
                                userName +
                                '</a> ' +
                                '<span class="user-name tabl-left-1">'+v.message+'</span>' +
                                '<span class="tabl-right-3 badge new-friend-'+v.own_id+'-'+v.user_id+'"></span>' +
                                '<a href="" class="hide-row">' +
                                '<span class="label label-default tabl-right-2 find-row-'+v.own_id+'-'+v.user_id+'" style="margin-top: 3px;" id="hide-row-'+id+'-'+v.id+'-m">hide</span></a>' +
                                '<input type="checkbox"  class="tabl-right-1"></li>';
                        });
                        if (countNewMessages){$('#new-messages-'+id).text(countNewMessages+' new');}
                        else {$('#new-friends-'+id).text('');}
                        if (i==total) {$('.loading-'+id).css("visibility", "hidden");}
                        $('#allmessage'+id+'-'+value.id).html(out);
                    }});
//                    alert(start);
// -- get info about all friends
                    $('.loading-'+id).css("visibility", "visible");
                    $.ajax({url: "/admin/cruds/0/type/allfriends/id/"+value.id, success: function(result){
                        $('.loading-'+id).css("visibility", "hidden");
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
                                $('.new-friend-'+v2.own_id+'-'+v2.user_id).text('F');
                            } else {
                                $('.new-friend-'+v2.own_id+'-'+v2.user_id).text('');
                                //тут нужно вернуть ID к старому виду
                            }
                            countFriends++; //подсчет всех друзей
                            if (!$('#user-'+id+'-'+v2.own_id+'-'+v2.user_id).height() && v2.status == 0) {
                                //alert('#user-'+id+'-'+v2.own_id+'-'+v2.user_id);
                                row==1?row=2:row=1;
                                var userName=v2.description?v2.description:v2.login;
                                var html = $('#allmessage'+id+'-'+value.id).html();
                                var frCode = '<li class="row-'+row+'0" id="user-'+id+'-'+v2.own_id+'-'+v2.user_id+'">' +
                                    '<a tabindex="-1" href="" data-toggle="modal" data-desc="'+v2.description+'" ' +
                                    'data-target="#overviewModal" data-user="'+v2.account_id+'"' +
                                    ' data-uid="'+v2.user_id+'" data-oid="'+v2.own_id+'"' +
                                    'data-own="'+v2.login+'" data-task="'+id+'">'+
                                    '<span class="txt-grey">'+userName+'</span></a> ' +
                                    '<span class="tabl-right-3 badge">F</span>' +
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
                startLoad();
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
                            <form id="modal-form">
                                <div class="form-group">
                                    <div style="overflow: auto; height: 350px; background-color: #eee;" id="messages_text"></div>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" rows="3" id="message_text" name="m"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary cancel-modal" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary send-modal">Send message</button>
                            <button type="button" class="btn btn-primary ok-modal" data-dismiss="modal"> OK </button>
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
                var own = button.data('own');
                var taskId = button.data('task');
                var userId = button.data('uid');
                var ownId = button.data('oid');
                var desc = button.data('desc');
                var modal = $(this)
                var txtDesc = ' ('+desc+')'
                modal.find('.modal-title').text('Conversation with ' + recipient + txtDesc)
                modal.find('.form-group div').text('Loading...')
                getModalMesages(taskId, ownId, userId);

            })

            function getModalMesages(taskId, ownId, userId) {
                $.ajax({url: "/admin/cruds/"+userId+"/type/messagesid/id/"+ownId, success: function(result){
                    var out='<input type="hidden" class="input-modal" name="uid" value="'+userId+'" id="uid">' +
                        '<input type="hidden" class="input-modal" name="oid" value="'+ownId+'" id="oid">' +
                        '<input type="hidden" class="input-modal" name="tid" value="'+taskId+'" id="tid">' +
                        '<table><tbody>';
                    $.each(result.data.reverse(), function (key, value) {
                        var cls = value.direction?"messout":"messin";
                        if (value.status==1){cls="messprep";}
                        var regex=/\n/g;
                        var message=value.message.replace(regex, "<br>");
                        out+='<tr><td><div class="mess '+cls+'">'+message+'</div></td></tr>';
                    });
                    out+='</tbody></table>';
                    $('#message_text').focus();
                    $('.form-group div').html(out);
                    $('#messages_text').scrollTop(9999);
                }});
            }

            $('.ok-modal').on('click', function (event) {
                var data={};
                $('.input-modal').each(function(){
                    data[this.id] = this.value;
                });
                data['_token'] = "{{ csrf_token() }}";
                //var button = $(event.relatedTarget);
//                $('.loading-modal').css("visibility", "visible");
                $.ajax({
                    url: "/admin/cruds",
                    type: "POST",
                    data: data,
                    dataType: 'json',
                    success: function(result) {
                        hideRows(data.oid, data.uid, data.tid)
  //                   $('.loading-modal').css("visibility", "hidden");

                        //alert(result);
                    },
                    error: function(request, status, error) {
                        alert('Error: '+error);
                    }
                });
                //event.preventDefault();
                //event.stopPropagation();
            });

            $('#message_text').on('keypress', function (event) {
                var key = (event.keyCode ? event.keyCode : event.which);
                if(key == 13) {
                    $('.send-modal').trigger('click');
                    return true;
                }
                if(key == 10) {
                    $('#message_text').val($('#message_text').val()+"\n");
                }
            });
            $('.send-modal').on('click', function (event) {
                //var button = $(event.relatedTarget);
                event.preventDefault();
                event.stopPropagation();
//                $('.loading-modal').css("visibility", "visible");
                var type = 'sendmessage';
                var taskId = $('#tid').val();
                var ownId = $('#oid').val();
                var userId = $('#uid').val();
                if ($('#message_text').val()) {
                    $.ajax({
                        type: 'PUT',
                        dataType: "json",
                        url: '/admin/cruds/' + taskId + '/type/' + type,
                        data: {
                            uid: userId,
                            oid: ownId,
                            m: $('#message_text').val(),
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            getModalMesages(taskId, ownId, userId);
                            $('#message_text').val('');
                            return response;
                        }
                    });
                }
            });

        </script>

@endsection