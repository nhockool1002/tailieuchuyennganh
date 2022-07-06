			<!-- Page Header -->
			<div id="post-header" class="page-header">
				<div class="background-img" style="background-image: url('{{ \Constant::UPLOAD_PAGE_PATH }}{{ $pages->page_img }}');"></div>
				<div class="container">
					<div class="row">
						<div class="col-md-10">
							<div class="post-meta">
								<span class="post-date">{{ $pages->created_at->format('d-m-Y') }}</span>
							</div>
							<h1>{{ $pages->page_name }}</h1>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Header -->
