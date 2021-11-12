@component('layouts.dashboard')

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
</div>
@endif

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Beneficiaries</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"></h6>
        <button class="btn btn-primary" data-toggle="modal" data-target="#exportModal">
            Export
        </button>
        <a class="btn btn-info" href="/exportBeneficiaries">
            Send Custom Message
        </a>
    </div>

    <!--  SMS Modal -->
<div class="modal fade" id="smsModal" tabindex="-1" aria-labelledby="smsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="smsModalLabel">Custom Message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/send-text" method="post">
              @csrf
              <div class="form-group mb-2">
                  <label for="">Number</label>
                  <input type="text" name="phone" class="form-control">
              </div>
              <div class="form-group mb-2">
                  <label for="">Message</label>
                  <textarea name="message" id="" cols="100%" rows="5"></textarea>
              </div>
              <div class="form-group mb-2">
                  <button class="btn btn-success" type="submit">
                      Send Message
                  </button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Export</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <!---code here--->

        </div>
      </div>
    </div>
  </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Location</th>
                        <th>Age</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Location</th>
                        <th>Age</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($beneficiaries as $b)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $b->name }}
                        </td>
                        <td>
                            {{ $b->phone }}
                        </td>
                        <td>
                            {{ $b->gender }}
                        </td>
                        <td>
                            {{  $b->location }}
                        </td>
                        <td>
                            {{ $b->age }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endcomponent
