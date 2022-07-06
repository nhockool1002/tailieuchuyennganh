    <div class="main-panel">
        @include('common.back.topsetting')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="col-md-12">
                                <div class="alertbox">
                                    <br />
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
                                <h4 class="title">Advertisement Manager</h4>
                            </div>
                            <div class="content">
                                <form method="POST" action="">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Ads Zone</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Ads Image</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Target Link</label>
                                            </div>
                                        </div>
                                    </div>
                                    @if(isset($ads))
                                    @foreach($ads as $item)
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-control" name="data[{{$item->id}}][{{$item->ads_zone}}]" style="line-height: 30px" disabled>{{ $item->ads_zone }}</div>
                                                <input type="hidden" name="data[{{$item->id}}]" value="{{ $item->id }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control border-input" placeholder="Advertisement Image" name="data[{{$item->id}}][ads_img]" value="{{ $item->ads_img }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control border-input" placeholder="Advertisement Target Link" name="data[{{$item->id}}][target_link]" value="{{ $item->target_link }}">
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info btn-fill btn-wd">Save</button>
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