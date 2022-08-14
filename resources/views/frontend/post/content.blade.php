		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Post content -->
					<div class="col-md-8">
						<div class="section-row sticky-container">
							<div class="main-post">
								@include('frontend.post.main-content')
							</div>
							<div class="post-shares sticky-shares">
								@include('frontend.post.social')
							</div>
						</div>

						<!-- ad -->
						<!--<div class="section-row text-center">-->
						<!--<style>#M396794ScriptRootC324742 {min-height: 350px;}</style>-->
						<!-- Composite Start -->
						<!--<div id="M396794ScriptRootC324742">-->
						<!--        <div id="M396794PreloadC324742">-->
						<!--        Loading...    </div>-->
						<!--        <script>-->
						<!--                (function(){-->
						<!--            var D=new Date(),d=document,b='body',ce='createElement',ac='appendChild',st='style',ds='display',n='none',gi='getElementById',lp=d.location.protocol,wp=lp.indexOf('http')==0?lp:'https:';-->
						<!--            var i=d[ce]('iframe');i[st][ds]=n;d[gi]("M396794ScriptRootC324742")[ac](i);try{var iw=i.contentWindow.document;iw.open();iw.writeln("<ht"+"ml><bo"+"dy></bo"+"dy></ht"+"ml>");iw.close();var c=iw[b];}-->
						<!--            catch(e){var iw=d;var c=d[gi]("M396794ScriptRootC324742");}var dv=iw[ce]('div');dv.id="MG_ID";dv[st][ds]=n;dv.innerHTML=324742;c[ac](dv);-->
						<!--            var s=iw[ce]('script');s.async='async';s.defer='defer';s.charset='utf-8';s.src=wp+"//jsc.mgid.com/x/s/xsharedata.com.324742.js?t="+D.getYear()+D.getMonth()+D.getUTCDate()+D.getUTCHours();c[ac](s);})();-->
						<!--    </script>-->
						<!--    </div>-->
						<!-- Composite End -->
						<!--	{{-- @include('frontend.ads.ads-bottom-post') --}}-->
						<!--</div>-->
						<!-- ad -->

						<!-- comments -->
						<div class="section-row">
							@include('frontend.post.comments')
						</div>
						<!-- /comments -->

						<!-- reply -->
						<div class="section-row">
							<!-- @include('frontend.post.form') -->
						</div>
						<!-- /reply -->
					</div>
					<!-- /Post content -->

					<!-- aside -->
					<div class="col-md-4">
						@include('frontend.post.widget')
					</div>
					<!-- /aside -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->
