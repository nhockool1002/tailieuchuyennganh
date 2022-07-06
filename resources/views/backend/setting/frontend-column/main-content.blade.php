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
                                <h4 class="title">Frontend Column</h4>
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
                                                <label>Frontend Column 1</label>
                                                <div class="content table-responsive table-full-width">
                                                    <textarea name="col1" class="form-control" id="editor1">
                                                        {{ isset($col1) ? $col1->config_setting : '' }} 
                                                    </textarea>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Frontend Label 2</label>
                                                <div class="content table-responsive table-full-width">
                                                    <input name="col2_name" class="form-control border-input" value="{{ isset($col2) && !empty($col2) ? $col2['title'] : '' }}" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Frontend Column 2</label>
                                                <div class="content table-responsive table-full-width">
                                                    <textarea name="col2_config" class="form-control" id="editor2">
                                                        {{ isset($col2) && !empty($col2) ? $col2['config'] : '' }}
                                                    </textarea>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Frontend Label 3</label>
                                                <div class="content table-responsive table-full-width">
                                                    <input name="col3_name" class="form-control border-input"  value="{{ isset($col3) && !empty($col3) ? $col3['title'] : '' }}" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Frontend Column 3</label>
                                                <div class="content table-responsive table-full-width">
                                                    <textarea name="col3_config" class="form-control" id="editor3">
                                                        {{ isset($col3) && !empty($col3) ? $col3['config'] : '' }}
                                                    </textarea>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Frontend Label 4</label>
                                                <div class="content table-responsive table-full-width">
                                                    <input name="col4_name" class="form-control border-input"  value="{{ isset($col4) && !empty($col4) ? $col4['title'] : '' }}" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Frontend Column 4</label>
                                                <div class="content table-responsive table-full-width">
                                                    <textarea name="col4_config" class="form-control" id="editor4">
                                                        {{ isset($col4) && !empty($col4) ? $col4['config'] : '' }}
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
