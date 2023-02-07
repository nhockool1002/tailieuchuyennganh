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
                            @if(session('warning_message'))
                              <div class="alert alert-danger">
                                  <i class="fa fa-times" aria-hidden="true"></i> {{session('warning_message')}}
                              </div>
                          @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Pokemon Controller</h4>
                                <p class="category">This page show all pokemon resource</p>
                                @include('backend.pokemon.buttonzone')
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>Name</th>
                                        <th>Version</th>
                                    	<th>Description</th>
                                    	<th>Author</th>
                                        <th>Updated Time</th>
                                        <th>Opion</th>
                                    </thead>
                                    <tbody>
                                        @foreach($pkms as $pkm)
                                        <tr>
                                        	<td width="10%">{{ $pkm->id }}</td>
                                            <td width="15%">{!! $pkm->name !!}</td>
                                            <td width="10%">{!! $pkm->version !!}</td>
                                        	<td width="30%">{{ $pkm->description }}</td>
                                            <td width="15%">{{ $pkm->author }}</td>
                                        	<td width="10%">{{ $pkm->updated_at }}</td>
                                            <td width="15%">
                                                <a href="{{ route('editViewPokemon', $pkm->id) }}" class="btn btn-xs btn-primary"><i class="ti-pencil"></i></a>
                                                <a href="{{ route('deleteRom', $pkm->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="ti-close"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="paginate-page" style="text-align: center">
                                {!! $pkms->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
