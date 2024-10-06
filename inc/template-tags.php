<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package avasol
 */

if ( ! function_exists( 'avasol_toc' ) ) :
function avasol_toc($content) {
    $matches = [];
    preg_match_all('/<h([1-6])>(.*?)<\/h[1-6]>/', $content, $matches, PREG_SET_ORDER);

    if (!$matches) {
        return;
    }

    $toc = '<div class="toc"><nav id="TableOfContents"><ul>';
    foreach ($matches as $match) {
        $heading_tag = $match[1];
        $heading_text = $match[2];

        $anchor = sanitize_title($heading_text);

        $toc .= '<li><a href="#' . $anchor . '">' . $heading_text . '</a>';

        if ($heading_tag < 6) {
            $toc .= generate_sub_headings($matches, $heading_tag, $anchor);
        }

        $toc .= '</li>';

        $content = str_replace($match[0], '<h' . $heading_tag . ' id="' . $anchor . '">' . $heading_text . '</h' . $heading_tag . '>', $content);
    }
    $toc .= '</ul></nav></div>';

    return $toc . $content;
}

function generate_sub_headings($matches, $parent_level, $parent_anchor) {
    $sub_toc = '';
    $sub_level = $parent_level + 1;

    foreach ($matches as $sub_match) {
        $sub_heading_tag = $sub_match[1];
        $sub_heading_text = $sub_match[2];

        if ($sub_heading_tag == $sub_level) {
            $sub_anchor = sanitize_title($sub_heading_text);
            $sub_toc .= '<ul><li><a href="#' . $sub_anchor . '">' . $sub_heading_text . '</a>';

            if ($sub_heading_tag < 6) {
                $sub_toc .= generate_sub_headings($matches, $sub_heading_tag, $sub_anchor);
            }

            $sub_toc .= '</li></ul>';
        }
    }

    return $sub_toc;
}

// Hook into 'the_content' filter to apply the TOC to post content
//add_filter('the_content', 'generate_hugo_style_table_of_contents');
endif;

if ( ! function_exists( 'avasol_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function avasol_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="entry-date modified screen-reader-text" datetime="%3$s" itemprop="dateModified">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'avasol' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'avasol_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function avasol_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'avasol' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'avasol_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function avasol_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'avasol' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'avasol' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'avasol' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'avasol' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'avasol' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

	}
endif;

if ( ! function_exists( 'avasol_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function avasol_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		$img_id = get_post_thumbnail_id();

		if ( is_singular() ) :
			?>

            <div class="entry-image">
                <div class="imagecontainer">
						<?php echo avasol_lazy_image($img_id, 'medium_large', 'img-fluid'); ?>
                </div>
            </div>

		<?php else : ?>

            <div class="entry-image">
                <div class="imagecontainer">
                    <a class="post-thumbnail" href="<?php the_permalink() ?>">
						<?php echo avasol_lazy_image($img_id, 'medium_large', 'img-fluid'); ?>
                    </a>
                </div>
            </div>

		<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'avasol_pagination_links' ) ) :
/**
 * Numbered pagination
 */
function avasol_pagination_links() {
	global $wp_query;

	$total_pages = $wp_query->max_num_pages;

	if ($total_pages > 1){
		$current_page = max(1, get_query_var('paged'));

		$base = get_pagenum_link( 1 ) . '%_%';
		$format = 'page/%#%';

		if (is_search()) {
			$base = get_home_url() . '%_%';
			$format = '/page/%#%/';
		}

		echo paginate_links(array(
			'base' => $base,
			'format' => $format,
			'type'      => 'list',
			'current' => $current_page,
			'total' => $total_pages,
		));
	}
}
endif;

if ( ! function_exists( 'avasol_lazy_image' ) ) :
	/**
	 * Return a responsive image tag without the cropped images from a wp image array
	 */
	function avasol_lazy_image( $img_arr, $default = null, $classes = '', $fit = null, $disable_lazy = false ) {

		if ( is_int( $img_arr ) ) {
			$img_arr = wp_prepare_attachment_for_js( $img_arr );
		}

		if ( ! is_array( $img_arr ) ) {
			return '';
		}
		//Get a list of available image sizes
		$sizes = get_intermediate_image_sizes();
		//Remove thumbnail and medium which are always first
		unset( $sizes[0], $sizes[1] );

		if ( is_admin() || $disable_lazy ) {
			$src    = 'src="';
			$srcset = 'srcset="';
		} else {
			$src    = 'data-src="';
			$srcset = 'data-srcset="';
			$classes .= ' lazyload ';
		}

		$tag = '<img ';
		if ( isset( $default ) && isset( $img_arr['sizes'][ $default . '-width' ] ) ) {
			$tag .= $src . $img_arr['sizes'][ $default ] . '" ' . "\n";
		} elseif ( isset( $default ) && isset( $img_arr['sizes'][ $default ]['url'] ) ) {
			$tag .= $src . $img_arr['sizes'][ $default ]['url'] . '" ' . "\n";
		} else {
			$tag .= $src . $img_arr['url'] . '" ' . "\n";
		}

		if ( ! is_admin() && ! $disable_lazy ) {
			//Add a blank image on pageload
			$tag .= 'srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" ' . "\n";
		}

		//Now loop through the available sizes and add them with their widths, default first
		if ( isset( $default ) && isset( $img_arr['sizes'][ $default . '-width' ] ) ) {
			$tag .= $srcset . $img_arr['sizes'][ $default ] . ' ' . $img_arr['sizes'][ $default . '-width' ] . 'w ' . $img_arr['sizes'][ $default . '-height' ] . 'h,' . "\n";
		} elseif ( isset( $default ) && isset( $img_arr['sizes'][ $default ]['width'] ) ) {
			$tag .= $srcset . $img_arr['sizes'][ $default ]['url'] . ' ' . $img_arr['sizes'][ $default ]['width'] . 'w ' . $img_arr['sizes'][ $default ]['height'] . 'h,' . "\n";
		} else {
			$tag .= $srcset . $img_arr['url'] . ' ' . $img_arr['width'] . 'w ' . $img_arr['height'] . 'h, ' . "\n";
		}
		foreach ( $sizes as $key => $size ) {
			//We only want to add a size if it's smaller than the original image
			if ( isset( $img_arr['sizes'][ $size . '-width' ] ) && $img_arr['sizes'][ $size . '-width' ] < $img_arr['width'] ) {
				$tag .= $img_arr['sizes'][ $size ] . ' ' . $img_arr['sizes'][ $size . '-width' ] . 'w, ' . "\n";
			} elseif ( isset( $img_arr['sizes'][ $size ]['width'] ) && $img_arr['sizes'][ $size ]['width'] < $img_arr['width'] ) {
				$tag .= $img_arr['sizes'][ $size ]['url'] . ' ' . $img_arr['sizes'][ $size ]['width'] . 'w, ' . "\n";
			}
		}
		//Trim off the last comma and close the quote
		$tag = rtrim( $tag, ",\n " ) . '" ' . "\n";
		//We want the plugin in auto mode so will hardcode this bit
		$tag .= 'data-sizes="auto" ' . "\n";
		//If object-fit is set we need a data att to support ie
		if ( isset( $fit ) && ( $fit === 'cover' || $fit === 'contain' ) ) {
			$tag     .= 'data-parent-fit="' . $fit . '"' . "\n";
			$classes = $classes . ' imagecontainer-img-' . $fit;
		}
		//Add the classes
		$tag .= 'class="' . $classes . '"' . "\n";
		//Add the alt
		$tag .= 'alt="' . $img_arr['alt'] . '"' . "\n";
		//Close the tag
		$tag .= ' />';

		return $tag;

	}
endif;

if ( ! function_exists( 'avasol_custom_code' ) ) :
	/**
	 * Echo custom code from the customizer
	 */
	function avasol_custom_code( $location = false ) {

		if ( $location === false ) {
			return false;
		}

		$code = get_theme_mod( $location );

		if ( $code ) {
			echo $code;
		}
	}
endif;

if ( ! function_exists( 'avasol_copyright' ) ) :
	/**
	 * Echo copyright from the customizer
	 */
	function avasol_copyright() {

		$copyright = get_theme_mod('avasol_copyright');

		if ( $copyright ) {
			echo '<p class="mb-md-0">' . str_replace( '{year}', date( 'Y' ), $copyright ) . '</p>';
		}
	}
endif;

if ( ! function_exists( 'avasol_is_mobile' ) ) :
	/**
	 * 
	 */
	function avasol_is_mobile() {
		$detect = new Mobile_Detect;
	
		if( $detect->isMobile() ){
			return true;
		} else {
			return false;
		}  
	}
endif;

if ( ! function_exists( 'avasol_is_mobile_phone' ) ) :
	/**
	 * 
	 */
	function avasol_is_mobile_phone() {
		$detect = new Mobile_Detect;
	
		if( $detect->isMobile() && !$detect->isTablet() ){
			return true;
		} else {
			return false;
		}  
	}
endif;

if ( ! function_exists( 'avasol_is_mobile_tablet' ) ) :
	/**
	 * 
	 */
	function avasol_is_mobile_tablet() {
		$detect = new Mobile_Detect;
	
		if( $detect->isMobile() && $detect->isTablet() ){
			return true;
		} else {
			return false;
		}  
	}
endif;

/**
 * SHARING BUTTONS 
 */
function avasol_sharing_buttons(){

	global $post;
	$url_to_share = esc_attr(get_permalink($post->ID));
	$title_to_share = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
	$image_to_share = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium-large' );

	$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$url_to_share;
	$twitterURL = 'https://twitter.com/intent/tweet?text='.$title_to_share.'&amp;url='.$url_to_share.'&amp;via=@HANDLE';
	$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$url_to_share;

	?>
	<div class="sharing-buttons position-relative d-flex gap-2">
		<!-- Copy (url) --> 
		<a class="btn-copyLink" href="#" onclick="copyLinktoShare()">
			<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M24.9999 11.6601V12.0001C25.0007 13.0662 24.576 14.0885 23.8199 14.84L20.9999 17.67C20.4738 18.1911 19.6261 18.1911 19.1 17.67L19 17.56C18.8094 17.3656 18.8094 17.0544 19 16.86L22.4399 13.4201C22.807 13.0394 23.0083 12.5288 22.9999 12.0001V11.6601C23.0003 11.127 22.788 10.6159 22.4099 10.2401L21.7599 9.59011C21.3841 9.21207 20.873 8.99969 20.3399 9.00011H19.9999C19.4669 8.99969 18.9558 9.21207 18.58 9.59011L15.14 13.0001C14.9456 13.1906 14.6344 13.1906 14.44 13.0001L14.33 12.8901C13.8089 12.3639 13.8089 11.5162 14.33 10.9901L17.16 8.15012C17.9165 7.40505 18.9382 6.99133 19.9999 7.00014H20.3399C21.4011 6.9993 22.4191 7.42018 23.1699 8.17012L23.8299 8.83012C24.5798 9.5809 25.0007 10.5989 24.9999 11.6601ZM12.6499 17.94L17.9399 12.6501C18.0338 12.5554 18.1616 12.5022 18.2949 12.5022C18.4282 12.5022 18.556 12.5554 18.6499 12.6501L19.3499 13.3501C19.4445 13.4439 19.4978 13.5717 19.4978 13.7051C19.4978 13.8384 19.4445 13.9662 19.3499 14.0601L14.0599 19.35C13.966 19.4447 13.8382 19.4979 13.7049 19.4979C13.5716 19.4979 13.4438 19.4447 13.3499 19.35L12.6499 18.65C12.5553 18.5561 12.502 18.4283 12.502 18.295C12.502 18.1617 12.5553 18.0339 12.6499 17.94ZM17.5599 19C17.3655 18.8094 17.0543 18.8094 16.8599 19L13.4299 22.41C13.0517 22.7905 12.5365 23.003 12 22.9999H11.66C11.1269 23.0004 10.6158 22.788 10.24 22.41L9.58997 21.76C9.21194 21.3842 8.99956 20.873 8.99998 20.34V20C8.99956 19.4669 9.21194 18.9558 9.58997 18.58L13.0099 15.14C13.2005 14.9456 13.2005 14.6345 13.0099 14.44L12.8999 14.33C12.3738 13.8089 11.5261 13.8089 11 14.33L8.17999 17.16C7.42392 17.9116 6.99916 18.9339 7 20V20.35C7.00182 21.4077 7.42249 22.4216 8.16999 23.1699L8.82998 23.8299C9.58076 24.5799 10.5988 25.0008 11.66 24.9999H12C13.0534 25.0061 14.0667 24.5964 14.8199 23.8599L17.6699 21.01C18.191 20.4838 18.191 19.6361 17.6699 19.11L17.5599 19Z" fill="black"/>
				<rect x="0.5" y="0.5" width="31" height="31" rx="15.5" stroke="black" stroke-opacity="0.33"/>
			</svg>
		</a>
		<div class="small text-center mt-3 py-1 alert-copy text-uppercase" role="alert"><?php _e( 'Link kopiert.', 'heckm' ); ?></div>

		<!-- LinkedIn (url, text, @mention) -->
		<a class="btn-linkedin" href="<?php echo $linkedInURL; ?>" target="_blank" rel="nofollow">
			<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M9 7H23C24.1046 7 25 7.89543 25 9V23C25 24.1046 24.1046 25 23 25H9C7.89543 25 7 24.1046 7 23V9C7 7.89543 7.89543 7 9 7ZM12 22C12.2761 22 12.5 21.7761 12.5 21.5V14.5C12.5 14.2239 12.2761 14 12 14H10.5C10.2239 14 10 14.2239 10 14.5V21.5C10 21.7761 10.2239 22 10.5 22H12ZM11.25 13C10.4216 13 9.75 12.3284 9.75 11.5C9.75 10.6716 10.4216 10 11.25 10C12.0784 10 12.75 10.6716 12.75 11.5C12.75 12.3284 12.0784 13 11.25 13ZM21.5 22C21.7761 22 22 21.7761 22 21.5V16.9C22.0325 15.3108 20.8576 13.9545 19.28 13.76C18.177 13.6593 17.1083 14.1744 16.5 15.1V14.5C16.5 14.2239 16.2761 14 16 14H14.5C14.2239 14 14 14.2239 14 14.5V21.5C14 21.7761 14.2239 22 14.5 22H16C16.2761 22 16.5 21.7761 16.5 21.5V17.75C16.5 16.9216 17.1716 16.25 18 16.25C18.8284 16.25 19.5 16.9216 19.5 17.75V21.5C19.5 21.7761 19.7239 22 20 22H21.5Z" fill="black"/>
				<rect x="0.5" y="0.5" width="31" height="31" rx="15.5" stroke="black" stroke-opacity="0.33"/>
			</svg>
		</a>

		<!-- Facebook (url) -->
		<a class="btn-facebook" href="<?php echo $facebookURL; ?>" target="_blank" rel="nofollow">
			<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M20.5 10H17.5C16.9477 10 16.5 10.4477 16.5 11V14H20.5C20.6137 13.9975 20.7216 14.0504 20.7892 14.1419C20.8568 14.2334 20.8758 14.352 20.84 14.46L20.1 16.66C20.0318 16.8619 19.8431 16.9984 19.63 17H16.5V24.5C16.5 24.7761 16.2761 25 16 25H13.5C13.2239 25 13 24.7761 13 24.5V17H11.5C11.2239 17 11 16.7761 11 16.5V14.5C11 14.2239 11.2239 14 11.5 14H13V11C13 8.79086 14.7909 7 17 7H20.5C20.7761 7 21 7.22386 21 7.5V9.5C21 9.77614 20.7761 10 20.5 10Z" fill="black"/>
				<rect x="0.5" y="0.5" width="31" height="31" rx="15.5" stroke="black" stroke-opacity="0.33"/>
			</svg>
		</a>

		<!-- Twitter (url, text, @mention) -->
		<a class="btn-twitter" href="<?php echo $twitterURL; ?>" target="_blank" rel="nofollow">
			<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M24.9737 10.7174C24.5093 11.3369 23.9479 11.8773 23.3112 12.3178C23.3112 12.4796 23.3112 12.6414 23.3112 12.8123C23.3163 15.7511 22.1424 18.5691 20.0527 20.6345C17.9629 22.6999 15.1321 23.8399 12.1949 23.7989C10.4968 23.8046 8.82053 23.4169 7.29728 22.6661C7.21514 22.6302 7.16217 22.549 7.16248 22.4593V22.3604C7.16248 22.2313 7.26709 22.1267 7.39613 22.1267C9.06528 22.0716 10.6749 21.4929 11.9972 20.4724C10.4864 20.4419 9.12705 19.5469 8.50146 18.1707C8.46987 18.0956 8.4797 18.0093 8.52743 17.9432C8.57515 17.8771 8.65386 17.8407 8.73511 17.8471C9.19428 17.8932 9.65804 17.8505 10.1011 17.7212C8.43325 17.375 7.18007 15.9904 7.00072 14.2957C6.99435 14.2144 7.03078 14.1357 7.09686 14.0879C7.16293 14.0402 7.2491 14.0303 7.32424 14.062C7.7718 14.2595 8.25495 14.3635 8.7441 14.3676C7.2827 13.4085 6.65147 11.5841 7.20741 9.92622C7.2648 9.76513 7.40267 9.64612 7.57036 9.61294C7.73804 9.57975 7.91082 9.63728 8.02518 9.76439C9.99725 11.8633 12.7069 13.114 15.5828 13.2528C15.5092 12.9589 15.473 12.6568 15.475 12.3537C15.5019 10.7647 16.4851 9.34921 17.9643 8.76987C19.4434 8.19054 21.1258 8.56203 22.2239 9.71044C22.9723 9.56785 23.6959 9.31645 24.3716 8.96421C24.4211 8.93331 24.4839 8.93331 24.5334 8.96421C24.5643 9.01373 24.5643 9.07652 24.5334 9.12604C24.2061 9.87552 23.6532 10.5041 22.9518 10.9242C23.566 10.853 24.1694 10.7081 24.7491 10.4926C24.7979 10.4594 24.862 10.4594 24.9108 10.4926C24.9517 10.5113 24.9823 10.5471 24.9944 10.5904C25.0065 10.6337 24.9989 10.6802 24.9737 10.7174Z" fill="black"/>
				<rect x="0.5" y="0.5" width="31" height="31" rx="15.5" stroke="black" stroke-opacity="0.33"/>
			</svg>
		</a>
	</div>
	<?php
}

/**
* Estimated reading time in minutes
* 
* @param $content
* @param $words_per_minute
* @param $with_gutenberg
* 
* @return int estimated time in minutes
* Code Example for template: avasol_reading_time( get_the_content(), 200, true );
*/

function avasol_reading_time( $content = '', $words_per_minute = 200, $with_gutenberg = false ) {
    // In case if content is build with gutenberg parse blocks
    if ( $with_gutenberg ) {
        $blocks = parse_blocks( $content );
        $contentHtml = '';

        foreach ( $blocks as $block ) {
            $contentHtml .= render_block( $block );
        }

        $content = $contentHtml;
    }
            
    // Remove HTML tags from string
    $content = wp_strip_all_tags( $content );
            
    // When content is empty return 0
    if ( !$content ) {
        return 0;
    }
            
    // Count words containing string
    $words_count = str_word_count( $content );
            
    // Calculate time for read all words and round
    $minutes = ceil( $words_count / $words_per_minute );

	if ($minutes == 1) {
        $timer = " min.";
    } else {
        $timer = " min.";
    }

    $totalreadingtime = $minutes . $timer;
            
    return $totalreadingtime;
}

/* Get primary category */
function get_primary_category($category , $useCatLink = false)
{
    //$useCatLink = false;
    // If post has a category assigned.
    if ($category) {
        $category_display = '';
        $category_link = '';
        if (class_exists('WPSEO_Primary_Term')) {
            // Show the post's 'Primary' category, if this Yoast feature is available, & one is set
            $wpseo_primary_term = new WPSEO_Primary_Term('category', get_the_id());
            $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
            $term = get_term($wpseo_primary_term);
            if (is_wp_error($term)) {
                // Default to first category (not Yoast) if an error is returned
                $category_display = $category[0]->name;
                $category_link = get_category_link($category[0]->term_id);
            } else {
                // Yoast Primary category
                $category_display = $term->name;
                $category_link = get_category_link($term->term_id);
            }
        } else {
            // Default, display the first category in WP's list of assigned categories
            $category_display = $category[0]->name;
            $category_link = get_category_link($category[0]->term_id);
        }
        // Display category
        if (!empty($category_display)) {
            if ($useCatLink == true && !empty($category_link)) {
                return '<a href="' . $category_link . '" title="' . $category_display . '">' . $category_display . '</a>';
            } else {
                return $category_display;
            }
        }
    }
}
