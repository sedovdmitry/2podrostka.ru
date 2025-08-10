/*
    Resize plugin.
    Grabs appropriately sized image from the server, with noscript fallback and error handling
    Author: Gavyn McKenzie @ Etch Apps
    Requires: jQuery, smartresize

    - Find the images in the dom
    - Get their size and src
    - Post them to the server
    - Populate the image tags on reply
*/


(function() {
  var crispy;

  crispy = {
    els: ".js-crispy",
    images: [],
    breakpoints: [
      "32em", 
      "48em", 
      "62em", 
      "76em"
    ],

    init: function() {
      this.currentBreakpoint = this.getCurrentBreakpoint();
      this.gather();
      this.bind();
    },

    bind: function() {
      var _this = this;
      $(window).smartresize(function() {
        _this.refreshImages();
      });
    },

    windowWidth: function() {
      return $(window).width() / Number($("body").css("font-size"));
    },

    getCurrentBreakpoint: function() {
      var bp, breakpoint, _fn, _i, _len, _ref,
        _this = this;
      bp = this.breakpoints[0];
      _ref = this.breakpoints;
      _fn = function(breakpoint) {
        if (window.matchMedia && window.matchMedia("all and (min-width: " + breakpoint + ")").matches) {
          return bp = breakpoint;
        }
      };
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        breakpoint = _ref[_i];
        _fn(breakpoint);
      }
      return bp;
    },

    testBreakpointChange: function() {
      var bp;
      bp = this.getCurrentBreakpoint();
      if (this.currentBreakpoint === bp) {
        return false;
      } else {
        this.currentBreakpoint = bp;
        return true;
      }
    },

    refreshImages: function() {
      if (this.testBreakpointChange()) {
        this.gather();
      }
    },

    gather: function() {
      var el, els, _i, _len;
      els = $(this.els);
      this.images = [];
      for (_i = 0, _len = els.length; _i < _len; _i++) {
        el = els[_i];
        this.add(el);
      }
      this.grabFromServer();
    },

    add: function(image) {
      image = $(image);
      this.images.push({
        src: image.attr("data-src"),
        width: image.width()
      });
    },

    buildQuery: function() {
      var image = { image: this.images }
      return $.param(image);
    },

    grabFromServer: function() {
      var data,
        _this = this;
      data = this.buildQuery();
      $.get("resize.php", data, function(data) {
          var image, _i, _len;
          for (_i = 0, _len = data.length; _i < _len; _i++) {
            image = data[_i];
            _this.loadImage(image);
          }
        }
      );
    },

    loadImage: function(image) {
      var el, img,
        _this = this;
      el = $("[data-src='" + image.og_src + "']");
      img = $("<img />");
      img.attr("src", image.src).attr("alt", el.attr("data-alt"));
      if (el.children("img").length) {
        el.children("img").attr("src", image.src);
      } else {
        img.load(function() {
          el.append(img);
          el.addClass('img-loaded');
        });
      }
    }
  };

  $(document).ready(function() {
    crispy.init();
  });

}).call(this);
