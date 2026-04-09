<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Pre-load saved key to render correct initial state without a JS flash
$_license_obj  = Taiowc_License::instance();
$_key_data     = $_license_obj->get_option_key();
$_saved_key    = isset( $_key_data['key'] )         ? $_key_data['key']         : '';
$_expire_date  = isset( $_key_data['expire_date'] ) ? $_key_data['expire_date'] : '';
$_has_key      = ! empty( $_saved_key );
$_is_expired   = Taiowc_License::is_expired();
$_is_active    = Taiowc_License::is_active();
$_masked_key   = $_has_key
    ? ( substr( $_saved_key, 0, 5 ) . str_repeat( '*', max( 0, strlen( $_saved_key ) - 10 ) ) . substr( $_saved_key, -5 ) )
    : '';
?>

<div class="th-license-wrap">

    <!-- Notice area -->
    <div id="th-taiowc-license-notice" style="display:none;"></div>

    <!-- Active / Expired state (key exists) -->
    <div id="th-taiowc-license-active" <?php echo $_has_key ? '' : 'style="display:none;"'; ?>>
        <div class="blocks">
            <div class="th-license-status-box">
                <span class="bold-heading"><?php esc_html_e( 'License Status', 'taiowc' ); ?></span>
                <div class="th-license-info">
                    <div class="th-license-row">
                        <span class="th-license-label"><?php esc_html_e( 'Your License Key :', 'taiowc' ); ?></span>
                        <span class="th-license-value">
                            <code id="th-taiowc-masked-key"><?php echo esc_html( $_masked_key ); ?></code>
                            <button id="th-taiowc-reset-btn" class="th-license-reset-btn">
                                <?php esc_html_e( 'RESET', 'taiowc' ); ?>
                            </button>
                            <span id="th-taiowc-reset-spinner" class="spinner" style="float:none;visibility:hidden;"></span>
                        </span>
                    </div>
                    <div class="th-license-row">
                        <span class="th-license-label"><?php esc_html_e( 'License Status :', 'taiowc' ); ?></span>
                        <span class="th-license-value">
                            <?php if ( $_is_expired ) : ?>
                                <span class="th-badge th-badge-expired"><?php esc_html_e( 'EXPIRED', 'taiowc' ); ?></span>
                            <?php else : ?>
                                <span class="th-badge th-badge-active"><?php esc_html_e( 'ACTIVE', 'taiowc' ); ?></span>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="th-license-row">
                        <span class="th-license-label"><?php esc_html_e( 'Domain Name :', 'taiowc' ); ?></span>
                        <span class="th-license-value"><?php echo esc_html( home_url() ); ?></span>
                    </div>
                    <?php if ( $_expire_date ) : ?>
                    <div class="th-license-row">
                        <span class="th-license-label"><?php esc_html_e( 'Valid Till :', 'taiowc' ); ?></span>
                        <span class="th-license-value <?php echo $_is_expired ? 'th-expired-date' : ''; ?>" id="th-taiowc-expire-date">
                            <?php echo esc_html( $_expire_date ); ?>
                        </span>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if ( $_is_expired ) : ?>
                    <p class="th-license-expired-msg">
                        <?php esc_html_e( 'Your license has expired. Please renew to re-enable all features.', 'taiowc' ); ?>
                        <a href="<?php echo esc_url( 'https://themehunk.com/th-all-in-one-woo-cart/' ); ?>" target="_blank" rel="noopener noreferrer">
                            <?php esc_html_e( 'Renew License', 'taiowc' ); ?>
                        </a>
                    </p>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <!-- Inactive state (no key at all) -->
    <div id="th-taiowc-license-inactive" <?php echo $_has_key ? 'style="display:none;"' : ''; ?>>
        <div class="blocks">
            <div class="th-license-activate-box">
                <span class="bold-heading"><?php esc_html_e( 'Activate License', 'taiowc' ); ?></span>
                <p class="th-color-title"><?php esc_html_e( 'Enter your license key to unlock all Pro features of TH All In One Woo Cart.', 'taiowc' ); ?></p>
                <div class="th-license-input-row">
                    <input type="text"
                           id="th-taiowc-license-key-input"
                           class="regular-text"
                           placeholder="<?php esc_attr_e( 'Enter your license key', 'taiowc' ); ?>" />
                    <button id="th-taiowc-activate-btn" class="button button-primary link_">
                        <?php esc_html_e( 'Activate', 'taiowc' ); ?>
                    </button>
                    <span id="th-taiowc-activate-spinner" class="spinner" style="float:none;visibility:hidden;"></span>
                </div>
                <a href="<?php echo esc_url( 'https://themehunk.com/license' ); ?>" class="link_" target="_blank" rel="noopener noreferrer">
                    <?php esc_html_e( 'Find Your License Key', 'taiowc' ); ?>
                </a>
            </div>

            <div>
                <span class="bold-heading"><?php esc_html_e( 'Get a License Key', 'taiowc' ); ?></span>
                <p class="th-color-title"><?php esc_html_e( 'Purchase a license to get your key and activate all Pro features.', 'taiowc' ); ?></p>
                <a href="<?php echo esc_url( 'https://themehunk.com/th-all-in-one-woo-cart/' ); ?>" class="link_" target="_blank" rel="noopener noreferrer">
                    <?php esc_html_e( 'Buy License', 'taiowc' ); ?>
                </a>
            </div>
        </div>
    </div>

</div><!-- .th-license-wrap -->

<style>
.th-license-wrap .th-license-info           { margin:14px 0; }
.th-license-wrap .th-license-row            { display:flex; gap:16px; margin-bottom:12px; align-items:center; }
.th-license-wrap .th-license-label          { font-weight:700; min-width:140px; color:#23282d; }
.th-license-wrap .th-license-input-row      { display:flex; gap:10px; align-items:center; margin:12px 0; }
.th-license-wrap .th-license-input-row input{ flex:1; max-width:380px; }
.th-license-wrap .th-license-notice-box     { padding:10px 15px; border-radius:4px; margin-bottom:16px; }
.th-license-wrap .th-notice-success         { background:#edfaef; border-left:4px solid #46b450; }
.th-license-wrap .th-notice-error           { background:#fdf0f0; border-left:4px solid #dc3232; }
/* Badges */
.th-badge                                   { display:inline-block; padding:4px 14px; border-radius:4px; font-weight:700; font-size:12px; letter-spacing:.5px; }
.th-badge-active                            { background:#d4edda; color:#2e7d32; border:1px solid #46b450; }
.th-badge-expired                           { background:#fdecea; color:#c62828; border:1px solid #dc3232; }
/* Reset button */
.th-license-reset-btn                       { background:#e53935; color:#fff; border:none; border-radius:3px; padding:4px 12px; font-size:12px; font-weight:700; cursor:pointer; margin-left:10px; letter-spacing:.5px; }
.th-license-reset-btn:hover                 { background:#c62828; color:#fff; }
/* Expired date */
.th-expired-date                            { color:#c62828; font-weight:600; }
/* Expired message */
.th-license-expired-msg                     { margin-top:12px; color:#c62828; font-size:13px; }
.th-license-expired-msg a                   { margin-left:6px; font-weight:600; }
/* Wrapper */
#taiowc_license_wrap                       { padding:20px; transform: translateY(50%);}
#taiowc_license_wrap .blocks               { display:flex; flex-wrap:wrap; flex-direction:column; gap:24px; padding: 21px; }
#taiowc_license_wrap .th-license-status-box,
#taiowc_license_wrap .th-license-activate-box { background:#fff; border-radius:8px; flex:1; min-width:280px; }
#taiowc_license_wrap .bold-heading         { font-size:15px; font-weight:700; display:block; margin-bottom:8px; }
#taiowc_license_wrap .th-color-title       { color:#555; font-size:13px; margin-bottom:0; }
.th-license-wrap a{ text-decoration: none; }
</style>
