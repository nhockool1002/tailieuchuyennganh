				<!-- row -->
				<div class="row">
					<div class="col-md-8">
						<div class="row">
						    <br />
								@if(isset($category_top_content_728x90))
										<a href="{{ $category_top_content_728x90->target_link }}" style="display: inline-block;margin: auto;">
												<img class="img-responsive" src="{{ $category_top_content_728x90->ads_img }}" alt="" target="_blank">
										</a>
								@endif
								<br />
							@for($i = 0; $i < count($random7post); $i++)								
							<!-- post -->
							<div class="{{ $i == 0 ? 'col-md-12' : 'col-md-6' }}">
								<div class="post post-thumb">
									<a class="post-img" href="{{ route('getPost', ['id' => $random7post[$i]['id'], 'slug' => $random7post[$i]['post_slug'] ]) }}"><img class="{{ $i != 0 ? 'h40' : '' }}" src="{{ \Constant::IMAGE_THUMB_POST }}/{{ $random7post[$i]['post_img'] }}" alt="{{ $random7post[$i]['post_name'] }}"></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category cat-{{ $random7post[$i]->category->id }}" href="{{ route('getCategory', ['id' => $random7post[$i]->category->id, 'slug' => $random7post[$i]->category->cat_slug ]) }}">{{ $random7post[$i]->category->cat_name }}</a>
											<span class="post-date">{{ $random7post[$i]['created_at']->format('d-m-Y') }}</span>
										</div>
										<h3 class="post-title"><a href="{{ route('getPost', ['id' => $random7post[$i]['id'], 'slug' => $random7post[$i]['post_slug'] ]) }}">{{ $random7post[$i]['post_name'] }}</a></h3>
									</div>
								</div>
							</div>
							<!-- /post -->
							@if($i == 2 || $i == 4)							
								<div class="clearfix visible-md visible-lg"></div>
							@endif
							@endfor
						</div>
					</div>
					@include('frontend.home.widget')
				</div>
				<!-- /row -->
