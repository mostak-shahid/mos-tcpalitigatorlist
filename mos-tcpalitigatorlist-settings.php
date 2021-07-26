<?php
function mos_tcpalitigatorlist_settings_init() {
	register_setting( 'mos_tcpalitigatorlist', 'mos_tcpalitigatorlist_options' );
	add_settings_section('mos_tcpalitigatorlist_section_top_nav', '', 'mos_tcpalitigatorlist_section_top_nav_cb', 'mos_tcpalitigatorlist');
	add_settings_section('mos_tcpalitigatorlist_section_dash_start', '', 'mos_tcpalitigatorlist_section_dash_start_cb', 'mos_tcpalitigatorlist');    
    add_settings_field( 'field_username', __( 'API Username', 'mos_tcpalitigatorlist' ), 'mos_tcpalitigatorlist_field_username_cb', 'mos_tcpalitigatorlist', 'mos_tcpalitigatorlist_section_dash_start', [ 'label_for' => 'username', 'class' => 'mos_tcpalitigatorlist_row', 'mos_tcpalitigatorlist_custom_data' => 'custom', ] );
    add_settings_field( 'field_password', __( 'API Password', 'mos_tcpalitigatorlist' ), 'mos_tcpalitigatorlist_field_password_cb', 'mos_tcpalitigatorlist', 'mos_tcpalitigatorlist_section_dash_start', [ 'label_for' => 'password', 'class' => 'mos_tcpalitigatorlist_row', 'mos_tcpalitigatorlist_custom_data' => 'custom', ] );   
	add_settings_section('mos_tcpalitigatorlist_section_dash_end', '', 'mos_tcpalitigatorlist_section_end_cb', 'mos_tcpalitigatorlist');
	
	add_settings_section('mos_tcpalitigatorlist_section_scripts_start', '', 'mos_tcpalitigatorlist_section_scripts_start_cb', 'mos_tcpalitigatorlist');
	//add_settings_field( 'field_jquery', __( 'JQuery', 'mos_tcpalitigatorlist' ), 'mos_tcpalitigatorlist_field_jquery_cb', 'mos_tcpalitigatorlist', 'mos_tcpalitigatorlist_section_scripts_start', [ 'label_for' => 'jquery', 'class' => 'mos_tcpalitigatorlist_row', 'mos_tcpalitigatorlist_custom_data' => 'custom', ] );
	//add_settings_field( 'field_bootstrap', __( 'Bootstrap', 'mos_tcpalitigatorlist' ), 'mos_tcpalitigatorlist_field_bootstrap_cb', 'mos_tcpalitigatorlist', 'mos_tcpalitigatorlist_section_scripts_start', [ 'label_for' => 'bootstrap', 'class' => 'mos_tcpalitigatorlist_row', 'mos_tcpalitigatorlist_custom_data' => 'custom', ] );
	add_settings_field( 'field_css', __( 'Custom Css', 'mos_tcpalitigatorlist' ), 'mos_tcpalitigatorlist_field_css_cb', 'mos_tcpalitigatorlist', 'mos_tcpalitigatorlist_section_scripts_start', [ 'label_for' => 'mos_tcpalitigatorlist_css' ] );
	add_settings_field( 'field_js', __( 'Custom Js', 'mos_tcpalitigatorlist' ), 'mos_tcpalitigatorlist_field_js_cb', 'mos_tcpalitigatorlist', 'mos_tcpalitigatorlist_section_scripts_start', [ 'label_for' => 'mos_tcpalitigatorlist_js' ] );
	add_settings_section('mos_tcpalitigatorlist_section_scripts_end', '', 'mos_tcpalitigatorlist_section_end_cb', 'mos_tcpalitigatorlist');

}
add_action( 'admin_init', 'mos_tcpalitigatorlist_settings_init' );

function get_mos_tcpalitigatorlist_active_tab () {
	$output = array(
		'option_prefix' => admin_url() . "/options-general.php?page=mos_tcpalitigatorlist_settings&tab=",
		//'option_prefix' => "?post_type=p_file&page=mos_tcpalitigatorlist_settings&tab=",
	);
	if (isset($_GET['tab'])) $active_tab = $_GET['tab'];
	elseif (isset($_COOKIE['plugin_active_tab'])) $active_tab = $_COOKIE['plugin_active_tab'];
	else $active_tab = 'dashboard';
	$output['active_tab'] = $active_tab;
	return $output;
}
function mos_tcpalitigatorlist_section_top_nav_cb( $args ) {
	$data = get_mos_tcpalitigatorlist_active_tab ();
	?>
    <ul class="nav nav-tabs">
        <li class="tab-nav <?php if($data['active_tab'] == 'dashboard') echo 'active';?>"><a data-id="dashboard" href="<?php echo $data['option_prefix'];?>dashboard">Dashboard</a></li>
        <li class="tab-nav <?php if($data['active_tab'] == 'scripts') echo 'active';?>"><a data-id="scripts" href="<?php echo $data['option_prefix'];?>scripts">Advanced CSS, JS</a></li>
    </ul>
	<?php
}
function mos_tcpalitigatorlist_section_dash_start_cb( $args ) {
	$data = get_mos_tcpalitigatorlist_active_tab ();
  global $mos_tcpalitigatorlist_options;
	?>
	<div id="mos-tcpalitigatorlist-dashboard" class="tab-con <?php if($data['active_tab'] == 'dashboard') echo 'active';?>">
		<?php //var_dump($mos_tcpalitigatorlist_options) ?>
		<p>Use this shortcode [mos-tcpalitigatorlist-form class=""]</p>

	<?php
}
function mos_tcpalitigatorlist_field_username_cb( $args ) {
	global $mos_tcpalitigatorlist_options;
	?>
	<label for="<?php echo esc_attr( $args['label_for'] ); ?>"></label>
	<input name="mos_tcpalitigatorlist_options[<?php echo esc_attr( $args['label_for'] ); ?>]" type="input" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="mos-regular-text" value="<?php echo isset( $mos_tcpalitigatorlist_options[ $args['label_for'] ] ) ? esc_html_e($mos_tcpalitigatorlist_options[$args['label_for']]) : '';?>">
	<?php
}
function mos_tcpalitigatorlist_field_password_cb( $args ) {
	global $mos_tcpalitigatorlist_options;
	?>
	<label for="<?php echo esc_attr( $args['label_for'] ); ?>"></label>
	<input name="mos_tcpalitigatorlist_options[<?php echo esc_attr( $args['label_for'] ); ?>]" type="password" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="mos-regular-text" value="<?php echo isset( $mos_tcpalitigatorlist_options[ $args['label_for'] ] ) ? esc_html_e($mos_tcpalitigatorlist_options[$args['label_for']]) : '';?>">
	<?php
}
function mos_tcpalitigatorlist_section_scripts_start_cb( $args ) {
	$data = get_mos_tcpalitigatorlist_active_tab ();
	?>
	<div id="mos-tcpalitigatorlist-scripts" class="tab-con <?php if($data['active_tab'] == 'scripts') echo 'active';?>">
	<?php
}
function mos_tcpalitigatorlist_field_jquery_cb( $args ) {
	global $mos_tcpalitigatorlist_options;
	?>
	<label for="<?php echo esc_attr( $args['label_for'] ); ?>"><input name="mos_tcpalitigatorlist_options[<?php echo esc_attr( $args['label_for'] ); ?>]" type="checkbox" id="<?php echo esc_attr( $args['label_for'] ); ?>" value="1" <?php echo isset( $mos_tcpalitigatorlist_options[ $args['label_for'] ] ) ? ( checked( $mos_tcpalitigatorlist_options[ $args['label_for'] ], 1, false ) ) : ( '' ); ?>><?php esc_html_e( 'Yes I like to add JQuery from Plugin.', 'mos_tcpalitigatorlist' ); ?></label>
	<?php
}
function mos_tcpalitigatorlist_field_bootstrap_cb( $args ) {
	global $mos_tcpalitigatorlist_options;
	?>
	<label for="<?php echo esc_attr( $args['label_for'] ); ?>"><input name="mos_tcpalitigatorlist_options[<?php echo esc_attr( $args['label_for'] ); ?>]" type="checkbox" id="<?php echo esc_attr( $args['label_for'] ); ?>" value="1" <?php echo isset( $mos_tcpalitigatorlist_options[ $args['label_for'] ] ) ? ( checked( $mos_tcpalitigatorlist_options[ $args['label_for'] ], 1, false ) ) : ( '' ); ?>><?php esc_html_e( 'Yes I like to add JQuery from Plugin.', 'mos_tcpalitigatorlist' ); ?></label>
	<?php
}
function mos_tcpalitigatorlist_field_css_cb( $args ) {
	global $mos_tcpalitigatorlist_options;
	?>
	<textarea name="mos_tcpalitigatorlist_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" rows="10" class="regular-text"><?php echo isset( $mos_tcpalitigatorlist_options[ $args['label_for'] ] ) ? esc_html_e($mos_tcpalitigatorlist_options[$args['label_for']]) : '';?></textarea>
	<script>
    var editor = CodeMirror.fromTextArea(document.getElementById("mos_tcpalitigatorlist_css"), {
      lineNumbers: true,
      mode: "text/css",
      extraKeys: {"Ctrl-Space": "autocomplete"}
    });
	</script>
	<?php
}
function mos_tcpalitigatorlist_field_js_cb( $args ) {
	global $mos_tcpalitigatorlist_options;
	?>
	<textarea name="mos_tcpalitigatorlist_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" rows="10" class="regular-text"><?php echo isset( $mos_tcpalitigatorlist_options[ $args['label_for'] ] ) ? esc_html_e($mos_tcpalitigatorlist_options[$args['label_for']]) : '';?></textarea>
	<script>
    var editor = CodeMirror.fromTextArea(document.getElementById("mos_tcpalitigatorlist_js"), {
      lineNumbers: true,
      mode: "text/css",
      extraKeys: {"Ctrl-Space": "autocomplete"}
    });
	</script>
	<?php
}
function mos_tcpalitigatorlist_section_end_cb( $args ) {
	$data = get_mos_tcpalitigatorlist_active_tab ();
	?>
	</div>
	<?php
}


function mos_tcpalitigatorlist_options_page() {
	//add_menu_page( 'WPOrg', 'WPOrg Options', 'manage_options', 'mos_tcpalitigatorlist', 'mos_tcpalitigatorlist_options_page_html' );
	add_submenu_page( 'options-general.php', 'Settings', 'Settings', 'manage_options', 'mos_tcpalitigatorlist_settings', 'mos_tcpalitigatorlist_admin_page' );
}
add_action( 'admin_menu', 'mos_tcpalitigatorlist_options_page' );

function mos_tcpalitigatorlist_admin_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( isset( $_GET['settings-updated'] ) ) {
		add_settings_error( 'mos_tcpalitigatorlist_messages', 'mos_tcpalitigatorlist_message', __( 'Settings Saved', 'mos_tcpalitigatorlist' ), 'updated' );
	}
	settings_errors( 'mos_tcpalitigatorlist_messages' );
	?>
	<div class="wrap mos-tcpalitigatorlist-wrapper">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
		<?php
		settings_fields( 'mos_tcpalitigatorlist' );
		do_settings_sections( 'mos_tcpalitigatorlist' );
		submit_button( 'Save Settings' );
		?>
		</form>
	</div>
	<?php
}