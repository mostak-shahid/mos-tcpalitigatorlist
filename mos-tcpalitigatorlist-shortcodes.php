<?php
function mos_tcpalitigatorlist_form_func($atts = array(), $content = '') {
	$atts = shortcode_atts( array(
        'class' => '',
	), $atts, 'mos-tcpalitigatorlist-form' );
    ob_start(); ?>
        <div class="mos-tcpalitigatorlist-wrapper <?php echo $atts['class'] ?>">
            <form class="mos-tcpalitigatorlist-form" method="post"> 
                <?php wp_nonce_field( 'mos_tcpalitigatorlist_action', 'mos_tcpalitigatorlist_field' ); ?>           
                <div class="input-group">
                    <input type="text" name="phone" class="form-control phone" placeholder="Phone Number" required>
                    <select name="type" id="" class="form-control type">
                        <option value="all" default="1">All statuses</option>
                        <option value="tcpa" default="1">TCPA</option>
                        <option value="dnc_fed" default="0">Federal DNC</option>
                        <option value="dnc">DNC Complainers</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-mos-tcpalitigatorlist-submit" type="submit">Check</button>
                    </div>
                </div>
            </form>
            <div class="result"></div>
        </div>
        <?php if ($content) : ?>
        <?php echo do_shortcode($content) ?>
        <?php endif;?>
    <?php $html = ob_get_clean();
    return $html;
}
add_shortcode( 'mos-tcpalitigatorlist-form', 'mos_tcpalitigatorlist_form_func' );
