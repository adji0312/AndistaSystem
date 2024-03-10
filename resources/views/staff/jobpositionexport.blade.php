@extends('mainexport')
@section('content')
<div>
    <h1>Job Position</h1>
    <table class="table w-100">
        <thead>
          <tr >
            <th scope="col" style="color: #7C7C7C">Name</th>
          </tr>
        </thead>
        <tbody>
            @foreach($position as $p)
            <tr>
                <td class="text-primary" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#editCategory{{ $p->id }}">{{ $p->position_name }}</td>
            </tr>
            @endforeach

            
            {{-- @endforeach --}}
        {{-- </tbody>--}}
    </table>
  </div>


<style>
  .table {
    border: 1px solid #ddd; /* Light gray border for the table */
  }
  
  .table th,
  .table td {
    border: 1px solid #ddd; /* Light gray border for each cell */
    padding: 8px; /* Add some padding for better readability */
  }
  
  .thead-dark {
    background-color: #343a40; /* Adjust the background color if needed */
    color: #fff; /* White text for the table header */
  }
</style> 

@endsection