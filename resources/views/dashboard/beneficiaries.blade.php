@component('layouts.dashboard')
@push('css')
  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
    
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Beneficiaries</h1>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Location</th>
                                    <th>Age</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Location</th>
                                    <th>Age</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($beneficiaries as $beneficiary)
                                <tr>
                                    <td>{{$beneficiary['name'] }}</td>
                                    <td>{{$beneficiary['phone'] }}</td>
                                    <td>{{$beneficiary['gender'] }}</td>
                                    <td>{{$beneficiary['location'] }}</td>
                                    <td>{{$beneficiary['age'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>

@push('js')
  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
@endpush
@endcomponent