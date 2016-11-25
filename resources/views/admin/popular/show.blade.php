@extends('admin.popular.layout')
@section('dashboard-header')
  <h1>
    Dashboard Tag
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('admin.popular.index') }}"><i class="fa fa-bookmark"></i> Populars</a></li>
    <li class="active"><a href="{{ route('admin.popular.show', $popular) }}"><i class="fa fa-lightbulb-o"></i> Ideas</a></li>
  </ol>
@endsection
@section('popular-content')
  <div class="box">
    <div class="box-header">
      <h2 class="box-title">Data Idea</h2>
      <div class="col-md-1 pull-right">
        <a href="{{ route('admin.popular.idea.create', $popular) }}" class="btn btn-success btn-flat btn-block">
        <i class="fa fa-plus"></i> Add </a>  
      </div>
      
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
          <th data-visible="true" data-width="10%">Order Number</th>
          <th data-visible="false" data-width="10%">ID</th>
          <th data-visible="true" data-width="10%">Title</th>
          <th data-visible="true" data-width="10%">Slug</th>
          <th data-visible="true" data-width="10%">Owner</th>
          <th data-visible="true" data-width="10%">Total Like</th>
          <th data-visible="true" data-width="10%">Total Member</th>
          <th data-visible="false" data-width="10%">Updated At</th>
          <th data-visible="false" data-width="10%">Created At</th>
          <th data-visible="true" data-width="20%">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($popularIdeas as $popularIdea)
        @php
          $idea = $popularIdea->idea
        @endphp
        <tr>
          <td>{{ $popularIdea->order_number }}</td>
          <td>{{ $idea->id }}</td>
          <td>{{ $idea->title }}</td>
          <td>{{ $idea->slug }}</td>
          <td><a href="{{ route('user.show', $idea->user) }}">{{ $idea->user->name }}</a></td>
          <td>{{ $idea->like_count }}</td>
          <td>{{ $idea->member_count }}</td>
          <td>{{ $idea->updated_at }}</td>
          <td>{{ $idea->created_at }}</td>
          <td>
            @include('admin.popular.concerns.form-idea-delete', compact('$popularIdea'))
          </td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
          <th data-visible="false" data-width="10%">ID</th>
          <th data-visible="true" data-width="10%">Nama</th>
          <th data-visible="true" data-width="10%">Slug</th>
          <th data-visible="true" data-width="10%">Owner</th>
          <th data-visible="true" data-width="10%">Total Like</th>
          <th data-visible="true" data-width="10%">Total Member</th>
          <th data-visible="false" data-width="10%">Updated At</th>
          <th data-visible="false" data-width="10%">Created At</th>
          <th data-visible="true" data-width="20%">Action</th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
