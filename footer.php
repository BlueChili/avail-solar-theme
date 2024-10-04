<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package avasol
 */

?>

	</div><?php // #content ?>

	<footer id="colophon" class="site-footer py-5 py-lg-7">
		<div class="site-info container">
			<div class="row content">
				<div class="col-lg-4 mb-4 mb-md-0">
					<?php
					$footer_logo = get_field( 'footer_logo', 'options' );
					if ( $footer_logo ) {
						echo wp_get_attachment_image( $footer_logo, 'full', '', array( 'class' => 'img-fluid mb-4 logo-footer' ) );
					}; ?>
					<?php if ( $footer_text_after_logo = get_field( 'footer_text_after_logo', 'options' ) ) : ?>
						<div class="mt-4 mb-0 footer-text"><?= $footer_text_after_logo; ?></div>
					<?php endif; ?>
					<?php if ( avasol_is_mobile() ) : ?>
						<div class="mt-5 menu">
							<?php if ( have_rows( 'footer_menu', 'options' ) ) : ?>
								<ul class="list-unstyled">
									<?php while ( have_rows( 'footer_menu', 'options' ) ) :
										the_row(); ?>
										<?php if ( have_rows( 'links_menu', 'options' ) ) : ?>
											<?php while ( have_rows( 'links_menu', 'options' ) ) :
												the_row(); ?>
												<?php
												$link = get_sub_field( 'link_menu_item', 'options' );
												$link_menu_classes = get_sub_field( 'link_menu_classes', 'options' );
												if ( $link ) :
													$link_url = $link['url'];
													$link_title = $link['title'];
													$link_target = $link['target'] ? $link['target'] : '_self';
													?>
													<li class="<?= esc_html( $link_menu_classes ); ?> mb-2"><a href="<?= esc_url( $link_url ); ?>" title="<?= esc_html( $link_title ); ?>" target="<?= esc_attr( $link_target ); ?>"><?= esc_html( $link_title ); ?></a>
												<?php endif; ?>
											<?php endwhile; ?>
										<?php endif; ?>
									<?php endwhile; ?>
								</ul>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<div class="contact my-5">
						<?php if ( $general_phone_label = get_field( 'general_phone_label', 'options' ) ) : ?>
							<?php if ( $general_phone = get_field( 'general_phone', 'options' ) ) : ?>
								<div class="d-flex gap-2 align-items-center">
									<svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#footer_phone)"><path d="M5.51667 9.49167C6.71667 11.85 8.65 13.775 11.0083 14.9833L12.8417 13.15C13.0667 12.925 13.4 12.85 13.6917 12.95C14.625 13.2583 15.6333 13.425 16.6667 13.425C17.125 13.425 17.5 13.8 17.5 14.2583V17.1667C17.5 17.625 17.125 18 16.6667 18C8.84167 18 2.5 11.6583 2.5 3.83333C2.5 3.375 2.875 3 3.33333 3H6.25C6.70833 3 7.08333 3.375 7.08333 3.83333C7.08333 4.875 7.25 5.875 7.55833 6.80833C7.65 7.1 7.58333 7.425 7.35 7.65833L5.51667 9.49167Z" fill="white"/></g><defs><clipPath id="footer_phone"><rect width="20" height="20" fill="white" transform="translate(0 0.5)"/></clipPath></defs></svg>
									<a href="tel:<?= $general_phone; ?>" class="text-white text-decoration-none" title="Call us" target="_blank"><?= $general_phone_label; ?></a>
								</div>
							<?php endif; ?>
						<?php endif; ?>
						<?php if ( $general_email = get_field( 'general_email', 'options' ) ) : ?>
							<div class="d-flex gap-2 align-items-center mt-2">
								<svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#footer_mail)"><path d="M16.6667 3.8335H3.33335C2.41669 3.8335 1.67502 4.5835 1.67502 5.50016L1.66669 15.5002C1.66669 16.4168 2.41669 17.1668 3.33335 17.1668H16.6667C17.5834 17.1668 18.3334 16.4168 18.3334 15.5002V5.50016C18.3334 4.5835 17.5834 3.8335 16.6667 3.8335ZM16.6667 7.16683L10 11.3335L3.33335 7.16683V5.50016L10 9.66683L16.6667 5.50016V7.16683Z" fill="white"/></g><defs><clipPath id="footer_mail"><rect width="20" height="20" fill="white" transform="translate(0 0.5)"/></clipPath></defs></svg>
								<a href="mailto:<?= $general_email ?>" class="text-white text-decoration-none" title="Email" target="_blank"><?= $general_email; ?></a>
							</div>
						<?php endif; ?>
						<?php if ( $general_address = get_field( 'general_address', 'options' ) ) : ?>
							<div class="d-flex gap-2 align-items-start mt-2">
								<svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-geo-alt-fill mt-2" viewBox="0 0 16 16"><path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg>
								<p class="mb-0"><?= $general_address; ?></p>
							</div>
						<?php endif; ?>
					</div>
					<div class="socialmedia d-flex mt-5">
						<ul class="d-flex gap-4 list-unstyled">
							<?php if ( $instagram_link = get_field( 'instagram_link', 'options' ) ) : ?>
								<li>
									<a href="<?= esc_url( $instagram_link ); ?>" title="Instagram">
										<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-instagram" viewBox="0 0 16 16">
											<path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
										</svg>
									</a>
								</li>
							<?php endif; ?>
							<?php if ( $facebook_link = get_field( 'facebook_link', 'options' ) ) : ?>
								<li>
									<a href="<?= esc_url( $facebook_link ); ?>" title="Facebook">
										<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-facebook" viewBox="0 0 16 16">
											<path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
										</svg>
									</a>
								</li>
							<?php endif; ?>
							<?php if ( $youtube_link = get_field( 'youtube_link', 'options' ) ) : ?>
								<li>
									<a href="<?= esc_url( $youtube_link ); ?>" title="Youtube">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-youtube" viewBox="0 0 16 16">
											<path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z" />
										</svg>
									</a>
								</li>
							<?php endif; ?>
							<?php if ( $spotify_link = get_field( 'spotify_link', 'options' ) ) : ?>
								<li>
									<a href="<?= esc_url( $spotify_link ); ?>" title="Spotify">
										<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-spotify" viewBox="0 0 16 16">
											<path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.669 11.538a.498.498 0 0 1-.686.165c-1.879-1.147-4.243-1.407-7.028-.77a.499.499 0 0 1-.222-.973c3.048-.696 5.662-.397 7.77.892a.5.5 0 0 1 .166.686zm.979-2.178a.624.624 0 0 1-.858.205c-2.15-1.321-5.428-1.704-7.972-.932a.625.625 0 0 1-.362-1.194c2.905-.881 6.517-.454 8.986 1.063a.624.624 0 0 1 .206.858zm.084-2.268C10.154 5.56 5.9 5.419 3.438 6.166a.748.748 0 1 1-.434-1.432c2.825-.857 7.523-.692 10.492 1.07a.747.747 0 1 1-.764 1.288z"/>
										</svg>
									</a>
								</li>
							<?php endif; ?>
							<?php if ( $linkedIn_link = get_field( 'linkedIn_link', 'options' ) ) : ?>
								<li>
									<a href="<?= esc_url( $linkedIn_link ); ?>" title="LinkedIn">
										<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-linkedin" viewBox="0 0 16 16">
											<path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
										</svg>
									</a>
								</li>
							<?php endif; ?>
							<?php if ( $xing_link = get_field( 'xing_link', 'options' ) ) : ?>
								<li>
									<a href="<?= esc_url( $xing_link ); ?>" title="Xing">
										<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 30 30" fill="white">
											<path id="_8547095_xing_square_icon" data-name="8547095_xing_square_icon" d="M27.2,32H3.264A3.265,3.265,0,0,0,0,35.264V59.2a3.265,3.265,0,0,0,3.264,3.264H27.2A3.265,3.265,0,0,0,30.462,59.2V35.264A3.265,3.265,0,0,0,27.2,32ZM9.546,51.6H6.378a.458.458,0,0,1-.408-.7L9.322,45c.007,0,.007-.007,0-.014L7.187,41.315a.433.433,0,0,1,.408-.687h3.169a1.012,1.012,0,0,1,.877.592l2.169,3.76-3.407,6A1,1,0,0,1,9.546,51.6ZM24.485,37.038,17.5,49.325v.014l4.454,8.091a.436.436,0,0,1-.408.687H18.372a.975.975,0,0,1-.877-.592l-4.488-8.18q.235-.418,7.031-12.4a.976.976,0,0,1,.85-.592h3.189A.435.435,0,0,1,24.485,37.038Z" transform="translate(0 -32)"/>
										</svg>
									</a>
								</li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
				<?php if ( !avasol_is_mobile() ) : ?>
					<div class="offset-lg-6 col-lg-2 d-none d-lg-block menu">
						<?php if ( have_rows( 'footer_menu', 'options' ) ) : ?>
							<ul class="list-unstyled">
								<?php while ( have_rows( 'footer_menu', 'options' ) ) :
									the_row(); ?>
									<?php if ( have_rows( 'links_menu', 'options' ) ) : ?>
										<?php while ( have_rows( 'links_menu', 'options' ) ) :
											the_row(); ?>
											<?php
											$link = get_sub_field( 'link_menu_item', 'options' );
											$link_menu_classes = get_sub_field( 'link_menu_classes', 'options' );
											if ( $link ) :
												$link_url = $link['url'];
												$link_title = $link['title'];
												$link_target = $link['target'] ? $link['target'] : '_self';
												?>
												<li class="<?= esc_html( $link_menu_classes ); ?> mb-2"><a href="<?= esc_url( $link_url ); ?>" title="<?= esc_html( $link_title ); ?>" target="<?= esc_attr( $link_target ); ?>"><?= esc_html( $link_title ); ?></a>
											<?php endif; ?>
										<?php endwhile; ?>
									<?php endif; ?>
								<?php endwhile; ?>
							</ul>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="row g-0 content mt-lg-6">
				<div class="col-12 footer-bottom">
					<div class="d-flex align-items-md-center justify-content-md-between flex-column flex-md-row">
						<div class="legal-menu order-md-2 mb-0">
							<?php if ( have_rows( 'footer_menu_legal', 'options' ) ) : ?>
								<ul class="d-flex list-unstyled gap-3 mb-0">
									<?php while ( have_rows( 'footer_menu_legal', 'options' ) ) :
										the_row(); ?>
										<?php if ( $headline_menu = get_sub_field( 'headline_menu', 'options' ) ) : ?>
											<div class="font-weight-medium mb-2 mb-lg-4"><?= esc_html( $headline_menu ); ?></div>
										<?php endif; ?>
										<?php
										$posts = get_sub_field( 'links_menu', 'options' );
										if ( $posts ) : ?>
											<?php foreach( $posts as $post) : ?>
												<?php setup_postdata( $post ); ?>
												<li class="mb-3 mb-lg-0"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
											<?php endforeach; ?>
											<?php wp_reset_postdata(); ?>
										<?php endif; ?>
									<?php endwhile; ?>
								</ul>
							<?php endif; ?>
						</div>
						<div class="copyright order-md-1">
							<?php avasol_copyright(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div><?php // #page ?>

<?php wp_footer(); ?>

<?php avasol_custom_code('avasol_before_closing_body'); ?>
</body>
</html>
