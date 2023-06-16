@extends('layouts.admin')

@section('title','Danh sách người dùng')
@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1>Danh sách nhóm</h1>
</div>

<table class="table table-bordered">
    <a href="{{route('admin.groups.add')}}">Thêm mới</a>
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>Phân quyền</th>
            <th>Xóa</th>
            <th>Sửa</th>
        </tr>
        @foreach($datagroup as $key=>$item)
       <tbody>
        <td>{{$key+1}}</td>
        <td>{{$item->name}}</td>
        <td>
            <a href="{{route('admin.groups.permission',$item)}}" class="btn btn-primary">Phân quyền</a>
        </td>
        <td><a href="{{route('admin.groups.delete',$item)}}">Xóa</a></td>
        <td><a href="{{route('admin.groups.edit', ['id' => $item->id])}}">Sửa</a></td>
       </tbody>
       @endforeach
    </thead>
</table>
@endsection