<!-- TABLE: LATEST MESSAGES -->
<div class="box box-info">
    <div class="box-header">
        <h3 class="box-title">Last Friendship Acceptance</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table class="table no-margin">
                <tbody>
                @foreach($last_friends as $friend)
                    <tr>
                        <td><a href="">{{$friend->account_id}}</a> </td>
                        <td>@if ($friend->description){{$friend->description}}@else{{$friend->login}}@endif</td>
                        <td style="position:absolute; right: 0px">
                            <a href="" onclick="return false;"><span class="label label-default">
                                    Hide
                            </span></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.table responsive -->
    </div>
    <br>
    <!-- box-body -->
    <div class="box-footer clearfix">
        <a href="" class="btn btn-sm btn-info btn-flat pull-left">All friends</a>
    </div>
</div>
<!-- /.col -->