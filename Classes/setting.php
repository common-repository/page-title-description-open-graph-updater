<?php
/**
* Menu for quick edit pages
*/
function dieno_register_quick_edit_page_setup() {
    add_menu_page( 'Quick Edit Pages', 'DDigital Quick Edit', 'edit_others_posts', 'dieno_quick_edit_pages_setting', 'dieno_quick_edit_pages', plugins_url( 'page-title-description-open-graph-updater/assets/images/edit_icon.png' ), 55 );;
}
add_action('admin_menu', 'dieno_register_quick_edit_page_setup');
function dieno_quick_edit_pages() { 
    ?>
    <div class="container quick_edit_container">
        <div class="row">
            <div class="col-sm-12 entry_meta">
                <div class="brand_logo">
                    <a href="https://www.dienodigital.com" target="_blank"><img src="<?php echo plugins_url( 'page-title-description-open-graph-updater/assets/images/dieno-digital-web.png' ); ?>"></a>
                </div>
                <h1 class="plugin_title">DDigital Page Title, Description & Open Graph Updater</h1>
                <h4 class="plugin_sub_title">Quickly update your Page Titles, Meta Descriptions, Open Graph Titles, Open Graph Descriptions and Open Graph Images below. Your Open Graph settings sets up how your pages will be displayed on social media networks. You can test this by searching for “Facebooks Debugger” tool and paste the URL of your page after updating.</h4>
                <h5 class="brand_desc">Brought to you by <a href="http://ddigitalapps.com/" target="_blank">DDigital Apps</a> a  part of <a href="http://ddigitalapps.com/" target="_blank">Dieno Digital Marketing.</a></h5>
            </div>
            <div class="col-sm-12">
                <table id="dieno_pages_list" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>OG Title</th>
                            <th>OG Description</th>
                            <th>OG Image</th>
                            <th>View Page</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <?php
}