
							@foreach($posts as $item)
							<!-- post -->
							<div class="col-md-12">
								<div class="post post-row category">
									<a class="post-img" href="{{ route('getPost',['id' => $item->id, 'slug' => $item->post_slug]) }}"><img src="{{ \Constant::UPLOAD_PATH }}{{ $item->post_img }}" alt="{{ $item->post_slug }}" alt=""></a>
									<div class="post-body">
										<h3 class="post-title"><a href="{{ route('getPost',['id' => $item->id, 'slug' => $item->post_slug]) }}">{{ $item->post_name }}</a></h3>
										<p>{{ strip_tags(trim(html_entity_decode(getExcerpt($item->post_content, 0, 250)))) }}</p>
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
