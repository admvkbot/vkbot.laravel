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
                <tbody id="frds">
                <thead>
                <tr>
                    <th>User</th>
                    <th>Own Account</th>
                    <th></th>
                </tr>
                <script>
                    function printFriends(last_friends) {
                        var rows="";
                        $.each(last_friends.data, function (key, value) {
                            var m=value.description?value.description:value.login;
                            rows=rows+'<tr>';
                            rows=rows+'<td><a href="">'+value.account_id+'</a> </td>';
                            rows=rows+'<td>'+m+'</a> </td>';
                            rows=rows+'<td style="position:absolute; right: 0px">' +
                                '<a href="#" onclick="hideRow('+value.id+',\'friend\');return false;">' +
                                '<span class="label label-default">Hide </span></a> </td>';
                            rows=rows+'</tr>';
                        });
                        $('#frds').html(rows);
                    }
                </script>
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