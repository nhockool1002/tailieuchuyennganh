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
                                <h4 class="title">Sửa nguồn khóa học VIP</h4>
                                <small>Sửa mới nguồn khóa học mới VIP</small>
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
                                        <a href="{{ route('addDonateBranchCourse') }}" class="btn btn-warning btn-fill">Thêm nguồn mới</a>
                                        <hr />
                                        <form method="POST" action="">
                                            @csrf
                                            <label>Tên nguồn khóa học</label>
                                            <input value ="{{ $branch->branch_name }}" name="branchcourse" type="text" class="form-control border-input" required />
                                            <div class="donateboxsetting text-center">
                                            <button class="btn btn-success btn-fill" type="submit">Lưu nguồn</button>
                                            </div>
                                        </form>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
