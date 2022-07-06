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
                                <h4 class="title">Donate Setting</h4>
                                <div class="buttonzone">
                                <a href="{{ route('setting') }}" class="btn btn-danger pull-right"><i class="ti-settings">Setting</i></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <hr />
                                    @include('backend.setting.donate.list-button')
                                    <hr />
                                    <div class="donateboxsetting">
                                        <form method="POST" action="{{ route('updateDonateInfo') }}">
                                            @csrf
                                            <textarea name="donate_info" class="form-control" id="editor1">
                                                {{ isset($donate_setting) ? $donate_setting->config_setting : '' }}
                                            </textarea>
                                        <br>
                                        <div class="col-md-12 text-center">
                                            <button class="btn btn-success btn-fill" type="submit">Lưu thông tin</button>
                                            <div class="donateboxsetting"></div>
                                            <br />
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
