<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package avasol
 */

$color_navbar =  get_field( 'color_navbar' );
$action_bar_text = get_field( 'action_bar_text', 'options' );
$action_bar_link = get_field( 'action_bar_link', 'options' );
	
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<?php avasol_custom_code('avasol_after_opening_head'); ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#000" />

	<?php wp_head(); ?>
	<?php avasol_custom_code('avasol_before_closing_head'); ?>
</head>

<body <?php body_class(); ?>>
<?php avasol_custom_code('avasol_after_opening_body'); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'avasol' ); ?></a>

    <header role="banner" id="masthead" class="site-header nav-wrap fixed-top <?php if ( $color_navbar && $action_bar_text ) : echo $color_navbar; endif; ?>">
		<?php if ( $action_bar_text ) : ?>
			<div class="action-bar d-flex align-items-center justify-content-center">
				<div class="container text-center px-6 position-relative">
					<?php if ( $action_bar_link ) : ?><a href="<?= $action_bar_link; ?>"><?php endif; ?>
						<?= $action_bar_text; ?> <span class="ms-1"><?php if ( $action_bar_link ) : ?><svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.125 1L15.125 7L9.125 13" stroke="currentColor"/><path d="M0.875 7L14.75 7" stroke="currentColor"/></svg></span><?php endif; ?>
					<?php if ( $action_bar_link ) : ?></a><?php endif; ?>
					<div id="close_activebar" class="close-bar">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M14.8354 14.364L14.3639 14.8354C14.1036 15.0957 13.6815 15.0957 13.4211 14.8354L8 9.4142L2.5788 14.8353C2.3185 15.0957 1.89638 15.0957 1.63603 14.8353L1.16462 14.3639C0.904273 14.1036 0.904273 13.6815 1.16462 13.4211L6.5858 8L1.16462 2.5788C0.904273 2.3185 0.904273 1.89638 1.16462 1.63603L1.63602 1.16463C1.89637 0.904282 2.3185 0.904282 2.5788 1.16463L8 6.5858L13.4211 1.16462C13.6815 0.904273 14.1036 0.904273 14.3639 1.16462L14.8354 1.63602C15.0957 1.89637 15.0957 2.3185 14.8354 2.5788L9.4142 8L14.8354 13.4211C15.0957 13.6815 15.0957 14.1036 14.8354 14.364Z" fill="currentColor"/>
						</svg>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="<?php if ( $color_navbar ) : echo $color_navbar; else : echo 'bg-white'; endif; ?> nav-container">
		<div class="container pb-2 py-lg-3">
            <nav id="site-navigation" class="main-navigation navbar navbar-expand-lg navbar-light" role="navigation">
                <div class="site-branding navbar-brand">
                    <a href="<?= home_url( '/' ); ?>" class="custom-logo-link" rel="home" <?php if ( is_front_page() ) { echo 'aria-current="page"'; } ?>>
                        <?php if ( $color_navbar == 'bg-primary' ) : ?>
                            <img src="<?= get_template_directory_uri() . '/assets/images/logo-white.svg'; ?>" width="285" height="56" class="custom-logo" alt="<?php bloginfo( 'name' ); ?>">
                        <?php else : ?>
                            <img src="<?= esc_url( wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ) ); ?>" width="285" height="56" class="custom-logo" alt="<?php bloginfo( 'name' ); ?>">
                        <?php endif; ?>
                    </a>
                </div>
                <span class="visually-hidden"><?php esc_html_e( 'Toggle navigation', 'avasol' ); ?></span>
                <button class="navbar-toggler brand border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="navbar-collapse-primary" class="collapse navbar-collapse">
					<?php wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id' => 'primary-menu',
						'container' => null,
						'menu_class' => 'navbar-nav ms-auto',
						'depth' => 2,
						'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
						'walker' => new wp_bootstrap_navwalker() ) );?>
                </div>
                <div class="offcanvas offcanvas-top d-block d-lg-none min-vh-100 bg-black-01 text-white bg-primary" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
                    <div class="offcanvas-header pt-2 pb-4 px-4">
                        <div id="offcanvasTopLabel" class="site-branding navbar-brand">
                            <div class="site-branding navbar-brand">
                                <img src="<?= get_template_directory_uri(); ?>/assets/images/logo-white.svg" width="285" height="56" class="custom-logo" alt="<?php bloginfo( 'name' ); ?>">
                            </div>
                        </div>
                        <button type="button" class="btn-close text-reset mt-2" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body pt-2 px-4">
                        <?php wp_nav_menu( array(
                            'theme_location' => 'menu-1',
                            'menu_id' => 'primary-menu',
                            'container' => null,
                            'menu_class' => 'navbar-nav',
                            'depth' => 2,
                            'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                            'walker' => new wp_bootstrap_navwalker() ) );
                        ;?>
                     <div class="socialmedia mt-6">
                            <ul class="list-unstyled d-flex gap-4 justify-content-center">
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
                </div>
            </nav>
        </div>
		</div>
    </header>

    <?php if ( function_exists( 'yoast_breadcrumb' ) ) { ?>
        <div class="container">
            <?php yoast_breadcrumb( '<div id="breadcrumbs" class="breadcrumbs">', '</div>' ); ?>
        </div>
    <?php } ?>

	<div id="content" class="site-content">
