			<!-- Page Header -->
			<div id="post-header" class="page-header">
				<div class="background-img" style="background-image: url('{{ \Constant::UPLOAD_PATH }}{{ $posts->post_img }}');"></div>
				<div class="container">
					<div class="row">
						<div class="col-md-10">
							<div class="post-meta">
								<a class="post-category cat-{{ $posts->category->id }}" href="{{ route('getCategory', ['id' => $posts->category->id, 'slug' => $posts->category->cat_slug ]) }}">{{ $posts->category->cat_name}}</a>
								<span class="post-date">{{ $posts->created_at->format('d-m-Y') }}</span>
							</div>
							<h1>{{ $posts->post_name }}</h1>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Header -->
