    <div class="main-panel">
        @include('common.back.topsetting')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
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
                            <div class="header">
                                <h4 class="title">Add User</h4>
                            </div>
                            <div class="content">
                                <form method="POST" action="" enctype="multipart/form-data">
                                	{{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control border-input" placeholder="Username" name="username" value="">
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
                                                <input type="email" class="form-control border-input" placeholder="Email" name="email" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Role</label>
                                                <select name="role" class="form-control border-input">
                                                    @foreach($role as $r)
                                                        @if ($r->name !== 'super-admin')
                                                            <option value="{{ $r->name }}">{{ $r->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>About Me</label>
                                                <textarea rows="5" class="form-control border-input" placeholder="Here can be your description" name="aboutme"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Avatar</label>
                                                <input type="file" name="avatar" class="form-control border-input" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info btn-fill btn-wd">Add User</button>
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
