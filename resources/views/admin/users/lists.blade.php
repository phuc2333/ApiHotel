@extends('layouts.admin')

@section('title','Danh sách người dùng')
@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1>Danh sách người dùng</h1>
</div>

<table class="table table-bordered">
    <a href="{{route('admin.users.add')}}">Thêm mới</a>
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Nhóm</th>
            <th>Xóa</th>
            <th>Sửa</th>
        </tr>
        @foreach($dataUser as $key=>$item)
       <tbody>
      
        <td>{{$key+1}}</td>
        <td>{{$item->name}}</td>
        <td>{{$item->email}}</td>
        <td>{{$item->group->name}}</td>
        <td><a href="{{route('admin.users.delete', $item)}}">Xóa</a></td>
        <td><a href="{{route('admin.users.edit', $item)}}">Sửa</a></td>
       </tbody>
       @endforeach
    </thead>
</table>
@endsection