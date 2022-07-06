				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="section-title">
							<h2>Bài viết mới</h2>
						</div>
					</div>
					@foreach($recent3post1 as $post)
					<!-- post -->
					<div class="col-md-4">
						<div class="post">
							<a class="post-img" href="{{ route('getPost', ['id' => $post->id, 'slug' => $post->post_slug ]) }}"><img class="h40" src="{{ \Constant::IMAGE_THUMB_POST }}/{{ $post->post_img }}" alt="{{ $post->post_slug }}"></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category cat-{{ $post->category->id }}" href="{{ route('getCategory', ['id' => $post->category->id, 'slug' => $post->category->cat_slug ]) }}">{{ $post->category->cat_name }}</a>
									<span class="post-date">{{ $post->created_at->format('d-m-Y') }}</span>
								</div>
								<h3 class="post-title"><a href="{{ route('getPost', ['id' => $post->id, 'slug' => $post->post_slug ]) }}">{{ $post->post_name}} <span class="postview-index">({{ $post->view_count }} Lượt xem)</span></a></h3>
							</div>
						</div>
					</div>
					<!-- /post -->
					@endforeach
					<div class="clearfix visible-md visible-lg"></div>

					@foreach($recent3post2 as $post)
					<!-- post -->
					<div class="col-md-4">
						<div class="post">
							<a class="post-img" href="{{ route('getPost', ['id' => $post->id, 'slug' => $post->post_slug ]) }}"><img class="h40" src="{{ \Constant::IMAGE_THUMB_POST }}/{{ $post->post_img }}" alt="{{ $post->post_slug }}"></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category cat-{{ $post->category->id }}" href="{{ route('getCategory', ['id' => $post->category->id, 'slug' => $post->category->cat_slug ]) }}">{{ $post->category->cat_name }}</a>
									<span class="post-date">{{ $post->created_at->format('d-m-Y') }}</span>
								</div>
								<h3 class="post-title"><a href="{{ route('getPost', ['id' => $post->id, 'slug' => $post->post_slug ]) }}">{{ $post->post_name}} <span class="postview-index">({{ $post->view_count }} Lượt xem)</span></a></h3>
							</div>
						</div>
					</div>
					<!-- /post -->
					@endforeach
				</div>
				<!-- /row -->
