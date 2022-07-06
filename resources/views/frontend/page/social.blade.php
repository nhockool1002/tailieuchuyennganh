								@if(isset($social['facebook']))
								<a href="{{ $social['facebook'] }}" target="_blank" class="share-facebook"><i class="fa fa-facebook"></i></a>
								@endif
								@if(isset($social['twitter']))
								<a href="{{ $social['twitter'] }}" target="_blank" class="share-twitter"><i class="fa fa-twitter"></i></a>
								@endif
								@if(isset($social['google']))
								<a href="{{ $social['google'] }}" target="_blank" class="share-google-plus"><i class="fa fa-google-plus"></i></a>
								@endif
								@if(isset($social['pinterest']))
								<a href="{{ $social['pinterest'] }}" target="_blank" class="share-pinterest"><i class="fa fa-pinterest"></i></a>
								@endif
								@if(isset($social['linkedin']))
								<a href="{{ $social['linkedin'] }}" target="_blank" class="share-linkedin"><i class="fa fa-linkedin"></i></a>
								@endif
								@if(isset($social['yahoo']))
								<a href="{{ $social['yahoo'] }}" target="_blank"><i class="fa fa-envelope"></i></a>
								@endif
