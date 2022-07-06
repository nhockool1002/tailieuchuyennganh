    <div class="main-panel">
        @include('common.back.topsetting')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="buttonzone">
                                <a href="{{ route('user') }}" class="btn btn-danger pull-right"><i class="ti-user"> Users Manager</i></a>
                        </div>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <div class="card card-user">
                            <div class="image">
                                <img src="{{ asset('admin-assets/img/background.jpg') }}" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                  <img class="avatar border-white" src="{{ isset($user->avatar) ? \Constant::AVATAR_PATH.$user->avatar : \Constant::IMG_PATH.'nblogsite.png' }}" alt="..."/>
                                  <h4 class="title">{{ $user->username }}<br />
                                     <a href="#"><small>{{ $user->role->role_name }}</small></a>
                                  </h4>
                                </div>
                                <p class="description text-center">
                                    "{{ $user->aboutme }}"
                                </p>
                            </div>
                            <hr>
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-1">
                                        <h5>{{ $user->post->count() }}<br /><small>Post</small></h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>0<br /><small>Post</small></h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>0<br /><small>Post</small></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                     		<div class="col-md-12">
                                <br />
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
                            <div class="header">
                                <h4 class="title">Edit Profile</h4>
                            </div>
                            <div class="content">
                                <form method="POST" action="{{ route('updateUser', $user->id) }}" enctype="multipart/form-data">
                                	{{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control border-input" placeholder="Username" name="username" value="{{ $user->username }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="text" class="form-control border-input" placeholder="Password" name="password" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email</label>
                                                <input type="email" class="form-control border-input" placeholder="Email" name="email" value="{{ $user->email }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Permission</label>
                                                <select name="role" class="form-control border-input">
                                                    @foreach($role as $r)
                                                	<option value="{{ $r->id }}" @if($r->id == $user->role->id) selected="selected" @endif>{{ $r->role_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>About Me</label>
                                                <textarea rows="5" class="form-control border-input" placeholder="Here can be your description" name="aboutme">{{ $user->aboutme }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Change Avatar</label>
                                                <input type="file" name="avatar" class="form-control border-input" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Signature</label>
                                                <textarea class="form-control" name="sign" id="editor1">
                                                    {{ isset($user->sign) ? $user->sign : '' }}
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info btn-fill btn-wd">Update Profile</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div
        </div>
    @include('common.back.copyright')
    </div>
