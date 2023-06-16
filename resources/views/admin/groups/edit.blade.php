@extends('layouts.admin')

@section('title','Sửa nhóm người dùng')
@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1>Sửa nhóm</h1>
</div>
@php
   // dd($obj);
@endphp
 @foreach($obj as $item)
 <form action="{{route('admin.groups.edit',['id' =>$item->id])}}" method="post">
    @csrf
    <label for="">Name</label>
    <input type="text" name="name" value="{{$item->name}}"><br>
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
    <button type="post">Edit</button>
  </form>
 @endforeach
@endsection