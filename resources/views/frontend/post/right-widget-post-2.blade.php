							<div class="section-title">
								<h2>Bài viết ngẫu nhiên</h2>
							</div>
							@foreach($randompost as $item)
							<div class="post post-thumb">
								<a class="post-img" href="{{ route('getPost',['id' => $item->id, 'slug' => $item->post_slug]) }}"><img src="{{ \Constant::UPLOAD_PATH }}{{ $item->post_img }}" alt="{{ $item->post_slug }}"></a>
								<div class="post-body">
									<div class="post-meta">
										<a class="post-category cat-{{ $item->category->id }}" href="#">{{ $item->category->cat_name }}</a>
										<span class="post-date">{{ $item->created_at->format('d/m/Y') }}</span>
									</div>
									<h3 class="post-title"><a href="{{ route('getPost',['id' => $item->id, 'slug' => $item->post_slug]) }}">{{ $item->post_name }}</a></h3>
								</div>
							</div>
							@endforeach