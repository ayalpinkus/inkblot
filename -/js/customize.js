// Generated by CoffeeScript 1.9.2
(function() {
  (function($) {
    var inkblot_color, inkblot_font, inkblot_update_layout;
    wp.customize('page_background_image', function(value) {
      return value.bind(function(to) {
        return $('.wrapper').css('background-image', to ? 'url(' + to + ')' : 'none');
      });
    });
    wp.customize('page_background_repeat', function(value) {
      return value.bind(function(to) {
        return $('.wrapper').css('background-repeat', to);
      });
    });
    wp.customize('page_background_position_x', function(value) {
      return value.bind(function(to) {
        return $('.wrapper').css('background-position', 'top ' + to);
      });
    });
    wp.customize('page_background_attachment', function(value) {
      return value.bind(function(to) {
        return $('.wrapper').css('background-attachment', to);
      });
    });
    wp.customize('trim_background_image', function(value) {
      return value.bind(function(to) {
        return $('.banner nav, .banner select, .banner nav ul ul, .contentinfo, .post-webcomic nav').css('background-image', to ? 'url(' + to + ')' : 'none');
      });
    });
    wp.customize('trim_background_repeat', function(value) {
      return value.bind(function(to) {
        return $('.banner nav, .banner select, .banner nav ul ul, .contentinfo, .post-webcomic nav').css('background-repeat', to);
      });
    });
    wp.customize('trim_background_position_x', function(value) {
      return value.bind(function(to) {
        return $('.banner nav, .banner select, .banner nav ul ul, .contentinfo, .post-webcomic nav').css('background-position', 'top ' + to);
      });
    });
    wp.customize('trim_background_attachment', function(value) {
      return value.bind(function(to) {
        return $('.banner nav, .banner select, .banner nav ul ul, .contentinfo, .post-webcomic nav').css('background-attachment', to);
      });
    });
    inkblot_color = function(id, to, selectors, property) {
      var isColor, rgba;
      id = id.replace(/_/g, '-');
      isColor = -1 < id.indexOf('color');
      rgba = isColor ? _.toArray(Color(to).toRgb()) : _.toArray(Color($('wbr.inkblot').data(id.replace(/opacity/g, 'color'))).toRgb());
      if (isColor) {
        rgba.push(parseFloat($('wbr.inkblot').data(id.replace(/color/g, 'opacity'))));
      } else {
        rgba.push(to);
      }
      if (-1 < selectors.indexOf(' a')) {
        $('#inkblot-theme-inline-css').append(selectors + '{' + property + ':' + 'rgba(' + rgba.join(',') + ')' + '}');
      } else {
        $(selectors).css(property, 'rgba(' + rgba.join(',') + ')');
      }
      return $('wbr.inkblot').data(id, to);
    };
    wp.customize('background_color', function(value) {
      return value.bind(function(to) {
        return inkblot_color('background_color', to, 'body', 'background-color');
      });
    });
    wp.customize('background_opacity', function(value) {
      return value.bind(function(to) {
        return inkblot_color('background_opacity', to, 'body', 'background-color');
      });
    });
    wp.customize('page_color', function(value) {
      return value.bind(function(to) {
        return inkblot_color('page_color', to, '.wrapper, input, textarea', 'background-color');
      });
    });
    wp.customize('page_opacity', function(value) {
      return value.bind(function(to) {
        return inkblot_color('page_opacity', to, '.wrapper, input, textarea', 'background-color');
      });
    });
    wp.customize('trim_color', function(value) {
      return value.bind(function(to) {
        return inkblot_color('trim_color', to, '.banner nav, .banner ul ul, .contentinfo, .post-webcomic nav, button, input[type="submit"], input[type="reset"], input[type="button"]', 'background-color');
      });
    });
    wp.customize('trim_opacity', function(value) {
      return value.bind(function(to) {
        return inkblot_color('trim_opacity', to, '.banner nav, .banner ul ul, .contentinfo, .post-webcomic nav, button, input[type="submit"], input[type="reset"], input[type="button"]', 'background-color');
      });
    });
    wp.customize('text_color', function(value) {
      return value.bind(function(to) {
        return inkblot_color('text_color', to, 'body', 'color');
      });
    });
    wp.customize('text_opacity', function(value) {
      return value.bind(function(to) {
        return inkblot_color('text_opacity', to, 'body', 'color');
      });
    });
    wp.customize('header_textcolor', function(value) {
      return value.bind(function(to) {
        if ('blank' !== to) {
          return inkblot_color('header_textcolor', to, '.banner > a', 'color');
        }
      });
    });
    wp.customize('header_textopacity', function(value) {
      return value.bind(function(to) {
        return inkblot_color('header_textopacity', to, '.banner > a, .banner > a:focus, .banner > a:hover', 'color');
      });
    });
    wp.customize('page_text_color', function(value) {
      return value.bind(function(to) {
        return inkblot_color('page_text_color', to, '.wrapper, input, textarea', 'color');
      });
    });
    wp.customize('page_text_opacity', function(value) {
      return value.bind(function(to) {
        return inkblot_color('page_text_opacity', to, '.wrapper, input, textarea', 'color');
      });
    });
    wp.customize('trim_text_color', function(value) {
      return value.bind(function(to) {
        return inkblot_color('trim_text_color', to, '.banner nav, .banner ul ul, .contentinfo, .post-webcomic nav, button, input[type="submit"], input[type="reset"], input[type="button"]', 'color');
      });
    });
    wp.customize('trim_text_opacity', function(value) {
      return value.bind(function(to) {
        return inkblot_color('trim_text_opacity', to, '.banner nav, .banner ul ul, .contentinfo, .post-webcomic nav, button, input[type="submit"], input[type="reset"], input[type="button"]', 'color');
      });
    });
    wp.customize('link_color', function(value) {
      return value.bind(function(to) {
        return inkblot_color('link_color', to, ' a', 'color');
      });
    });
    wp.customize('link_opacity', function(value) {
      return value.bind(function(to) {
        return inkblot_color('link_opacity', to, ' a', 'color');
      });
    });
    wp.customize('link_hover_color', function(value) {
      return value.bind(function(to) {
        return inkblot_color('link_hover_color', to, 'a:focus, a:hover', 'color');
      });
    });
    wp.customize('link_hover_opacity', function(value) {
      return value.bind(function(to) {
        return inkblot_color('link_hover_opacity', to, 'a:focus, a:hover', 'color');
      });
    });
    wp.customize('page_link_color', function(value) {
      return value.bind(function(to) {
        inkblot_color('page_link_color', to, '.wrapper a, .post-footer span, nav.posts, nav.post-pages, nav.posts-paged, nav.comments-paged', 'color');
        inkblot_color('page_link_color', to, 'blockquote, hr, pre, th, td, fieldset, input, textarea, .post-footer, .comment, .comment .comment, .pingback, .trackback, .bypostauthor', 'border-color');
        inkblot_color('header_textcolor', $('wbr.inkblot').data('header-textcolor'), '.banner > a', 'color');
        return inkblot_color('trim_link_color', $('wbr.inkblot').data('trim-link-color'), '.banner nav:before, .banner nav a, .banner select, .contentinfo a, .post-webcomic nav a', 'color');
      });
    });
    wp.customize('page_link_opacity', function(value) {
      return value.bind(function(to) {
        inkblot_color('page_link_opacity', to, '.wrapper a, .post-footer span, nav.posts, nav.post-pages, nav.posts-paged, nav.comments-paged', 'color');
        inkblot_color('page_link_opacity', to, 'blockquote, hr, pre, th, td, fieldset, input, textarea, .post-footer, .comment, .comment .comment, .pingback, .trackback, .bypostauthor', 'border-color');
        inkblot_color('header_textcolor', $('wbr.inkblot').data('header-textcolor'), '.banner > a', 'color');
        return inkblot_color('trim_link_color', $('wbr.inkblot').data('trim-link-color'), '.banner nav:before, .banner nav a, .banner select, .contentinfo a, .post-webcomic nav a', 'color');
      });
    });
    wp.customize('page_link_hover_color', function(value) {
      return value.bind(function(to) {
        inkblot_color('page_link_hover_color', to, '.wrapper a:focus, .wrapper a:hover', 'color');
        inkblot_color('page_link_hover_color', to, 'input:focus, input:hover, textarea:focus, textarea:hover', 'border-color');
        inkblot_color('header_textcolor', $('wbr.inkblot').data('header-textcolor'), '.banner > a:focus, .banner > a:hover', 'color');
        return inkblot_color('trim_link_hover_color', $('wbr.inkblot').data('trim-link-hover-color'), '.banner nav:focus:before, .banner nav:hover:before, .banner nav a:focus, .banner nav a:hover, .banner select:focus, .banner select:hover, .banner li:focus > a, .banner li:hover > a, .banner li.current_page_item > a, .banner li.current_page_ancestor > a, .contentinfo a:focus, .contentinfo a:hover, .post-webcomic nav a:focus, .post-webcomic nav a:hover', 'color');
      });
    });
    wp.customize('page_link_hover_opacity', function(value) {
      return value.bind(function(to) {
        inkblot_color('page_link_hover_opacity', to, '.wrapper a:focus, .wrapper a:hover', 'color');
        inkblot_color('page_link_hover_opacity', to, 'input:focus, input:hover, textarea:focus, textarea:hover', 'border-color');
        inkblot_color('header_textcolor', $('wbr.inkblot').data('header-textcolor'), '.banner > a:focus, .banner > a:hover', 'color');
        return inkblot_color('trim_link_hover_color', $('wbr.inkblot').data('trim-link-hover-color'), '.banner nav:focus:before, .banner nav:hover:before, .banner nav a:focus, .banner nav a:hover, .banner select:focus, .banner select:hover, .banner li:focus > a, .banner li:hover > a, .banner li.current_page_item > a, .banner li.current_page_ancestor > a, .contentinfo a:focus, .contentinfo a:hover, .post-webcomic nav a:focus, .post-webcomic nav a:hover', 'color');
      });
    });
    wp.customize('trim_link_color', function(value) {
      return value.bind(function(to) {
        return inkblot_color('trim_link_color', to, '.banner nav:before, .banner nav a, .banner select, .contentinfo a, .post-webcomic nav a', 'color');
      });
    });
    wp.customize('trim_link_opacity', function(value) {
      return value.bind(function(to) {
        return inkblot_color('trim_link_opacity', to, '.banner nav:before, .banner nav a, .banner select, .contentinfo a, .post-webcomic nav a', 'color');
      });
    });
    wp.customize('trim_link_hover_color', function(value) {
      return value.bind(function(to) {
        return inkblot_color('trim_link_hover_color', to, '.banner nav:focus:before, .banner nav:hover:before, .banner nav a:focus, .banner nav a:hover, .banner select:focus, .banner select:hover, .banner li:focus > a, .banner li:hover > a, .banner li.current_page_item > a, .banner li.current_page_ancestor > a, .contentinfo a:focus, .contentinfo a:hover, .post-webcomic nav a:focus, .post-webcomic nav a:hover', 'color');
      });
    });
    wp.customize('trim_link_hover_opacity', function(value) {
      return value.bind(function(to) {
        return inkblot_color('trim_link_hover_opacity', to, '.banner nav:focus:before, .banner nav:hover:before, .banner nav a:focus, .banner nav a:hover, .banner select:focus, .banner select:hover, .banner li:focus > a, .banner li:hover > a, .banner li.current_page_item > a, .banner li.current_page_ancestor > a, .contentinfo a:focus, .contentinfo a:hover, .post-webcomic nav a:focus, .post-webcomic nav a:hover', 'color');
      });
    });
    wp.customize('css', function(value) {
      return value.bind(function(to) {
        $('head style.inkblot-custom').remove();
        if (to) {
          return $('head').append('<style class="inkblot-custom">' + to + '</style>');
        }
      });
    });
    inkblot_font = function(to, selectors) {
      if ('' === to) {
        return $(selectors).css('font-family', 'inherit');
      } else {
        $('head').append('<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=' + to + '">');
        return $(selectors).css('font-family', to.replace(/\+/g, ' ').substr(0, to.indexOf(':')));
      }
    };
    wp.customize('font_size', function(value) {
      return value.bind(function(to) {
        return $('body').css('font-size', to + '%');
      });
    });
    wp.customize('font', function(value) {
      return value.bind(function(to) {
        return inkblot_font(to, 'body');
      });
    });
    wp.customize('header_font', function(value) {
      return value.bind(function(to) {
        return inkblot_font(to, '.banner > a');
      });
    });
    wp.customize('page_font', function(value) {
      return value.bind(function(to) {
        return inkblot_font(to, '.wrapper');
      });
    });
    wp.customize('title_font', function(value) {
      return value.bind(function(to) {
        return inkblot_font(to, 'h1:not(.banner h1), h2, h3, h4, h5, h6');
      });
    });
    wp.customize('trim_font', function(value) {
      return value.bind(function(to) {
        return inkblot_font(to, '.banner nav, .banner select, .contentinfo, .post-webcomic nav');
      });
    });
    inkblot_update_layout = function() {
      var content, sidebar1, sidebar2, width;
      width = 100;
      content = $('wbr.inkblot').data('content');
      sidebar1 = Number($('wbr.inkblot').data('sidebar1-width'));
      sidebar2 = Number($('wbr.inkblot').data('sidebar2-width'));
      if (-1 !== content.indexOf('three')) {
        width -= sidebar1 + sidebar2 + 2;
      } else if (-1 !== content.indexOf('two')) {
        width -= sidebar1 + 1;
      }
      if ('three-column-center' === content) {
        $('main ').css({
          left: sidebar1 + 1 + '%',
          position: 'relative'
        });
        $('.sidebar1').css({
          left: '-' + width + '%',
          position: 'relative'
        });
      } else {
        $('main ').css({
          left: '0',
          position: 'static'
        });
        $('.sidebar1').css({
          left: '-' + width + '%',
          position: 'static'
        });
      }
      $('main').css('width', width + '%');
      $('.sidebar1').css('width', sidebar1 + '%');
      $('.sidebar2').css('width', sidebar2 + '%');
      return $('body').removeClass('one-column two-column-left two-column-right three-column-left three-column-right three-column-center').addClass(content);
    };
    wp.customize('content', function(value) {
      return value.bind(function(to) {
        $('wbr.inkblot').data('content', to);
        return inkblot_update_layout();
      });
    });
    wp.customize('sidebar1_width', function(value) {
      return value.bind(function(to) {
        $('wbr.inkblot').data('sidebar1-width', to);
        return inkblot_update_layout();
      });
    });
    wp.customize('sidebar2_width', function(value) {
      return value.bind(function(to) {
        $('wbr.inkblot').data('sidebar2-width', to);
        return inkblot_update_layout();
      });
    });
    wp.customize('min_width', function(value) {
      return value.bind(function(to) {
        return $('.wrapper, .document-header, .document-footer').css('min-width', 0 < Number(to) ? to + 'px' : '');
      });
    });
    wp.customize('max_width', function(value) {
      return value.bind(function(to) {
        return $('.wrapper, .document-header, .document-footer').css('max-width', 0 < Number(to) ? to + 'px' : '');
      });
    });
    wp.customize('blogname', function(value) {
      return value.bind(function(to) {
        return $('.banner h1').html(to);
      });
    });
    wp.customize('blogdescription', function(value) {
      return value.bind(function(to) {
        return $('.banner > a > p').html(to);
      });
    });
    wp.customize('header_textcolor', function(value) {
      return value.bind(function(to) {
        return $('.banner h1, .banner p').toggle('blank' !== to);
      });
    });
    wp.customize('webcomic_resize', function(value) {
      return value.bind(function(to) {
        return $('.post-webcomic .webcomic-image').toggleClass('scroll', !to);
      });
    });
    wp.customize('webcomic_nav_above', function(value) {
      return value.bind(function(to) {
        return $('.post-webcomic nav.above').toggle(to);
      });
    });
    return wp.customize('webcomic_nav_below', function(value) {
      return value.bind(function(to) {
        return $('.post-webcomic nav.below').toggle(to);
      });
    });
  })(jQuery);

}).call(this);
