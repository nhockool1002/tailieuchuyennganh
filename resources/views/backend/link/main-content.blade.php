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
                            @if(session('warning_mesage'))
                                <div class="alert alert-danger">
                                    <i class="fa fa-times" aria-hidden="true"></i> {{session('warning_mesage')}}
                                </div>
                            @endif                          
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Links Manager</h4>
                                <p class="category">This page show all tools for links configure</p>
                            </div>
                            <div class="content table-responsive table-full-width link-tab">
                                <button class="tablink" onclick="openPage('General', this)" {{ (Request()->param === null || (Request()->param == 'update_service')) ? 'id=defaultOpen' : '' }}>General Configure</button>
                                <button class="tablink" onclick="openPage('Service', this)" {{ (Request()->param == 'service') ? 'id=defaultOpen' : '' }}>Service Shortlink</button>
                                <button class="tablink" onclick="openPage('Create', this)" {{ (Request()->param == 'create') ? 'id=defaultOpen' : '' }}>Create Link</button>
                                <button class="tablink" onclick="openPage('List', this)" {{ (Request()->param == 'yourlink') ? 'id=defaultOpen' : '' }}>Your Link</button>
                                <div id="General" class="tabcontent">
                                    @include('backend.link.tabcontent-general')
                                </div>
                                <div id="Service" class="tabcontent">
                                    @if(Auth::user()->role_id == '1')
                                    @include('backend.link.tabcontent-service')
                                    @else
                                    <br />
                                    <p class="text-danger">Bạn không đủ quyền hạn để khởi tạo Service Shorlink -  Vui lòng liên hệ Administrator <a href="mailto:dulieuchuyennganh@gmail.com">[Tại đây]</a></p>
                                    @endif
                                </div>
                                <div id="Create" class="tabcontent">
                                  @include('backend.link.tabcontent-create')
                                </div>
                                <div id="List" class="tabcontent">
                                   @include('backend.link.tabcontent-list')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alertbox">
                            @if(session('s3_success_message'))
                                <div class="alert alert-success">
                                    <i class="fa fa-check" aria-hidden="true"></i> {{session('s3_success_message')}}
                                </div>
                            @endif  
                            @if(session('s3_warning_message'))
                                <div class="alert alert-warning">
                                    <i class="fa fa-times" aria-hidden="true"></i> {{session('s3_warning_message')}}
                                </div>
                            @endif          
                            @if(session('link_created_s3_error'))
                            <div class="alert alert-danger">
                                <i class="fa fa-times" aria-hidden="true"></i> {{session('link_created_s3_error')}}
                            </div>
                            @endif                 
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">S3 LINK MANAGE</h4>
                                <p class="category">S3 Management Link</p>
                            </div>
                            <div class="content">
                                @if(session('link_s3_created'))
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group alert alert-info">
                                                <div class="row">
                                                    <div class="col-sm-12 text-center">
                                                        <label style="color:#c53665"><h4>New Url Created</h4></label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-8 text-center">
                                                        <input id="newLinkS3" class="form-control" type="text" value="{{ \Constant::URL_HOME}}s3link/{{session('link_s3_created')}}">
                                                    </div>
                                                    <div class="col-sm-4 text-center">
                                                        <button onclick="cpcS3()" type="button" class="btn btn-block btn-success btn-fill btn-wd">COPY TO CLIPBOARD</button>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                    </div>
                                @endif 
                                <form action="{{ route('uploads3post') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Choose File</label>
                                        <input class="form-control" type="file" id="formFile" name="itemS3">
                                        <br />
                                        <button type="submit" class="btn btn-primarry">Submit</button>
                                    </div>
                                </form>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-striped" id="your-link">
                                        <thead>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Key File</th>
                                            <th>Link</th>
                                            <th>Option</th>
                                        </thead>
                                        <tbody>
                                            @foreach($s3Link as $item)
                                            <tr>
                                                <td width="5%">{{ $item->id }}</td>
                                                <td width="15%">{{ $item->title }}</td>
                                                <td width="30%">
                                                    <div class="hashS3Item">{{ $item->hash }}</div>
                                                </td>
                                                <td width="10%">#A</td>
                                                <td width="10%">
                                                    <a href="{{ route('deleteS3Link', ['id' => $item->id])}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="ti-close"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
