
							@foreach($posts as $item)
							<!-- post -->
							<div class="col-md-12">
								<div class="post post-row">
									<a class="post-img" href="{{ route('getPost',['id' => $item->post->id, 'slug' => $item->post->post_slug]) }}"><img src="{{ \Constant::UPLOAD_PATH }}{{ $item->post->post_img }}" alt="{{ $item->post->post_slug }}"></a>
									<div class="post-body">
										<h3 class="post-title"><a href="{{ route('getPost',['id' => $item->post->id, 'slug' => $item->post->post_slug]) }}">{{ $item->post->post_name }}</a></h3>
										<p>{{ strip_tags(trim(html_entity_decode(getExcerpt($item->post->post_content, 0, 250)))) }}</p>
									</div>
								</div>
							</div>
							<!-- /post -->
							@endforeach
							<div class="col-md-12">
								<div class="paginate-page" style="text-align: center">
                                {!! $posts->links() !!}
                                </div>
							</div>
