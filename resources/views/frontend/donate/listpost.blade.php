
							<div class="col-md-12">
								<div class="box-donate-notice">
									{!! $notice !!}
								</div>
								<br />
									<style>#M396794ScriptRootC324699 {min-height: 300px;}</style>
									<!-- Composite Start -->
									<div id="M396794ScriptRootC324699">
									        <div id="M396794PreloadC324699">
									        Loading...    </div>
									        <script>
									                (function(){
									            var D=new Date(),d=document,b='body',ce='createElement',ac='appendChild',st='style',ds='display',n='none',gi='getElementById',lp=d.location.protocol,wp=lp.indexOf('http')==0?lp:'https:';
									            var i=d[ce]('iframe');i[st][ds]=n;d[gi]("M396794ScriptRootC324699")[ac](i);try{var iw=i.contentWindow.document;iw.open();iw.writeln("<ht"+"ml><bo"+"dy></bo"+"dy></ht"+"ml>");iw.close();var c=iw[b];}
									            catch(e){var iw=d;var c=d[gi]("M396794ScriptRootC324699");}var dv=iw[ce]('div');dv.id="MG_ID";dv[st][ds]=n;dv.innerHTML=324699;c[ac](dv);
									            var s=iw[ce]('script');s.async='async';s.defer='defer';s.charset='utf-8';s.src=wp+"//jsc.mgid.com/x/s/xsharedata.com.324699.js?t="+D.getYear()+D.getMonth()+D.getUTCDate()+D.getUTCHours();c[ac](s);})();
									    </script>
									    </div>
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
