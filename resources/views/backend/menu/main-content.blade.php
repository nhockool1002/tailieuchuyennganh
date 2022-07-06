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
                            @if(session('danger_mesage'))
                                <div class="alert alert-danger">
                                    <i class="fa fa-check" aria-hidden="true"></i> {{session('danger_mesage')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Menu</h4>
                                    </div>
                                    <div class="content table-responsive table-full-width">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @foreach($menus as $menu)
                                                <div class="menu-item-config">
                                                    {{ $menu->menu_name }}
                                                    <a href="{{ route('deletemenu', $menu->id) }}" class="btn btn-xs btn-danger pull-right"><i class="ti-close"></i></a>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Category List</h4>
                                    </div>
                                    <div class="content table-responsive table-full-width">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @foreach($cats as $cat)
                                                <div class="menu-item-config">
                                                    <form method="POST" action="{{ route('postaddcategorymenu') }}"> 
                                                    {{ csrf_field() }}
                                                    {{ $cat->cat_name }}
                                                    <input type="hidden" value="{{ $cat->cat_name }}" name="menu_name">
                                                    <input type="hidden" value="{{ $cat->id }}" name="menu_id">
                                                    <button type="submit" class="btn btn-xs btn-success pull-right"><i class="ti-plus">Add menu</i></button>
                                                    </form>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Custom Link</h4>
                                    </div>
                                    <div class="content table-responsive table-full-width">
                                        <div class="custom-link-menu">
                                            <form method="POST" action="{{ route('postaddmenucustom') }}">
                                                {{ csrf_field() }}
                                                <label>Menu Name</label>
                                                <input type="text" name="menu_name" class="form-control border-input">
                                                <label>Menu URL</label>
                                                <input type="text" name="menu_url" class="form-control border-input">
                                                <div style="height:20px;"></div>
                                                <button type="submit" class="btn btn-sm btn-success pull-right"><i class="ti-plus">Add menu</i></button>
                                                <br/>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
