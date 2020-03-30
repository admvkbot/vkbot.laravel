@extends('layouts.app_admin')

@section('content')


    <section class="content-header">
        @component('bot.admin.components.breadcrumb')
            @slot('title') Overview @endslot
            @slot('parrent') Main page @endslot
            @slot('active')  @endslot
        @endcomponent
    </section>


    <!-- main content -->
    <section class="content">

        <div id = 'msg'>This message will be replaced using Ajax.
            Click the button to replace the message.</div>
    @php
    echo Form::button('Replace Message',['onClick'=>'getMessage()']);
    @endphp
        <!-- Small boxes (Stat box) -->
        <div class="row">
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
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua-gradient">
                    <div class="inner">
                        <h4>Tasks:&nbsp;&nbsp;&nbsp;{{$countTasks}}</h4>
                        <p><a href="#" style="color: #fff"><span style="text-decoration: underline">Active:</span>&nbsp;&nbsp;<span style="color: red"><strong>{{$countActiveTasks}}</strong></span></a></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-compose"></i>
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
                        <p><a href="#" style="color: #fff"><span style="text-decoration: underline">Unread:</span>&nbsp;&nbsp;<span style="color: red"><strong>{{$countUnreadMessages}}</strong></span></a>&nbsp;
                            (from {{$countTaskMessages}} task@php $countTaskMessages>1?print('s'):1 @endphp)</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-paper-airplane"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </section>

@endsection
