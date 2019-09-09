@extends('layouts.ortax')

@push('headerscripts')

@endpush

@section('content')

<section class="content">
<!-- BEGIN .wrapper -->
<div>
<!-- BEGIN .split-block -->
<div class="split-block">
 <!-- BEGIN .main-content -->
	<div class="main-content ot-scrollnimate" data-animation="fadeInUpSmall">
						

<!-- BEGIN .split-blocks -->
<div class="paragraph-row row">
<div  class="main-content column7 ot-scrollnimate">

		
	<!-- BEGIN .split-blocks -->
	<div class="paragraph-row row">
		<div  class=" column12 ot-scrollnimate">
		
<!-- Highlights -->
			<div class="ot-panel-block">
				<div class="title-block">
							<h2>Highlights</h2>
				</div>
				<div class="article-classic">

							<div class="paragraph-row">

								<div class="column6 featured-side">

								
											<div class="item">
												<div class="item-header">
													<a href="{{ route('contentortax.show', ['id'=> $highlightmain->idref, 'param'=> $highlightmain->modul] ) }}">
													<span class="item-header-category"><i class="fa fa-folder-open"></i><span>{{ $highlightmain->modul }}</span></span>
														<img src="{{ asset('storage/'.$highlightmain->splash) }}" srcset="{{ asset('storage/'.$highlightmain->splash) }}" alt="{{ $highlightmain->judul }}"/>                                   
													</a>
												</div>
												<div class="item-content">
													<div class="item-content-head">
															<div class="item-content-date">
																<strong>{{ date('d', strtotime($highlightmain->created_at)) }}</strong>
																<span>{{ date('M', strtotime($highlightmain->created_at)) }}</span>
																<span>{{ date('Y', strtotime($highlightmain->created_at)) }}</span>
															</div>
														<h3>
															<a href="{{ route('contentortax.show', ['id'=> $highlightmain->idref, 'param'=> $highlightmain->modul] ) }}">
															{{ $highlightmain->judul }}
															</a>
														</h3>
													</div>
													<p>{{ strip_tags($highlightmain->isi) }}</p>
				
												</div>
											</div>
											<br />
											<div class="widget widget_tag_cloud">
												<div class="title-block"> <h2><i class="fa fa-ellipsis-v"></i> Kategori</h2></div>
												<div class="tagcloud" style="padding:10px">
													@foreach($highlightcat as $highlightcatitem) 
													<a href="{{ route('contentortax.list', ['param'=> $highlightcatitem->modul] ) }}" class="tag-cloud-link tag-link-12 tag-link-position-1" style="font-size: 22pt;" aria-label="Automotive (12 items)">
														<i class="fa fa-bookmark-o"></i>&nbsp; {{ $highlightcatitem->modul }}
													</a>
													@endforeach
												</div>
											</div>

								</div>

								<div class="column6 list-side">
											
									@foreach($highlight as $highlightitem)                                           <!-- BEGIN .item -->
											<div class="item">
												<div class="item-header">
													<a href="{{ route('contentortax.show', ['id'=> $highlightitem->idref, 'param'=> $highlightitem->modul] ) }}">
														<img src="{{ asset('storage/'.$highlightitem->splash) }}" srcset="{{ asset('storage/'.$highlightitem->splash) }}" alt="{{ $highlightitem->judul }}"/> 
													</a>
												</div>
												<div class="item-content">
													<h3>
														<a href="{{ route('contentortax.show', ['id'=> $highlightitem->idref, 'param'=> $highlightitem->modul] ) }}">
														{!! \Illuminate\Support\Str::words($highlightitem->judul, 9,'...')  !!}
														</a>
													</h3>
													<span class="block-title left">
														<a style="color:#ffffff" href="{{ route('contentortax.show', ['id'=> $highlightitem->idref, 'param'=> $highlightitem->modul] ) }}">
															{!! \Illuminate\Support\Str::words($highlightitem->modul, 2,'')  !!}
														</a>
													</span>
													<span class="date_format">&nbsp; <i class="fa fa-calendar"></i> {{ date('d M Y', strtotime($highlightitem->created_at)) }}</span>
													

													</div>
											<!-- END .item -->
											</div>
									@endforeach  
									<!-- BEGIN .item -->
									<div class="article-grid articles-long">
												<div class="item" style="box-shadow:none;">
													<div class="item-footer" style="background-color:#fff">
														<button class="article-more-arrow left">
																<i class="fa fa-caret-right"></i>
																<i class="show-hover">Read more</i>
														</button>
														<div class="item-meta">&nbsp;</div>
													</div>
												</div>
									</div>
								</div>
							</div>

				</div>
			</div>	
		
<!-- Data Center -->
			<div class="ot-panel-block">
			
					<div class="title-block">
						<h2>Data Center</h2>
					</div>

					<div class="paragraph-row">

						<div class="column8 article-classic">
								
									<div class="item paragraph-row" style="background-color: #196798;width:60%">
										<div class="column2">
											<div class="item-content" style="color:#fff;background-color: rgba(0,0,0,0.6);padding:10px">
												<i class="fa fa-folder-open"></i>
											</div>
										</div>
										<div class="column5">
											<div class="item-content" style="color:#fff;background-color: #196798;padding:10px">
												<h3 style="font-size:16px">Peraturan</h3>
											</div>
										</div>
										<div class="column5">
											<div class="item-content" style="color:#000;background-color: #dedede;padding:10px">
												<h3 style="font-size:16px"># Terbaru</h3>
											</div>
										</div>
									</div>

											<div class="widget ot-widget-timeline">	
												<div class="ot-widget-timeline" style="margin:10px">

											
									@foreach($aturan as $aturanitem)  
														<div class="item">
															<div class="item-date">
																<span class="item-date-day" style="color:#0f3d5b">{{ date('d', strtotime($aturanitem->published_at)) }}</span>
																<div>
																	<span class="item-date-month" style="color:#0f3d5b">{{ date('M', strtotime($aturanitem->published_at)) }}</span>
																	<span class="item-date-time" style="color:#0f3d5b">{{ date('Y', strtotime($aturanitem->published_at)) }}</span>
																</div>
															</div>
															<div class="item-content">
																<div>
																<h4>
																	<a href="{{ route('aturanortax.show', ['id'=> $aturanitem->id]) }}" class="item-category">
																		{{ $aturanitem->judul }}
																	</a>
																</h4>
																<br />
																<span class="block-title" style="text-align:left;color:#fff;">
																	{{ $aturanitem->nomor }}
																</span>
																</div>
																<br />
																<div>
																<small>
																	<a href="{{ route('aturanortax.show', ['id'=> $aturanitem->id]) }}">
																		{{ $aturanitem->perihal }}
																	</a>
																</small>
																</div>
															</div>
														</div>

									@endforeach
														
												</div>
											</div>
											<br />
											<div class="widget widget_tag_cloud">
												<div class="title-block"> <h2><i class="fa fa-tag"></i> Tags</h2></div>
												<div class="tagcloud" style="padding:10px">
													<a href="#" class="tag-cloud-link tag-link-12 tag-link-position-1" style="font-size: 22pt;" aria-label="Automotive (12 items)">
														<i class="fa fa-bookmark-o"></i>&nbsp; Terbaru
													</a>

													<a href="#" class="tag-cloud-link tag-link-12 tag-link-position-1" style="font-size: 22pt;" aria-label="Automotive (12 items)">
														<i class="fa fa-bookmark-o"></i>&nbsp; Terpopuler
													</a>

													<a href="#" class="tag-cloud-link tag-link-12 tag-link-position-1" style="font-size: 22pt;" aria-label="Automotive (12 items)">
														<i class="fa fa-bookmark-o"></i>&nbsp; Paling banyak dilihat
													</a>
												</div>
											</div>
						<!-- END .ot-panel-block -->
						</div>
						<div class="column4 article-classic ">
								<div class="item paragraph-row" style="background-color: #196798;">
									<div class="column2">
										<div class="item-content" style="color:#fff;background-color: rgba(0,0,0,0.6);padding:10px">
											<i class="fa fa-folder-open"></i>
										</div>
									</div>
									<div class="column10">
										<div class="item-content" style="color:#fff;background-color: #196798;padding:10px">
											<h3 style="font-size:16px">Data dan informasi lainnya</h3>
										</div>
									</div>
								</div>						<!-- BEGIN .item -->
							<div class="reviews-block lets-do-3" style="padding:10px">
								<div class="item">
									<div class="item-header">
										<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-9/">
										<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/pelican-367x232_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/pelican-734x464_c.jpg 1900w" alt="How to Sail the British Virgin Islands for Free"/>
										</a>
									</div>
									<div class="item-content text-center" style="color:#fff;background-color: #196798;">
										<h3 style="font-size:16px">Tax Treaty/P3B</h3>
									</div>
								</div>
								<div class="item">
									<div class="item-header">
										<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-9/"><img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/pelican-367x232_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/pelican-734x464_c.jpg 1900w" alt="How to Sail the British Virgin Islands for Free"/></a>
									</div>
									<div class="item-content text-center" style="color:#fff;background-color: #196798;">
										<h3 style="font-size:16px">Putusan Pengadilan</h3>
									</div>
								</div>
								<div class="item">
									<div class="item-header">
										<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-9/"><img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/pelican-367x232_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/pelican-734x464_c.jpg 1900w" alt="How to Sail the British Virgin Islands for Free"/></a>
									</div>
									<div class="item-content text-center" style="color:#fff;background-color: #196798;">
										<h3 style="font-size:16px">Kurs Pajak</h3>
									</div>
								</div>
								<div class="item">
									<div class="item-header">
										<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-9/"><img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/pelican-367x232_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/pelican-734x464_c.jpg 1900w" alt="How to Sail the British Virgin Islands for Free"/></a>
									</div>
									<div class="item-content text-center" style="color:#fff;background-color: #196798;">
										<h3 style="font-size:16px">Kurs BI</h3>
									</div>
								</div>
							</div>
							
						</div>
					
					</div>	
			</div>
		
<!-- Tax Tools -->
				
			<div class="ot-panel-block dark-scheme">
					<div class="title-block">
						<h2 style="background-color: #A30000;">Tax Tools</h2>
					</div>
						<div class="reviews-block lets-do-3">
							<div class="item">
								<div class="item-header">
									<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-9/"><img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/pelican-367x232_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/pelican-734x464_c.jpg 1900w" alt="How to Sail the British Virgin Islands for Free"/></a>
								</div>
								<div class="item-content">
									<h3><a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-9/">How to Sail the British Virgin Islands for Free</a></h3>
								</div>
							</div>
							<div class="item">
								<div class="item-header">
									<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-7/"><img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/m6rT4MYFQ7CT8j9m2AEC_JakeGivens-Sunset-in-the-Park-367x232_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/m6rT4MYFQ7CT8j9m2AEC_JakeGivens-Sunset-in-the-Park-734x464_c.jpg 1900w" alt="Why Road Trips are a Good Idea for Family Travel"/></a>
								</div>
								<div class="item-content">
									<h3><a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-7/">Why Road Trips are a Good Idea for Family Travel</a></h3>
								</div>
							</div>
							<div class="item">
								<div class="item-header">
									<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied/"><img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/3b6f33f2-367x232_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/3b6f33f2-734x464_c.jpg 1900w" alt="Can Keurig stop coffee pirates with cups that can&#8217;t be copied?"/></a>
								</div>
								<div class="item-content">
									<h3><a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied/">Can Keurig stop coffee pirates with cups that can&#8217;t be copied?</a></h3>
								</div>
							</div>
							<div class="item">
								<div class="item-header">
									<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-9/"><img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/pelican-367x232_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/pelican-734x464_c.jpg 1900w" alt="How to Sail the British Virgin Islands for Free"/></a>
								</div>
								<div class="item-content">
									<h3><a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-9/">How to Sail the British Virgin Islands for Free</a></h3>
								</div>
							</div>
							<div class="item">
								<div class="item-header">
									<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-7/"><img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/m6rT4MYFQ7CT8j9m2AEC_JakeGivens-Sunset-in-the-Park-367x232_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/m6rT4MYFQ7CT8j9m2AEC_JakeGivens-Sunset-in-the-Park-734x464_c.jpg 1900w" alt="Why Road Trips are a Good Idea for Family Travel"/></a>
								</div>
								<div class="item-content">
									<h3><a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-7/">Why Road Trips are a Good Idea for Family Travel</a></h3>
								</div>
							</div>
							<div class="item">
								<div class="item-header">
									<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied/"><img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/3b6f33f2-367x232_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/3b6f33f2-734x464_c.jpg 1900w" alt="Can Keurig stop coffee pirates with cups that can&#8217;t be copied?"/></a>
								</div>
								<div class="item-content">
									<h3><a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied/">Can Keurig stop coffee pirates with cups that can&#8217;t be copied?</a></h3>
								</div>
							</div>
						</div>
			
			</div>
		
<!-- KnowledgeBase -->
			<div class="ot-panel-block">
						<div class="title-block">
						<h2 style="background-color: #E14F55;">Creative</h2>
					</div>
						<div class="article-grid articles-long">
							<div class="item">
								<div class="item-header">
									<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-14/">
																		<span class="item-header-category"><i class="fa fa-folder-open"></i><span>Creative</span></span>
																	<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/elegant-woman-367x232_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/elegant-woman-734x464_c.jpg 1900w" alt="Marilyn Minter on Her First Major Retrospective"/>                        </a>
								</div>
								<div class="item-content">
									<div class="item-content-head">
																		<div class="item-content-date">
												<strong>13</strong>
												<span>Apr</span>
												<span>2015</span>
											</div>
																	<h3><a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-14/">Marilyn Minter on Her First Major Retrospective</a></h3>
									</div>
									<p>The Mathematical Symphony of Typography As it turns out, this symphony is not unique to websites. You “hear” it every time you read a book, newspaper, magazine, or web site—every place where typography exists. At first glance, you might think that typography and math have nothing to do with one another. After all, typography consists of letters and words, and math is…well…numbers. But the truth is, typography is a combination of artistic letterforms and mathematical proportions, an exquisite marriage of form and function. Lorem ipsum dolor sit amet, his ad homero quodsi. Definitiones vituperatoribus mei et. Simul regione ea quo,</p>
								
								</div>
								<div class="item-footer">
									<button class="article-more-arrow right"><i class="fa fa-caret-right"></i><i class="show-hover">Read more</i></button>
									<div class="item-meta">
																		<a href="http://solidus.orange-themes.net/author/admin/"><i class="fa fa-pencil"></i>Orange Themes</a>
																	
																		<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-14/#comments"><i class="fa fa-comment"></i>0</a>
																</div>
								</div>
							</div>
							<div class="item">
								<div class="item-header">
									<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-13/">
																		<span class="item-header-category"><i class="fa fa-folder-open"></i><span>Fashion</span></span>
																	<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1417870839255-a23faa90c6b0-367x232_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1417870839255-a23faa90c6b0-734x464_c.jpg 1900w" alt="Has Technology Ruined the Travel Experience?"/>                        </a>
								</div>
								<div class="item-content">
									<div class="item-content-head">
																		<div class="item-content-date">
												<strong>13</strong>
												<span>Apr</span>
												<span>2015</span>
											</div>
																	<h3><a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-13/">Has Technology Ruined the Travel Experience?</a></h3>
									</div>
									<p>The Mathematical Symphony of Typography As it turns out, this symphony is not unique to websites. You “hear” it every time you read a book, newspaper, magazine, or web site—every place where typography exists. At first glance, you might think that typography and math have nothing to do with one another. After all, typography consists of letters and words, and math is…well…numbers. But the truth is, typography is a combination of artistic letterforms and mathematical proportions, an exquisite marriage of form and function. Lorem ipsum dolor sit amet, his ad homero quodsi. Definitiones vituperatoribus mei et. Simul regione ea quo,</p>
								
								</div>
								<div class="item-footer">
									<button class="article-more-arrow right"><i class="fa fa-caret-right"></i><i class="show-hover">Read more</i></button>
									<div class="item-meta">
																		<a href="http://solidus.orange-themes.net/author/admin/"><i class="fa fa-pencil"></i>Orange Themes</a>
																	
																		<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-13/#comments"><i class="fa fa-comment"></i>0</a>
																</div>
								</div>
							</div>
						</div>
			</div>
		</div>
	</div>	

</div>


<aside  id="sidebar-small" data-animation="fadeInUpSmall" class="small-sidebar column2 ot-scrollnimate">

				
	<div class="widget-1 first widget widget_ot_cat_posts">	
		<div class="title-block"><h2>Latests News</h2></div>			
			<div class="article-block without-images">
				@foreach($berita as $beritaitem)
				<div class="item no-image">
					<div class="item-content">
							<span class="article-meta left meta-date">
								<i class="fa fa-calendar"></i>{{ date('d M Y', strtotime($beritaitem->created_at)) }}
							</span>
						<div class="clear-float"></div>
							<h4>
								<a href="{{ route('contentortax.show', ['id'=> $beritaitem->id, 'param'=> $beritaitem->kategori] ) }}">
								{!! \Illuminate\Support\Str::words($beritaitem->judul, 7,'...')  !!}
								</a>
							</h4>
							<p>{!! \Illuminate\Support\Str::words($beritaitem->isi, 15,'...')  !!}</p>
					</div>
				</div>
				@endforeach
			</div>
	</div> 	

	<div class="widget-2 widget widget_ot_cat_posts">	
		<div class="title-block"><h2>Fashion</h2></div>			
		<div class="article-block">
								<div class="item">
									<div class="item-header">
										<a href="#" class="image-hover">
											<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1422568374078-27d3842ba676-151x104_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1422568374078-27d3842ba676-302x208_c.jpg 1900w" alt="My 2015 Group Tours: Two Trips to Europe!"/>									
										</a>
									</div>
									<div class="item-content">
										<a href="#" style="background: #6ca96e" class="item-content-category">Automotive</a>
										<h4><a href="#">My 2015 Group Tours: Two Trips to Europe!</a></h4>
									</div>
								</div>
								<div class="item">
									<div class="item-header">
										<a href="#" class="image-hover">
											<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1422568374078-27d3842ba676-151x104_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1422568374078-27d3842ba676-302x208_c.jpg 1900w" alt="My 2015 Group Tours: Two Trips to Europe!"/>									
										</a>
									</div>
									<div class="item-content">
										<a href="#" style="background: #6ca96e" class="item-content-category">Automotive</a>
										<h4><a href="#">My 2015 Group Tours: Two Trips to Europe!</a></h4>
									</div>
								</div>
								<div class="item">
									<div class="item-header">
										<a href="#" class="image-hover">
											<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1422568374078-27d3842ba676-151x104_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1422568374078-27d3842ba676-302x208_c.jpg 1900w" alt="My 2015 Group Tours: Two Trips to Europe!"/>									
										</a>
									</div>
									<div class="item-content">
										<a href="#" style="background: #6ca96e" class="item-content-category">Automotive</a>
										<h4><a href="#">My 2015 Group Tours: Two Trips to Europe!</a></h4>
									</div>
								</div>

		</div>
	</div>

	  	<div class="widget-3 last widget tz_ad600_widget">
		  	<div class="ot-widget-banner">
			<a href="http://www.orange-themes.net" target="_blank">
				<img src="http://solidus.orange-themes.net/wp-content/themes/solidus-theme/images/no-banner-160x600.jpg" alt="Banner"/>
			</a>
			</div>
		</div>	
	</aside>


	<aside  id="sidebar" data-animation="fadeInUpSmall" class="sidebar column3 ot-scrollnimate">

		<div class="widget-1 first widget tz_ad300_widget">
			<div class="w-cool-b">
				<a href="http://www.orange-themes.net" target="_blank">
				<img src="http://solidus.orange-themes.net/wp-content/themes/solidus-theme/images/no-banner-300x250.jpg" alt="Banner"/>
				</a>
			</div>
		</div>	
			
	<div class="widget-2 widget widget_ot_timeline">	
		<div class="title-block"><h2>Latests News</h2></div>			

	<div class="ot-widget-timeline">
									<div class="item">
										<div class="item-date">
											<span class="item-date-day">21</span>
											<div>
												<span class="item-date-month">Apr</span>
												<span class="item-date-time">14:05</span>
											</div>
										</div>

																					<div class="item-avatar">
												<a href="http://solidus.orange-themes.net/travel-tips-for-morrocco-part-one/">
													<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1417144762996-a41c0f6be9c7-40x40_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1417144762996-a41c0f6be9c7-80x80_c.jpg 1900w" alt="A surfer girl is &#8220;Making Waves&#8221; in Morocco"/>												</a>
											</div>
										
										<div class="item-content">
											<div>
						                        						                       		<a href="http://solidus.orange-themes.net/category/tourism/" class="item-category" style="color: #bf6bda;">Tourism</a>
						               <i class="fa fa-comment"></i>
							                        	0							                        </a>
							                    											</div>
											<strong><a href="http://solidus.orange-themes.net/travel-tips-for-morrocco-part-one/">A surfer girl is &#8220;Making Waves&#8221; in Morocco</a></strong>
										</div>
									</div>

																	<div class="item">
										<div class="item-date">
											<span class="item-date-day">13</span>
											<div>
												<span class="item-date-month">Apr</span>
												<span class="item-date-time">12:27</span>
											</div>
										</div>

																					<div class="item-avatar">
												<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-16/">
													<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1422568374078-27d3842ba676-40x40_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1422568374078-27d3842ba676-80x80_c.jpg 1900w" alt="My 2015 Group Tours: Two Trips to Europe!"/>												</a>
											</div>
										
										<div class="item-content">
											<div>
						                        						                       		<a href="http://solidus.orange-themes.net/category/automotive/" class="item-category" style="color: #6ca96e;">Automotive</a>
						                        							                    							                        <a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-16/#comments" class="item-comments">
							                        	<i class="fa fa-comment"></i>
							                        	1							                        </a>
							                    											</div>
											<strong><a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-16/">My 2015 Group Tours: Two Trips to Europe!</a></strong>
										</div>
									</div>

																	<div class="item">
										<div class="item-date">
											<span class="item-date-day">13</span>
											<div>
												<span class="item-date-month">Apr</span>
												<span class="item-date-time">12:27</span>
											</div>
										</div>

																					<div class="item-avatar">
												<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-15/">
													<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1428263197823-ce6a8620d1e1-40x40_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1428263197823-ce6a8620d1e1-80x80_c.jpg 1900w" alt="Amal Clooney Steps Out in the Statement Flare"/>												</a>
											</div>
										
										<div class="item-content">
											<div>
						                        						                       		<a href="http://solidus.orange-themes.net/category/automotive/" class="item-category" style="color: #6ca96e;">Automotive</a>
						                        							                    							                        <a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-15/#comments" class="item-comments">
							                        	<i class="fa fa-comment"></i>
							                        	0							                        </a>
							                    											</div>
											<strong><a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-15/">Amal Clooney Steps Out in the Statement Flare</a></strong>
										</div>
									</div>

																	<div class="item">
										<div class="item-date">
											<span class="item-date-day">13</span>
											<div>
												<span class="item-date-month">Apr</span>
												<span class="item-date-time">12:26</span>
											</div>
										</div>

																					<div class="item-avatar">
												<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-14/">
													<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/elegant-woman-40x40_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/elegant-woman-80x80_c.jpg 1900w" alt="Marilyn Minter on Her First Major Retrospective"/>												</a>
											</div>
										
										<div class="item-content">
											<div>
						                        						                       		<a href="http://solidus.orange-themes.net/category/creative/" class="item-category" style="color: #eb7f00;">Creative</a>
						                        							                    							                        <a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-14/#comments" class="item-comments">
							                        	<i class="fa fa-comment"></i>
							                        	0							                        </a>
							                    											</div>
											<strong><a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-14/">Marilyn Minter on Her First Major Retrospective</a></strong>
										</div>
									</div>

																	<div class="item">
										<div class="item-date">
											<span class="item-date-day">13</span>
											<div>
												<span class="item-date-month">Apr</span>
												<span class="item-date-time">12:25</span>
											</div>
										</div>

																					<div class="item-avatar">
												<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-13/">
													<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1417870839255-a23faa90c6b0-40x40_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1417870839255-a23faa90c6b0-80x80_c.jpg 1900w" alt="Has Technology Ruined the Travel Experience?"/>												</a>
											</div>
										
										<div class="item-content">
											<div>
						                        						                       		<a href="http://solidus.orange-themes.net/category/tourism/" class="item-category" style="color: #bf6bda;">Tourism</a>
						                        							                    							                        <a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-13/#comments" class="item-comments">
							                        	<i class="fa fa-comment"></i>
							                        	0							                        </a>
							                    											</div>
											<strong><a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-13/">Has Technology Ruined the Travel Experience?</a></strong>
										</div>
									</div>

							</div>

	</div>
      		
	<div class="widget-3 widget widget_ot_reviews">	<div class="title-block"><h2>Reviews</h2></div>		<div class="article-block">
												<div class="item">
													<div class="item-header">
								<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-9/" class="image-hover">
									<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/pelican-100x69_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/pelican-200x138_c.jpg 1900w" alt="How to Sail the British Virgin Islands for Free"/>								</a>
							</div>
												<div class="item-content">
							<span class="article-meta">
																	<a href="http://solidus.orange-themes.net/2015/04/" class="meta-date"><i class="fa fa-clock-o"></i>April 13, 2015</a>
																
			                    			                        <a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-9/#comments" class="meta-comments">
			                        	<i class="fa fa-comment"></i>
			                        	0			                        </a>
			                    								
							</span>
							<h4><a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-9/">How to Sail the British Virgin Islands for Free</a></h4>
							<span class="item-stars" style="color: #f05c5c;">
								<span class="stars-inner" style="width: 92.6%;"></span>
							</span>
						</div>
					</div>
																						<div class="item">
													<div class="item-header">
								<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-7/" class="image-hover">
									<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/m6rT4MYFQ7CT8j9m2AEC_JakeGivens-Sunset-in-the-Park-100x69_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/m6rT4MYFQ7CT8j9m2AEC_JakeGivens-Sunset-in-the-Park-200x138_c.jpg 1900w" alt="Why Road Trips are a Good Idea for Family Travel"/>								</a>
							</div>
												<div class="item-content">
							<span class="article-meta">
																	<a href="http://solidus.orange-themes.net/2015/04/" class="meta-date"><i class="fa fa-clock-o"></i>April 13, 2015</a>
																
			                    			                        <a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-7/#comments" class="meta-comments">
			                        	<i class="fa fa-comment"></i>
			                        	0			                        </a>
			                    								
							</span>
							<h4><a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-7/">Why Road Trips are a Good Idea for Family Travel</a></h4>
							<span class="item-stars" style="color: #f05c5c;">
								<span class="stars-inner" style="width: 76.6%;"></span>
							</span>
						</div>
					</div>
																						<div class="item">
													<div class="item-header">
								<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied/" class="image-hover">
									<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/3b6f33f2-100x69_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/3b6f33f2-200x138_c.jpg 1900w" alt="Can Keurig stop coffee pirates with cups that can&#8217;t be copied?"/>								</a>
							</div>
												<div class="item-content">
							<span class="article-meta">
																	<a href="http://solidus.orange-themes.net/2015/04/" class="meta-date"><i class="fa fa-clock-o"></i>April 13, 2015</a>
																
			                    			                        <a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied/#comments" class="meta-comments">
			                        	<i class="fa fa-comment"></i>
			                        	0			                        </a>
			                    								
							</span>
							<h4><a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied/">Can Keurig stop coffee pirates with cups that can&#8217;t be copied?</a></h4>
							<span class="item-stars" style="color: #f05c5c;">
								<span class="stars-inner" style="width: 82.6%;"></span>
							</span>
						</div>
					</div>
																</div>
	</div>		
	
      		
	<div class="widget-4 widget widget_ot_latest_comments">	<div class="title-block"><h2>Recent Comments</h2></div>		<div class="comments-w-block">
				
				<div class="item">
					<div class="item-header">
						<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-12/#comment-46" class="image-hover">
							<img src="//www.gravatar.com/avatar/cb821c0a9f93a6dc312d0b8dfe665220?s=60&#038;r=g&#038;d=mm" alt="Orange Themes" />
						</a>
					</div>
					<div class="item-content">
						<span class="date-meta right">16. Apr 08:10</span>
						<p>Lorem ipsum dolor sit amet, his ad homero quodsi. Definitiones...</p>
						<h4><a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-12/#comment-46">Read all comments...</a></h4>
					</div>
				</div>

				
				<div class="item">
					<div class="item-header">
						<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-12/#comment-45" class="image-hover">
							<img src="//www.gravatar.com/avatar/cb821c0a9f93a6dc312d0b8dfe665220?s=60&#038;r=g&#038;d=mm" alt="Orange Themes" />
						</a>
					</div>
					<div class="item-content">
						<span class="date-meta right">16. Apr 08:09</span>
						<p>Mei at diam accusam, vel tale sint error ex, labore...</p>
						<h4><a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-12/#comment-45">Read all comments...</a></h4>
					</div>
				</div>

			
		</div>

	</div>		
	
      	<div class="widget-5 widget widget_ot_gallery">	<div class="title-block title-block-absolute"><h2>Latest Galleries</h2></div>			<div class="ot-widget-gallery">
															<div class="item" rel="gallery-82">
							<div class="item-header">
								<a href="http://solidus.orange-themes.net/gallery/minimum-quaerendum-te-12/" data-id="gallery-82" class="">
									<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/ZLSw0SXxThSrkXRIiCdT_DSC_0345-330x250_c.jpg" alt="" />
								</a>
							</div>
							<div class="item-footer">
								<a href="#galery-left"><i class="fa fa-caret-left"></i></a>
								<a href="#galery-right"><i class="fa fa-caret-right"></i></a>
								<div class="item-thumbnails">
									<div class="item-thumbnails-inner">
									
												<a href="http://solidus.orange-themes.net/wp-content/uploads/2015/04/ZLSw0SXxThSrkXRIiCdT_DSC_0345.jpg" data-href="http://solidus.orange-themes.net/gallery/minimum-quaerendum-te-12/?page=1" class="image-hover active" data-id="gallery-82">
													<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/ZLSw0SXxThSrkXRIiCdT_DSC_0345-74x56_c.jpg" data-id="1" alt="Minimum quaerendum te" />
												</a>
											
												<a href="http://solidus.orange-themes.net/wp-content/uploads/2015/04/URG2BbWQQ9SAcqLuTOLp_BP7A9947.jpg" data-href="http://solidus.orange-themes.net/gallery/minimum-quaerendum-te-12/?page=2" class="image-hover" data-id="gallery-82">
													<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/URG2BbWQQ9SAcqLuTOLp_BP7A9947-74x56_c.jpg" data-id="2" alt="Minimum quaerendum te" />
												</a>
											
												<a href="http://solidus.orange-themes.net/wp-content/uploads/2015/04/teddy-bear-524251_1280.jpg" data-href="http://solidus.orange-themes.net/gallery/minimum-quaerendum-te-12/?page=3" class="image-hover" data-id="gallery-82">
													<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/teddy-bear-524251_1280-74x56_c.jpg" data-id="3" alt="Minimum quaerendum te" />
												</a>
											
												<a href="http://solidus.orange-themes.net/wp-content/uploads/2015/04/stones.jpg" data-href="http://solidus.orange-themes.net/gallery/minimum-quaerendum-te-12/?page=4" class="image-hover" data-id="gallery-82">
													<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/stones-74x56_c.jpg" data-id="4" alt="Minimum quaerendum te" />
												</a>
											
												<a href="http://solidus.orange-themes.net/wp-content/uploads/2015/04/rose-488864_1280.jpg" data-href="http://solidus.orange-themes.net/gallery/minimum-quaerendum-te-12/?page=5" class="image-hover" data-id="gallery-82">
													<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/rose-488864_1280-74x56_c.jpg" data-id="5" alt="Minimum quaerendum te" />
												</a>
											
												<a href="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1419332563740-42322047ff09.jpg" data-href="http://solidus.orange-themes.net/gallery/minimum-quaerendum-te-12/?page=6" class="image-hover" data-id="gallery-82">
													<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1419332563740-42322047ff09-74x56_c.jpg" data-id="6" alt="Minimum quaerendum te" />
												</a>
											
												<a href="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1417870839255-a23faa90c6b0.jpg" data-href="http://solidus.orange-themes.net/gallery/minimum-quaerendum-te-12/?page=7" class="image-hover" data-id="gallery-82">
													<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1417870839255-a23faa90c6b0-74x56_c.jpg" data-id="7" alt="Minimum quaerendum te" />
												</a>
											
												<a href="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1416838375725-e834a83f62b7.jpg" data-href="http://solidus.orange-themes.net/gallery/minimum-quaerendum-te-12/?page=8" class="image-hover" data-id="gallery-82">
													<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1416838375725-e834a83f62b7-74x56_c.jpg" data-id="8" alt="Minimum quaerendum te" />
												</a>
											
												<a href="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1416339684178-3a239570f315.jpg" data-href="http://solidus.orange-themes.net/gallery/minimum-quaerendum-te-12/?page=9" class="image-hover" data-id="gallery-82">
													<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1416339684178-3a239570f315-74x56_c.jpg" data-id="9" alt="Minimum quaerendum te" />
												</a>
											
												<a href="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1414924347000-9823c338079b.jpg" data-href="http://solidus.orange-themes.net/gallery/minimum-quaerendum-te-12/?page=10" class="image-hover" data-id="gallery-82">
													<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1414924347000-9823c338079b-74x56_c.jpg" data-id="10" alt="Minimum quaerendum te" />
												</a>
											
												<a href="http://solidus.orange-themes.net/wp-content/uploads/2015/04/pelican.jpg" data-href="http://solidus.orange-themes.net/gallery/minimum-quaerendum-te-12/?page=11" class="image-hover" data-id="gallery-82">
													<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/pelican-74x56_c.jpg" data-id="11" alt="Minimum quaerendum te" />
												</a>
											
												<a href="http://solidus.orange-themes.net/wp-content/uploads/2015/04/mens-shirt-524022_1280.jpg" data-href="http://solidus.orange-themes.net/gallery/minimum-quaerendum-te-12/?page=12" class="image-hover" data-id="gallery-82">
													<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/mens-shirt-524022_1280-74x56_c.jpg" data-id="12" alt="Minimum quaerendum te" />
												</a>
											
												<a href="http://solidus.orange-themes.net/wp-content/uploads/2015/04/m6rT4MYFQ7CT8j9m2AEC_JakeGivens-Sunset-in-the-Park.jpg" data-href="http://solidus.orange-themes.net/gallery/minimum-quaerendum-te-12/?page=13" class="image-hover" data-id="gallery-82">
													<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/m6rT4MYFQ7CT8j9m2AEC_JakeGivens-Sunset-in-the-Park-74x56_c.jpg" data-id="13" alt="Minimum quaerendum te" />
												</a>
											
												<a href="http://solidus.orange-themes.net/wp-content/uploads/2015/04/hBd6EPoQT2C8VQYv65ys_White-Sands.jpg" data-href="http://solidus.orange-themes.net/gallery/minimum-quaerendum-te-12/?page=14" class="image-hover" data-id="gallery-82">
													<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/hBd6EPoQT2C8VQYv65ys_White-Sands-74x56_c.jpg" data-id="14" alt="Minimum quaerendum te" />
												</a>
											
												<a href="http://solidus.orange-themes.net/wp-content/uploads/2015/04/farm-336549_1280.jpg" data-href="http://solidus.orange-themes.net/gallery/minimum-quaerendum-te-12/?page=15" class="image-hover" data-id="gallery-82">
													<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/farm-336549_1280-74x56_c.jpg" data-id="15" alt="Minimum quaerendum te" />
												</a>
											
												<a href="http://solidus.orange-themes.net/wp-content/uploads/2015/04/child-510604_1280.jpg" data-href="http://solidus.orange-themes.net/gallery/minimum-quaerendum-te-12/?page=16" class="image-hover" data-id="gallery-82">
													<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/child-510604_1280-74x56_c.jpg" data-id="16" alt="Minimum quaerendum te" />
												</a>
											
												<a href="http://solidus.orange-themes.net/wp-content/uploads/2015/04/avenes.jpg" data-href="http://solidus.orange-themes.net/gallery/minimum-quaerendum-te-12/?page=17" class="image-hover" data-id="gallery-82">
													<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/avenes-74x56_c.jpg" data-id="17" alt="Minimum quaerendum te" />
												</a>
											
												<a href="http://solidus.orange-themes.net/wp-content/uploads/2015/04/ad50c1f0.jpg" data-href="http://solidus.orange-themes.net/gallery/minimum-quaerendum-te-12/?page=18" class="image-hover" data-id="gallery-82">
													<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/ad50c1f0-74x56_c.jpg" data-id="18" alt="Minimum quaerendum te" />
												</a>
											
												<a href="http://solidus.orange-themes.net/wp-content/uploads/2015/04/3b6f33f2.jpg" data-href="http://solidus.orange-themes.net/gallery/minimum-quaerendum-te-12/?page=19" class="image-hover" data-id="gallery-82">
													<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/3b6f33f2-74x56_c.jpg" data-id="19" alt="Minimum quaerendum te" />
												</a>
																				</div>
								</div>
							</div>
						</div>
													
			</div>

		</div>	
        		
	<div class="widget-6 widget widget_ot_popular_posts">	<div class="title-block"><h2>Popular Posts</h2></div>			<div class="article-block">
														<div class="item">
															<div class="item-header">
									<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-16/" class="image-hover">
										<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1422568374078-27d3842ba676-151x104_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1422568374078-27d3842ba676-302x208_c.jpg 1900w" alt="My 2015 Group Tours: Two Trips to Europe!"/>									</a>
								</div>
														<div class="item-content">
		                        		                            <a href="http://solidus.orange-themes.net/category/automotive/" style="background: #6ca96e" class="item-content-category">Automotive</a>
		                        		                        								<h4><a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-16/">My 2015 Group Tours: Two Trips to Europe!</a></h4>
								 									<span class="article-meta">
					                    					                        <a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-16/#comments" class="meta-comments">
					                        	<i class="fa fa-comment"></i>
					                        	1					                        </a>
					                    						                											<span><i class="fa fa-eye"></i>11820</span>
																			</span>
																							</div>
						</div>

														<div class="item">
															<div class="item-header">
									<a href="http://solidus.orange-themes.net/travel-tips-for-morrocco-part-one/" class="image-hover">
										<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1417144762996-a41c0f6be9c7-151x104_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1417144762996-a41c0f6be9c7-302x208_c.jpg 1900w" alt="A surfer girl is &#8220;Making Waves&#8221; in Morocco"/>									</a>
								</div>
														<div class="item-content">
		                        		                            <a href="http://solidus.orange-themes.net/category/tourism/" style="background: #bf6bda" class="item-content-category">Tourism</a>
		                        		                        								<h4><a href="http://solidus.orange-themes.net/travel-tips-for-morrocco-part-one/">A surfer girl is &#8220;Making Waves&#8221; in Morocco</a></h4>
								 									<span class="article-meta">
					                    					                        <a href="http://solidus.orange-themes.net/travel-tips-for-morrocco-part-one/#comments" class="meta-comments">
					                        	<i class="fa fa-comment"></i>
					                        	0					                        </a>
					                    						                											<span><i class="fa fa-eye"></i>8148</span>
																			</span>
																							</div>
						</div>

														<div class="item">
															<div class="item-header">
									<a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-14/" class="image-hover">
										<img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/elegant-woman-151x104_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/elegant-woman-302x208_c.jpg 1900w" alt="Marilyn Minter on Her First Major Retrospective"/>									</a>
								</div>
														<div class="item-content">
		                        		                            <a href="http://solidus.orange-themes.net/category/creative/" style="background: #eb7f00" class="item-content-category">Creative</a>
		                        		                        								<h4><a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-14/">Marilyn Minter on Her First Major Retrospective</a></h4>
								 									<span class="article-meta">
					                    					                        <a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-14/#comments" class="meta-comments">
					                        	<i class="fa fa-comment"></i>
					                        	0					                        </a>
					                    						                											<span><i class="fa fa-eye"></i>7237</span>
																			</span>
																							</div>
						</div>

							</div>

	</div>

    <div class="widget-7 widget widget_tag_cloud"><div class="title-block"><h2>Tags</h2></div><div class="tagcloud"><a href="http://solidus.orange-themes.net/tag/automotive/" class="tag-cloud-link tag-link-12 tag-link-position-1" style="font-size: 22pt;" aria-label="Automotive (12 items)">Automotive</a>
<a href="http://solidus.orange-themes.net/tag/creative/" class="tag-cloud-link tag-link-15 tag-link-position-2" style="font-size: 8pt;" aria-label="Creative (11 items)">Creative</a>
<a href="http://solidus.orange-themes.net/tag/fashion/" class="tag-cloud-link tag-link-13 tag-link-position-3" style="font-size: 8pt;" aria-label="Fashion (11 items)">Fashion</a>
<a href="http://solidus.orange-themes.net/tag/gadgets/" class="tag-cloud-link tag-link-16 tag-link-position-4" style="font-size: 8pt;" aria-label="Gadgets (11 items)">Gadgets</a>
<a href="http://solidus.orange-themes.net/tag/tourism/" class="tag-cloud-link tag-link-14 tag-link-position-5" style="font-size: 22pt;" aria-label="Tourism (12 items)">Tourism</a></div>
</div>		<div class="widget-8 last widget widget_ot_aweber">			<div class="title-block"><h2>Subscribe Newsletter</h2></div>			<div class="ot-subscribe-widget">
									<p>Deserunt posuere pellentesque porta ridiculus fugiat. Tempus ad per consectetur maecenas penatibus.</p>
								<div class="ot-subscribe-widget-inner">
					<div class="alert-box aweber-fail" style="display:none;">
					 	<a href="#" class="close-alert right"><i class="fa fa-times"></i></a>
					 	<i class="fa fa-warning"></i>
					 	<p><strong>ERROR:</strong><span class="response">Error Occurred!</span></p>
					</div>

					<div class="alert-box success aweber-success" style="background-color: #81B030; display:none;">
					 	<a href="#" class="close-alert right"><i class="fa fa-times"></i></a>
					 	<i class="fa fa-thumbs-up"></i>
					 	<p><strong>SUCCESS:</strong><span class="response">Everything went well, You are now subscribed !</span></p>
					</div>

					<div class="alert-box loading aweber-loading" style="display:none;">
						<img src="http://solidus.orange-themes.net/wp-content/themes/solidus-theme/images/loading.gif" class="loading-gif" alt="Loading" />
					 	<p><strong>LOADING:</strong><span class="response">This may take a few seconds !</span></p>
					</div>
				</div>



				
					<form name="aweber-form" class="subscribe-form aweber-form">
						<input type="hidden" name="listID" value="1528765" />
						<p class="sub-name">
							<input type="text" value="" placeholder="Name" name="u_name" class="u_name" />
						</p>
						<p class="sub-email">
							<input type="email" value="" placeholder="E-mail address" name="email" class="email" />
						</p>
						<p class="sub-submit">
							<input type="submit" value="Subscribe" class="button aweber-submit" />
						</p>
					</form>
				
			</div>	

	</div>        &nbsp;	</aside>
<!-- END .split-blocks -->
</div>
<!-- BEGIN .split-blocks -->
<div class="paragraph-row row">


	<div  class=" column12 ot-scrollnimate">

		<!-- BEGIN .ot-panel-block -->
<div class="ot-panel-block">                     
    
    <div class="article-grid lets-do-3">
                                    <div class="item">
                    <div class="item-header">
                        <a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-14/">
                                                            <span class="item-header-category"><i class="fa fa-folder-open"></i><span>Automotive</span></span>
                                                        <img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/elegant-woman-367x232_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/elegant-woman-734x464_c.jpg 1900w" alt="Marilyn Minter on Her First Major Retrospective"/>                        </a>
                    </div>
                    <div class="item-content">
                        <div class="item-content-head">
                                                            <div class="item-content-date">
                                    <strong>13</strong>
                                    <span>Apr</span>
                                    <span>2015</span>
                                </div>
                                                        <h3><a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-14/">Marilyn Minter on Her First Major Retrospective</a></h3>
                        </div>
                        <p>The Mathematical Symphony of Typography As it turns out, this symphony is not unique to websites. You “hear” it every</p>
                      
                    </div>
                    <div class="item-footer">
                        <button class="article-more-arrow right"><i class="fa fa-caret-right"></i><i class="show-hover">Read more</i></button>
                        <div class="item-meta">
                                                            <a href="http://solidus.orange-themes.net/author/admin/"><i class="fa fa-pencil"></i>Orange Themes</a>
                                                        
                                                            <a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-14/#comments"><i class="fa fa-comment"></i>0</a>
                                                        
                        </div>
                    </div>
                </div>
                                    <div class="item">
                    <div class="item-header">
                        <a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-13/">
                                                            <span class="item-header-category"><i class="fa fa-folder-open"></i><span>Fashion</span></span>
                                                        <img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1417870839255-a23faa90c6b0-367x232_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1417870839255-a23faa90c6b0-734x464_c.jpg 1900w" alt="Has Technology Ruined the Travel Experience?"/>                        </a>
                    </div>
                    <div class="item-content">
                        <div class="item-content-head">
                                                            <div class="item-content-date">
                                    <strong>13</strong>
                                    <span>Apr</span>
                                    <span>2015</span>
                                </div>
                                                        <h3><a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-13/">Has Technology Ruined the Travel Experience?</a></h3>
                        </div>
                        <p>The Mathematical Symphony of Typography As it turns out, this symphony is not unique to websites. You “hear” it every</p>
                      
                    </div>
                    <div class="item-footer">
                        <button class="article-more-arrow right"><i class="fa fa-caret-right"></i><i class="show-hover">Read more</i></button>
                        <div class="item-meta">
                                                            <a href="http://solidus.orange-themes.net/author/admin/"><i class="fa fa-pencil"></i>Orange Themes</a>
                                                        
                                                            <a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-13/#comments"><i class="fa fa-comment"></i>0</a>
                                                        
                        </div>
                    </div>
                </div>
                                    <div class="item">
                    <div class="item-header">
                        <a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-12/">
                                                            <span class="item-header-category"><i class="fa fa-folder-open"></i><span>Automotive</span></span>
                                                        <img src="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1416838375725-e834a83f62b7-367x232_c.jpg" srcset="http://solidus.orange-themes.net/wp-content/uploads/2015/04/photo-1416838375725-e834a83f62b7-734x464_c.jpg 1900w" alt="The Best Street Style from Australian Fashion Week"/>                        </a>
                    </div>
                    <div class="item-content">
                        <div class="item-content-head">
                                                            <div class="item-content-date">
                                    <strong>13</strong>
                                    <span>Apr</span>
                                    <span>2015</span>
                                </div>
                                                        <h3><a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-12/">The Best Street Style from Australian Fashion Week</a></h3>
                        </div>
                        <p>The Mathematical Symphony of Typography As it turns out, this symphony is not unique to websites. You “hear” it every</p>
                      
                    </div>
                    <div class="item-footer">
                        <button class="article-more-arrow right"><i class="fa fa-caret-right"></i><i class="show-hover">Read more</i></button>
                        <div class="item-meta">
                                                            <a href="http://solidus.orange-themes.net/author/admin/"><i class="fa fa-pencil"></i>Orange Themes</a>
                                                        
                                                            <a href="http://solidus.orange-themes.net/can-keurig-stop-coffee-pirates-with-cups-that-cant-be-copied-12/#comments"><i class="fa fa-comment"></i>3</a>
                                                        
                        </div>
                    </div>
                </div>
        
    </div>
<!-- END .ot-panel-block -->
</div>	</div>
<!-- END .split-blocks -->
</div> 
	&nbsp;

				<!-- END .main-content -->
				</div>
										
			<!-- END .split-block -->
			</div>
				
		<!-- END .wrapper -->
		</div>
	<!-- BEGIN .content -->
	</section>

	@endsection

@push('footerscripts')
 
@endpush