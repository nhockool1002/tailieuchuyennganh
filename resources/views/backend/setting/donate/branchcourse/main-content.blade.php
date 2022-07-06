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
                                <h4 class="title">Nguồn khóa học VIP</h4>
                                <small>Hiển thị nguồn của các khóa học VIP</small>
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
                                        <table class="table table-dark table-hover" id="your-link">
                                            <thead>
                                              <tr>
                                                <th width="10%">ID</th>
                                                <th width="40%">Nguồn khóa học</th>
                                                <th width="30%">Số lượng</th>
                                                <th>Option</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($branch as $item)
                                              <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->branch_name }}</td>
                                                <td>{{ $item->course->count() }} Khóa học</td>
                                                <td>
                                                    <a href="{{ route('editDonateBranchCourse', $item->id) }}" class="btn btn-primary btn-xs btn-fill">Edit</a>
                                                    <a href="{{ route('deleteDonateBranchCourse', $item->id) }}" class="btn btn-danger btn-xs btn-fill" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                                </td>
                                              </tr>
                                            @endforeach
                                            </tbody>
                                          </table>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
