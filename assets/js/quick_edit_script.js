jQuery(document).ready(function(){
	  //Show Pages List
	dieno_pages_table = jQuery('#dieno_pages_list').DataTable({
	    ajax: {
	        url: dieno_ajax_object.ajax_url + '?action=dieno_datatable_get_all_pages_list',
	        "dataSrc": function ( json ) {
                return json.data;  
            } 
	    },
	    language: {
	      "emptyTable": "No Page Found In List"
	    },
	    columns: [
	        { data: 'Title' },
	        { data: 'Description' },
	        { data: 'OG Title' },
	        { data: 'OG Description' },
	        { data: 'OG Image' },
	        { data: 'View Page' }
	    ]
	});
	//open edit screen
	jQuery(document).on("click", ".open_edit_btn", function (event) {
	  	event.preventDefault();
	  	$this = jQuery(this);
	  	jQuery(this).closest(".default_page_content").hide();
	  	jQuery(this).closest("td").find(".edit_content_container").show();
	  	var dataupdate = jQuery(this).data("update");
	  	var pageid = jQuery(this).data("id");
	  	jQuery.ajax({
	      type: 'POST',
	      url: dieno_ajax_object.ajax_url,
	      data: {
	            'action':'dieno_show_field_data_for_update',
	            'dataupdate':dataupdate,
	            'pageid':pageid
	        },
	        success:function(response) {
	        	$this.closest('td').find('.edit_content_container').html(response);
	        	$this.closest('td').find('.default_page_content').hide();
	        },
	        error: function(errorThrown){
	        }
	    });
	});
	//Close edit screen
	jQuery(document).on("click", ".cancel_update_btn", function (event) {
	  	event.preventDefault();
	  	jQuery(this).closest("td").find(".default_page_content").show();
	  	jQuery(this).closest(".edit_content_container").empty();
	});
	//Update Page Title
	jQuery(document).on("click", ".update_content_btns_pagetitle", function (event) {
	  	event.preventDefault();
	  	$this = jQuery(this);
	  	var pageid = jQuery(this).data("id");
	  	var pagetitle = jQuery(this).closest(".edit_content_container").find("input[type='text']").val();
	  	jQuery.ajax({
	      type: 'POST',
	      url: dieno_ajax_object.ajax_url,
	      data: {
	            'action':'dieno_update_page_title',
	            'pagetitle' : pagetitle,
	            'pageid' : pageid
	        },
	        success:function(response) {
	          	dieno_pages_table.ajax.reload();
	          	$this.closest("td").find(".default_page_content").show();
	          	$this.closest("td").find(".edit_content_container").hide();
	        },
	        error: function(errorThrown){
	        }
	    });
	});
	//Update Page Description
	jQuery(document).on("click", ".update_content_btns_pagedescription", function (event) {
	  	event.preventDefault();
	  	$this = jQuery(this);
	  	var pageid = jQuery(this).data("id");
	  	var pagedescription = jQuery(this).closest(".edit_content_container").find("textarea#page_meta_description").val();
	  	//var pagedescription = tinymce.activeEditor.getContent();
	  	jQuery.ajax({
	      type: 'POST',
	      url: dieno_ajax_object.ajax_url,
	      data: {
	            'action':'dieno_update_page_description',
	            'pagedescription' : pagedescription,
	            'pageid' : pageid
	        },
	        success:function(response) {
	          	dieno_pages_table.ajax.reload();
	          	$this.closest("td").find(".default_page_content").show();
	          	$this.closest("td").find(".edit_content_container").hide();
	        },
	        error: function(errorThrown){
	        }
	    });
	});
	//Update Page OG Title
	jQuery(document).on("click", ".update_content_btns_pageogtitle", function (event) {
	  	event.preventDefault();
	  	$this = jQuery(this);
	  	var pageid = jQuery(this).data("id");
	  	var pageogtitle = jQuery(this).closest(".edit_content_container").find("input[type='text']").val();
	  	jQuery.ajax({
	      type: 'POST',
	      url: dieno_ajax_object.ajax_url,
	      data: {
	            'action':'dieno_update_page_og_title',
	            'pageogtitle' : pageogtitle,
	            'pageid' : pageid
	        },
	        success:function(response) {
	          	dieno_pages_table.ajax.reload();
	          	$this.closest("td").find(".default_page_content").show();
	          	$this.closest("td").find(".edit_content_container").hide();
	        },
	        error: function(errorThrown){
	        }
	    });
	});
	//Update Page OG Description
	jQuery(document).on("click", ".update_content_btns_pageogdescription", function (event) {
	  	event.preventDefault();
	  	$this = jQuery(this);
	  	var pageid = jQuery(this).data("id");
	  	var pageogdesription = jQuery(this).closest(".edit_content_container").find("textarea#ogpagedescription").val();
	  	jQuery.ajax({
	      type: 'POST',
	      url: dieno_ajax_object.ajax_url,
	      data: {
	            'action':'dieno_update_page_og_description',
	            'pageogdesription' : pageogdesription,
	            'pageid' : pageid
	        },
	        success:function(response) {
	          	dieno_pages_table.ajax.reload();
	          	$this.closest("td").find(".default_page_content").show();
	          	$this.closest("td").find(".edit_content_container").hide();
	        },
	        error: function(errorThrown){
	        }
	    });
	});
	//Update Page OG Image
	/*jQuery(document).on("click", ".update_content_btns_pageogimage", function (event) {
	  	event.preventDefault();
	  	$this = jQuery(this);
	  	var pageid = jQuery(this).data("id");
	  	var pageogimage = jQuery(this).closest(".edit_content_container").find("input[type='text']").val();
	  	jQuery.ajax({
	      type: 'POST',
	      url: dieno_ajax_object.ajax_url,
	      data: {
	            'action':'dieno_update_page_og_image',
	            'pageogimage' : pageogimage,
	            'pageid' : pageid
	        },
	        success:function(response) {
	          	dieno_pages_table.ajax.reload();
	          	$this.closest("td").find(".default_page_content").show();
	          	$this.closest("td").find(".edit_content_container").hide();
	        },
	        error: function(errorThrown){
	        }
	    });
	});*/
	//Update Page OG Image
	jQuery(document).on("click", "input#upload_image_button", function (event) {
         event.preventDefault();
         $this = jQuery(this);
         pageid = $this.data('id');
         var image_frame;
         if(image_frame){
             image_frame.open();
         }
         // Define image_frame as wp.media object
         image_frame = wp.media({
                       title: 'Select Media',
                       multiple : false,
                       library : {
                            type : 'image',
                        }
                   });
        image_frame.on('close',function() {
            // On close, get selections and save to the hidden input
           	// plus other AJAX stuff to refresh the image preview
            var selection =  image_frame.state().get('selection');
            var gallery_ids = new Array();
            var gallery_url = new Array();
            var my_index = 0;
            selection.each(function(attachment) {
            	//console.log(attachment);
                gallery_ids[my_index] = attachment['id'];
                gallery_url[my_index] = attachment['attributes']['url'];
                $this.closest('td').find('.edit_content_container input[type="text"]').attr('value',attachment['attributes']['url']);
                //Update Page OG Image
                jQuery.ajax({
			      type: 'POST',
			      url: dieno_ajax_object.ajax_url,
			      data: {
			            'action':'dieno_update_page_og_image',
			            'pageogimage' : attachment['attributes']['url'],
			            'pageid' : pageid
			        },
			        success:function(response) {
			          	dieno_pages_table.ajax.reload();
			          	$this.closest("td").find(".default_page_content").show();
			          	$this.closest("td").find(".edit_content_container").hide();
			        },
			        error: function(errorThrown){
			        }
			    });
                my_index++;
            });
            var ids = gallery_ids.join(",");
            jQuery('input#image_attachment_id').val(ids);
        });
        image_frame.on('open',function() {
            // On open, get the id from the hidden input
            // and select the appropiate images in the media manager
            var selection =  image_frame.state().get('selection');
            var ids = jQuery('input#image_attachment_id').val().split(',');
            ids.forEach(function(id) {
              var attachment = wp.media.attachment(id);
              attachment.fetch();
              selection.add( attachment ? [ attachment ] : [] );
            });
        });
        image_frame.open();
 	});
});