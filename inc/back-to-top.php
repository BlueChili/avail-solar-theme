<?php
 
//ADD SOME JS TO THE FOOTER 
add_action( 'wp_footer', function(){ ?>
	 
	<a id="backToTop" onclick="window.scroll({  top: 0,   left: 0,   behavior: 'smooth'});"> 		
		<svg id="Gruppe_49" data-name="Gruppe 49" xmlns="http://www.w3.org/2000/svg" width="54" height="54" viewBox="0 0 54 54">
			<g id="Ellipse_1" data-name="Ellipse 1" fill="#fff" stroke="#000" stroke-width="2">
				<circle cx="27" cy="27" r="27" stroke="none"/>
				<circle cx="27" cy="27" r="26" fill="none"/>
			</g>
			<g id="Gruppe_48" data-name="Gruppe 48" transform="translate(19.089 17.621)">
				<g id="Gruppe_47" data-name="Gruppe 47">
				<path id="Pfad_337" data-name="Pfad 337" d="M7299,1029.377v-18" transform="translate(-7290.987 -1010.619)" fill="none" stroke="#000" stroke-width="2"/>
				<path id="Pfad_338" data-name="Pfad 338" d="M7290.987,1030.136l7.911-7.911,7.911,7.911" transform="translate(-7290.987 -1022.225)" fill="none" stroke="#000" stroke-width="2"/>
				</g>
			</g>
		</svg>
	</a>
	 
	<script>
	window.addEventListener('scroll', function(){
		if(window.pageYOffset >= 1000) document.getElementById('backToTop').style.visibility="visible"; else document.getElementById('backToTop').style.visibility="hidden";
		}, { capture: false, passive: true});
	</script>
	
<?php } );
 