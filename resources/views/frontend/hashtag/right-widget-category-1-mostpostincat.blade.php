							<div class="section-title">
								<h2>Bài viết liên quan</h2>
							</div>
							@foreach($relatepost as $item)
							<div class="post post-widget">
								<a class="post-img" href="{{ route('getPost',['id' => $item->id, 'slug' => $item->post_slug]) }}"><img src="{{ \Constant::UPLOAD_PATH }}{{ $item->post_img }}" alt="{{ $item->post_slug }}"></a>
								<div class="post-body">
									<h3 class="post-title"><a href="{{ route('getPost',['id' => $item->id, 'slug' => $item->post_slug]) }}">{{ $item->post_name }}</a></h3>
								</div>
							</div>
							@endforeach