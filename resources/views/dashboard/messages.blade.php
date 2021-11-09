@component('layouts.dashboard')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Beneficiaries</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>From</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>S/N</th>
                        <th>From</th>
                        <th>Message</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($messages as $m)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $m->from }}
                        </td>
                        <td>
                            {{ $m->sms }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endcomponent
