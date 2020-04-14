<h1>
    @if (isset($title)){{$title}}@endif
</h1>
<ol class="breadcrumb">
    <li>
        <a href="/admin/index"><i class="fa fa-dashboard"></i>{{$parrent}}</a>
    </li>
    @if (isset($manage_own_accounts))
        <li><a href=""><i></i>{{$manage_own_accounts}}</a></li>
    @endif
    <li><i class="active"></i>{{$active}}</li>
</ol>