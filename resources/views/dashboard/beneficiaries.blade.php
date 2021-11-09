@component('layouts.dashboard')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<link href="css/styles.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
@endpush
    
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Beneficiaries</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tables</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                        <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                        .
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        DataTable Example
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>phone</th>
                                    <th>name</th>
                                    <th>gender</th>
                                    <th>location</th>
                                    <th>age</th>
                                    <th>language_id</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>phone</th>
                                    <th>name</th>
                                    <th>gender</th>
                                    <th>location</th>
                                    <th>age</th>
                                    <th>language_id</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($beneficiaries as $beneficiary)
                                <tr>
                                    <td>{{$beneficiary['phone'] }}</td>
                                    <td>{{$beneficiary['name'] }}</td>
                                    <td>{{$beneficiary['gender'] }}</td>
                                    <td>{{$beneficiary['location'] }}</td>
                                    <td>{{$beneficiary['age'] }}</td>
                                    <td>{{$beneficiary['language_id'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
@endpush
@endcomponent