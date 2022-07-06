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
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Backend Column</h4>
                                <div class="buttonzone">
                                <a href="{{ route('setting') }}" class="btn btn-danger pull-right"><i class="ti-settings">Setting</i></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" action="">
                                    @csrf
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Backend Column 1</label>
                                                <div class="content table-responsive table-full-width">
                                                    <textarea name="col1" class="form-control" id="editor1">
                                                        {{ isset($col1) ? $col1->config_setting : '' }}
                                                    </textarea>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Backend Column 2</label>
                                                <div class="content table-responsive table-full-width">
                                                    <textarea name="col2" class="form-control" id="editor2">
                                                        {{ isset($col2) ? $col2->config_setting : '' }}
                                                    </textarea>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Backend Column 3</label>
                                                <div class="content table-responsive table-full-width">
                                                    <textarea name="col3" class="form-control" id="editor3">
                                                        {{ isset($col3) ? $col3->config_setting : '' }}
                                                    </textarea>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-info btn-fill btn-wd">Update</button>
                                                </div>
                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
