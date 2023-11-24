<?php
$getUrlTab = isset($_GET['th-tab']) && $_GET['th-tab'] ? sanitize_key($_GET['th-tab']) : false;
$tabActiveWl =  $getUrlTab == 'welcome' ? 'active' : '';
$tabActiveRp =  $getUrlTab == 'recommended-plugin' ? 'active' : '';
$tabActiveImportDc =  $getUrlTab == 'import-demo-content' ? 'active' : '';
$tabActiveGtChild =  $getUrlTab == 'get-child-theme' ? 'active' : '';
$tabActiveFreePRo =  $getUrlTab == 'free-vs-pro' ? 'active' : '';
$tabActiveHelp =  $getUrlTab == 'help' ? 'active' : '';
if (!$tabActiveWl && !$tabActiveRp && !$tabActiveImportDc && !$tabActiveGtChild && !$tabActiveFreePRo && !$tabActiveHelp) {
    $tabActiveWl = 'active';
}
?>

<div class="wrap-th about-wrap-th theme_info_wrapper">
    <div class="header">

        <!-- wptexturehemes-badge wp-badge-->
<div class="texture-option-area">
        <div class="texture-option-top-hdr">
            <div class="col-1">
                <div class="logo-img">
                <a target="_blank" href="<?php echo $theme_header['theme_brand_url']; ?>/?wp=bizz-ecommerce" class=""> <span class="logo-image"><?php echo $theme_header['theme_brand']; ?></span></a>
            </div>
            </div>
            <div class="col-2">
                <div class="texture-option-heading">
                    <h2><?php  echo $theme_header['welcome']; ?></h2>
                    <span><?php echo $theme_header['welcome_desc']; ?></span>
                </div>
                <span class="version"><?php echo $theme_header['v']; ?></span>
                <span><?php echo _e('FREE THEME','bizz-ecommerce'); ?></span>
            </div>
        </div>
        <div class="texture-option-bottom-hdr">
            <a class="tablinks <?php echo esc_attr($tabActiveWl) ?>" onclick="openTab(event, 'Welcome')"><?php _e('Welcome','bizz-ecommerce');?></a>
            <a class="tablinks <?php echo esc_attr($tabActiveRp) ?>" onclick="openTab(event, 'Recommended-Plugin')"><?php _e('Recommended Plugin','bizz-ecommerce');?> </a>
            <a class="tablinks <?php echo esc_attr($tabActiveImportDc) ?>" onclick="openTab(event, 'Import-Demo-Content')"><?php _e('Demo Import','bizz-ecommerce');?> </a>
        </div>

    </div>

    </div> <!-- /header -->

    </div>

<div class="content-wrap">
    <div class="main">

<div class="tab-left" >

        

        <!-- Tab content -->
        <div id="Welcome" class="tabcontent <?php echo esc_attr($tabActiveWl) ?>">
            <div class="rp-two-column welcome-tabs">
        <?php include('welcome.php' ); ?>

            </div> <!-- close twocolumn -->
        </div>


          <div id="Import-Demo-Content" class="tabcontent <?php echo esc_attr($tabActiveImportDc) ?>">

            <div class="rp-two-column">

                <div class="rcp theme_link th-row import-demo">
                    <div class="import-image">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/lib/texture-option/assets/images/import.png">
                    </div>
                <div class="title-plugin">
                <h3><?php _e('Click Here To Import Demo Content','bizz-ecommerce'); ?></h3>
				 
				 <p> <?php _e('You need to Install required plugins like- Wptexture Customizer, WooCommerce and One click demo import plugin. After installing required plugins import button will activate.', 'bizz-ecommerce'); ?></p>
              <a href="<?php echo admin_url( 'themes.php?page=one-click-demo-import' ); ?>" class="button ztabtn"><?php _e( 'Import Demo', 'bizz-ecommerce' ); ?></a>

             </div>

             </div>
             
                  
                <?php $this->plugin_install('import-demo-content'); ?>
            
            </div>

        
        </div>

        <div id="Recommended-Plugin" class="tabcontent <?php echo esc_attr($tabActiveRp) ?>">
            <div class="rp-two-column">
            <?php $this->plugin_install(); ?>
            </div>
        </div>

</div> <!-- tab div close -->



<div class="sidebar-wrap">
    <div class="sidebar">
    <?php include('sidebar.php' ); ?>
    </div>
</div>


</div>
</div>