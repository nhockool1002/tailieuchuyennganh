							<div class="section-title">
								<h2>Danh mục</h2>
							</div>
							<div class="category-widget">
								<ul>
									@foreach($cats as $cat)
									<li><a href="{{ route('getCategory',['id' => $cat->id, 'slug' => $cat->cat_slug]) }}" class="cat-{{ $cat->id }}">{{ $cat->cat_name }}<span>{{ $cat->post->count() }}</span></a></li>
									@endforeach
								</ul>
							</div>