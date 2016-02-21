<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
?>

<style>
.section {
    margin-left: -20px;
    margin-right: -20px;
    font-family: "Raleway", san-serif;
}

.section h1 {
    text-align: center;
    text-transform: uppercase;
    color: #808a97;
    font-size: 35px;
    font-weight: 700;
    line-height: normal;
    display: inline-block;
    width: 100%;
    margin: 50px 0 0;
}

.section:nth-child(even) {
    background-color: #fff;
}

.section:nth-child(odd) {
    background-color: #f1f1f1;
}

.section .section-title img {
    display: table-cell;
    vertical-align: middle;
    width: auto;
    margin-right: 15px;
}

.section h2,
.section h3 {
    display: inline-block;
    vertical-align: middle;
    padding: 0;
    font-size: 24px;
    font-weight: 700;
    color: #808a97;
    text-transform: uppercase;
}

.section .section-title h2 {
    display: table-cell;
    vertical-align: middle;
}

.section-title {
    display: table;
}

.section h3 {
    font-size: 14px;
    line-height: 28px;
    margin-bottom: 0;
    display: block;
}

.section p {
    font-size: 13px;
    margin: 25px 0;
}

.section ul li {
    margin-bottom: 4px;
}

.landing-container {
    max-width: 750px;
    margin-left: auto;
    margin-right: auto;
    padding: 50px 0 30px;
}

.landing-container:after {
    display: block;
    clear: both;
    content: '';
}

.landing-container .col-1,
.landing-container .col-2 {
    float: left;
    box-sizing: border-box;
    padding: 0 15px;
}

.landing-container .col-1 img {
    width: 100%;
}

.landing-container .col-1 {
    width: 55%;
}

.landing-container .col-2 {
    width: 45%;
}

.premium-cta {
    background-color: #808a97;
    color: #fff;
    border-radius: 6px;
    padding: 20px 15px;
}

.premium-cta:after {
    content: '';
    display: block;
    clear: both;
}

.premium-cta p {
    margin: 7px 0;
    font-size: 14px;
    font-weight: 500;
    display: inline-block;
    width: 60%;
}

.premium-cta a.button {
    border-radius: 6px;
    height: 60px;
    float: right;
    background: url('<?php echo YWPC_URL?>assets/images/upgrade.png') #ff643f no-repeat 13px 13px;
    border-color: #ff643f;
    box-shadow: none;
    outline: none;
    color: #fff;
    position: relative;
    padding: 9px 50px 9px 70px;
}

.premium-cta a.button:hover,
.premium-cta a.button:active,
.premium-cta a.button:focus {
    color: #fff;
    background: url(<?php echo YWPC_URL?>assets/images/upgrade.png) #971d00 no-repeat 13px 13px;
    border-color: #971d00;
    box-shadow: none;
    outline: none;
}

.premium-cta a.button:focus {
    top: 1px;
}

.premium-cta a.button span {
    line-height: 13px;
}

.premium-cta a.button .highlight {
    display: block;
    font-size: 20px;
    font-weight: 700;
    line-height: 20px;
}

.premium-cta .highlight {
    text-transform: uppercase;
    background: none;
    font-weight: 800;
    color: #fff;
}

@media (max-width: 768px) {
    .section {
        margin: 0
    }

    .premium-cta p {
        width: 100%;
    }

    .premium-cta {
        text-align: center;
    }

    .premium-cta a.button {
        float: none;
    }
}

@media (max-width: 480px) {
    .wrap {
        margin-right: 0;
    }

    .section {
        margin: 0;
    }

    .landing-container .col-1,
    .landing-container .col-2 {
        width: 100%;
        padding: 0 15px;
    }

    .section-odd .col-1 {
        float: left;
        margin-right: -100%;
    }

    .section-odd .col-2 {
        float: right;
        margin-top: 65%;
    }
}

@media (max-width: 320px) {
    .premium-cta a.button {
        padding: 9px 20px 9px 70px;
    }

    .section .section-title img {
        display: none;
    }
}
</style>
<div class="landing">
<div class="section section-cta section-odd">
    <div class="landing-container">
        <div class="premium-cta">
            <p>
                <?php echo sprintf( __( 'Upgrade to the %1$spremium version%2$s
                         of %1$sYITH WooCommerce Product Countdown%2$s to benefit from all features!', 'yith-woocommerce-product-countdown' ),
                    '<span class="highlight">', '</span>' ); ?>
            </p>
            <a href="<?php echo $this->get_premium_landing_uri(); ?>" target="_blank"
               class="premium-cta-button button btn">
                <?php echo sprintf( __( '%1$s UPGRADE %2$s %3$s to the premium version %2$s', 'yith-woocommerce-product-countdown' ),
                    '<span class="highlight">', '</span>', '<span>' ); ?>
            </a>
        </div>
    </div>
</div>
<div class="section section-even clear"
     style="background: url(<?php echo YWPC_URL ?>assets/images/01-bg.png) no-repeat #fff; background-position: 85% 75%">
    <h1>Premium Features</h1>

    <div class="landing-container">
        <div class="col-1">
            <img src="<?php echo YWPC_URL ?>assets/images/01.png" alt="Icon 01"/>
        </div>
        <div class="col-2">
            <div class="section-title">
                <img src="<?php echo YWPC_URL ?>assets/images/01-icon.png" alt="Sale bar"/>
                <h2><?php _e('Sale bar','yith-woocommerce-product-countdown');?></h2>
            </div>
            <p>
                <?php echo sprintf(__('%1$sEncourage your users to purchase your products%2$s, make them want to have a rare good.
                        Choose an initial number of completed sales and the amount of available products (affected by the WooCommerce “Manage stock”, if enabled),
                        and for each sale the bar will increase its level, showing the remaining number of products.
                    ', 'yith-woocommerce-product-countdown'), '<b>', '</b>')  ?>
            </p>
        </div>
    </div>
</div>
<div class="section section-odd clear"
     style="background: url(<?php echo YWPC_URL ?>assets/images/02-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
    <div class="landing-container">
        <div class="col-2">
            <div class="section-title">
                <img src="<?php echo YWPC_URL ?>assets/images/02-icon.png" alt="Content"/>
                <h2><?php _e('Content','yith-woocommerce-product-countdown');?></h2>
            </div>
            <p>
                <?php
                echo sprintf( __('With the related option, you can choose what you want to show in the box of the plugin: %1$sthe countdown and/or the progressing sale bar%2$s. A general option suitable for all products.','yith-woocommerce-product-countdown'),'<b>','</b>');
                ?>
            </p>
        </div>
        <div class="col-1">
            <img src="<?php echo YWPC_URL ?>assets/images/02.png" alt="icon 02"/>
        </div>
    </div>
</div>
<div class="section section-even clear"
     style="background: url(<?php echo YWPC_URL ?>assets/images/03-bg.png) no-repeat #fff; background-position: 85% 100%">
    <div class="landing-container">
        <div class="col-1">
            <img src="<?php echo YWPC_URL ?>assets/images/03.png" alt="position"/>
        </div>
        <div class="col-2">
            <div class="section-title">
                <img src="<?php echo YWPC_URL ?>assets/images/03-icon.png" alt="icon 03"/>
                <h2><?php _e('Position','yith-woocommerce-product-countdown');?></h2>
            </div>
            <p>
                <?php
                echo sprintf( __( 'You have %1$sdifferent options%2$s where you can place the countdown in the product detail page and in category page.
                Before or after the title, between the tabs, or after the related products: these are only some of the solutions the plugin offers.', 'yith-woocommerce-product-countdown' ), '<b>', '</b>');
                ?>
            </p>
        </div>
    </div>
</div>
<div class="section section-odd clear"
     style="background: url(<?php echo YWPC_URL ?>assets/images/04-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
    <div class="landing-container">
        <div class="col-2">
            <div class="section-title">
                <img src="<?php echo YWPC_URL ?>assets/images/04-icon.png" alt="Icon 04"/>
                <h2><?php _e('What\'s next?','yith-woocommerce-product-countdown');?></h2>
            </div>
            <p>
                <?php echo sprintf( __('What happens when the countdown ends? %1$sDon\'t worry, the plugin leaves nothing to chance.%2$s Go to the settings panel and set the related option:
                choose if you want the product to be removed from the product catalogue, to stay visible but not purchasable,
                 or if you want to simply remove the countdown box.','yith-woocommerce-product-countdown'),'<b>','</b>'); ?>
            </p>
        </div>
        <div class="col-1">
            <img src="<?php echo YWPC_URL ?>assets/images/04.png" alt="Date time"/>
        </div>
    </div>
</div>
<div class="section section-even clear"
     style="background: url(<?php echo YWPC_URL ?>assets/images/05-bg.png) no-repeat #fff; background-position: 85% 75%">
    <div class="landing-container">
        <div class="col-1">
            <img src="<?php echo YWPC_URL ?>assets/images/05.png" alt="Shortcode and widget"/>
        </div>
        <div class="col-2">
            <div class="section-title">
                <img src="<?php echo YWPC_URL ?>assets/images/05-icon.png" alt="Icon 05"/>
                <h2><?php _e('Shortcode and widget','yith-woocommerce-product-countdown');?></h2>
            </div>
            <p>
                <?php
                echo sprintf( __('With the premium version of the pugin, you can use a %1$sshortcode%2$s and a %1$swidget%2$s to add the products with a countdown in the pages and in the sidebars of your sites.
                Set one or more product IDs and that\'s all!','yith-woocommerce-product-countdown'),'<b>','</b>');
                ?>
            </p>
        </div>
    </div>
</div>
<div class="section section-odd clear"
     style="background: url(<?php echo YWPC_URL ?>assets/images/06-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
    <div class="landing-container">
        <div class="col-2">
            <div class="section-title">
                <img src="<?php echo YWPC_URL ?>assets/images/06-icon.png" alt="Icon 06"/>
                <h2><?php _e('Tailored texts','yith-woocommerce-product-countdown');?></h2>
            </div>
            <p>
                <?php
                echo sprintf( __('A product, an expiration date, and a charming message that encourage users to purchase! Do not renounce to these details:
                %1$scustomize the messages%2$s that the plugin show to users from the settings panel.','yith-woocommerce-product-countdown'),'<b>','</b>' );
                ?>
            </p>
        </div>
        <div class="col-1">
            <img src="<?php echo YWPC_URL ?>assets/images/06.png" alt="Customize Text"/>
        </div>
    </div>
</div>
<div class="section section-even clear"
     style="background: url(<?php echo YWPC_URL ?>assets/images/07-bg.png) no-repeat #fff; background-position: 85% 75%">
    <div class="landing-container">
        <div class="col-1">
            <img src="<?php echo YWPC_URL ?>assets/images/07.png" alt="Screenshot"/>
        </div>
        <div class="col-2">
            <div class="section-title">
                <img src="<?php echo YWPC_URL ?>assets/images/07-icon.png" alt="Icon 07"/>
                <h2><?php _e('3 different layouts','yith-woocommerce-product-countdown');?></h2>
            </div>
            <p>
                <?php
                echo sprintf( __('Three different graphic styles for the countdown box of your shop products. Customize colors and use the instant preview to choose the %1$sperfect solution%2$s for your e-commerce.','yith-woocommerce-product-countdown'),'<b>','</b>');
                ?>
            </p>
        </div>
    </div>
</div>
<div class="section section-odd clear"
     style="background: url(<?php echo YWPC_URL ?>assets/images/08-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
    <div class="landing-container">
        <div class="col-2">
            <div class="section-title">
                <img src="<?php echo YWPC_URL ?>assets/images/08-icon.png" alt="icon 08"/>
                <h2><?php _e('Product groups','yith-woocommerce-product-countdown');?></h2>
            </div>
            <p>
                <?php
                echo sprintf( __('A comfortable solution that can make you spare precious time for your work.
                The plugin settings panel lets you configure %1&sdifferent countdowns for different product groups%2&s, without accessing to the product detail page.','yith-woocommerce-product-countdown'),'<b>','</b>' );
                ?>
            </p>
        </div>
        <div class="col-1">
            <img src="<?php echo YWPC_URL ?>assets/images/08.png" alt="Product Groups"/>
        </div>
    </div>
</div>
<div class="section section-even clear"
     style="background: url(<?php echo YWPC_URL ?>assets/images/09-bg.png) no-repeat #fff; background-position: 85% 100%">
    <div class="landing-container">
        <div class="col-1">
            <img src="<?php echo YWPC_URL ?>assets/images/09.png" alt="Fixed bar"/>
        </div>
        <div class="col-2">
            <div class="section-title">
                <img src="<?php echo YWPC_URL ?>assets/images/09-icon.png" alt="icon 09"/>
                <h2><?php _e('"Top bar" or "bottom bar"?','yith-woocommerce-product-countdown');?></h2>
            </div>
            <p>
                <?php
                echo sprintf( __('A fixed bar that lets you highlight a product of your shop that has already a countdown.
                Activate it, choose to display it in the top part of the bottom part of the page, and change style and texts: %1$syou will see it
                in all the pages of your site%2$s, and your users won\'t miss it!','yith-woocommerce-product-countdown'),'<b>','</b>' )
                ?>
            </p>
        </div>
    </div>
</div>
<div class="section section-odd clear"
     style="background: url(<?php echo YWPC_URL ?>assets/images/10-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
    <div class="landing-container">
        <div class="col-2">
            <div class="section-title">
                <img src="<?php echo YWPC_URL ?>assets/images/10-icon.png" alt="Icon"/>
                <h2><?php _e(' Pre-sale countdown','yith-woocommerce-product-countdown');?></h2>
            </div>
            <p>
                <?php
                echo sprintf( __('%1$sAnnounce your products before the official release%2$s, before they are concretely on sale. Set a specific countdown
                to let your users know when the product will be available. Remeber to always inform them!','yith-woocommerce-product-countdown'),'<b>','</b>' );
                ?>
            </p>
        </div>
        <div class="col-1">
            <img src="<?php echo YWPC_URL ?>assets/images/10.png" alt="Pre-sale countdown"/>
        </div>
    </div>
</div>
<div class="section section-cta section-odd">
    <div class="landing-container">
        <div class="premium-cta">
            <p>
                <?php echo sprintf( __( 'Upgrade to the %1$spremium version%2$s
                         of %1$sYITH WooCommerce Product Countdown%2$s to benefit from all features!', 'yith-woocommerce-product-countdown' ),
                    '<span class="highlight">', '</span>' ); ?>
            </p>
            <a href="<?php echo $this->get_premium_landing_uri(); ?>" target="_blank"
               class="premium-cta-button button btn">
                <?php echo sprintf( __( '%1$s UPGRADE %2$s %3$s to the premium version %2$s', 'yith-woocommerce-product-countdown' ),
                    '<span class="highlight">', '</span>', '<span>' ); ?>
            </a>
        </div>
    </div>
</div>
</div>
