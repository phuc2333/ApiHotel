@extends('layouts.admin')

@section('title','Thêm Danh sách người dùng')
@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1>Sua danh sách người dùng</h1>
</div>
 @foreach($obj as $item)
 <form action="{{route('admin.users.edit', ['id' => $item->id])}}" method="post">
    @csrf
    <label for="">Name</label>
    <input type="text" name="name" value="{{$item->name}}"><br>
    <label for="">Email</label>
    <input type="email" name="email" value="{{$item->email}}"><br>
    <label for="">Chon quyen</label>
    
    <select name="group_id">
        @foreach($group as $row)
        <option @if($item->group->name === $row->name) selected @endif   value="{{$row->id}}">{{$row->name}}</option>
        @endforeach
    </select>
   
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
    <button type="post">Edit</button>
  </form>
 @endforeach
@endsection