
							<div class="col-md-12">
								<div class="box-donate-notice">
									{!! $notice !!}
								</div>
								<br />
									<style>#M396794ScriptRootC324699 {min-height: 300px;}</style>
									<!-- Composite Start -->
									<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ftailieuchuyennganhmienphi&tabs=timeline&width=340&height=271&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=513881545829406" width="340" height="271" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
									<!-- Composite End -->
								<div class="box-content-donate">
									<table class="table table-striped" id="your-link">
                                    <thead>
                                        <th width="">Tên khóa học</th>
                                        <th width="15%">Danh mục</th>
									    <th width="20%">Link gốc</th>
									    <th width="20%">Link Học</th>
                                    </thead>
                                    <tbody>
                                       @foreach($courses as $item)
									      <tr>
									        <td class="name_td">{{ $item->course_name }} (<b>{{ $item->branch->branch_name }}</b>)</td>
                                            <td>{{ $item->category->cat_name }}</td>
									        <td><a class="link-origin" target="_blank" href="{{ $item->originlink }}">Xem bài viết</a></td>
									        <td><a class="link-study" target="_blank" href="{{ $item->link }}">Học ngay</a></td>
									      </tr>
									     @endforeach
                                    </tbody>
                                </table>
								</div>
							</div>
                            <hr />
                            <div class="col-md-12">
                            <div class="comment-box-online">
                            <div class="fb-comments" data-href="{{ url()->current() }}" data-numposts="5" width="1000px"></div>
                            </div>
                            </div>
