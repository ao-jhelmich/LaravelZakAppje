@extends('layout.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        ZakAppje
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    	<p>books controller</p> 
    </section>
      @foreach ($requirements as $requirement)
        {{ $requirement->name }}
        <br>
      @endforeach
      {{ $allInfo }}
  </div>
@endsection