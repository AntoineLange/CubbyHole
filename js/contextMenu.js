//Fonction Jquery contextMenu permettant de modifier le menu du clic droit de la souris
if(jQuery)( function() {
	jQuery.extend(jQuery.fn, {
		
		contextMenu: function(o, callback, onShowMenu) {
			// Valeurs par defauts.
			if( o.menu == undefined ) return false;
			if( o.inSpeed == undefined ) o.inSpeed = 150;
			if( o.addSelectedClass == undefined ) o.addSelectedClass = true;
			if( o.outSpeed == undefined ) o.outSpeed = 75;
			// 0 needs to be -1 for expected results (no fade)
			if( o.inSpeed == 0 ) o.inSpeed = -1;
			if( o.outSpeed == 0 ) o.outSpeed = -1;
			// Loop each context menu
			jQuery(this).each( function() {
				var el = jQuery(this);
				var offset = jQuery(el).offset();
				// Ajout de la classe contextMenu
				jQuery('#' + o.menu).addClass('contextMenu');
				// Simulation d'un vrai clic droit.
				jQuery(this).mousedown( function(e) {
					var evt = e;
					evt.stopPropagation();
					jQuery(this).mouseup( function(e) {
						e.stopPropagation();
						var srcElement = jQuery(this);
						srcElement.unbind('mouseup');
						if( evt.button == 2 ) {
							// Hide context menus that may be showing
							jQuery(".contextMenu").hide();
							// Get this context menu
							var menu = jQuery('#' + o.menu);
							menu.enableContextMenuItems();
							if (onShowMenu) {
								if (!onShowMenu( srcElement, menu )) {
									return false;
								}
							}
							if (!srcElement.hasClass('rowSelected')){
								jQuery("#dirsFilesTable div.item").each(function(){
									jQuery(this).removeClass('rowSelected');					
								});
								if (o.addSelectedClass) {
								    srcElement.addClass('rowSelected');
							    }
							} 
							
							var jmenu = jQuery(menu);
							if( jQuery(el).hasClass('disabled')) {
								return false;
							}
							// Detection de la position de la souris
							var d = {}, x, y;
							if( self.innerHeight ) {
								d.pageYOffset = self.pageYOffset;
								d.pageXOffset = self.pageXOffset;
								d.innerHeight = self.innerHeight;
								d.innerWidth = self.innerWidth;
							} else if( document.documentElement &&
								document.documentElement.clientHeight ) {
								d.pageYOffset = document.documentElement.scrollTop;
								d.pageXOffset = document.documentElement.scrollLeft;
								d.innerHeight = document.documentElement.clientHeight;
								d.innerWidth = document.documentElement.clientWidth;
							} else if( document.body ) {
								d.pageYOffset = document.body.scrollTop;
								d.pageXOffset = document.body.scrollLeft;
								d.innerHeight = document.body.clientHeight;
								d.innerWidth = document.body.clientWidth;
							}
							(e.pageX) ? x = e.pageX : x = e.clientX + d.scrollLeft;
							(e.pageY) ? y = e.pageY : y = e.clientY + d.scrollTop;
							
							// Affichage du menu
							jQuery(document).unbind('click');
							jmenu.css({ top: y-40, left: x-80 }).fadeIn(o.inSpeed);
							
							// Events au passage de la souris
							jmenu.find('A').mouseover( function() {
								jmenu.find('li.hover').removeClass('hover');
								if (!jQuery(this).parent().parent().hasClass('subContextMenu')) {
									 jmenu.find('ul.subContextMenu').hide();
								}
								jQuery(this).parent().addClass('hover');
								jQuery(this).parent().find('UL').css({ top: 0, left: 120 }).fadeIn(o.inSpeed);
							}).mouseout( function() {
								jmenu.find('LI.hover').removeClass('hover');
							});
							
							// Quand les items sont selectionnés
							menu.find('A').unbind('click');
							menu.find('A').bind('click', function() {
								if(jQuery(this).parent().hasClass('disabled')){
								   return false;
							    }
								jQuery(".contextMenu").hide();
								// Callback
								if (callback) {
								    callback( jQuery(this).attr('rel'), jQuery(srcElement), {x: x - offset.left, y: y - offset.top, docX: x, docY: y} );
							    }
								return false;
							});
							
							// Hide bindings
							setTimeout( function() { // Delay for Mozilla
								jQuery(document).click( function() {
									jQuery(menu).fadeOut(o.outSpeed);
								});
							}, 0);
						}
					});
				});
				
				// Disable text selection
				jQuery('#' + o.menu).attr('unselectable', 'on').css({'-webkit-user-select': 'none',
																	'-khtml-user-select': 'none',
																	'-moz-user-select': 'none',
																	'-o-user-select': 'none',
																	'-user-select': 'none'}).each(function() { this.onselectstart = function() { return false; };
				});

				// Disable browser context menu (requires both selectors to work in IE/Safari + FF/Chrome)
				jQuery(el).add(jQuery('UL.contextMenu')).bind('contextmenu', function() { return false; });
				
			});
			return jQuery(this);
		},
		
		// Disable context menu items on the fly
		disableContextMenuItems: function(o) {
			if( o == undefined ) {
				// Disable all
				jQuery(this).find('li').addClass('disabled');
				return( jQuery(this) );
			}
			jQuery(this).each( function() {
				if( o != undefined ) {
					var d = o.split(',');
					for( var i = 0; i < d.length; i++ ) {
						//alert(d[i]);
						jQuery(this).find('a[rel="' + d[i] + '"]').parent().addClass('disabled');
					}
				}
			});
			return( jQuery(this) );
		},
		
		// Enable context menu items on the fly
		enableContextMenuItems: function(o) {
			if( o == undefined ) {
				// Enable all
				jQuery(this).find('li.disabled').removeClass('disabled');
				return( jQuery(this) );
			}
			jQuery(this).each( function() {
				if( o != undefined ) {
					var d = o.split(',');
					for( var i = 0; i < d.length; i++ ) {
						jQuery(this).find('a[rel="' + d[i] + '"]').parent().removeClass('disabled');
						
					}
				}
			});
			return( jQuery(this) );
		},
		
		// Disable context menu(s)
		disableContextMenu: function() {
			jQuery(this).each( function() {
				jQuery(this).addClass('disabled');
			});
			return( jQuery(this) );
		},
		
		// Enable context menu(s)
		enableContextMenu: function() {
			jQuery(this).each( function() {
				jQuery(this).removeClass('disabled');
			});
			return( jQuery(this) );
		},
		
		// Destroy context menu(s)
		destroyContextMenu: function() {
			// Destroy specified context menus
			jQuery(this).each( function() {
				// Disable action
				jQuery(this).unbind('mousedown').unbind('mouseup');
			});
			return( jQuery(this) );
		}
		
	});
})(jQuery);