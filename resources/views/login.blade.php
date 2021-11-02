@component('layouts.app')
    <div class="container-fluid vh-100" style="background: #6c4130">
        <div class="container" >

            <div class="text-center pt-4">
                <a href="/">
                    <img src="{{ asset('img/tailogowhite.png') }}" style="max-width: 200px">
                </a>
                <br><br>
                <h2 class="text-white font-weight-bolder">
                    SMS Platform
                </h2>
            </div>

            <div class="d-flex row justify-content-center">    
                <div class="card mt-3" style="width: 32rem;">
                    <div class="card-body">
                      <form action="/authenticate" method="POST">
                          @csrf
                          <div class="form-group mb-3">
                              <label for="">Email</label>
                              <input type="email" name="email" autocomplete="off" class="form-control">
                          </div>
                          <div class="form-group mb-4">
                              <label for="">Password</label>
                              <input type="password" name="password" autocomplete="off" class="form-control">
                          </div>
                          <div class="form-group mb-3">
                              <a class="btn-primary btn" type="submit">
                                  Login
                              </a>
                          </div>
                      </form>
                    </div>
                  </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <img src="{{ asset('img/tai-kids.png') }}" alt="..." style="max-width: 450px">
            </div>
        </div>
    </div>

@endcomponent