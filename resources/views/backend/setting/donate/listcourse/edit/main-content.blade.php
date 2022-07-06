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
                                <h4 class="title">Sửa khóa học VIP</h4>
                                <small>Sửa khóa học mới VIP</small>
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
                                        <form method="POST" action="">
                                            @csrf
                                            <label>Tên khóa học</label>
                                            <input name="coursename" type="text" class="form-control border-input" value="{{ $course->course_name }}" />
                                            <label>Nhập Link Khóa học</label>
                                            <input name="courseoriginlink" type="text" class="form-control border-input" value="{{ $course->originlink }}" required />
                                            <label>Nhập Link Học</label>
                                            <input name="courselink" type="text" class="form-control border-input" value="{{ $course->link }}" required />
                                            <label>Nhập Link Backup</label>
                                            <input name="courselink2" type="text" class="form-control border-input" value="{{ $course->backuplink }}" />
                                            <label>Chọn danh mục</label>
                                            <select name="category" class="form-control border-input">
                                                @foreach($cats as $item)
                                                <option value="{{ $item->id }}" @if($item->id == $course->cat_id) selected  @endif>{{ $item->cat_name }}</option>
                                                @endforeach
                                            </select>
                                            <label>Chọn nguồn</label>
                                            <select name="coursebranch" class="form-control border-input">
                                                @foreach($branch as $item)
                                                <option value="{{ $item->id }}" @if($item->id == $course->branch_course_id) selected  @endif>{{ $item->branch_name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="donateboxsetting text-center">
                                            <button class="btn btn-success btn-fill" type="submit">Lưu khóa học</button>
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
