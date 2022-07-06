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
                                <h4 class="title">Under Construction Setting</h4>
                                <div class="buttonzone">
                                <a href="{{ route('setting') }}" class="btn btn-danger pull-right"><i class="ti-settings">Setting</i></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" action="">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                                <label class="form-control">Choose Setting</label>
                                                <select class="form-control border-input" name="select">
                                                    <option value="0" {{ $status == '0' ? 'selected' : '' }}>Enable</option>
                                                    <option value="1" {{ $status == '1' ? 'selected' : '' }}>Disable</option>
                                                </select>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="text-center">
                                                            <br>
                                                            <button type="submit" class="btn btn-info btn-fill btn-wd">Save</button>
                                                        </div>
                                                    </div>
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
