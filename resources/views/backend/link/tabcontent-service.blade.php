<form method="POST" action="{{ route('storeService') }}">
	@csrf
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label><h4>Service name</h4></label>
                <input type='text' name="service" class="form-control border-input">
    	</div>
        <div class="form-group">
            <label><h4>API url service</h4></label>
                <input type='text' name="api_url" class="form-control border-input">
        </div>
    </div>
</div>
<div class="text-center">
    <button type="submit" class="btn btn-danger btn-fill btn-wd">Add Service</button>
</div>
</form>
<div class="content table-responsive table-full-width text-center">
    <table class="table table-striped">
        <thead>
            <th class="text-center">ID</th>
            <th class="text-center">Service Name</th>
            <th class="text-center">Opion</th>
        </thead>
        <tbody>
        	@foreach($service as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name_service }}</td>
                <td>
                    <a href="{{ route('deleteService', $item->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="ti-close"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
     </table>
</div>