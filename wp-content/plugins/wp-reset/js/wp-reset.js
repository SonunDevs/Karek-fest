/**
 * WP Reset
 * https://wpreset.com/
 * (c) WebFactory Ltd, 2017-2019
 */

jQuery(document).ready(function($) {
  // init tabs
  $('#wp-reset-tabs')
    .tabs({
      create: function() {
        $('#loading-tabs').remove();
      },
      activate: function(event, ui) {
        localStorage.setItem('wp-reset-tabs', $('#wp-reset-tabs').tabs('option', 'active'));
      },
      active: localStorage.getItem('wp-reset-tabs') || 0
    })
    .show();

  // helper for swithcing tabs & linking anchors in different tabs
  $('.tools_page_wp-reset').on('click', '.change-tab', function(e) {
    e.preventDefault();

    $('#wp-reset-tabs').tabs('option', 'active', $(this).data('tab'));

    // get the link anchor and scroll to it
    target = this.href.split('#')[1];
    if (target) {
      $.scrollTo('#' + target, 500, { offset: { top: -50, left: 0 } });
    }

    $(this).blur();
    return false;
  }); // jump to tab/anchor helper

  // helper for scrolling to anchor
  $('.tools_page_wp-reset').on('click', '.scrollto', function(e) {
    e.preventDefault();

    // get the link anchor and scroll to it
    target = this.href.split('#')[1];
    if (target) {
      $.scrollTo('#' + target, 500, { offset: { top: -50, left: 0 } });
    }

    $(this).blur();
    return false;
  }); // scroll to anchor helper

  // toggle button dropdown menu
  $('.tools_page_wp-reset').on('click', '.button.dropdown-toggle', function(e) {
    e.preventDefault();

    parent_dropdown = $(this).parent('.dropdown');
    sibling_menu = $(this).siblings('.dropdown-menu');

    $('.dropdown')
      .not(parent_dropdown)
      .removeClass('show');
    $('.dropdown-menu')
      .not(sibling_menu)
      .removeClass('show');

    $(parent_dropdown).toggleClass('show');
    $(sibling_menu).toggleClass('show');

    return false;
  }); // toggle button dropdown menu

  $(document).on('click', ':not(.dropdown-toggle), .dropdown-item', function() {
    wpr_close_dropdowns();
  });

  // delete transients
  $('.tools_page_wp-reset').on('click', '#delete-transients', 'click', function(e) {
    e.preventDefault();

    run_tool(this, 'delete_transients');

    return false;
  }); // delete transients

  // delete uploads
  $('.tools_page_wp-reset').on('click', '#delete-uploads', 'click', function(e) {
    e.preventDefault();

    run_tool(this, 'delete_uploads');

    return false;
  }); // delete uploads

  // reset theme options (mods)
  $('.tools_page_wp-reset').on('click', '#reset-theme-options', 'click', function(e) {
    e.preventDefault();

    run_tool(this, 'reset_theme_options');

    return false;
  }); // reset theme options

  // delete themes
  $('.tools_page_wp-reset').on('click', '#delete-themes', 'click', function(e) {
    e.preventDefault();

    run_tool(this, 'delete_themes');

    return false;
  }); // delete themes

  // delete plugins
  $('.tools_page_wp-reset').on('click', '#delete-plugins', 'click', function(e) {
    e.preventDefault();

    run_tool(this, 'delete_plugins');

    return false;
  }); // delete plugins

  // drop custom tables
  $('.tools_page_wp-reset').on('click', '#drop-custom-tables', 'click', function(e) {
    e.preventDefault();

    run_tool(this, 'drop_custom_tables');

    return false;
  }); // drop custom tables

  // truncate custom tables
  $('.tools_page_wp-reset').on('click', '#truncate-custom-tables', 'click', function(e) {
    e.preventDefault();

    run_tool(this, 'truncate_custom_tables');

    return false;
  }); // truncate custom tables

  // delete htaccess file
  $('.tools_page_wp-reset').on('click', '#delete-htaccess', 'click', function(e) {
    e.preventDefault();

    run_tool(this, 'delete_htaccess');

    return false;
  }); // delete htaccess file

  // compare snapshot
  $('#wpr-snapshots').on('click', '.compare-snapshot', 'click', function(e) {
    e.preventDefault();
    uid = $(this).data('ss-uid');
    button = $(this);

    block_ui($(button).data('wait-msg'));
    $.get({
      url: ajaxurl,
      data: {
        action: 'wp_reset_run_tool',
        _ajax_nonce: wp_reset.nonce_run_tool,
        tool: 'compare_snapshots',
        extra_data: uid
      }
    })
      .always(function(data) {
        swal.close();
      })
      .done(function(data) {
        if (data.success) {
          msg = $(button)
            .data('title')
            .replace('%s', $(button).data('name'));
          swal({
            width: '90%',
            title: msg,
            html: data.data,
            showConfirmButton: false,
            allowEnterKey: false,
            focusConfirm: false,
            showCloseButton: true,
            customClass: 'compare-snapshots'
          });
        } else {
          swal({
            type: 'error',
            title: wp_reset.documented_error + ' ' + data.data
          });
        }
      })
      .fail(function(data) {
        swal({ type: 'error', title: wp_reset.undocumented_error });
      });

    return false;
  }); // compare snapshot

  // restore snapshot
  $('#wpr-snapshots').on('click', '.restore-snapshot', 'click', function(e) {
    e.preventDefault();
    uid = $(this).data('ss-uid');

    run_tool(this, 'restore_snapshot', uid);

    return false;
  }); // restore snapshot

  // download snapshot
  $('#wpr-snapshots').on('click', '.download-snapshot', 'click', function(e) {
    e.preventDefault();
    uid = $(this).data('ss-uid');
    button = this;

    block_ui($(this).data('wait-msg'));
    $.get({
      url: ajaxurl,
      data: {
        action: 'wp_reset_run_tool',
        _ajax_nonce: wp_reset.nonce_run_tool,
        tool: 'download_snapshot',
        extra_data: uid
      }
    })
      .always(function(data) {
        swal.close();
      })
      .done(function(data) {
        if (data.success) {
          msg = $(button)
            .data('success-msg')
            .replace('%s', data.data);
          swal({ type: 'success', title: msg });
        } else {
          swal({
            type: 'error',
            title: wp_reset.documented_error + ' ' + data.data
          });
        }
      })
      .fail(function(data) {
        swal({ type: 'error', title: wp_reset.undocumented_error });
      });

    return false;
  }); // download snapshot

  // delete snapshot
  $('#wpr-snapshots').on('click', '.delete-snapshot', 'click', function(e) {
    e.preventDefault();
    uid = $(this).data('ss-uid');

    run_tool(this, 'delete_snapshot', uid);

    return false;
  }); // delete snapshot

  // create snapshot
  $('.tools_page_wp-reset').on('click', '.create-new-snapshot', 'click', function(e) {
    e.preventDefault();
    button = $('#create-new-snapshot-primary');
    description = $(this).data('description') || '';

    swal({
      title: $(button).data('title'),
      type: 'question',
      text: $(button).data('text'),
      input: 'text',
      inputValue: description,
      inputPlaceholder: $(button).data('placeholder'),
      showCancelButton: true,
      focusConfirm: false,
      confirmButtonText: $(button).data('btn-confirm'),
      cancelButtonText: wp_reset.cancel_button,
      width: 600
    }).then(result => {
      if (typeof result.value != 'undefined') {
        block = block_ui($(button).data('msg-wait'));
        $.get({
          url: ajaxurl,
          data: {
            action: 'wp_reset_run_tool',
            _ajax_nonce: wp_reset.nonce_run_tool,
            tool: 'create_snapshot',
            extra_data: result.value
          }
        })
          .always(function(data) {
            swal.close();
          })
          .done(function(data) {
            if (data.success) {
              swal({
                type: 'success',
                title: $(button).data('msg-success')
              }).then(result => {
                location.reload();
              });
            } else {
              swal({
                type: 'error',
                title: wp_reset.documented_error + ' ' + data.data
              });
            }
          })
          .fail(function(data) {
            swal({ type: 'error', title: wp_reset.undocumented_error });
          });
      } // if confirmed
    });

    return false;
  }); // create snapshot

  // show/hide extra table info in snapshot diff
  $('body.tools_page_wp-reset').on('click', '.header-row', function(e) {
    e.preventDefault();

    parent = $(this).parents('div.wpr-table-container > table > tbody');
    $(' > tr:not(.header-row)', parent).toggleClass('hidden');

    $('span.dashicons', parent)
      .toggleClass('dashicons-arrow-down-alt2')
      .toggleClass('dashicons-arrow-up-alt2');

    return false;
  }); // show hide extra info in diff

  // standard way of running a tool, with confirmation, loading and success message
  function run_tool(button, tool_name, extra_data) {
    var confirm_title = $(button).data('confirm-title') || wp_reset.confirm_title;

    wpr_close_dropdowns();

    confirm_action(
      confirm_title,
      $(button).data('text-confirm'),
      $(button).data('btn-confirm'),
      wp_reset.cancel_button
    ).then(result => {
      if (result.value) {
        block = block_ui($(button).data('text-wait'));
        $.get({
          url: ajaxurl,
          data: {
            action: 'wp_reset_run_tool',
            _ajax_nonce: wp_reset.nonce_run_tool,
            tool: tool_name,
            extra_data: extra_data
          }
        })
          .always(function(data) {
            swal.close();
          })
          .done(function(data) {
            if (data.success) {
              if (data.data == 1) {
                msg = $(button).data('text-done-singular');
              } else {
                msg = $(button)
                  .data('text-done')
                  .replace('%n', data.data);
              }
              swal({ type: 'success', title: msg }).then(() => {
                if (tool_name == 'restore_snapshot') {
                  location.reload();
                }
              });
              if (tool_name == 'delete_snapshot') {
                $('#wpr-ss-' + extra_data).remove();
                if ($('#wpr-snapshots tr').length <= 1) {
                  $('#wpr-snapshots').hide();
                  $('#ss-no-snapshots').show();
                }
              }
            } else {
              swal({
                type: 'error',
                title: wp_reset.documented_error + ' ' + data.data
              });
            }
          })
          .fail(function(data) {
            swal({ type: 'error', title: wp_reset.undocumented_error });
          });
      } // if confirmed
    });
  } // run_tool

  // display a message while an action is performed
  function block_ui(message) {
    tmp = swal({
      text: message,
      type: false,
      imageUrl: wp_reset.icon_url,
      onOpen: () => {
        $(swal.getImage()).addClass('rotating');
      },
      imageWidth: 100,
      imageHeight: 100,
      imageAlt: message,
      allowOutsideClick: false,
      allowEscapeKey: false,
      allowEnterKey: false,
      showConfirmButton: false
    });

    return tmp;
  } // block_ui

  // display dialog to confirm action
  function confirm_action(title, question, btn_confirm, btn_cancel) {
    tmp = swal({
      title: title,
      type: 'question',
      html: question,
      showCancelButton: true,
      focusConfirm: false,
      focusCancel: true,
      confirmButtonText: btn_confirm,
      cancelButtonText: btn_cancel,
      confirmButtonColor: '#dd3036',
      width: 600
    });

    return tmp;
  } // confirm_action

  $('#wp_reset_form').on('submit', function(e, confirmed) {
    if (!confirmed) {
      $('#wp_reset_submit').trigger('click');
      e.preventDefault();
      return false;
    }

    $(this)
      .off('submit')
      .submit();
    return true;
  }); // bypass default submit behaviour

  $('#wp_reset_submit').click(function(e) {
    if ($('#wp_reset_confirm').val() !== 'reset') {
      swal({
        title: wp_reset.invalid_confirmation_title,
        text: wp_reset.invalid_confirmation,
        type: 'error',
        confirmButtonText: wp_reset.ok_button
      });

      e.preventDefault();
      return false;
    } // wrong confirmation code

    message = wp_reset.confirm1 + '<br>' + wp_reset.confirm2;
    swal({
      title: wp_reset.confirm_title_reset,
      type: 'question',
      html: message,
      showCancelButton: true,
      focusConfirm: false,
      focusCancel: true,
      confirmButtonText: wp_reset.confirm_button,
      cancelButtonText: wp_reset.cancel_button,
      confirmButtonColor: '#dd3036',
      width: 600
    }).then(result => {
      if (result.value === true) {
        block_ui(wp_reset.doing_reset);
        $('#wp_reset_form').trigger('submit', true);
      }
    });

    e.preventDefault();
    return false;
  }); // reset submit

  // collapse / expand card
  $('.tools_page_wp-reset').on('click', '.toggle-card', function(e, skip_anim) {
    e.preventDefault();

    card = $(this)
      .parents('.card')
      .toggleClass('collapsed');
    $('.dashicons', this)
      .toggleClass('dashicons-arrow-up-alt2')
      .toggleClass('dashicons-arrow-down-alt2');
    $(this).blur();

    if (typeof skip_anim != 'undefined' && skip_anim) {
      $(card)
        .find('.card-body')
        .toggle();
    } else {
      $(card)
        .find('.card-body')
        .slideToggle(500);
    }

    cards = localStorage.getItem('wp-reset-cards');
    if (cards == null) {
      cards = new Object();
    } else {
      cards = JSON.parse(cards);
    }

    card_id = card.attr('id') || $('h4', card).attr('id') || '';

    if (card.hasClass('collapsed')) {
      cards[card_id] = 'collapsed';
    } else {
      cards[card_id] = 'expanded';
    }
    localStorage.setItem('wp-reset-cards', JSON.stringify(cards));

    return false;
  }); // toggle-card

  // init cards; collapse those that need collapsing
  cards = localStorage.getItem('wp-reset-cards');
  if (cards != null) {
    cards = JSON.parse(cards);
  }
  $.each(cards, function(card_name, card_value) {
    if (card_value == 'collapsed') {
      $('a.toggle-card', '#' + card_name).trigger('click', true);
    }
  });

  // dismiss notice / pointer
  $('.wpr-dismiss-notice').on('click', function(e) {
    notice_name = $(this).data('notice');
    if (!notice_name) {
      return true;
    }

    if ($(this).data('survey')) {
      $('#survey-dialog').dialog('close');
    }

    $.get(ajaxurl, {
      notice_name: notice_name,
      _ajax_nonce: wp_reset.nonce_dismiss_notice,
      action: 'wp_reset_dismiss_notice'
    });

    $(this)
      .parents('.notice-wrapper')
      .fadeOut();

    e.preventDefault();
    return false;
  }); // dismiss notice

  // maybe init survey dialog
  if (wp_reset.open_survey) {
    $('#survey-dialog').dialog({
      dialogClass: 'wp-dialog wpr-dialog wpr-survey-dialog',
      modal: 1,
      resizable: false,
      width: 800,
      height: 'auto',
      show: 'fade',
      hide: 'fade',
      close: function(event, ui) {},
      open: function(event, ui) {
        wpr_fix_dialog_close(event, ui);
      },
      autoOpen: true,
      closeOnEscape: true
    });
  }

  // turn questions into checkboxes
  $('.question-wrapper').on('click', function(e) {
    if ($(this).hasClass('selected')) {
      $(this).removeClass('selected');
    } else {
      if ($('.question-wrapper.selected').length >= 2) {
        swal({
          type: 'error',
          allowOutsideClick: false,
          text: 'You can choose only up to 2 features at a time.'
        });
      } else {
        $(this).addClass('selected');
      }
    }

    e.preventDefault();
    return false;
  });

  // submit and hide survey
  $('.submit-survey').on('click', function(e) {
    if ($('.question-wrapper.selected').length != 2 && $('.question-wrapper.selected').length != 1) {
      swal({
        type: 'error',
        allowOutsideClick: false,
        text: 'Please choose 1 or 2 features you would like us to build next.'
      });
      return false;
    }

    if (
      $('#survey-dialog .custom-input').val() == '' &&
      $('#survey-dialog .custom-input')
        .parents('div.question-wrapper')
        .hasClass('selected')
    ) {
      swal({
        type: 'error',
        allowOutsideClick: false,
        text: 'Please describe the custom feature you need.'
      });
      return false;
    }

    answers = '';
    $('.question-wrapper.selected').each(function(i, el) {
      answers += $(el).data('value') + ',';
    });

    $.post(ajaxurl, {
      survey: 'features',
      answers: answers,
      emailme: $('#survey-dialog #emailme:checked').val(),
      custom_answer: $('#survey-dialog .custom-input').val(),
      _ajax_nonce: wp_reset.nonce_submit_survey,
      action: 'wp_reset_submit_survey'
    });

    $('#survey-dialog').dialog('close');
    swal({
      type: 'success',
      text: 'Thank you for your time! We appriciate your input!'
    });

    e.preventDefault();
    return false;
  });

  $('.tools_page_wp-reset').on('click', '.open-webhooks-dialog', function(e) {
    $(this).blur();
    $('#webhooks-dialog').dialog('open');

    e.preventDefault();
    return false;
  });

  // webhooks dialog init
  $('#webhooks-dialog').dialog({
    dialogClass: 'wp-dialog wpr-dialog webhooks-dialog',
    modal: 1,
    resizable: false,
    title: 'WP Webhooks - Connect WordPress to any 3rd party system',
    width: 550,
    height: 'auto',
    show: 'fade',
    hide: 'fade',
    open: function(event, ui) {
      wpr_fix_dialog_close(event, ui);
      $(this)
        .siblings()
        .find('span.ui-dialog-title')
        .html(wp_reset.webhooks_dialog_title);
    },
    close: function(event, ui) {},
    autoOpen: false,
    closeOnEscape: true
  });
  $(window).resize(function(e) {
    $('#webhooks-dialog').dialog('option', 'position', {
      my: 'center',
      at: 'center',
      of: window
    });
  });

  jQuery('#install-webhooks').on('click', function(e) {
    $('#webhooks-dialog').dialog('close');
    jQuery('body').append(
      '<div style="width:550px;height:450px; position:fixed;top:10%;left:50%;margin-left:-275px; color:#444; background-color: #fbfbfb;border:1px solid #DDD; border-radius:4px;box-shadow: 0px 0px 0px 4000px rgba(0, 0, 0, 0.85);z-index: 9999999;"><iframe src="' +
        wp_reset.webhooks_install_url +
        '" style="width:100%;height:100%;border:none;" /></div>'
    );
    jQuery('#wpwrap').css('pointer-events', 'none');
    e.preventDefault();
    return false;
  });
}); // onload

function wpr_fix_dialog_close(event, ui) {
  jQuery('.ui-widget-overlay').bind('click', function() {
    jQuery('#' + event.target.id).dialog('close');
  });
} // wpr_fix_dialog_close

function wpr_close_dropdowns() {
  jQuery('.dropdown').removeClass('show');
  jQuery('.dropdown-menu').removeClass('show');
} // wpr_close_dropdowns
