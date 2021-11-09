@section('css')
  <!-- Custom styles for this page -->
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@component('layouts.dashboard')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Messages</h1>
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
                            <th>from</th>
                            <th>sms</th>
                            <th>transaction_id</th>
                            <th>beneficiary_id</th>
                            <th>beneficiary_id</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>from</th>
                            <th>sms</th>
                            <th>transaction_id</th>
                            <th>beneficiary_id</th>
                            <th>beneficiary_id</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($messages as $message)
                        <tr>
                            <td>{{$message['from'] }}</td>
                            <td>{{$message['sms'] }}</td>
                            <td>{{$message['transaction_id'] }}</td>
                            <td>{{$message['beneficiary_id'] }}</td>
                            <td>{{$message['beneficiary_id'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>


@endcomponent


@section('js')
  <!-- Page level plugins -->
  <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
@endsection