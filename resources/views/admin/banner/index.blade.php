@extends('admin.banner.layout')
@section('banner-content')
  <div class="box">
    <div class="box-header">
      <h2 class="box-title">Data Banner</h2>
      <div class="col-md-1 pull-right">
        <a href="{{ route('admin.banner.create') }}" class="btn btn-success btn-flat btn-block">
        <i class="fa fa-plus"></i> Create </a>  
      </div>
      
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
          <th data-visible="true" data-width="5%">Order Number</th>
          <th data-visible="false" data-width="10%">ID</th>
          <th data-visible="true" data-width="10%">Title</th>
          <th data-visible="false" data-width="10%">Slug</th>
          <th data-visible="true" data-width="10%">Publish</th>
          <th data-visible="true" data-width="10%">Start At</th>
          <th data-visible="true" data-width="10%">Finish At</th>
          <th data-visible="false" data-width="10%">URL</th>
          <th data-visible="false" data-width="10%">Updated At</th>
          <th data-visible="false" data-width="10%">Created At</th>
          <th data-visible="true" data-width="20%">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($banners as $banner)
        <tr>
          <td>{{ $banner->order_number }}</td>
          <td>{{ $banner->id }}</td>
          <td>{{ $banner->title }}</td>
          <td>{{ $banner->slug }}</td>
          <td>
            @if($banner->publish)
              <span class="label label-success">Published</span>
            @else
              <span class="label label-danger">Not published</span>
            @endif
          </td>
          <td>{{ $banner->start_at }}</td>
          <td>{{ $banner->finish_at }}</td>
          <td>
            @if($banner->url)
              <a href="{{ $banner->url }}">{{ $banner->url }}</a>
            @endif
          </td>
          <td>{{ $banner->updated_at }}</td>
          <td>{{ $banner->created_at }}</td>
          <td>
            @if($banner->publish)
              <a href="{{ route('admin.banner.unpublish', $banner) }}" class="btn btn-info btn-flat">Unpublish</a>
            @else
              <a href="{{ route('admin.banner.publish', $banner) }}" class="btn btn-info btn-flat">Publish</a>
            @endif
            <a href="{{ route('admin.banner.edit', $banner) }}" class="btn btn-success btn-flat">Edit</a>
            @include('admin.banner.concerns.form-delete', compact('banner'))
          </td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
          <th data-visible="true" data-width="5%">Order Number</th>
          <th data-visible="false" data-width="10%">ID</th>
          <th data-visible="true" data-width="10%">Title</th>
          <th data-visible="true" data-width="10%">Slug</th>
          <th data-visible="true" data-width="10%">Publish</th>
          <th data-visible="true" data-width="10%">Start At</th>
          <th data-visible="true" data-width="10%">Finish At</th>
          <th data-visible="false" data-width="10%">URL</th>
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
