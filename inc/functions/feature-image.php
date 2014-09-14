<?php
function set_featured_image_from_attachment($content) {
	global $post;
	if (has_post_thumbnail()) {
		// display the featured image
		$content = the_post_thumbnail() . $content;
	} else {
		// get & set the featured image
		$attachments = get_children(array(
			'post_parent' => $post->ID, 
			'post_status' => 'inherit', 
			'post_type' => 'attachment', 
			'post_mime_type' => 'image', 
			'order' => 'ASC', 
			'orderby' => 'menu_order'
		));
		if ($attachments) {
			foreach ($attachments as $attachment) {
				set_post_thumbnail($post->ID, $attachment->ID);
				break;
			}
			// display the featured image
			$content = the_post_thumbnail() . $content;
		}
	}
	return $content;
}
add_filter('the_content', 'set_featured_image_from_attachment');



// 85. Automatically use Resized Images instead of originals
// Replace your uploaded image with the large image generated by WordPress.
// This will save space on your server, and save bandwidth if you link your thumbnail to the original image.
// I love things that speed up your website.
//
// http://premium.wpmudev.org/blog/shun-the-plugin-100-wordpress-code-snippets-from-across-the-net/
function replace_uploaded_image($image_data) { 
// if there is no large image : return
 
 
if (!isset($image_data['sizes']['large'])) return $image_data; 
// paths to the uploaded image and the large image
 
$upload_dir = wp_upload_dir(); 
$uploaded_image_location = $upload_dir['basedir'] . '/' .$image_data['file']; 
$large_image_location = $upload_dir['path'] . '/'.$image_data['sizes']['large']['file']; 
// delete the uploaded image
 
unlink($uploaded_image_location); 
// rename the large image
 
rename($large_image_location,$uploaded_image_location); 
// update image metadata and return them
 
$image_data['width'] = $image_data['sizes']['large']['width']; 
$image_data['height'] = $image_data['sizes']['large']['height']; 
unset($image_data['sizes']['large']); 
 
return $image_data; 
} 
add_filter('wp_generate_attachment_metadata','replace_uploaded_image'); 


// http://pastebin.com/BnSW1u6Z
// get_the_post_thumbnail( $pageid )
// you just have to set $pageid to the id of post/page
function oikos_get_attachment_link_filter( $content, $post_id, $size, $permalink ) {
    // Only do this if we're getting the file URL
    if (! $permalink) {
        // This returns an array of (url, width, height)
        $image = wp_get_attachment_image_src( $post_id, 'large' );
        $new_content = preg_replace('/href=\'(.*?)\'/', 'href=\'' . $image[0] . '\'', $content );
        return $new_content;
    } else {
        return $content;
    }
}
 
add_filter('wp_get_attachment_link', 'oikos_get_attachment_link_filter', 10, 4);
?>