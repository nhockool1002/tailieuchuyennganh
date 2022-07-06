
							<div class="col-md-12">
								<div class="row">
                                    @foreach($posts as $item)
                                    <!-- post -->
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <div class="hovereffect">
                                            <img class="img-responsive" src="{{ \Constant::UPLOAD_PATH }}{{ $item->post_img }}" alt="{{ $item->post_slug }}">
                                                <div class="overlay">
                                                    <h2>{{ $item->post_name }}</h2>
                                                    <p>
                                                        <a href="{{ route('getPost',['id' => $item->id, 'slug' => $item->post_slug]) }}">LINK HERE</a>
                                                    </p>
                                                </div>
                                        </div>
                                        <div class="clearfix visible-md visible-lg"></div>
                                        <div class="wordpress-title-post">
                                            <a href="{{ route('getPost',['id' => $item->id, 'slug' => $item->post_slug]) }}">{{ $item->post_name }}</a>
                                        </div>
                                    </div>
                                    <!-- /post -->
							        @endforeach
                                </div>
                            </div>
                            <div class="clearfix visible-md visible-lg"></div>
							<div class="col-md-12">
								<div class="paginate-page" style="text-align: center">
                                {!! $posts->links() !!}
                                </div>
							</div>
