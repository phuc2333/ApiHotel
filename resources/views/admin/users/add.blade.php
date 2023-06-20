@extends('layouts.admin')

@section('title', 'Thêm Danh sách người dùng')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1>Thêm danh sách người dùng</h1>
    </div>
    <form action="{{ route('admin.users.add') }}" method="post">
        @csrf
        <label for="">Name</label>
        <input type="text" name="name"><br>
        <label for="">Email</label>
        <input type="email" name="email"><br>
        <label for="">Password</label>
        <input type="password" name="password">
        <label for="">Chon quyen</label>
        <select name="group_id" id="">
            @foreach ($nameGroup as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <button type="post">Save</button>
    </form>
@endsection
