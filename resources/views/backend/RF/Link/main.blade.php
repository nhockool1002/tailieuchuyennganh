<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
          <div class="alertbox">
              @if(count($errors) > 0)
              <div class="alert alert-danger">
                  @foreach($errors->all() as $err)
                      <i class="fa fa-times" aria-hidden="true"></i> {{$err}}<br>
                  @endforeach
              </div>
              @endif
              @if(session('success_mesage'))
                  <div class="alert alert-success">
                      <i class="fa fa-check" aria-hidden="true"></i> {{session('success_mesage')}}
                  </div>
              @endif  
              @if(session('warning_mesage'))
                  <div class="alert alert-danger">
                      <i class="fa fa-times" aria-hidden="true"></i> {{session('warning_mesage')}}
                  </div>
              @endif                          
          </div>
      </div>
      <div class="col-md-12">
          <div class="card">
              <div class="header">
                  <h4 class="title">Links Creator</h4>
                  <p class="category">This page show all tools for links configure</p>
              </div>
              <div class="content">
                <div class="row">
                  <div class="col-sm-7">
                    <div id="example-table"></div>
                  </div>
                  <div class="col-sm-5 p-0">
                        <div style="background-color:#1b1b1b; padding: 10px; border-radius: 10px;">
                            <h6 style="color: white;">Link Name</h6><br />
                            <input type="text" id="link_name" name="link_name" class="form-control" placeholder="Link Name" /><br />
                            <div class="name-error" style="color: red;"></div><br />
                            <h6 style="color: white;">Link Origin</h6><br />
                            <input type="text" id="link_origin" name="link_origin" class="form-control" placeholder="Link Origin" /><br />
                            <div class="url-error" style="color: red;"></div><br />
                            <div class="w-100 text-center">
                                <button class="btn btn-success d-flex text-center generate-btn">Generate Short Link</button>
                            </div>
                        </div>
                  </div>
                </div>
              </div>
          </div>
      </div>
  </div>
</div>
