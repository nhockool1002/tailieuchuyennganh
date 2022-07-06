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
                                <h4 class="title">Social Setting</h4>
                                <div class="buttonzone">
                                <a href="{{ route('setting') }}" class="btn btn-danger pull-right"><i class="ti-settings">Setting</i></a>
                                </div>
                            </div>
                            <div class="content">
                                <form method="POST" action="">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Facebook</label>
                                                <input class="form-control border-input" name="facebook" value="{{ isset($social['facebook']) ? $social['facebook'] : '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Twitter</label>
                                                <input class="form-control border-input" name="twitter" value="{{ isset($social['twitter']) ? $social['twitter'] : '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Google+</label>
                                                <input class="form-control border-input" name="google" value="{{ isset($social['google']) ? $social['google'] : '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Pinterest</label>
                                                <input class="form-control border-input" name="pinterest" value="{{ isset($social['pinterest']) ? $social['pinterest'] : '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Linkedin</label>
                                                <input class="form-control border-input" name="linkedin" value="{{ isset($social['linkedin']) ? $social['linkedin'] : '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Yahoo!</label>
                                                <input class="form-control border-input" name="yahoo" value="{{ isset($social['yahoo']) ? $social['yahoo'] : '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <br>
                                                <button type="submit" class="btn btn-info btn-fill btn-wd">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
