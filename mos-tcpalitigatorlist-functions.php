<?php
function mos_tcpalitigatorlist_admin_enqueue_scripts(){
	$page = @$_GET['page'];
	global $pagenow, $typenow;
	/*var_dump($pagenow); //options-general.php(If under settings)/edit.php(If under post type)
	var_dump($typenow); //post type(If under post type)
	var_dump($page); //mos_tcpalitigatorlist_settings(If under settings)*/
	
	if ($pagenow == 'options-general.php' AND $page == 'mos_tcpalitigatorlist_settings') {
		wp_enqueue_style( 'mos-tcpalitigatorlist-admin', plugins_url( 'css/mos-tcpalitigatorlist-admin.css', __FILE__ ) );

		//wp_enqueue_media();

		wp_enqueue_script( 'jquery' );
		
		/*Editor*/
		//wp_enqueue_style( 'docs', plugins_url( 'plugins/CodeMirror/doc/docs.css', __FILE__ ) );
		wp_enqueue_style( 'codemirror', plugins_url( 'plugins/CodeMirror/lib/codemirror.css', __FILE__ ) );
		wp_enqueue_style( 'show-hint', plugins_url( 'plugins/CodeMirror/addon/hint/show-hint.css', __FILE__ ) );

		wp_enqueue_script( 'codemirror', plugins_url( 'plugins/CodeMirror/lib/codemirror.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'css', plugins_url( 'plugins/CodeMirror/mode/css/css.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'javascript', plugins_url( 'plugins/CodeMirror/mode/javascript/javascript.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'show-hint', plugins_url( 'plugins/CodeMirror/addon/hint/show-hint.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'css-hint', plugins_url( 'plugins/CodeMirror/addon/hint/css-hint.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'javascript-hint', plugins_url( 'plugins/CodeMirror/addon/hint/javascript-hint.js', __FILE__ ), array('jquery') );
		/*Editor*/

		wp_enqueue_script( 'mos-tcpalitigatorlist-functions', plugins_url( 'js/mos-tcpalitigatorlist-functions.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'mos-tcpalitigatorlist-admin', plugins_url( 'js/mos-tcpalitigatorlist-admin.js', __FILE__ ), array('jquery') );
	}

}
add_action( 'admin_enqueue_scripts', 'mos_tcpalitigatorlist_admin_enqueue_scripts' );
function mos_tcpalitigatorlist_enqueue_scripts(){
	global $mos_tcpalitigatorlist_options;
	wp_enqueue_style( 'mos-tcpalitigatorlist', plugins_url( 'css/mos-tcpalitigatorlist.css', __FILE__ ) );
	wp_enqueue_script( 'mos-tcpalitigatorlist-functions', plugins_url( 'js/mos-tcpalitigatorlist-functions.js', __FILE__ ), array('jquery') );
	wp_enqueue_script( 'mos-tcpalitigatorlist', plugins_url( 'js/mos-tcpalitigatorlist.js', __FILE__ ), array('jquery') );
}
add_action( 'wp_enqueue_scripts', 'mos_tcpalitigatorlist_enqueue_scripts' );
function mos_tcpalitigatorlist_ajax_scripts(){
	wp_enqueue_script( 'mos-tcpalitigatorlist-ajax', plugins_url( 'js/mos-tcpalitigatorlist-ajax.js', __FILE__ ), array('jquery') );
	$ajax_params = array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'ajax_nonce' => wp_create_nonce('mos_tcpalitigatorlist_verify'),
	);
	wp_localize_script( 'mos-tcpalitigatorlist-ajax', 'ajax_obj', $ajax_params );
}
add_action( 'wp_enqueue_scripts', 'mos_tcpalitigatorlist_ajax_scripts' );
add_action( 'admin_enqueue_scripts', 'mos_tcpalitigatorlist_ajax_scripts' );

function mos_tcpalitigatorlist_scripts() {
	global $mos_tcpalitigatorlist_options;
	if (@$mos_tcpalitigatorlist_options['mos_tcpalitigatorlist_css']) {
		?>
		<style>
			<?php echo $mos_tcpalitigatorlist_options['mos_tcpalitigatorlist_css'] ?>
		</style>
		<?php
	}
	if (@$mos_tcpalitigatorlist_options['mos_tcpalitigatorlist_js']) {
		?>
		<style>
			<?php echo $mos_tcpalitigatorlist_options['mos_tcpalitigatorlist_js'] ?>
		</style>
		<?php
	}
}
add_action( 'wp_footer', 'mos_tcpalitigatorlist_scripts', 100 );