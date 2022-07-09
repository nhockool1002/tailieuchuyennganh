<form method="POST" action="{{ route('createLink') }}">
	@csrf
<div class="row">
    <div class="col-md-12">
    	<div class="form-group">
            <label><h4>Title</h4></label>
                <input type='text' name="title" class="form-control border-input">
    	</div>
        <div class="form-group">
            <label><h4>Url</h4></label>
                <input type='text' name="link" class="form-control border-input">
    	</div>
    </div>
</div>
<div class="text-center">
    <button type="submit" class="btn btn-danger btn-fill btn-wd">Create Link</button>
</div>
</form>
<br>
@if(session('link_created'))
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
                    <input id="newLink" class="form-control" type="text" value="{{ \Constant::URL_HOME}}go/{{session('link_created')}}">
                </div>
                <div class="col-sm-4 text-center">
                    <button onclick="cpc()" type="button" class="btn btn-block btn-success btn-fill btn-wd">COPY TO CLIPBOARD</button>
                </div>
            </div>  
    	</div>
    </div>
</div>
@endif 
@if(session('link_created_error'))
<div class="row">
    <div class="col-md-12">
    	<div class="form-group alert alert-info">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <label style="color:red"><h4>{session('link_created_error')}</h4></label>
                </div>
            </div>
    	</div>
    </div>
</div>
@endif 
