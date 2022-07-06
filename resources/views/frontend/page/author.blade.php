								<div class="media">
									<div class="media-left">
										<img class="media-object author-avatar" src="{{ isset($pages->user->avatar) ? \Constant::AVATAR_PATH.$pages->user->avatar : \Constant::IMG_PATH.'nblogsite.png' }}" alt="">
									</div>
									<div class="media-body">
										<div class="media-heading">
											<h3>{{ $pages->user->username }}</h3>
										</div>
										<p>{{ $pages->user->aboutme }}</p>
										<ul class="author-social">
											@if(isset($settingConfig['sc']['facebook']))
											<li><a href="{{ $settingConfig['sc']['facebook'] }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
											@endif
											@if(isset($settingConfig['sc']['twitter']))
											<li><a href="{{ $settingConfig['sc']['twitter'] }}" target="_blank"><i class="fa fa-twitter"></i></a></li>
											@endif
											@if(isset($settingConfig['sc']['google']))
											<li><a href="{{ $settingConfig['sc']['google'] }}" target="_blank"><i class="fa fa-google-plus"></i></a></li>
											@endif
											@if(isset($settingConfig['sc']['pinterest']))
											<li><a href="{{ $settingConfig['sc']['pinterest'] }}" target="_blank"><i class="fa fa-pinterest-square"></i></a></li>
											@endif
											@if(isset($settingConfig['sc']['linkedin']))
											<li><a href="{{ $settingConfig['sc']['linkedin'] }}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
											@endif
											@if(isset($settingConfig['sc']['yahoo']))
											<li><a href="{{ $settingConfig['sc']['yahoo'] }}" target="_blank"><i class="fa fa-envelope"></i></a></li>
											@endif
										</ul>
									</div>
								</div>
