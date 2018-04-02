@extends('layout.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach
        </div>
        <h1>
            {{$rank->rank_name}}
            <small>{{$mainrequirement->mainrequirements_name}}</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{$requirement->requirements_name}}</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
                </div>
                <div class="box-body">
                    @isset ($instructions)
                    @foreach ($instructions as $instruction)
                    <div class="pre">{!!htmlspecialchars_decode($instruction->instructions_desc)!!}</div>
                    @endforeach
                    @endisset
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
        </div>
            @if(Auth::check())
                @if($rank->rank_id == 4)
                    @if(Auth::user()->users_rank_id == 0)
                        @if($inrow)
                            <a href="/check/{{$requirement->requirements_id}}/{{Auth::user()->id}}">
                            <button class="btn btn-block bg-olive">Aftekenen</button></a>
                        @endif
                    @endif
                @endif
                    @if($rank->rank_id == 3)
                        @if(Auth::user()->users_rank_id == 4)
                            @if($inrow)
                                <a href="/check/{{$requirement->requirements_id}}/{{Auth::user()->id}}">
                                <button class="btn btn-block bg-olive">Aftekenen</button></a>
                            @endif
                        @endif
                    @endif
                    @if($rank->rank_id == 2)
                        @if(Auth::user()->users_rank_id == 3)
                            @if($inrow)
                                <a href="/check/{{$requirement->requirements_id}}/{{Auth::user()->id}}">
                                <button class="btn btn-block bg-olive">Aftekenen</button></a>
                            @endif
                        @endif
                    @endif
                    @if($rank->rank_id == 1)
                        @if(Auth::user()->users_rank_id == 2)
                            @if($inrow)
                                <a href="/check/{{$requirement->requirements_id}}/{{Auth::user()->id}}">
                                <button class="btn btn-block bg-olive">Aftekenen</button></a>
                            @endif
                        @endif
                    @endif
                @endif
        
        </section>
    <!-- /.content -->
</div>
@endsection