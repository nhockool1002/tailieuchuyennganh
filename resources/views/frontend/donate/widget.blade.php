						<!-- ad -->
						<div class="aside-widget text-center">
							<!-- Composite Start -->
							<div id="M396794ScriptRootC324706">
							        <div id="M396794PreloadC324706">
							        Loading...    </div>
							        <script>
							                (function(){
							            var D=new Date(),d=document,b='body',ce='createElement',ac='appendChild',st='style',ds='display',n='none',gi='getElementById',lp=d.location.protocol,wp=lp.indexOf('http')==0?lp:'https:';
							            var i=d[ce]('iframe');i[st][ds]=n;d[gi]("M396794ScriptRootC324706")[ac](i);try{var iw=i.contentWindow.document;iw.open();iw.writeln("<ht"+"ml><bo"+"dy></bo"+"dy></ht"+"ml>");iw.close();var c=iw[b];}
							            catch(e){var iw=d;var c=d[gi]("M396794ScriptRootC324706");}var dv=iw[ce]('div');dv.id="MG_ID";dv[st][ds]=n;dv.innerHTML=324706;c[ac](dv);
							            var s=iw[ce]('script');s.async='async';s.defer='defer';s.charset='utf-8';s.src=wp+"//jsc.mgid.com/x/s/xsharedata.com.324706.js?t="+D.getYear()+D.getMonth()+D.getUTCDate()+D.getUTCHours();c[ac](s);})();
							    </script>
							    </div>
							<!-- Composite End -->
							{{-- @include('frontend.ads.ads-right-widget-category') --}}
						</div>
						<!-- /ad -->
						
						<!-- post widget -->
						<div class="aside-widget">
							@include('frontend.donate.right-widget-category-1-mostpostincat')
						</div>
						<!-- /post widget -->
						
						<!-- catagories -->
						<div class="aside-widget">
							@include('common.front.widget-list-category')
						</div>
						<!-- /catagories -->
						
						<!-- tags -->
						<div class="aside-widget">
							@include('common.front.widget-list-tags')
						</div>
						<!-- /tags -->
						
						<!-- archive -->
						<div class="aside-widget">
							@include('common.front.widget-list-archive')
						</div>
						<!-- /archive -->