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
                                <h4 class="title">Danh sách khóa học VIP</h4>
                                <small>Hiển thị danh sách Khóa học của nhóm XShare Donate</small>
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
                                        <a href="{{ route('addDonateCourse') }}" class="btn btn-warning btn-fill">Thêm khóa mới</a>
                                        <hr />
                                        <table class="table table-dark table-hover" id="your-link">
                                            <thead>
                                              <tr>
                                                <th width="10%">ID</th>
                                                <th width="40%">Tên khóa học</th>
                                                <th width="30%">Category</th>
                                                <th>Option</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              @foreach($list as $item)
                                              <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->course_name}} (<b>{{ $item->branch->branch_name }}</b>)</td>
                                                <td>{{ $item->category->cat_name}}</td>
                                                <td>
                                                    <a href="{{ route('editDonateCourse', $item->id) }}" class="btn btn-primary btn-xs btn-fill">Edit</a>
                                                    <a href="{{ route('deleteDonateCourse', $item->id) }}" class="btn btn-danger btn-xs btn-fill" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
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
