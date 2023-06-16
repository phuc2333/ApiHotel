@extends('layouts.admin')
@foreach($group as $item)
@section('title', 'Danh sách phân quyền '.$item->name)

@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1>Danh sách nhóm:{{$item->name}}</h1>
  </div>
  <form action="{{route('admin.groups.Postpermission')}}" method="post">
    @csrf
    <input type="hidden" value="{{$item->id}}" name="id_group">
    <table class="table table-bordered">
      <thead>
          <tr>
              <th>STT</th>
              <th>Module</th>
              <th>Quyền</th>
          </tr>
          @foreach($modules as $row)
         <tbody>
          <td>1</td>
          <td>{{$row->title}}</td>
        
          <td>
            <div class="row">
              @foreach($roleListsArr as $roleName => $roleLabel)
              <div class="col-3">
                <label for="role_{{$row->name}}_{{$roleName}}">
                  <input type="checkbox" id="role_{{$row->name}}_{{$roleName}}"  
                  name="role[{{$row->name}}][]" value="{{$roleName}}"  {{isRole($roleArr,$row->name,$roleName) ? 'checked' : false}}>
                  {{$roleLabel}}
                </label>
              </div>
              @endforeach
              
              @if ($row->name == 'groups')
              <div class="col-3">
                <label for="role_{{$row->name}}_permission">
                  <input type="checkbox" id="role_{{$row->name}}_permission"  
                  name="role[{{$row->name}}][]" value="permission" {{isRole($roleArr,$row->name,'permission') ? 'checked' : false}}>
                 Phân quyền
                </label>
              </div>
              @endif
            </div>
          </td>
         </tbody>
         @endforeach
      </thead>
  </table>
  <button type="submit" class="btn btn-primary">Phân quyên</button>
  </form>
@endforeach
@endsection