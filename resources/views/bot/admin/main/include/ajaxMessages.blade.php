<!-- TABLE: LATEST MESSAGES -->
<div class="box box-info">
    <div class="box-header">
        <h3 class="box-title">Last Unread Messages</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table class="table no-margin" id="datatable">
                <tbody id="msgs">
                <thead>
                <tr>
                    <th>Message</th>
                    <th>Own Account</th>
                    <th></th>
                </tr>
                <script>
                    function printMessages(last_messages) {
                        var rows="";
                        //document.write(last_messages.data);return;
                        $.each(last_messages.data, function (key, value) {
                            var m=value.description?value.description:value.login;
                            rows=rows+'<tr>';
                            rows=rows+'<td style="width: 73%"><a href="#" data-toggle="modal" ' +
                                'data-target="#overviewModal" data-user="'+value.account_id+'" ' +
                                'data-owns="'+value.login+'">'+value.message+'</a> </td>';
                            rows=rows+'<td>'+m+'</a> </td>';
                            rows=rows+'<td style="position:absolute; right: 0px"><a href="#" ' +
                                'onclick="hideRow('+value.id+',\'message\');return false;">' +
                                '<span class="label label-default">Hide </span></a> </td>';
                            rows=rows+'</tr>';
                        });
                        $('#msgs').html(rows);
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
        <a href="" class="btn btn-sm btn-info btn-flat pull-left">All messages</a>
    </div>

</div>

<!-- /.col -->