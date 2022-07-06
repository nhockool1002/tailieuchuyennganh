<div class="wrap-post-content">
<h3 class="post-title">{{ $pages->page_name }}</h3>
<div class="post-content">{!! $pages->page_content !!}</div>
<div class="sign-content">
	@if(isset($pages->user->sign))
		{!! $pages->user->sign !!}
	@else
		@if(!empty($settingConfig['signature']['config_setting']))
           {!! $settingConfig['signature']['config_setting'] !!}
        @endif
	@endif
</div>
</div>