// -------------------------------------------   Start scripts function - LBF  -----------------------------------------------

  function onLoadData() {
    // Cookies
    $.cookie.json = true;
    var sessionCart = $.cookie("sessionCart");
    if (sessionCart) {}
    else {
      var sessionCart = [];
      $.cookie("sessionCart", sessionCart);
    }
    updateNotifNumber();
    updateNotifNumberXS();

    // Top button
    document.getElementById("button_to_top").className = "opacity0";
  }

  function onLoadDataSpecial() {
    // Cookies
    $.cookie.json = true;
    var sessionCart = [];
    $.cookie("sessionCart", sessionCart);
    updateNotifNumber();
    updateNotifNumberXS();
  }

  // To reload page on browser size change !!
  $(window).resize(function() {
    window.location.reload();
  });

  $(function() {
    //  changes mouse cursor when highlighting loawer right of box
    $("textarea").mousemove(function(e) {
        var myPos = $(this).offset();
        myPos.bottom = $(this).offset().top + $(this).outerHeight();
        myPos.right = $(this).offset().left + $(this).outerWidth();
        
        if (myPos.bottom > e.pageY && e.pageY > myPos.bottom - 16 && myPos.right > e.pageX && e.pageX > myPos.right - 16) {
            $(this).css({ cursor: "nw-resize" });
        }
        else {
            $(this).css({ cursor: "" });
        }
    })
    //  the following simple make the textbox "Auto-Expand" as it is typed in
    .keyup(function(e) {
        //  the following will help the text expand as typing takes place
        while($(this).outerHeight() < this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth"))) {
            $(this).height($(this).height()+1);
        };
    });
  });





  //  BEGIN SMOOTH SCROLLING

  // Anchors
  var myAnchors = ['#mainSection', '#ourProducts', '#ourRecipes', '#aboutUs', '#footerSection'];
  var myAnchorsLinksId = ['#btn_section0', '#btn_section2', '#btn_section3', '#btn_section1', '#btn_section4'];
  var side_buttons = ['btn_side_1', 'btn_side_2', 'btn_side_3', 'btn_side_4', 'btn_side_5'];
  var currentAnchor = 0;
  if (document.location.hash) {
    var the_hash = document.location.hash;
    // the_hash = the_hash.replace("#","");
    for (var i = 0; i < myAnchors.length; i++) {
      if (myAnchors[i] == the_hash) {
        currentAnchor = i;
        break;
      }
    }
  }
  changeActiveAnchor(currentAnchor);
  changeSideButton(currentAnchor);
  var currentPosition = $(window).scrollTop();


  /**
   * Get current anchor
   */
  function getCurrentAnchor() {
    // Get container scroll position
    var gap_point = window.innerHeight * 0.4;
    var currentPosition = $(window).scrollTop();
    // Get id of current scroll item
    for (var i = 0; i < myAnchors.length; i++) {
      if (Math.abs(currentPosition - $(myAnchors[i]).offset().top) < gap_point) {
        currentAnchor = i;
      }
    }
  }

  /**
   * Stick to closest anchor
   */
  // function goToClosestAnchor(){
  //   var gap_to_join = window.innerHeight * 0.2;
  //   var currentPosition = $(window).scrollTop();
  //   for (var i = 0; i < myAnchors.length; i++) {
  //     if (Math.abs(currentPosition - $(myAnchors[i]).offset().top) < gap_to_join) {
  //       currentAnchor = i;
  //     }
  //   }

  //   var idAgoToAnchor = myAnchorsLinksId[currentAnchor];
  //   // alert(idAgoToAnchor);
  //   $(idAgoToAnchor).trigger('click');
  // }
  
  /**
   * Scrolling event
   */
  $(window).scroll(function(){
    // Get current Anchor
    getCurrentAnchor();

    // // Check if user has scrolled at least 1/3 of page
    // var movedOf = window.innerHeight * 0.3;
    // var newPosition = $(window).scrollTop();
    // if (Math.abs(newPosition - currentPosition) > movedOf) {
    //   // alert(Math.abs(newPosition - currentPosition));
    //   currentPosition = newPosition;
    //   // Activate anchor MAGNET
    //   goToClosestAnchor();
    // }
    // Change Anchor active
    changeActiveAnchor(currentAnchor);
    changeSideButton(currentAnchor);
  });

  /**
   * Sliding with arrow keys, both, vertical and horizontal
   */
  $(document).keydown(function(e) {
    //preventing the scroll with arrow keys
    if(e.which == 40 || e.which == 38){
      e.preventDefault();
    }

    switch (e.which) {
      //up
      case 38:
      case 33:
        getCurrentAnchor();
        if (currentAnchor > 0) {
          currentAnchor --;
          var idAgoToAnchor = myAnchorsLinksId[currentAnchor];
          // alert(idAgoToAnchor);
          $(idAgoToAnchor).trigger('click');
        }
        break;

      //down
      case 40:
      case 34:
        getCurrentAnchor();
        if (currentAnchor < myAnchors.length - 1) {
          currentAnchor ++;
          var idAgoToAnchor = myAnchorsLinksId[currentAnchor];
          // alert(idAgoToAnchor);
          $(idAgoToAnchor).trigger('click');
        }
        break;

      // //Home
      // case 36:
      //   moveTo(1);
      //   break;

      // //End
      // case 35:
      //   moveTo( myAnchors.length );
      //   break;

      // //left
      // case 37:
      //   moveSlideLeft();
      //   break;

      // //right
      // case 39:
      //   moveSlideRight();
      //   break;

      default:
        return; // exit this handler for other keys
    }

    changeActiveAnchor(currentAnchor);
    changeSideButton(currentAnchor);

  });

  
  /**
   * Soft scrolling on click
   */
  $(document).ready(function(){ 

    var window_height = window.innerHeight;
    $('.section').css({'min-height':window_height+'px'});


    (function($) {  
      $.fn.juizScrollTo = function( speed ) { 
        if ( !speed ) var speed = 'slow';  
        
        // coeur du plugin
        return this.each( function() {  
          $(this).click( function() {  
            var goscroll = false;  
            var the_hash = $(this).attr("href");  
            var regex = new RegExp("(.*)\#(.*)","gi");

            // Check no bootstrap tabs
            // if (the_hash.indexOf('tab') > -1) {
            //   return false;
            // }

            if ( the_hash.match("\#") ) {  
              the_hash = the_hash.replace(regex,"$2");
              if($("#"+the_hash).length>0) {  
                the_element = "#" + the_hash;  
                goscroll = true;  
              }  
              else if ( $("a[name=" + the_hash + "]").length>0 ) {  
                the_element = "a[name=" + the_hash + "]";  
                goscroll = true;  
              }  
              if ( goscroll ) {  
                var container = 'body';
                $(container).animate( {  
                  scrollTop: $(the_element).offset().top  
                }, speed, function() {
                  tab_n_focus(the_hash)
                  write_hash(the_hash);
                });  

                for (var i = 0; i < myAnchors.length; i++) {
                  if (myAnchors[i] == '#'+the_hash) {
                    currentAnchor = i;
                    break;
                  }
                }
                currentPosition = $(window).scrollTop();
                changeActiveAnchor(currentAnchor);
                changeSideButton(currentAnchor);

                return false;  
              }  
            }  
          });  
        });
        
        // fonctions
        
        // écriture du hash
        function write_hash( the_hash ) {
          document.location.hash =  the_hash;
        }
        
        // accessibilité au clavier
        function tab_n_focus( the_hash ) {  
          $(the_hash).attr('tabindex','0').focus().removeAttr('tabindex');  
        }

      };  
      
      // appel de la fonction sur toutes les ancres !
      $('a').juizScrollTo('slow');
      
      // fonction de slide au chargement
      function trigger_click_for_slide() {
        var the_hash = document.location.hash;
        if ( the_hash )
          $('a[href~="'+the_hash+'"]').trigger('click');
      }
      trigger_click_for_slide();

    })(jQuery)
  });

  
  /**
   * Acivate anchor link in menu
   */
  function changeActiveAnchor(current) {
    var goToAnchor = myAnchors[current];
    // Top button
    if (goToAnchor == '#aboutUs' || goToAnchor == '#ourProducts' || goToAnchor == '#ourRecipes' || goToAnchor == '#footerSection') {
      document.getElementById("button_to_top").className = "opacity1";
    }
    else {
      document.getElementById("button_to_top").className = "opacity0";
    }
    // Active buttons
    if (goToAnchor == '#aboutUs') {
      document.getElementById("btn_section2").className = "btn btn-log";
      document.getElementById("btn_section1").className += " btn-log-active";
    }
    else if (goToAnchor == '#ourProducts') {
      document.getElementById("btn_section1").className = "btn btn-log";
      document.getElementById("btn_section2").className += " btn-log-active";
    }
    else {
      document.getElementById("btn_section1").className = "btn btn-log";
      document.getElementById("btn_section2").className = "btn btn-log";
    }
  }

  /**
   * Side buttons
   */
  function changeSideButton(current) {
    for (var i = 0; i < side_buttons.length; i++) {
      if (i == current) {
        document.getElementById(side_buttons[i]).className = "btn-side btn-side-active";
      }
      else {
        document.getElementById(side_buttons[i]).className = "btn-side";
      }
    }
    // In footer
    if (current == (side_buttons.length - 1)) {
      for (var i = 0; i < side_buttons.length; i++) {
        document.getElementById(side_buttons[i]).className += " btn-side-footer";
        if (i == current) {
          document.getElementById(side_buttons[i]).className += " btn-side-footer-active";
        }
      }
    }
  }

  // END SMOOTH SCROLLING