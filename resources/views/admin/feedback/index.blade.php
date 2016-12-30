@extends('admin.feedback.layout')
@section('feedback-content')
  <div class="box">
    <div class="box-header">
      <h2 class="box-title">Data Feedbacks</h2>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
          <th data-visible="false" data-width="10%">ID</th>
          <th data-visible="true" data-width="20%">Email</th>
          <th data-visible="true" data-width="20%">Subject</th>
          <th data-visible="true" data-width="10%">Status</th>
          <th data-visible="false" data-width="10%">Updated At</th>
          <th data-visible="false" data-width="10%">Created At</th>
          <th data-visible="true" data-width="20%">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($feedbacks as $feedback)
        <tr>
          <td>{{ $feedback->id }}</td>
          <td>{{ $feedback->email }}</td>
          <td>{{ $feedback->subject }}</td>
          <td>{{ $feedback->status }}</td>
          <td>{{ $feedback->updated_at }}</td>
          <td>{{ $feedback->created_at }}</td>
          <td>
            <a href="{{ route('admin.feedback.reply', $feedback) }}" class="btn btn-success btn-flat"><i class="fa fa-mail-reply"></i> Reply</a>
            @include('admin.feedback.concerns.form-delete', compact('feedback'))
          </td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
          <th data-visible="false" data-width="20%">ID</th>
          <th data-visible="true" data-width="20%">Email</th>
          <th data-visible="true" data-width="20%">Subject</th>
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
