jQuery(document).ready(function () {
    
    // Sticky Header JS
    var newsIndex = []; 
    for(var i=0, len=localStorage.length; i<len; i++){
        var key = localStorage.key(i);
        if(key == null) continue;
        var value = localStorage[key];
        if(key.search('news_section') >= 0){
            newsIndex.push(key);
        }
    }
    for(var i = 0 ; i <= newsIndex.length; i ++){
        localStorage.removeItem(newsIndex[i]);
    }

    jQuery('.ecommerce-shop-products-tab').on('click', 'li.ecommerce-shop-products-tabs-title', function(e) {
        e.preventDefault();
        var select_category_id = jQuery( this ).attr( 'select_category_id' );
        var tab_product_count = jQuery( this ).attr('tab_product_count');

        var widget = jQuery(this).closest(".news_class");

        var id = jQuery(widget).attr('id');

        var storage_id = id + "-" +select_category_id;

        var data = localStorage.getItem(storage_id);

        var that = jQuery( this );

        var buzz_ecommerce_ajaxtab_content = that.closest(".products-tab-wraper").find(".products-tab-section");

        jQuery.ajax({
            url : BuzzEcommerce.ajaxurl,
            type : 'post',
            data : {
                action : 'category_tab_products',
                post_id : select_category_id,
                prduct_count : tab_product_count,
            },
            success : function( response ) {
                setTimeout(function() {
                    localStorage.setItem(storage_id, data);
                    jQuery(buzz_ecommerce_ajaxtab_content).html(response);

                }, 1000);

            },
            beforeSend: function() {
                jQuery(buzz_ecommerce_ajaxtab_content).html('<div class="ajax-call-buzz-ecommerce"><svg width="200px"  height="200px"  xmlns="" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-eclipse" style="background: none;"><path ng-attr-d="{{config.pathCmd}}" ng-attr-fill="{{config.color}}" stroke="none" d="M10 50A40 40 0 0 0 90 50A40 42 0 0 1 10 50" fill="#e86785" transform="rotate(233.818 50 51)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 51;360 50 51" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform></path></svg></div>');
            },
        
        });
                    
    });     
});
