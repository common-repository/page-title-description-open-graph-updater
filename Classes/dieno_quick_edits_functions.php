<?php
//Dieno_datatable_get_all_pages_list
add_action( 'wp_ajax_dieno_datatable_get_all_pages_list', 'dieno_datatable_get_all_pages_list' );
add_action( 'wp_ajax_nopriv_dieno_datatable_get_all_pages_list', 'dieno_datatable_get_all_pages_list' );
function dieno_datatable_get_all_pages_list() {
	global $wpdb;
	$pages_list = get_all_page_ids();
	$return_json = array();
	if(!empty($pages_list)){
		foreach ($pages_list as $key => $id) {
			$title = get_the_title($id);
			$website_name = get_bloginfo( 'name' );
			$pagetitle = get_the_title($id);
			$pageogtitle = get_post_meta($id,'dieno_page_og_title',true);
			$pageogdescription = get_post_meta($id,'dieno_page_og_description',true);
			$pageogimage = get_post_meta($id,'dieno_page_og_image',true);
			$page_meta_description = get_post_meta($id,'dieno_page_meta_description',true);
			$pageogtitle = ($pageogtitle == '') ? $pagetitle : $pageogtitle;
			$pageogdescription = ($pageogdescription == '') ? $pagetitle : $pageogdescription;
			$pageogimage = ($pageogimage == '') ? $website_name : '<img src="'.esc_url( $pageogimage ).'" style="width: 100px;">';
			$page_meta_description = ($page_meta_description == '') ? $title.' - '.$website_name : $page_meta_description;
			$page_meta_description = strlen($page_meta_description) > 50 ? substr($page_meta_description,0,50)."..." : $page_meta_description;
			$page_link = get_permalink($id);
		    $row = array(
		      'Title' => '<div class="default_page_content"><a href="#" data-id="'.esc_attr( $id ).'" class="open_edit_btn" data-update="pagetitle" data-id="'.esc_attr( $id ).'"><i class="fa fa-pencil" aria-hidden="true"></i></a> '.esc_html( $title ).'</div><div class="edit_content_container"></div>',
		      'Description' => '<div class="default_page_content"><a href="#" data-id="'.esc_attr( $id ).'" class="open_edit_btn" data-update="pagedescription" data-id="'.esc_attr( $id ).'"><i class="fa fa-pencil" aria-hidden="true"></i></a> '.esc_html( $page_meta_description ).'</div><div class="edit_content_container"></div>',
		      'OG Title' => '<div class="default_page_content"><a href="#" data-id="'.esc_attr( $id ).'" class="open_edit_btn" data-update="pageogtitle" data-id="'.esc_attr( $id ).'"><i class="fa fa-pencil" aria-hidden="true"></i></a> '.esc_html( $pageogtitle ).'</div><div class="edit_content_container"></div>',
		      'OG Description' => '<div class="default_page_content"><a href="#" data-id="'.esc_attr( $id ).'" class="open_edit_btn" data-update="pageogdescription" data-id="'.esc_attr( $id ).'"><i class="fa fa-pencil" aria-hidden="true"></i></a> '.esc_html( $pageogdescription ).'</div><div class="edit_content_container"></div>',
		      'OG Image' => '<div class="default_page_content"><a href="#" data-id="'.esc_attr( $id ).'" class="open_edit_btn" data-update="pageogimage" data-id="'.esc_attr( $id ).'"><i class="fa fa-pencil" aria-hidden="true"></i></a> '.$pageogimage.'</div><div class="edit_content_container"></div>',
		      'View Page' => '<a href="'.esc_attr( $page_link ).'" target="_blank">View Page</a>'
		    );
			$return_json[] = $row;
		}
		echo json_encode(array('data' => $return_json));
	}else{
		echo json_encode(array('data' => ''));
	}
	die();
}
//dieno_show_field_data_for_update
add_action( 'wp_ajax_dieno_show_field_data_for_update', 'dieno_show_field_data_for_update' );
add_action( 'wp_ajax_nopriv_dieno_show_field_data_for_update', 'dieno_show_field_data_for_update' );
function dieno_show_field_data_for_update() {
	global $wpdb;
	$pageid = sanitize_text_field( $_REQUEST['pageid'] );
	$dataupdate = sanitize_text_field( $_REQUEST['dataupdate'] );
	$website_name = get_bloginfo( 'name' );
	$pagetitle = get_the_title($pageid);
	$pageogtitle = get_post_meta($pageid,'dieno_page_og_title',true);
	$pageogdescription = get_post_meta($pageid,'dieno_page_og_description',true);
	$pageogimage = get_post_meta($pageid,'dieno_page_og_image',true);
	$pageogtitle = ($pageogtitle == '') ? $pagetitle : $pageogtitle;
	$pageogdescription = ($pageogdescription == '') ? $pagetitle : $pageogdescription;
	$pageogimage = ($pageogimage == '') ? $website_name : $pageogimage;
	if($dataupdate == 'pagetitle') {
		echo '<input type="text" value="'.esc_attr( $pagetitle ).'"><div class="update_content_btns"><a href="#" data-id="'.esc_attr( $pageid ).'" class="update_content_btns_pagetitle update_btn"><i class="fa fa-check" aria-hidden="true"></i></a><a href="#" data-id="'.esc_attr( $pageid ).'" data-type="cancel_update_btn" class="cancel_update_btn"><i class="fa fa-times" aria-hidden="true"></i></a></div>';
	}else if($dataupdate == 'pagedescription') {
		$page_meta_description = get_post_meta($pageid,'dieno_page_og_description',true);
		$page_meta_description = ($page_meta_description == '') ? $pagetitle.' - '.$website_name : $page_meta_description;
		echo '<textarea id="page_meta_description" name="page_meta_description" rows="4" cols="30">'.esc_html( $page_meta_description ).'</textarea><div class="update_content_btns"><a href="#" data-id="'.esc_attr( $pageid ).'" class="update_content_btns_pagedescription update_btn"><i class="fa fa-check" aria-hidden="true"></i></a><a href="#" data-id="'.esc_attr( $pageid ).'" data-type="cancel_update_btn" class="cancel_update_btn"><i class="fa fa-times" aria-hidden="true"></i></a></div>';
	}else if($dataupdate == 'pageogtitle') {
		echo '<input type="text" value="'.esc_attr( $pageogtitle ).'"><div class="update_content_btns"><a href="#" data-id="'.esc_attr( $pageid ).'" class="update_content_btns_pageogtitle update_btn"><i class="fa fa-check" aria-hidden="true"></i></a><a href="#" data-id="'.esc_attr( $pageid ).'" data-type="cancel_update_btn" class="cancel_update_btn"><i class="fa fa-times" aria-hidden="true"></i></a></div>';
	}else if($dataupdate == 'pageogdescription') {
		echo '<textarea id="ogpagedescription" name="ogpagedescription" rows="4" cols="30">'.esc_html( $pageogdescription ).'</textarea><div class="update_content_btns"><a href="#" data-id="'.esc_attr( $pageid ).'" class="update_content_btns_pageogdescription update_btn"><i class="fa fa-check" aria-hidden="true"></i></a><a href="#" data-id="'.esc_attr( $pageid ).'" data-type="cancel_update_btn" class="cancel_update_btn"><i class="fa fa-times" aria-hidden="true"></i></a></div>';
	}else if($dataupdate == 'pageogimage') {
		echo '<input type="text" value="'.esc_attr( $pageogimage ).'"><div class="update_content_btns"><input id="upload_image_button" data-id="'.esc_attr( $pageid ).'" type="button" class="button" value="Update image" /><input type="hidden" name="image_attachment_id" id="image_attachment_id" value="" data-id="'.esc_attr( $pageid ).'"><a href="#" data-id="'.esc_attr( $pageid ).'" data-type="cancel_update_btn" class="cancel_update_btn"><i class="fa fa-times" aria-hidden="true"></i></a></div>';
	}
	die();
}
//Update page title dieno_update_page_title
add_action( 'wp_ajax_dieno_update_page_title', 'dieno_update_page_title' );
add_action( 'wp_ajax_nopriv_dieno_update_page_title', 'dieno_update_page_title' );
function dieno_update_page_title() {
	global $wpdb;
	$pagetitle = sanitize_text_field( $_REQUEST['pagetitle'] );
	$pageid = sanitize_text_field( $_REQUEST['pageid'] );
	$post_update = array(
    'ID'         => $pageid,
    'post_title' => $pagetitle
  );
  wp_update_post( $post_update );
  update_post_meta($pageid,'_aioseop_title',$pagetitle);
	die();
}
//Update page title dieno_update_page_description
add_action( 'wp_ajax_dieno_update_page_description', 'dieno_update_page_description' );
add_action( 'wp_ajax_nopriv_dieno_update_page_description', 'dieno_update_page_description' );
function dieno_update_page_description() {
	global $wpdb;
	$pagedescription = sanitize_text_field ( $_REQUEST['pagedescription'] );
	$pageid = sanitize_text_field ( $_REQUEST['pageid'] );
	update_post_meta($pageid,'dieno_page_meta_description',$pagedescription);
	update_post_meta($pageid,'_aioseop_description',$pagedescription);
	die();
}
//Update page og title dieno_update_page_og_title
add_action( 'wp_ajax_dieno_update_page_og_title', 'dieno_update_page_og_title' );
add_action( 'wp_ajax_nopriv_dieno_update_page_og_title', 'dieno_update_page_og_title' );
function dieno_update_page_og_title() {
	global $wpdb;
	$pageogtitle = sanitize_text_field( $_REQUEST['pageogtitle'] );
	$pageid = sanitize_text_field( $_REQUEST['pageid'] );
	update_post_meta($pageid,'dieno_page_og_title',$pageogtitle);
	die();
}
//Update page og description dieno_update_page_og_description
add_action( 'wp_ajax_dieno_update_page_og_description', 'dieno_update_page_og_description' );
add_action( 'wp_ajax_nopriv_dieno_update_page_og_description', 'dieno_update_page_og_description' );
function dieno_update_page_og_description() {
	global $wpdb;
	$pageogdesription = sanitize_text_field( $_REQUEST['pageogdesription'] );
	$pageid = sanitize_text_field( $_REQUEST['pageid'] );
	update_post_meta($pageid,'dieno_page_og_description',$pageogdesription);
	die();
}
//Update page og image dieno_update_page_og_image
add_action( 'wp_ajax_dieno_update_page_og_image', 'dieno_update_page_og_image' );
add_action( 'wp_ajax_nopriv_dieno_update_page_og_image', 'dieno_update_page_og_image' );
function dieno_update_page_og_image() {
	global $wpdb;
	$pageogimage = sanitize_text_field( $_REQUEST['pageogimage'] );
	$pageid = sanitize_text_field( $_REQUEST['pageid'] );
	update_post_meta($pageid,'dieno_page_og_image',$pageogimage);
	die();
}