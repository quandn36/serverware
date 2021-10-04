<div class="container">
	<div class="row">
		@for($i=0;$i<4;$i++)
		<div class="col-md-3" id="cat_thumbnail">
			<a class="cat_links_f" href="#" style="background-image: url({{ asset(config('template.homeTemplateURL')  . 'images/msa2040.png') }}); height: 100%;">
				<div class="cat-box">
					<h3>HPE ProLiant Servers</h3>
					<p>Dense performance with ideal memory and I/O expandability for multi-workload compute in the data centre.</p>
				</div>
			</a>
		</div>
		@endfor
	</div>
</div>