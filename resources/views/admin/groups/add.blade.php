@extends('layouts.admin')

@section('title','Thêm Danh sách nhóm')
@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1>Thêm danh sách nhóm</h1>
</div>
  <form action="{{route('admin.groups.GroupAdd')}}" method="post">
    @csrf
    <label for="">Name</label>
    <input type="text" name="name"><br>
    <label for="">permission</label>
    <input type="text" name="permission"><br>
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
    <button type="post">Save</button>
  </form>
@endsection