<div class="main-panel">
  @include('common.back.topsetting')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12 col-md-12">
              <div class="card">
                  <div class="col-md-12">
                      <div class="alertbox">
                          @if(count($errors) > 0)
                              <div class="alert alert-danger">
                                  @foreach($errors->all() as $err)
                                      <i class="fa fa-times" aria-hidden="true"></i> {{$err}}<br>
                                  @endforeach
                              </div>
                          @endif
                          @if(session('success_message'))
                              <div class="alert alert-success">
                                  <i class="fa fa-check" aria-hidden="true"></i> {{session('success_message')}}
                              </div>
                          @endif
                          @if(session('warning_message'))
                              <div class="alert alert-danger">
                                  <i class="fa fa-times" aria-hidden="true"></i> {{session('warning_message')}}
                              </div>
                          @endif
                      </div>
                  </div>
                  <div class="header">
                      <h4 class="title"><a style="margin-right: 10px;font-weight: bold; color: red;" href="{{ route('indexViewPokemon') }}">くく BACK </a>Add Pokemon Rom</h4>
                  </div>
                  <div class="content">
                      <form method="POST" action="{{ route('addSubmit') }}" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Rom Name</label>
                                      <input type="text" class="form-control border-input" placeholder="Pokemon Auroza" name="name" value="">
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Rom Description</label>
                                    <input type="text" class="form-control border-input" placeholder="Pokemon Auroza is ...." name="description" value="">
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Rom Author</label>
                                    <input type="text" class="form-control border-input" placeholder="Nhut Nguyen Minh" name="author" value="">
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Rom Author BIO</label>
                                    <input type="text" class="form-control border-input" placeholder="http://fb.com" name="author_bio" value="">
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Rom Version</label>
                                    <input type="text" class="form-control border-input" placeholder="v0.1" name="version" value="">
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Rom Base On</label>
                                    <input type="text" class="form-control border-input" placeholder="Fire Red" name="base_on" value="">
                                </div>
                            </div>
                          </div>
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Content</label>
                                      <textarea rows="5" class="form-control border-input" placeholder="Here can be your description" id="editor1" name="content"></textarea>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Image Thumbnails</label>
                                      <input type="file" class="form-control border-input" placeholder="Thumbnail" name="thumb" value="">
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Rom Download</label>
                                    <input type="text" class="form-control border-input" placeholder="Download" name="url" value="">
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Rom Download (Mirror)</label>
                                    <input type="text" class="form-control border-input" placeholder="Download" name="url2" value="">
                                </div>
                            </div>
                          </div>
                          <div class="text-center">
                              <button type="submit" class="btn btn-info btn-fill btn-wd">Add ROM</button>
                          </div>
                          <div class="clearfix"></div>
                      </form>
                  </div>
              </div>
          </div>


      </div>
  </div
  </div>
@include('common.back.copyright')
</div>
