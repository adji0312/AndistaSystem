@extends('mainexport')
@section('content')
  <div>
    <h1>Daftar Pelanggan</h1>
    <table class="table table-bordered">
      <thead class="thead-dark">
        <tr>
          {{-- <th scope="col" style="color: #7C7C7C; width: 50px;">#</th> --}}
          <th scope="col" style="color: #7C7C7C">Nama Pelanggan</th>
          <th scope="col" style="color: #7C7C7C">Nama Peliharaan</th>
          <th scope="col" style="color: #7C7C7C">No Hp</th>
          <th scope="col" style="color: #7C7C7C">Email</th>
          <th scope="col" style="color: #7C7C7C">Tanggal Bergabung</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($customers as $customer)
          <tr>
            {{-- <th scope="row">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="checkBox[{{ $customer->id }}]" name="checkBox" value="{{ $customer->id }}">
                <input type="hidden" id="serviceName{{ $customer->id }}" value="{{ $customer->service_name }}">
              </div>
            </th> --}}
            <td>{{ $customer->first_name }}</td>
            <td>
              @foreach ($customer->pets as $pet)
                {{ $pet->pet_name }}<br>
              @endforeach
            </td>
            <td>{{ $customer->phone ? $customer->phone : "-"}}</td>
            <td>{{ $customer->email ? $customer->email : "-" }}</td>
            <td>{{ $customer->created_at ? date_format($customer->created_at, 'd M Y H:i') : "-" }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
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
  
  .thead-dark {
    background-color: #343a40; /* Adjust the background color if needed */
    color: #fff; /* White text for the table header */
  }
</style>
