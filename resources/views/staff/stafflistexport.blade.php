@extends('mainexport')
@section('content')
<h1>Staff List</h1>
<table class="table w-100">
  <thead>
    <tr>
      <th scope="col" style="color: #7C7C7C;">ID</th>
      <th scope="col" style="color: #7C7C7C;">Nama</th>
      <th scope="col" style="color: #7C7C7C;">Telepon</th>
      <th scope="col" style="color: #7C7C7C;">Email</th>
      <th scope="col" style="color: #7C7C7C;">Jabatan</th>
      <th scope="col" style="color: #7C7C7C;">Status</th>
    </tr>
  </thead>
  <tbody>
    @foreach($staffs as $staff)
      <tr>
        <td>{{ $staff->id }}</td>
        <td>{{$staff->first_name }} {{ $staff->middle_name }} {{ $staff->last_name }}</td>
        <td>{{ $staff->phone }}</td>
        <td>{{ $staff->email }}</td>
        <td>{{ $staff->position->position_name }}</td>
        <td>{{ $staff->status }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection

<style>
  .table {
    border: 1px solid #ddd; /* Light gray border for the table */
  }
  
  .table th,
  .table td {
    border: 1px solid #ddd; /* Light gray border for each cell */
    padding: 8px; /* Add some padding for better readability */
  }
</style>
