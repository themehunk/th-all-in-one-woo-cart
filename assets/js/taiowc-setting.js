(function ($){

  "use strict";
  
    var taiowcsettingLib = {
        init: function (){
            this.bindEvents();
        },
        bindEvents: function (){
          var $this = this;
            $this.SettingTab();
            $this.ColorPickr();
            $this.ImageAdd();
            $this.SaveSetting();
            $this.ChangeSettinghideshow();
            $this.CopyToClipboard();
            $this.LiveStylePreview();
            $this.LiveTogglePreview();
            $this.LiveTextPreview();
            $this.LiveCartEffectPreview();
            $this.LiveMobileCartEffectPreview();
            $this.LiveMobileSwitcher();
            $this.HeaderResetTrigger();

        },

        HeaderResetTrigger: function () {

    $(document).on('click', 'span.reset', function (e) {
        // e.preventDefault();

        // Trigger click on Reset tab
        $("a[data-target='taiowc_reset']").trigger('click');
    });

},

        LiveMobileSwitcher: function () {

    // OPEN cart (bottom → top)
    $(document).on('click', '.live-mobile .taiowc-content', function (e) {
        e.preventDefault();

        $('.live-mobile .cart-panel-preview .cart-wrapper')
            .addClass('active');
    });

    // CLOSE cart (button / overlay)
    $(document).on('click', '.live-mobile .close-btn, .live-mobile .cart-overlay', function (e) {
        e.preventDefault();

        $('.live-mobile .cart-panel-preview .cart-wrapper')
            .removeClass('active');
    });

    // ESC key close (optional)
    $(document).on('keyup', function (e) {
        if (e.key === 'Escape') {
            $('.live-mobile .cart-panel-preview .cart-wrapper')
                .removeClass('active');
        }
    });

},

        LiveMobileCartEffectPreview: function () {

    var $mobileSelect = $('#taiowc-cart_mobile_effect-field');
    var $globalSelect = $('#taiowc-cart_effect-field');
    var $wrapper      = $('.live-mobile .cart-panel-preview .cart-wrapper');

    function applyMobileEffect() {
        var mobileEffect = $mobileSelect.val();
        var globalEffect = $globalSelect.val();

        // remove ALL effect classes
        $wrapper.removeClass(function (i, cls) {
            return (cls.match(/(taiowc-\S+|mobiletopslide)/g) || []).join(' ');
        });

        if (mobileEffect === 'mobiletopslide') {
            // mobile-only bottom slide
            $wrapper.addClass('mobiletopslide');
        } else {
            // inherit global effect
            if (globalEffect) {
                $wrapper.addClass(globalEffect);
            }
        }
    }

    // mobile effect change
    $(document).on('change', '#taiowc-cart_mobile_effect-field', function () {
        applyMobileEffect();
    });

    // global effect change (only when mobile = global)
    $(document).on('change', '#taiowc-cart_effect-field', function () {
        if ($mobileSelect.val() === 'global') {
            applyMobileEffect();
        }
    });

    // apply on page load
    $(document).ready(function () {
        applyMobileEffect();
    });

},



        LiveTogglePreview: function () {


  function applyToggle(inputId, isChecked) {

            $('[data-th-toggle="' + inputId + '"]').each(function () {

              var mode = $(this).data('th-toggle-mode') || 'show';

              if (mode === 'hide') {
                // checked = hide
                if (isChecked) {
                  $(this).hide();
                } else {
                  $(this).show();
                }
              } else {
                // default: checked = show
                if (isChecked) {
                  $(this).show();
                } else {
                  $(this).hide();
                }
              }

            });

          }


  // Live change
  $(document).on('change', 'input[type="checkbox"]', function () {
    if (!this.id) return;
    applyToggle(this.id, $(this).is(':checked'));
  });

  // Apply on page load
  $(document).ready(function () {
    $('input[type="checkbox"]').each(function () {
      if (this.id) {
        applyToggle(this.id, $(this).is(':checked'));
      }
    });
  });

},

        LiveStylePreview: function () {

function applyPreview(inputId, value) {

  /* ---------- COLORS ---------- */

  $('[data-th-bg="' + inputId + '"]').css('background-color', value);
  $('[data-th-color="' + inputId + '"]').css('color', value);
  $('[data-th-border="' + inputId + '"]').css('border-color', value);

  $('[data-th-shadow="' + inputId + '"]').each(function () {
    var shadowTpl = $(this).data('th-shadow-val');
    if (!shadowTpl) return;
    $(this).css('box-shadow', shadowTpl.replace('{color}', value));
  });

  /* ---------- NUMBERS ---------- */

  applyNumberCss('font-size', 'data-th-font-size');
  applyNumberCss('width', 'data-th-width');
  applyNumberCss('height', 'data-th-height');
  applyNumberCss('line-height', 'data-th-line-height');
  applyNumberCss('border-radius', 'data-th-radius');
  applyNumberCss('padding', 'data-th-padding');
  applyNumberCss('margin', 'data-th-margin');
  applyNumberCss('letter-spacing', 'data-th-letter-spacing');
  applyNumberCss('top', 'data-th-top');
  applyNumberCss('right', 'data-th-right');
  applyNumberCss('bottom', 'data-th-bottom');
  applyNumberCss('left', 'data-th-left');
  applyNumberCss('max-width', 'data-th-max-width');
  applyNumberCss('min-height', 'data-th-min-height');

  function applyNumberCss(cssProp, attrName) {
    $('[ ' + attrName + '="' + inputId + '" ]').each(function () {
      var unit = $(this).data('th-unit');
      unit = (unit === undefined) ? 'px' : unit;
      $(this).css(cssProp, value + unit);
    });
  }

  /* ---------- ADVANCED PROPERTIES ---------- */

// gap
$('[data-th-gap="' + inputId + '"]').each(function () {
  var unit = $(this).data('th-unit');
  unit = (unit === undefined) ? 'px' : unit;
  $(this).css('gap', value + unit);
});

// z-index
$('[data-th-z-index="' + inputId + '"]').css('z-index', value);

// opacity
$('[data-th-opacity="' + inputId + '"]').css('opacity', value);

// transform: scale
$('[data-th-transform="' + inputId + '"]').css('transform', 'scale(' + value + ')');


}




  // Listen to color picker updates
$(document).on('change keyup', '.color_picker', function () {
  var inputId = this.id;
  var value = $(this).val();
  applyPreview(inputId, value);
});

  // Listen to Number Control updates
$(document).on('input change', 'input[type="number"]', function () {
  if (this.id) {
    applyPreview(this.id, $(this).val());
  }
});



  // Apply saved values on page load
  $(document).ready(function () {
    $('.color_picker').each(function () {
      if (this.id && $(this).val()) {
        applyPreview(this.id, $(this).val());
      }
    });
  });


},

LiveTextPreview: function () {

  function applyText(inputId, value) {

    // TEXT ONLY
    $('[data-th-text="' + inputId + '"]').each(function () {
      $(this).text(value);
    });

    // HTML ALLOWED
    $('[data-th-text-html="' + inputId + '"]').each(function () {
      $(this).html(value);
    });

  }

  // Live typing
  $(document).on('input keyup change', 'input[type="text"], textarea', function () {
    if (!this.id) return;
    applyText(this.id, $(this).val());
  });

  // Apply saved values on page load
  $(document).ready(function () {
    $('input[type="text"], textarea').each(function () {
      if (this.id && $(this).val()) {
        applyText(this.id, $(this).val());
      }
    });
  });

},

LiveCartEffectPreview: function () {

    var $select = $('#taiowc-cart_effect-field');
    var $wrapper = $('.cart-wrapper');

    function applyCartEffect() {
        var selectedClass = $select.val();

        // Remove ONLY dynamic taiowc-* classes
        $wrapper.removeClass(function (index, className) {
            return (className.match(/taiowc-\S+/g) || []).join(' ');
        });

        // Add selected class
        if (selectedClass) {
            $wrapper.addClass(selectedClass);
        }
    }

    // Apply on change
    $(document).on('change', '#taiowc-cart_effect-field', function () {
        applyCartEffect();
    });

    // Apply default selected on page load
    $(document).ready(function () {
        applyCartEffect();
    });

},




        CopyToClipboard: function () {

  $(document).on('click', '.taiowc-copy-btn', function (e) {
    e.preventDefault();

    var $btn = $(this);
    var $box = $btn.closest('.shortcode-box');
    var textToCopy = $box.find('code').text().trim();

    // Modern clipboard
    if (navigator.clipboard && window.isSecureContext) {
      navigator.clipboard.writeText(textToCopy).then(function () {
        copiedFeedback($btn);
      });
    } else {
      // Fallback for old browsers / WP admin
      var $temp = $('<textarea>');
      $('body').append($temp);
      $temp.val(textToCopy).select();
      document.execCommand('copy');
      $temp.remove();
      copiedFeedback($btn);
    }

    function copiedFeedback(btn) {
      var originalText = btn.text();
      btn.text('Copied');
      btn.addClass('copied');

      setTimeout(function () {
        btn.text(originalText);
        btn.removeClass('copied');
      }, 1500);
    }
  });

},

        SettingTab: function (){
          $(document).ready(function(){ 
                  $('#taiowc').on('click', '.nav-tab', function (event){
                  event.preventDefault()
                  var target = $(this).data('target')
                  $(this).addClass('nav-tab-active').siblings().removeClass('nav-tab-active')
                  $('#' + target).show().siblings().hide()
                  $('#_last_active_tab').val(target)
                 
                  if ($("a[data-target='taiowc_reset']").hasClass('nav-tab-active')){
                        $('a.reset').show();
                        $('button#submit').hide();
                  }else{
                       $('a.reset').hide();
                       $('button#submit').show();

                  }

                  if ($("a[data-target='taiowc_cart_analyst']").hasClass('nav-tab-active')){
                    $('#taiowc_cart_analys').show();
                  }else{
                    $('#taiowc_cart_analys').hide();
                    
                  }

                  if ($("a[data-target='taiowc_license']").hasClass('nav-tab-active')){
                    $('#taiowc_license_wrap').show();
                    $('.setting-content').hide();
                    $('button#submit').hide();
                    $('a.reset').hide();
                  }else{
                    $('#taiowc_license_wrap').hide();
                  }


                   // ===== header title change =====
                  var tabText = $(this).clone().children().remove().end().text().trim();
                  $('.tabheading').text(tabText);
                  
                /* --------- DYNAMIC PREVIEW (REPLACED PART) --------- */

            var $preview = $('.setting-preview-wrap[data-tab="' + target + '"]');
            var $form = $('.setting-preview-wrap').closest('.taiowc-setting-form');

            // remove old preview classes
          
// remove ONLY dynamic preview classes
$form.removeClass(function (i, cls) {
    return (cls.match(/(^|\s)preview-\S+/g) || []).join(' ');
});
            // hide all previews
            $('.setting-preview-wrap').hide();

            // show matching preview & add dynamic class
            if ($preview.length) {
                $preview.show();
                $form.addClass('preview-' + target);
            }

                });
             });
        },
       
        ColorPickr: function () {
            function myColorPicker() {
              let value_ = this;
              const inputElement = $(value_);
              const defaultColor = inputElement.css("background-color");
              const pickr = new Pickr({
                el: value_,
                useAsButton: true,
                default: defaultColor,
                theme: "nano", // or 'monolith', or 'nano'
                swatches: [
                  "rgba(244, 67, 54, 1)",
                  "rgba(233, 30, 99, 0.95)",
                  "rgba(156, 39, 176, 0.9)",
                  "rgba(103, 58, 183, 0.85)",
                  "rgba(63, 81, 181, 0.8)",
                  "rgba(33, 150, 243, 0.75)",
                  "rgba(255, 193, 7, 1)",
                ],
                components: {
                  preview: true,
                  opacity: true,
                  hue: true,
                  interaction: {
                    input: true,
                  },
                },
              })
                .on("change", (color, instance) => {
                let color_ = color.toRGBA().toString(0);

                // update input UI + value
                inputElement.css("background-color", color_);
                inputElement.val(color_);

                // 🔥 FORCE EVENT (THIS IS THE FIX)
                inputElement.trigger('keyup');

                $("#submit").removeAttr("disabled");
              })

                .on("init", (instance) => {
                  $(instance._root.app).addClass("visible");
                })
                .on("hide", (instance) => {
                  instance._root.app.remove();
                });
            }
            $(document).on("click", "input.color_picker", myColorPicker);
          },
          
        ImageAdd:function (){
            
           $(document).on('click', '.button.taiowc_upload_image_button', function (event){
                  
                    event.preventDefault();

                    var attachment;

                    var self = $(this);

                    // Create the media frame.
                    
                    var file_frame = wp.media.frames.file_frame = wp.media({
                        title: self.data('uploader_title'),
                        button: {
                            text: self.data('uploader_button_text'),
                        },
                        multiple: false
                    });
                    file_frame.on('select', function () {
                        attachment = file_frame.state().get('selection').first().toJSON();

                        self.prev('.taiowc-icon_url').val(attachment.url);
                    });

                    // Finally, open the modal
                    file_frame.open();

                    $('#submit').removeAttr("disabled");

          });
        },
        SaveSetting:function(){

        $(document).on('keyup change paste', '.taiowc-setting-form input, .taiowc-setting-form select, .taiowc-setting-form textarea', function () {
        
              $('#submit').removeAttr("disabled");
              
        }); 

        $(document).on("click", ".taiowc-button-wrapper #submit", function (e) {

        e.preventDefault();

        $(this).addClass('loader');
        
        var form_settting = $(".taiowc-setting-form").serialize();
        $.ajax({

          url: taiowcluginObject.ajaxurl,

          type: "POST",

          data: form_settting +'&_wpnonce=' + taiowcluginObject.taiowc_nonce +'',

          success: function (response) {
           
            $('#submit').removeClass('loader');

            $('#submit').attr("disabled","disabled");

          }

        });

      });
    },
    ChangeSettinghideshow:function(){
        
           $(document).on('click', '#taiowc-show_cart-field', function (event){

                    if($(this).is(':checked')){

                      $('#taiowc-cart_style-wrapper, #taiowc-cart_open-wrapper, #taiowc-cart_styletaiowc-cart_style-section-1, .taiowc-cart_styletaiowc-cart_style-section-1').show(500);

                    }else{

                      $('#taiowc-cart_style-wrapper, #taiowc-cart_open-wrapper, #taiowc-cart_styletaiowc-cart_style-section-1, .taiowc-cart_styletaiowc-cart_style-section-1').hide(500);

                   }
                   
             });

           $(document).on('change', '#taiowc-fxd_cart_position-field', function (event){

                    if($(this).find("option:selected").val() == "fxd-left"){

                       if($("input[id=taiowc-cart_style]:checked").val() == "style-1"){
                          $('#taiowc-fxd_cart_frm_left-wrapper').show();
                          $('#taiowc-fxd_cart_frm_btm-wrapper').show();
                          $('#taiowc-fxd_cart_frm_right-wrapper').hide();
                        }
                        $(".taiowc-wrap").removeClass("fxd-right");
                        $(".taiowc-wrap").addClass("fxd-left");

                    }else{

                          if($("input[id=taiowc-cart_style]:checked").val() == "style-1"){
                          $('#taiowc-fxd_cart_frm_left-wrapper').hide();
                          $('#taiowc-fxd_cart_frm_right-wrapper').show();
                          $('#taiowc-fxd_cart_frm_btm-wrapper').show();
                        }
                        $(".taiowc-wrap").removeClass("fxd-left");
                        $(".taiowc-wrap").addClass("fxd-right");
                        

                   }
                   
             });

           // Mobile Position Settings

           $(document).on('change', '#taiowc-fxd_cart_mobile_position-field', function (event){

                if($(this).find("option:selected").val() == "fxd-left"){

                        $(".taiowc-wrap").removeClass("th-mobile-fxd-right");
                        $(".taiowc-wrap").addClass("th-mobile-fxd-left");

                    }else{

                        $(".taiowc-wrap").removeClass("th-mobile-fxd-left");
                        $(".taiowc-wrap").addClass("th-mobile-fxd-right");
                        

                   }

           });

          $(document).on('click', '#taiowc-cart-icon', function () {

              if ($("input[id=taiowc-cart-icon]:checked").val() === "icon-7") {
                  $('#taiowc-icon_url-wrapper').css('display', 'grid');
              } else {
                  $('#taiowc-icon_url-wrapper').css('display', 'none');
              }

          });

          // Image Uploader

 // Image Uploader + Live Preview (SIMPLE & SAFE)

$(document).on('click', '.taiowc-upload-drop', function () {

  var $wrap = $(this).closest('.taiowc-upload-wrap');
  var $button = $wrap.find('.taiowc_upload_image_button');
  var $input  = $wrap.find('input[type="text"]');
  var $previewImg = $wrap.find('.taiowc-upload-preview img');

  // Store old value
  var oldVal = $input.val();

  // Trigger existing uploader
  $button.trigger('click');

  // 🔥 POLL FOR VALUE CHANGE (THIS IS THE KEY)
  var checkInterval = setInterval(function () {

    var newVal = $input.val();

    if (newVal && newVal !== oldVal) {
      $previewImg.attr('src', newVal).show();
      clearInterval(checkInterval);
    }

  }, 300); // check every 300ms

});


// Remove image + live preview update (simple & safe)
$(document).on('click', '.taiowc-remove-image', function (e) {
  e.preventDefault();

  var $wrap = $(this).closest('.taiowc-upload-wrap');
  var $input = $wrap.find('input[type="text"]');
  var $previewImg = $wrap.find('.taiowc-upload-preview img');

  // Clear value
  $input.val('');

  // Hide preview
  $previewImg.attr('src', '').hide();
});


            $(document).on('click', '#taiowc-show_rld_product-field', function (event){

                    if($(this).is(':checked')){

                      $('#taiowc-product_may_like_tle-wrapper, #taiowc-choose_prdct_like-wrapper, #taiowc-product_may_like_id-wrapper, #taiowc-cart_styletaiowc-cart_style-section-3, .taiowc-cart_styletaiowc-cart_style-section-3').show(500);

                    }else{

                      $('#taiowc-product_may_like_tle-wrapper, #taiowc-choose_prdct_like-wrapper, #taiowc-product_may_like_id-wrapper, #taiowc-cart_styletaiowc-cart_style-section-3, .taiowc-cart_styletaiowc-cart_style-section-3').hide(500);

                   }
                   
             });

            $(document).on('click', '#taiowc-show_shipping-field', function (event){

                    if($(this).is(':checked')){

                      $('#taiowc-ship_txt-wrapper').show(500);

                    }else{

                      $('#taiowc-ship_txt-wrapper').hide(500);

                   }
                   
             });

            $(document).on('click', '#taiowc-show_discount-field', function (event){

                    if($(this).is(':checked')){

                      $('#taiowc-discount_txt-wrapper').show(500);

                    }else{

                      $('#taiowc-discount_txt-wrapper').hide(500);

                   }
                   
             });

            $(document).on('click', '#taiowc-show_coupon-field', function (event){

                    if($(this).is(':checked')){

                      $('#taiowc-coupon_plchdr_txt-wrapper, #taiowc-coupon_aply_txt-wrapper, #taiowc-show_coupon_list-wrapper, #taiowc-coupon_btn_txt-wrapper, #taiowc-show_added_coupon-wrapper, #taiowc-cart_styletaiowc-cart_style-section-5, .taiowc-cart_styletaiowc-cart_style-section-5').show(500);

                    }else{

                      $('#taiowc-coupon_plchdr_txt-wrapper, #taiowc-coupon_aply_txt-wrapper, #taiowc-show_coupon_list-wrapper, #taiowc-coupon_btn_txt-wrapper, #taiowc-show_added_coupon-wrapper, #taiowc-cart_styletaiowc-cart_style-section-5, .taiowc-cart_styletaiowc-cart_style-section-5').hide(500);

                   }
                   
             });

            $(document).on('click', '#taiowc-cart_pan_notify_shw-field', function (event){

                    if($(this).is(':checked')){

                      $('#taiowc-success_mgs_bg_clr-wrapper, #taiowc-success_mgs_txt_clr-wrapper, #taiowc-error_mgs_bg_clr-wrapper, #taiowc-error_mgs_txt_clr-wrapper').show(500);

                    }else{

                      $('#taiowc-success_mgs_bg_clr-wrapper, #taiowc-success_mgs_txt_clr-wrapper, #taiowc-error_mgs_bg_clr-wrapper, #taiowc-error_mgs_txt_clr-wrapper').hide(500);

                   }
                   
             });

            $(document).on('click', '#taiowc-cart_pan_icon_shw-field', function () {
              
                if ($(this).is(':checked')) {
                    $('#taiowc-cart_pan_icon_clr-wrapper')
                        .css('display', 'grid')
                       
                } else {
                    $('#taiowc-cart_pan_icon_clr-wrapper').css('display', 'none')
                }

            });



                $(document).ready(function() {
    // Function to toggle settings based on selected radio button
    function toggleSettings() {
        var selectedStyle = $("input[name='taiowc[taiowc-cart_style]']:checked").val();

        if (selectedStyle == "style-1") {
            // Show/hide left/right cart position settings based on the selected position
            if ($('#taiowc-fxd_cart_position-field').find("option:selected").val() == "fxd-left") {
                $('#taiowc-fxd_cart_frm_left-wrapper,#taiowc-fxd_cart_frm_btm-wrapper').show();
                $('#taiowc-fxd_cart_frm_right-wrapper').hide();
            } else {
                $('#taiowc-fxd_cart_frm_right-wrapper,#taiowc-fxd_cart_frm_btm-wrapper').show();
                $('#taiowc-fxd_cart_frm_left-wrapper').hide();
            }

            // Hide the third option (taiowc-click-dropdown) for style-1
            $('#taiowc-cart_effect-field option[value="taiowc-click-dropdown"]').css('display', 'none');

            // Automatically set the dropdown value to "taiowc-slide-right" when the "click-dropdown" is hidden
            if ($('#taiowc-cart_effect-field option[value="taiowc-click-dropdown"]').css('display') === 'none') {
                $('#taiowc-cart_effect-field').val('taiowc-slide-right');
            }

            // Hide the header section for style-1
            $('#taiowc-cart_fxd_2_hd-wrapper').hide();
            
        
            $(".taiowc-wrap").removeClass("style-2");
            $(".taiowc-wrap").addClass("style-1");
            // $('.taiowc-fixed-cart .taiowc-cart-item .label').remove();


        } else {
            // Show both options (taiowc-click-dropdown and taiowc-slide-right) for style-2
            $('#taiowc-cart_effect-field option[value="taiowc-click-dropdown"]').css('display', 'block');
            $('#taiowc-cart_effect-field option[value="taiowc-slide-right"]').css('display', 'block');

            // Show the header section for style-2
            $('#taiowc-cart_fxd_2_hd-wrapper').show();

            // Hide position settings (left/right) for style-2
            $('#taiowc-fxd_cart_frm_right-wrapper,#taiowc-fxd_cart_frm_left-wrapper,#taiowc-fxd_cart_frm_btm-wrapper').hide();
        
            $(".taiowc-wrap").removeClass("style-1");
            $(".taiowc-wrap").addClass("style-2");
            // $('.taiowc-fixed-cart .taiowc-cart-item').prepend('<p class="label">Cart</p>');

        }
    }

    // Bind change event on radio button to toggle settings
    $(document).on('change', "input[name='taiowc[taiowc-cart_style]']", function(event) {
        toggleSettings();  // Update settings when radio button value changes
    });

    // Call toggleSettings on page load to handle default state
    toggleSettings();  // Ensure default state is set when page loads
});

$('#taiowc_mobile_cart input,#taiowc_mobile_cart select').attr("disabled", true);


        },
        
  

}
taiowcsettingLib.init();
})(jQuery);

jQuery(document).ready(function ($) {

    $('#taiowc-toggle-sidebar').on('click', function () {

        $('#taiowc .nav-tab-wrapper').toggleClass('taiowc-sidebar-collapsed');

        // change arrow direction
        $(this).find('.dashicons')
        .toggleClass('dashicons-arrow-left-alt2 dashicons-arrow-right-alt2');

    });

       function handleSidebarOnResize() {
            if ($(window).width() <= 768) {
                $('#taiowc .nav-tab-wrapper').addClass('taiowc-sidebar-collapsed');
            } else {
                $('#taiowc .nav-tab-wrapper').removeClass('taiowc-sidebar-collapsed');
            }
        }

        // Run on load
        handleSidebarOnResize();

        // Run on resize
        $(window).on('resize', handleSidebarOnResize);


});