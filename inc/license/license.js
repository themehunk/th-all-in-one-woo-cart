(function ($) {

    var ajaxUrl   = thTaiowcLicense.ajaxUrl;
    var nonce     = thTaiowcLicense.nonce;
    var siteURL   = thTaiowcLicense.siteURL;
    var i18n      = thTaiowcLicense.i18n;
    var userAgent = navigator.userAgent;
    var ipAddress = '';

    // Fetch IP once on load
    fetch('https://api.ipify.org?format=json')
        .then(function (r) { return r.json(); })
        .then(function (d) { ipAddress = d.ip; })
        .catch(function () {});

    function showNotice(msg, type) {
        var cls = type === 'success' ? 'th-notice-success' : 'th-notice-error';
        $('#th-taiowc-license-notice')
            .removeClass('th-notice-success th-notice-error')
            .addClass('th-license-notice-box ' + cls)
            .html('<p>' + msg + '</p>')
            .show();
    }

    function errorCheck(code) {
        var msg = i18n[code] || i18n.generic;
        showNotice(msg, 'error');
    }

    // Save key + expire_date locally via WP AJAX
    function saveKeyLocally(keyData, onSuccess) {
        $.post(ajaxUrl, {
            action  : 'th_taiowc_pro_site_key',
            security: nonce,
            data    : JSON.stringify({ data: keyData })
        }).done(function (res) {
            if (res && res.success) {
                onSuccess();
            } else {
                showNotice(i18n.save_failed, 'error');
            }
        }).fail(function () {
            showNotice(i18n.ajax_failed, 'error');
        });
    }

    // Reset key locally via WP AJAX
    function doReset(onSuccess) {
        $.post(ajaxUrl, {
            action  : 'th_taiowc_pro_site_key',
            security: nonce,
            data    : JSON.stringify({ data: 'reset' })
        }).done(function (res) {
            if (res && res.success) { onSuccess(); }
        }).fail(function () {
            showNotice(i18n.ajax_failed, 'error');
        });
    }

    // Activate — verify on ThemeHunk server, then save locally
    $('#th-taiowc-activate-btn').on('click', function () {
        var key = $.trim($('#th-taiowc-license-key-input').val());
        if (!key) {
            showNotice(i18n.empty_key, 'error');
            return;
        }

        var $btn     = $(this);
        var $spinner = $('#th-taiowc-activate-spinner');
        $spinner.css('visibility', 'visible');
        $btn.prop('disabled', true);

        // Step 1 — verify against ThemeHunk server
        $.get('https://themehunk.com/wp-json/ai/v1/apikey/ai-site-builder', {
            apikey   : key,
            ipAddress: ipAddress,
            siteURL  : siteURL,
            userAgent: userAgent,
            slug     : 'th-all-in-one-woo-cart-pro'
        }).done(function (response) {

            if (response && response.status === false) {
                errorCheck(response.code);
                $spinner.css('visibility', 'hidden');
                $btn.prop('disabled', false);
                return;
            }

            // Step 2 — server OK → save key + expire_date locally
            var expireDate = response.expire_date || '';
            saveKeyLocally({ key: key, expire_date: expireDate }, function () {
                var masked = key.substring(0, 5)
                    + key.substring(5, key.length - 5).replace(/./g, '*')
                    + key.slice(-5);
                $('#th-taiowc-masked-key').text(masked);
                $('#th-taiowc-expire-date').text(expireDate || '-');
                $('#th-taiowc-license-inactive').hide();
                $('#th-taiowc-license-active').show();
                showNotice(i18n.activated, 'success');
                $spinner.css('visibility', 'hidden');
                $btn.prop('disabled', false);
                // Unlock all locked tabs immediately without reload
                $(document).trigger('taiowc.license.activated');
            });

        }).fail(function () {
            showNotice(i18n.server_unreachable, 'error');
            $spinner.css('visibility', 'hidden');
            $btn.prop('disabled', false);
        });
    });

    // Reset
    $('#th-taiowc-reset-btn').on('click', function () {
        if (!confirm(i18n.reset_confirm)) { return; }

        var $btn     = $(this);
        var $spinner = $('#th-taiowc-reset-spinner');
        $spinner.css('visibility', 'visible');
        $btn.prop('disabled', true);

        doReset(function () {
            $('#th-taiowc-license-active').hide();
            $('#th-taiowc-license-inactive').show();
            $('#th-taiowc-license-key-input').val('');
            showNotice(i18n.reset_success, 'success');
            $spinner.css('visibility', 'hidden');
            $btn.prop('disabled', false);
        });
    });

    /* ------------------------------------------------------------------ */
    /* License Gate — lock tabs when license is not active / expired       */
    /* ------------------------------------------------------------------ */

    // Tabs that require an active license
    var lockedTabs = [
        'taiowc_menu_cart',
        'taiowc_fixed_cart',
        'taiowc-cart_style_set',
        'taiowc_cart',
        'taiowc_hide_cart',
        'taiowc_mobile_cart',
        'taiowc_cart_analyst'
    ];

    var isActive  = parseInt( thTaiowcLicense.isActive,  10 ) === 1;
    var isExpired = parseInt( thTaiowcLicense.isExpired, 10 ) === 1;
    var shouldLock = ! isActive; // covers both: no license AND expired

    var lockTitle = isExpired ? i18n.expired_title : i18n.lock_title;
    var lockDesc  = isExpired ? i18n.expired_desc  : i18n.lock_desc;
    var lockBtn   = isExpired ? i18n.expired_btn   : i18n.lock_btn;

    var lockOverlayHTML =
        '<div class="th-lock-overlay">' +
            '<div class="th-lock-box">' +
                '<span class="dashicons dashicons-lock th-lock-icon"></span>' +
                '<h3>' + lockTitle + '</h3>' +
                '<p>'  + lockDesc  + '</p>' +
                '<a href="#" class="button button-primary taiowc-go-to-license">' + lockBtn + '</a>' +
            '</div>' +
        '</div>';

    var lockCSS =
        'a.nav-tab.taiowc-tab-locked { opacity: .65; }' +
        'a.nav-tab.taiowc-tab-locked::after { content: "\\f160"; font-family: dashicons; font-size: 12px; margin-left: 5px; vertical-align: middle; }' +
        '.taiowc-content-locked { min-height: 200px; }' +
        '.th-lock-overlay { position: absolute; inset: 0; background: rgba(255,255,255,.85); z-index: 999; display: flex; align-items: center; justify-content: center; border-radius: 6px; }' +
        '.th-lock-box { text-align: center; padding: 32px 40px; background: #fff; border: 1px solid #e0e0e0; border-radius: 8px; box-shadow: 0 2px 12px rgba(0,0,0,.08); max-width: 360px; }' +
        '.th-lock-icon { font-size: 40px !important; width: 40px !important; height: 40px !important; color: #b0b0b0; display: block; margin: 0 auto 12px; }' +
        '.th-lock-box h3 { margin: 0 0 8px; font-size: 16px; }' +
        '.th-lock-box p  { color: #666; margin: 0 0 16px; font-size: 13px; }';

    // Inject lock CSS
    $('<style>').text( lockCSS ).appendTo( 'head' );

    // Helper: get the visible content element for a given tab ID
    function getContentEl( tab ) {
        // Cart Analytics uses an external wrapper div
        if ( tab === 'taiowc_cart_analyst' ) {
            return $( '#taiowc_cart_analys' );
        }
        return $( '#' + tab );
    }

    if ( shouldLock ) {

        lockedTabs.forEach( function ( tab ) {

            // Mark nav tab as locked
            $( "a.nav-tab[data-target='" + tab + "']" ).addClass( 'taiowc-tab-locked' );

            // Add overlay and disable inputs inside the content area
            var $content = getContentEl( tab );
            $content.addClass( 'taiowc-content-locked' ).prepend( lockOverlayHTML );
            // $content.find( 'input, select, textarea, button' ).prop( 'disabled', true );
            // $content.css({
            // 'pointer-events': 'none',
            // 'opacity': '0.6'
            //     });
        } );

        // Navigate to license tab when overlay CTA is clicked
        $( document ).on( 'click', '.taiowc-go-to-license', function ( e ) {
            e.preventDefault();
            $( "a.nav-tab[data-target='taiowc_license']" ).trigger( 'click' );
        } );

        // Keep Save/Reset buttons hidden when a locked tab is active
        // (runs after taiowc-setting.js which would otherwise show them)
        $( document ).on( 'click', '.nav-tab', function () {
            var target   = $( this ).data( 'target' );
            var isLocked = lockedTabs.indexOf( target ) !== -1;
            if ( isLocked ) {
                $( 'button#submit' ).hide();
                $( 'a.reset' ).hide();
            }
        } );

        // Page-load: if the current active tab is a locked one, hide Save/Reset
        $( document ).ready( function () {
            var $activeTab = $( 'a.nav-tab.nav-tab-active' );
            if ( $activeTab.length ) {
                var activeTarget = $activeTab.data( 'target' );
                if ( lockedTabs.indexOf( activeTarget ) !== -1 ) {
                    $( 'button#submit' ).hide();
                    $( 'a.reset' ).hide();
                }
            }
        } );

    } else {

        // License is active — ensure all content areas are enabled
        lockedTabs.forEach( function ( tab ) {
            var $content = getContentEl( tab );
            // $content.find( 'input, select, textarea, button' ).prop( 'disabled', false );
            // $content.css({
            //         'pointer-events': '',
            //         'opacity': ''
            //     });
        } );

    }

    // After successful activation — remove all locks without page reload
    $( document ).on( 'taiowc.license.activated', function () {
        lockedTabs.forEach( function ( tab ) {
            $( "a.nav-tab[data-target='" + tab + "']" ).removeClass( 'taiowc-tab-locked' );
            var $content = getContentEl( tab );
            $content.find( '.th-lock-overlay' ).remove();
            $content.removeClass( 'taiowc-content-locked' );
            // $content.find( 'input, select, textarea, button' ).prop( 'disabled', false );
            // $content.css({
            //     'pointer-events': '',
            //     'opacity': ''
            // });
        } );
        // Show Save button again on current tab
        var activeTarget = $( 'a.nav-tab.nav-tab-active' ).data( 'target' );
        if ( activeTarget !== 'taiowc_license' && activeTarget !== 'taiowc_reset' ) {
            $( 'button#submit' ).show();
        }
    } );

    /* ------------------------------------------------------------------ */
    /* Show / hide Save button + license wrapper when license tab active   */
    /* ------------------------------------------------------------------ */
    $( document ).ready( function () {

        $( '#taiowc' ).on( 'click', '.nav-tab', function () {
            var isLicenseActive = $( "a[data-target='taiowc_license']" ).hasClass( 'nav-tab-active' );
            if ( isLicenseActive ) {
                $( 'button#submit' ).hide();
                $( 'a.reset' ).hide();
                $( '#taiowc_license_wrap' ).show();
                $( '.setting-content' ).hide();
            } else {
                $( '#taiowc_license_wrap' ).hide();
            }
        } );

        // On page load — if license tab is already active
        if ( $( "a[data-target='taiowc_license']" ).hasClass( 'nav-tab-active' ) ) {
            $( 'button#submit' ).hide();
            $( 'a.reset' ).hide();
            $( '#taiowc_license_wrap' ).show();
            $( '.setting-content' ).hide();
        }

    } );

}(jQuery));
