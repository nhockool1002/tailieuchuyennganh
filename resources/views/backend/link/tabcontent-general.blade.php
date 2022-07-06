<form method="POST" action="{{ route('updateService') }}">
	@csrf
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label><h4>Choose main service</h4></label>
                <select name="service" class="form-control border-input">
                	@foreach($service as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $member->service_shortlink_id ? 'selected' : ''}}>{{ $item->name_service }}</option>
                    @endforeach
                 </select>
    	</div>
    </div>
</div>
@if(isset($token->api_token))
@php
    $token = json_decode($token->api_token, true);
@endphp
@endif
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label><h4>Token API Shortlink Service</h4></label><br />
            @foreach($service as $item)
            <label>{{ $item->name_service }}</label>
            <input type="text" name="{{ $item->key_service }}" class="form-control border-input" value="{{ (isset($token[$item->key_service]) && $token[$item->key_service] != null) ? $token[$item->key_service] : '' }}">
             @endforeach
        </div>
    </div>
</div>
<div class="text-center">
    <button type="submit" class="btn btn-info btn-fill btn-wd" onclick="return confirm('Are you sure you want to update this config ?');">Save</button>
</div>
</form>