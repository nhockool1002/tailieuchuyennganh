				<!-- row -->
				<div class="row">
					@foreach($stickytop2post as $post)	
					<!-- post -->
					<div class="col-md-6">
						<div class="post post-thumb stickpost">
							<a class="post-img" href="{{ route('getPost', ['id' => $post->id, 'slug' => $post->post_slug ]) }}"><img src="{{ \Constant::IMAGE_THUMB_POST }}/{{ $post->post_img }}" alt="{{ $post->post_slug }}"></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category cat-{{ $post->category->id }}" href="{{ route('getCategory', ['id' => $post->category->id, 'slug' => $post->category->cat_slug ]) }}">{{ $post->category->cat_name }}</a>
									<span class="post-date">{{ $post->created_at->format('d-m-Y') }}</span>
								</div>
								<h3 class="post-title"><a href="{{ route('getPost', ['id' => $post->id, 'slug' => $post->post_slug ]) }}">{{ $post->post_name }}</a></h3>
							</div>
						</div>
					</div>
					<!-- /post -->
					@endforeach
				</div>
				<!-- /row -->
