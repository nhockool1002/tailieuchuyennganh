<div class="col-md-8">
						<div class="row">
							<div class="col-md-12">
								<div class="section-title">
									<h2>Ngoại ngữ</h2>
								</div>
							</div>
							@foreach($foreign4post as $post)
							<!-- post -->
							<div class="col-md-12">
								<div class="post post-row">
									<a class="post-img" href="{{ route('getPost', ['id' => $post->id, 'slug' => $post->post_slug ]) }}"><img class="h40" src="{{ \Constant::IMAGE_THUMB_POST }}/{{ $post->post_img }}" alt="{{ $post->post_slug }}"></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category cat-{{ $post->category->id }}" href="{{ route('getCategory', ['id' => $post->category->id, 'slug' => $post->category->cat_slug ]) }}
                                                ">{{ $post->category->cat_name }}</a>
											<span class="post-date">{{ $post->created_at->format('d-m-Y') }}</span>
										</div>
										<h3 class="post-title"><a href="{{ route('getPost', ['id' => $post->id, 'slug' => $post->post_slug ]) }}">{{ $post->post_name }}</a></h3>
										<p>{{ strip_tags(trim(html_entity_decode(getExcerpt($post->post_content, 0, 250)))) }}</p>
									</div>
								</div>
							</div>
							<!-- /post -->
							@endforeach
						</div>
					</div>
