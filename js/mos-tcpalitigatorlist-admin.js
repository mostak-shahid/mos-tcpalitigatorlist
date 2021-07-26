jQuery(document).ready(function($) {
    $(window).load(function(){
      $('.mos-tcpalitigatorlist-wrapper .tab-con').hide();
      $('.mos-tcpalitigatorlist-wrapper .tab-con.active').show();
    });

    $('.mos-tcpalitigatorlist-wrapper .tab-nav > a').click(function(event) {
      event.preventDefault();
      var id = $(this).data('id');

      set_mos_tcpalitigatorlist_cookie('plugin_active_tab',id,1);
      $('#mos-tcpalitigatorlist-'+id).addClass('active').show();
      $('#mos-tcpalitigatorlist-'+id).siblings('div').removeClass('active').hide();

      $(this).closest('.tab-nav').addClass('active');
      $(this).closest('.tab-nav').siblings().removeClass('active');
    });
});
