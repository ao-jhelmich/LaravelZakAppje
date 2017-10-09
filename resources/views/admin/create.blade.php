@extends('layout.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>ZakAppje</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">General Elements</h3>
            </div>
            <div class="box-body">
                @if ($tablename == 'mainrequirement')
                {{Form::open(['url' => 'admin/mainrequirement', 'role' => 'form'])}}
                @elseif($tablename == 'requirement')
                {{Form::open(['url' => 'admin/requirement', 'role' => 'form'])}}
                @elseif($tablename == 'instruction')
                {{Form::open(['url' => 'admin/instruction', 'role' => 'form'])}}
                @endif
                <div class="form-group">
                    {{ Form::label('name',  $tablename . ' name: ') }}
                    {{ Form::text('name', null, ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    @if ($tablename == 'instruction')
                    {{ Form::label('desc', 'Desc: ') }}
                    {{ Form::textarea('desc',null, ['id' => 'editor1']) }}
                    @else
                    {{ Form::label('desc', 'Desc: ') }}
                    {{ Form::text('desc',null,['class' => 'form-control'])}}
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::label('select', 'Toekennen aan: ')}}
                    {{Form::select('select', $select, null,['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{ Form::label('flag', 'Flag: ')}}
                    {{Form::select('flag', ['1' => 'Active', '0' => 'Unactive'], '1' , ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{ Form::submit('Save')}}
                </div>
                {{Form::close()}}
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection