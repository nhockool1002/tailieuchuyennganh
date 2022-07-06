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
            </div>
