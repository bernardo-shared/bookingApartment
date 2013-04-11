/*
jQWidgets v2.8.0 (2013-Mar-22)
Copyright (c) 2011-2013 jQWidgets.
License: http://jqwidgets.com/license/
*/

(function(a){a.jqx.jqxWidget("jqxMenu","",{});a.extend(a.jqx._jqxMenu.prototype,{defineInstance:function(){this.items=new Array();this.mode="horizontal";this.width=null;this.height=null;this.easing="easeInOutSine";this.animationShowDuration=200;this.animationHideDuration=200;this.autoCloseInterval=0;this.animationHideDelay=100;this.animationShowDelay=100;this.menuElements=new Array();this.autoSizeMainItems=false;this.autoCloseOnClick=true;this.autoCloseOnMouseLeave=true;this.enableRoundedCorners=true;this.disabled=false;this.autoOpenPopup=true;this.enableHover=true;this.autoOpen=true;this.autoGenerate=true;this.clickToOpen=false;this.showTopLevelArrows=false;this.touchMode="auto";this.source=null;this.popupZIndex=20000;this.rtl=false;this.events=["shown","closed","itemclick","initialized"]},createInstance:function(d){var c=this;this.host.css("display","block");this.propertyChangeMap.disabled=function(h,k,j,l){if(c.disabled){c.host.addClass(c.toThemeProperty("jqx-fill-state-disabled"));c.host.addClass(c.toThemeProperty("jqx-menu-disabled"))}else{c.host.removeClass(c.toThemeProperty("jqx-fill-state-disabled"));c.host.removeClass(c.toThemeProperty("jqx-menu-disabled"))}};this.setSize();var b=false;var f=this;if(f.width!=null&&f.width.toString().indexOf("%")!=-1){b=true}if(f.height!=null&&f.height.toString().indexOf("%")!=-1){b=true}this.addHandler(a(window),"resize.menu"+this.element.id,function(){if(b){if(f.refreshTimer){clearTimeout(f.refreshTimer)}f.refreshTimer=setTimeout(function(){f.refresh()},1)}});if(b){setInterval(function(){var j=f.host.width();var h=f.host.height();if(f._lastWidth!=j||f._lastHeight!=h){f.refresh()}f._lastWidth=j;f._lastHeight=h},100)}if(this.disabled){this.host.addClass(this.toThemeProperty("jqx-fill-state-disabled"));this.host.addClass(this.toThemeProperty("jqx-menu-disabled"))}this.host.attr("tabIndex",1);this.host.css("outline","none");if(this.source){if(this.source!=null){var e=this.loadItems(this.source);this.element.innerHTML=e}}if(this.element.innerHTML.indexOf("UL")){var g=this.host.find("ul:first");if(g.length>0){this._createMenu(g[0])}}this.host.data("autoclose",{});this._render();var f=this;if(a.jqx.browser.msie&&a.jqx.browser.version<8){this.host.attr("hideFocus",true)}},focus:function(){try{this.host.focus()}catch(b){}},loadItems:function(c,e){if(c==null){return}if(c.length==0){return""}var b=this;this.items=new Array();var d="<ul>";if(e){d='<ul style="width:'+e+';">'}a.map(c,function(f){if(f==undefined){return null}d+=b._parseItem(f)});d+="</ul>";return d},_parseItem:function(f){var c="";if(f==undefined){return null}var b=f.label;if(!f.label&&f.html){b=f.html}if(!b){b="Item"}if(typeof f==="string"){b=f}var e=false;if(f.selected!=undefined&&f.selected){e=true}var d=false;if(f.disabled!=undefined&&f.disabled){d=true}c+="<li";if(d){c+=' item-disabled="true" '}if(f.label&&!f.html){c+=' item-label="'+b+'" '}if(f.value!=null){c+=' item-value="'+f.value+'" '}if(f.id!=undefined){c+=' id="'+f.id+'" '}c+=">"+b;if(f.items){if(f.subMenuWidth){c+=this.loadItems(f.items,f.subMenuWidth)}else{c+=this.loadItems(f.items)}}c+="</li>";return c},setSize:function(){if(this.width!=null&&this.width.toString().indexOf("%")!=-1){this.host.width(this.width)}else{if(this.width!=null&&this.width.toString().indexOf("px")!=-1){this.host.width(this.width)}else{if(this.width!=undefined&&!isNaN(this.width)){this.host.width(this.width)}}}if(this.height!=null&&this.height.toString().indexOf("%")!=-1){this.host.height(this.height)}else{if(this.height!=null&&this.height.toString().indexOf("px")!=-1){this.host.height(this.height)}else{if(this.height!=undefined&&!isNaN(this.height)){this.host.height(this.height)}}}},isTouchDevice:function(){if(this._isTouchDevice!=undefined){return this._isTouchDevice}var b=a.jqx.mobile.isTouchDevice();if(this.touchMode==true){b=true}else{if(this.touchMode==false){b=false}}if(b){this.host.addClass(this.toThemeProperty("jqx-touch"));a(".jqx-menu-item").addClass(this.toThemeProperty("jqx-touch"))}this._isTouchDevice=b;return b},refresh:function(b){if(!b){this.setSize()}},_closeAll:function(f){var d=f!=null?f.data:this;var b=d.items;a.each(b,function(){var e=this;if(e.hasItems==true){if(e.isOpen){d._closeItem(d,e)}}});if(d.mode=="popup"){if(f!=null){var c=d._isRightClick(f);if(!c){d.close()}}}},closeItem:function(e){if(e==null){return false}var b=e;var c=document.getElementById(b);var d=this;a.each(d.items,function(){var f=this;if(f.isOpen==true&&f.element==c){d._closeItem(d,f);if(f.parentId){d.closeItem(f.parentId)}}});return true},openItem:function(e){if(e==null){return false}var b=e;var c=document.getElementById(b);var d=this;a.each(d.items,function(){var f=this;if(f.isOpen==false&&f.element==c){d._openItem(d,f);if(f.parentId){d.openItem(f.parentId)}}});return true},_getClosedSubMenuOffset:function(c){var b=a(c.subMenuElement);var f=-b.outerHeight();var e=-b.outerWidth();var d=c.level==0&&this.mode=="horizontal";if(d){e=0}else{f=0}switch(c.openVerticalDirection){case"up":case"center":f=b.outerHeight();break}switch(c.openHorizontalDirection){case this._getDir("left"):if(d){e=0}else{e=b.outerWidth()}break;case"center":if(d){e=0}else{e=b.outerWidth()}break}return{left:e,top:f}},_closeItem:function(l,o,g,c){if(l==null||o==null){return false}var j=a(o.subMenuElement);var b=o.level==0&&this.mode=="horizontal";var f=this._getClosedSubMenuOffset(o);var m=f.top;var e=f.left;$menuElement=a(o.element);var k=j.closest("div.jqx-menu-popup");if(k!=null){var h=l.animationHideDelay;if(c==true){h=0}if(j.data("timer").show!=null){clearTimeout(j.data("timer").show);j.data("timer").show=null}var n=function(){o.isOpen=false;if(!a.jqx.browser.msie&&this.animationtype=="fade"){}if(b){if(!a.jqx.browser.msie){}j.stop().animate({top:m},l.animationHideDuration,function(){a(o.element).removeClass(l.toThemeProperty("jqx-fill-state-pressed"));a(o.element).removeClass(l.toThemeProperty("jqx-menu-item-top-selected"));var p=a(o.arrow);if(p.length>0&&l.showTopLevelArrows){p.removeClass();if(o.openVerticalDirection=="down"){p.addClass(l.toThemeProperty("jqx-menu-item-arrow-down"))}else{p.addClass(l.toThemeProperty("jqx-menu-item-arrow-up"))}}k.css({display:"none"});if(l.animationHideDuration==0){j.css({top:m})}l._raiseEvent("1",o)})}else{if(!a.jqx.browser.msie){}j.stop().animate({left:e},l.animationHideDuration,function(){if(l.animationHideDuration==0){j.css({left:e})}if(o.level>0){a(o.element).removeClass(l.toThemeProperty("jqx-fill-state-pressed"));a(o.element).removeClass(l.toThemeProperty("jqx-menu-item-selected"));var p=a(o.arrow);if(p.length>0){p.removeClass();if(o.openHorizontalDirection!="left"){p.addClass(l.toThemeProperty("jqx-menu-item-arrow-"+l._getDir("right")))}else{p.addClass(l.toThemeProperty("jqx-menu-item-arrow-"+l._getDir("left")))}}}else{a(o.element).removeClass(l.toThemeProperty("jqx-fill-state-pressed"));a(o.element).removeClass(l.toThemeProperty("jqx-menu-item-top-selected"));var p=a(o.arrow);if(p.length>0){p.removeClass();if(o.openHorizontalDirection!="left"){p.addClass(l.toThemeProperty("jqx-menu-item-arrow-top-"+l._getDir("right")))}else{p.addClass(l.toThemeProperty("jqx-menu-item-arrow-top-"+l._getDir("left")))}}}k.css({display:"none"});l._raiseEvent("1",o)})}};if(h>0){j.data("timer").hide=setTimeout(function(){n()},h)}else{n()}if(g!=undefined&&g){var d=j.children();a.each(d,function(){if(l.menuElements[this.id]&&l.menuElements[this.id].isOpen){var p=a(l.menuElements[this.id].subMenuElement);l._closeItem(l,l.menuElements[this.id],true,true)}})}}},getSubItems:function(j,h){if(j==null){return false}var g=this;var c=new Array();if(h!=null){a.extend(c,h)}var d=j;var f=this.menuElements[d];var b=a(f.subMenuElement);var e=b.find(".jqx-menu-item");a.each(e,function(){c[this.id]=g.menuElements[this.id];var k=g.getSubItems(this.id,c);a.extend(c,k)});return c},disable:function(g,d){if(g==null){return}var c=g;var f=this;if(this.menuElements[c]){var e=this.menuElements[c];e.disabled=d;var b=a(e.element);e.element.disabled=d;a.each(b.children(),function(){this.disabled=d});if(d){b.addClass(f.toThemeProperty("jqx-menu-item-disabled"));b.addClass(f.toThemeProperty("jqx-fill-state-disabled"))}else{b.removeClass(f.toThemeProperty("jqx-menu-item-disabled"));b.removeClass(f.toThemeProperty("jqx-fill-state-disabled"))}}},_setItemProperty:function(g,c,f){if(g==null){return}var b=g;var e=this;if(this.menuElements[b]){var d=this.menuElements[b];if(d[c]){d[c]=f}}},setItemOpenDirection:function(d,c,e){if(d==null){return}var k=d;var g=this;var f=a.jqx.browser.msie&&a.jqx.browser.version<8;if(this.menuElements[k]){var j=this.menuElements[k];if(c!=null){j.openHorizontalDirection=c;if(j.hasItems&&j.level>0){var h=a(j.element);if(h!=undefined){var b=a(j.arrow);if(j.arrow==null){b=a('<span id="arrow'+h[0].id+'"></span>');if(!f){b.prependTo(h)}else{b.appendTo(h)}}b.removeClass();if(j.openHorizontalDirection=="left"){b.addClass(g.toThemeProperty("jqx-menu-item-arrow-"+g._getDir("left")))}else{b.addClass(g.toThemeProperty("jqx-menu-item-arrow-"+g._getDir("right")))}b.css("visibility","visible");if(!f){b.css("display","block");b.css("float","right")}else{b.css("display","inline-block");b.css("float","none")}}}}if(e!=null){j.openVerticalDirection=e;var b=a(j.arrow);var h=a(j.element);if(h!=undefined){if(j.arrow==null){b=a('<span id="arrow'+h[0].id+'"></span>');if(!f){b.prependTo(h)}else{b.appendTo(h)}}b.removeClass();if(j.openVerticalDirection=="down"){b.addClass(g.toThemeProperty("jqx-menu-item-arrow-down"))}else{b.addClass(g.toThemeProperty("jqx-menu-item-arrow-up"))}b.css("visibility","visible");if(!f){b.css("display","block");b.css("float","right")}else{b.css("display","inline-block");b.css("float","none")}}}}},_getSiblings:function(c){var d=new Array();var b=0;for(i=0;i<this.items.length;i++){if(this.items[i]==c){continue}if(this.items[i].parentId==c.parentId&&this.items[i].hasItems){d[b++]=this.items[i]}}return d},_openItem:function(s,r,q){if(s==null||r==null){return false}if(r.isOpen){return false}if(r.disabled){return false}if(s.disabled){return false}var l=s.popupZIndex;if(q!=undefined){l=q}var e=s.animationHideDuration;s.animationHideDuration=0;s._closeItem(s,r,true,true);s.animationHideDuration=e;this.host.focus();var f=[5,5];var t=a(r.subMenuElement);if(t!=null){t.stop()}if(t.data("timer").hide!=null){clearTimeout(t.data("timer").hide)}var o=t.closest("div.jqx-menu-popup");var h=a(r.element);var j=r.level==0?this._getOffset(r.element):h.position();if(r.level>0&&this.hasTransform){var p=parseInt(h.coord().top)-parseInt(this._getOffset(r.element).top);j.top+=p}if(r.level==0&&this.mode=="popup"){j=h.coord()}var k=r.level==0&&this.mode=="horizontal";var b=k?j.left:this.menuElements[r.parentId]!=null&&this.menuElements[r.parentId].subMenuElement!=null?parseInt(a(a(this.menuElements[r.parentId].subMenuElement).closest("div.jqx-menu-popup")).outerWidth())-f[0]:parseInt(t.outerWidth());o.css({visibility:"visible",display:"block",left:b,top:k?j.top+h.outerHeight():j.top,zIndex:l});t.css("display","block");if(this.mode!="horizontal"&&r.level==0){var d=this._getOffset(this.element);o.css("left",-1+d.left+this.host.outerWidth());t.css("left",-t.outerWidth())}else{var c=this._getClosedSubMenuOffset(r);t.css("left",c.left);t.css("top",c.top)}o.css({height:parseInt(t.outerHeight())+parseInt(f[1])+"px"});var n=0;var g=0;switch(r.openVerticalDirection){case"up":if(k){t.css("top",t.outerHeight());n=f[1];o.css({display:"block",top:j.top-o.outerHeight(),zIndex:l})}else{n=f[1];t.css("top",t.outerHeight());o.css({display:"block",top:j.top-o.outerHeight()+f[1]+h.outerHeight(),zIndex:l})}break;case"center":if(k){t.css("top",0);o.css({display:"block",top:j.top-o.outerHeight()/2+f[1],zIndex:l})}else{t.css("top",0);o.css({display:"block",top:j.top+h.outerHeight()/2-o.outerHeight()/2+f[1],zIndex:l})}break}switch(r.openHorizontalDirection){case this._getDir("left"):if(k){o.css({left:j.left-(o.outerWidth()-h.outerWidth()-f[0])})}else{g=0;t.css("left",o.outerWidth());o.css({left:j.left-(o.outerWidth())+2*r.level})}break;case"center":if(k){o.css({left:j.left-(o.outerWidth()/2-h.outerWidth()/2-f[0]/2)})}else{o.css({left:j.left-(o.outerWidth()/2-h.outerWidth()/2-f[0]/2)});t.css("left",o.outerWidth())}break}if(k){if(parseInt(t.css("top"))==n){r.isOpen=true;return}}else{if(parseInt(t.css("left"))==g){r.isOpen==true;return}}a.each(s._getSiblings(r),function(){s._closeItem(s,this,true,true)});var m=a.data(s.element,"animationHideDelay");s.animationHideDelay=m;if(this.autoCloseInterval>0){if(this.host.data("autoclose")!=null&&this.host.data("autoclose").close!=null){clearTimeout(this.host.data("autoclose").close)}if(this.host.data("autoclose")!=null){this.host.data("autoclose").close=setTimeout(function(){s._closeAll()},this.autoCloseInterval)}}t.data("timer").show=setTimeout(function(){if(o!=null){if(k){t.stop();t.css("left",g);if(!a.jqx.browser.msie){}h.addClass(s.toThemeProperty("jqx-fill-state-pressed"));h.addClass(s.toThemeProperty("jqx-menu-item-top-selected"));var u=a(r.arrow);if(u.length>0&&s.showTopLevelArrows){u.removeClass();if(r.openVerticalDirection=="down"){u.addClass(s.toThemeProperty("jqx-menu-item-arrow-down-selected"))}else{u.addClass(s.toThemeProperty("jqx-menu-item-arrow-up-selected"))}}if(s.animationShowDuration==0){t.css({top:n});r.isOpen=true;s._raiseEvent("0",r)}else{t.animate({top:n},s.animationShowDuration,s.easing,function(){r.isOpen=true;s._raiseEvent("0",r)})}}else{t.stop();t.css("top",n);if(!a.jqx.browser.msie){}if(r.level>0){h.addClass(s.toThemeProperty("jqx-fill-state-pressed"));h.addClass(s.toThemeProperty("jqx-menu-item-selected"));var u=a(r.arrow);if(u.length>0){u.removeClass();if(r.openHorizontalDirection!="left"){u.addClass(s.toThemeProperty("jqx-menu-item-arrow-"+s._getDir("right")+"-selected"))}else{u.addClass(s.toThemeProperty("jqx-menu-item-arrow-"+s._getDir("left")+"-selected"))}}}else{h.addClass(s.toThemeProperty("jqx-fill-state-pressed"));h.addClass(s.toThemeProperty("jqx-menu-item-top-selected"));var u=a(r.arrow);if(u.length>0){u.removeClass();if(r.openHorizontalDirection!="left"){u.addClass(s.toThemeProperty("jqx-menu-item-arrow-"+s._getDir("right")+"-selected"))}else{u.addClass(s.toThemeProperty("jqx-menu-item-arrow-"+s._getDir("left")+"-selected"))}}}if(!a.jqx.browser.msie){}if(s.animationShowDuration==0){t.css({left:g});s._raiseEvent("0",r);r.isOpen=true}else{t.animate({left:g},s.animationShowDuration,s.easing,function(){s._raiseEvent("0",r);r.isOpen=true})}}}},this.animationShowDelay)},_getDir:function(b){switch(b){case"left":return !this.rtl?"left":"right";case"right":return this.rtl?"left":"right"}return"left"},_applyOrientation:function(j,d){var g=this;var f=0;this.host.removeClass(g.toThemeProperty("jqx-menu-horizontal"));this.host.removeClass(g.toThemeProperty("jqx-menu-vertical"));this.host.removeClass(g.toThemeProperty("jqx-menu"));this.host.removeClass(g.toThemeProperty("jqx-widget"));this.host.addClass(g.toThemeProperty("jqx-widget"));this.host.addClass(g.toThemeProperty("jqx-menu"));if(j!=undefined&&d!=undefined&&d=="popup"){if(this.host.parent().length>0&&this.host.parent().parent().length>0&&this.host.parent().parent()[0]==document.body){var h=a.data(document.body,"jqxMenuOldHost"+this.element.id);if(h!=null){var e=this.host.closest("div.jqx-menu-wrapper");e.remove();e.appendTo(h);this.host.css("display","block");this.host.css("visibility","visible");e.css("display","block");e.css("visibility","visible")}}}else{if(j==undefined&&d==undefined){a.data(document.body,"jqxMenuOldHost"+this.element.id,this.host.parent()[0])}}if(this.autoOpenPopup){if(this.mode=="popup"){this.addHandler(a(document),"contextmenu."+this.element.id,function(k){return false});this.addHandler(a(document),"mousedown.menu"+this.element.id,function(k){g._openContextMenu(k)})}else{this.removeHandler(a(document),"contextmenu."+this.element.id);this.removeHandler(a(document),"mousedown.menu"+this.element.id)}}else{this.removeHandler(a(document),"contextmenu."+this.element.id);this.removeHandler(a(document),"mousedown.menu"+this.element.id)}if(this.rtl){this.host.addClass(this.toThemeProperty("jqx-rtl"))}switch(this.mode){case"horizontal":this.host.addClass(g.toThemeProperty("jqx-widget-header"));this.host.addClass(g.toThemeProperty("jqx-menu-horizontal"));a.each(this.items,function(){var m=this;$element=a(m.element);var l=a(m.arrow);l.removeClass();if(m.hasItems&&m.level>0){var l=a('<span style="border: none; background-color: transparent;" id="arrow'+$element[0].id+'"></span>');l.prependTo($element);l.css("float",g._getDir("right"));l.addClass(g.toThemeProperty("jqx-menu-item-arrow-"+g._getDir("right")));m.arrow=l[0]}if(m.level==0){a(m.element).css("float",g._getDir("left"));if(!m.ignoretheme&&m.hasItems&&g.showTopLevelArrows){var l=a('<span style="border: none; background-color: transparent;" id="arrow'+$element[0].id+'"></span>');var k=a.jqx.browser.msie&&a.jqx.browser.version<8;if(m.arrow==null){if(!k){l.prependTo($element)}else{l.appendTo($element)}}else{l=a(m.arrow)}if(m.openVerticalDirection=="down"){l.addClass(g.toThemeProperty("jqx-menu-item-arrow-down"))}else{l.addClass(g.toThemeProperty("jqx-menu-item-arrow-up"))}l.css("visibility","visible");if(!k){l.css("display","block");l.css("float","right")}else{l.css("display","inline-block")}m.arrow=l[0]}else{if(!m.ignoretheme&&m.hasItems&&!g.showTopLevelArrows){if(m.arrow!=null){var l=a(m.arrow);l.remove();m.arrow=null}}}f=Math.max(f,$element.height())}});break;case"vertical":case"popup":this.host.addClass(g.toThemeProperty("jqx-menu-vertical"));a.each(this.items,function(){var l=this;$element=a(l.element);if(l.hasItems&&!l.ignoretheme){if(l.arrow){a(l.arrow).remove()}var k=a('<span style="border: none; background-color: transparent;" id="arrow'+$element[0].id+'"></span>');k.prependTo($element);k.css("float","right");if(l.level==0){k.addClass(g.toThemeProperty("jqx-menu-item-arrow-top-"+g._getDir("right")))}else{k.addClass(g.toThemeProperty("jqx-menu-item-arrow-"+g._getDir("right")))}l.arrow=k[0]}$element.css("float","none")});if(this.mode=="popup"){this.host.addClass(g.toThemeProperty("jqx-widget-content"));this.host.wrap('<div class="jqx-menu-wrapper" style="z-index:'+this.popupZIndex+'; border: none; background-color: transparent; padding: 0px; margin: 0px; position: absolute; top: 0; left: 0; display: block; visibility: visible;"></div>');var e=this.host.closest("div.jqx-menu-wrapper");e[0].id="menuWrapper"+this.element.id;e.appendTo(a(document.body))}else{this.host.addClass(g.toThemeProperty("jqx-widget-header"))}if(this.mode=="popup"){var b=this.host.height();this.host.css("position","absolute");this.host.css("top","0");this.host.css("left","0");this.host.height(b);this.host.css("display","none")}break}var c=this.isTouchDevice();if(this.autoCloseOnClick){this.removeHandler(a(document),"mousedown.menu"+this.element.id,g._closeAfterClick);this.addHandler(a(document),"mousedown.menu"+this.element.id,g._closeAfterClick,g);if(c){this.addHandler(a(document),a.jqx.mobile.getTouchEventName("touchstart")+".menu"+this.element.id,g._closeAfterClick,g)}}},_getBodyOffset:function(){var c=0;var b=0;if(a("body").css("border-top-width")!="0px"){c=parseInt(a("body").css("border-top-width"));if(isNaN(c)){c=0}}if(a("body").css("border-left-width")!="0px"){b=parseInt(a("body").css("border-left-width"));if(isNaN(b)){b=0}}return{left:b,top:c}},_getOffset:function(c){var e=a.jqx.mobile.isSafariMobileBrowser();var h=a(c).coord();var g=h.top;var f=h.left;if(a("body").css("border-top-width")!="0px"){g=parseInt(g)+this._getBodyOffset().top}if(a("body").css("border-left-width")!="0px"){f=parseInt(f)+this._getBodyOffset().left}var d=a.jqx.mobile.isWindowsPhone();if(this.hasTransform||(e!=null&&e)||d){var b={left:a.jqx.mobile.getLeftPos(c),top:a.jqx.mobile.getTopPos(c)};return b}else{return{left:f,top:g}}},_isRightClick:function(c){var b;if(!c){var c=window.event}if(c.which){b=(c.which==3)}else{if(c.button){b=(c.button==2)}}return b},_openContextMenu:function(d){var c=this;var b=c._isRightClick(d);if(b){c.open(parseInt(d.clientX)+5,parseInt(d.clientY)+5)}},close:function(){var c=this;var d=a.data(this.element,"contextMenuOpened"+this.element.id);if(d){var b=this.host;a.each(c.items,function(){var e=this;if(e.hasItems){c._closeItem(c,e)}});a.each(c.items,function(){var e=this;if(e.isOpen==true){$submenu=a(e.subMenuElement);var f=$submenu.closest("div.jqx-menu-popup");f.hide(this.animationHideDuration)}});this.host.hide(this.animationHideDuration);a.data(c.element,"contextMenuOpened"+this.element.id,false);c._raiseEvent("1",c)}},open:function(e,d){if(this.mode=="popup"){var c=0;if(this.host.css("display")=="block"){this.close();c=this.animationHideDuration}var b=this;if(e==undefined||e==null){e=0}if(d==undefined||d==null){d=0}setTimeout(function(){b.host.show(b.animationShowDuration);b.host.css("visibility","visible");a.data(b.element,"contextMenuOpened"+b.element.id,true);b._raiseEvent("0",b);b.host.css("z-index",9999);if(e!=undefined&&d!=undefined){b.host.css({left:e,top:d})}},c)}},_renderHover:function(c,e,b){var d=this;if(!e.ignoretheme){this.addHandler(c,"mouseenter",function(){if(!e.disabled&&!e.separator&&d.enableHover&&!d.disabled){if(e.level>0){c.addClass(d.toThemeProperty("jqx-fill-state-hover"));c.addClass(d.toThemeProperty("jqx-menu-item-hover"))}else{c.addClass(d.toThemeProperty("jqx-fill-state-hover"));c.addClass(d.toThemeProperty("jqx-menu-item-top-hover"))}}});this.addHandler(c,"mouseleave",function(){if(!e.disabled&&!e.separator&&d.enableHover&&!d.disabled){if(e.level>0){c.removeClass(d.toThemeProperty("jqx-fill-state-hover"));c.removeClass(d.toThemeProperty("jqx-menu-item-hover"))}else{c.removeClass(d.toThemeProperty("jqx-fill-state-hover"));c.removeClass(d.toThemeProperty("jqx-menu-item-top-hover"))}}})}},_closeAfterClick:function(c){var b=c!=null?c.data:this;var d=false;if(b.autoCloseOnClick){a.each(a(c.target).parents(),function(){if(this.className.indexOf){if(this.className.indexOf("jqx-menu")!=-1){d=true;return false}}});if(!d){c.data=b;b._closeAll(c)}}},_autoSizeHorizontalMenuItems:function(){var c=this;if(c.autoSizeMainItems&&this.mode=="horizontal"){var b=this.maxHeight;if(parseInt(b)>parseInt(this.host.height())){b=parseInt(this.host.height())}b=parseInt(this.host.height());a.each(this.items,function(){var m=this;$element=a(m.element);if(m.level==0&&b>0){var d=$element.children().length>0?parseInt($element.children().height()):$element.height();var g=c.host.find("ul:first");var h=parseInt(g.css("padding-top"));var n=parseInt(g.css("margin-top"));var k=b-2*(n+h);var j=parseInt(k)/2-d/2;var e=parseInt(j);var l=parseInt(j);$element.css("padding-top",e);$element.css("padding-bottom",l);if(parseInt($element.outerHeight())>k){var f=1;$element.css("padding-top",e-f);e=e-f}}})}},_render:function(f,b){var g=this.popupZIndex;var c=[5,5];var e=this;a.data(e.element,"animationHideDelay",e.animationHideDelay);var d=this.isTouchDevice();a.data(document.body,"menuel",this);this.hasTransform=a.jqx.utilities.hasTransform(this.host);this._applyOrientation(f,b);if(e.enableRoundedCorners){this.host.addClass(e.toThemeProperty("jqx-rc-all"))}a.each(this.items,function(){var p=this;var l=a(p.element);if(e.enableRoundedCorners){l.addClass(e.toThemeProperty("jqx-rc-all"))}e.removeHandler(l,"click");e.addHandler(l,"click",function(u){if(p.disabled){return}e._raiseEvent("2",{item:p.element,event:u});if(!e.autoOpen){if(p.level>0){if(e.autoCloseOnClick&&!d&&!e.clickToOpen){u.data=e;e._closeAll(u)}}}else{if(e.autoCloseOnClick&&!d&&!e.clickToOpen){if(p.closeOnClick){u.data=e;e._closeAll(u)}}}if(d&&e.autoCloseOnClick){u.data=e;if(!p.hasItems){e._closeAll(u)}}if(u.target.tagName!="A"&&u.target.tagName!="a"){var s=p.anchor!=null?a(p.anchor):null;if(s!=null&&s.length>0){var r=s.attr("href");var t=s.attr("target");if(r!=null){if(t!=null){window.open(r,t)}else{window.location=r}}}}});e.removeHandler(l,"mouseenter");e.removeHandler(l,"mouseleave");e._renderHover(l,p,d);if(p.subMenuElement!=null){var m=a(p.subMenuElement);m.wrap('<div class="jqx-menu-popup" style="border: none; background-color: transparent; z-index:'+g+'; padding: 0px; margin: 0px; position: absolute; top: 0; left: 0; display: block; visibility: hidden;"><div style="background-color: transparent; border: none; position:absolute; overflow:hidden; left: 0; top: 0; right: 0; width: 100%; height: 100%;"></div></div>');m.css({overflow:"hidden",position:"absolute",left:0,display:"inherit",top:-m.outerHeight()});m.data("timer",{});if(p.level>0){m.css("left",-m.outerWidth())}else{if(e.mode=="horizontal"){m.css("left",0)}}g++;var o=a(p.subMenuElement).closest("div.jqx-menu-popup").css({width:parseInt(a(p.subMenuElement).outerWidth())+parseInt(c[0])+"px",height:parseInt(a(p.subMenuElement).outerHeight())+parseInt(c[1])+"px"});var q=l.closest("div.jqx-menu-popup");if(q.length>0){var h=m.css("margin-left");var k=m.css("margin-right");var j=m.css("padding-left");var n=m.css("padding-right");o.appendTo(q);m.css("margin-left",h);m.css("margin-right",k);m.css("padding-left",j);m.css("padding-right",n)}else{var h=m.css("margin-left");var k=m.css("margin-right");var j=m.css("padding-left");var n=m.css("padding-right");o.appendTo(a(document.body));m.css("margin-left",h);m.css("margin-right",k);m.css("padding-left",j);m.css("padding-right",n)}if(!e.clickToOpen){e.addHandler(l,"mouseenter",function(){if(e.autoOpen||(p.level>0&&!e.autoOpen)){clearTimeout(m.data("timer").hide)}if(p.parentId&&p.parentId!=0){if(e.menuElements[p.parentId]){var r=e.menuElements[p.parentId].isOpen;if(!r){return}}}if(e.autoOpen||(p.level>0&&!e.autoOpen)){e._openItem(e,p)}return false});e.addHandler(l,"mousedown",function(){if(!e.autoOpen&&p.level==0){clearTimeout(m.data("timer").hide);if(m!=null){m.stop()}if(!p.isOpen){e._openItem(e,p)}else{e._closeItem(e,p,true)}}});if(d){e.removeHandler(l,"touchstart");e.addHandler(l,"touchstart",function(r){clearTimeout(m.data("timer").hide);if(m!=null){m.stop()}if(p.level==0&&!p.isOpen){r.data=e;e._closeAll(r)}if(!p.isOpen){e._openItem(e,p)}else{e._closeItem(e,p,true)}return false})}e.addHandler(l,"mouseleave",function(s){if(e.autoCloseOnMouseLeave){clearTimeout(m.data("timer").hide);var v=a(p.subMenuElement);var r={left:parseInt(s.pageX),top:parseInt(s.pageY)};var u={left:parseInt(v.coord().left),top:parseInt(v.coord().top),width:parseInt(v.outerWidth()),height:parseInt(v.outerHeight())};var t=true;if(u.left-5<=r.left&&r.left<=u.left+u.width+5){if(u.top<=r.top&&r.top<=u.top+u.height){t=false}}if(t){e._closeItem(e,p,true)}}});e.removeHandler(o,"mouseenter");e.addHandler(o,"mouseenter",function(){clearTimeout(m.data("timer").hide)});e.removeHandler(o,"mouseleave");e.addHandler(o,"mouseleave",function(r){if(e.autoCloseOnMouseLeave){clearTimeout(m.data("timer").hide);clearTimeout(m.data("timer").show);if(m!=null){m.stop()}e._closeItem(e,p,true)}})}else{e.removeHandler(l,"mousedown");e.addHandler(l,"mousedown",function(r){clearTimeout(m.data("timer").hide);if(m!=null){m.stop()}if(p.level==0&&!p.isOpen){r.data=e;e._closeAll(r)}if(!p.isOpen){e._openItem(e,p)}else{e._closeItem(e,p,true)}})}}});this._autoSizeHorizontalMenuItems();this._raiseEvent("3",this)},createID:function(){var b=Math.random()+"";b=b.replace(".","");b="99"+b;b=b/1;while(this.items[b]){b=Math.random()+"";b=b.replace(".","");b=b/1}return"menuItem"+b},_createMenu:function(c,f){if(c==null){return}if(f==undefined){f=true}if(f==null){f=true}var o=this;var t=a(c).find("li");var q=0;for(var j=0;j<t.length;j++){var m=t[j];var r=a(m);if(m.className.indexOf("jqx-menu")==-1&&this.autoGenerate==false){continue}var p=m.id;if(!p){p=this.createID()}if(f){m.id=p;this.items[q]=new a.jqx._jqxMenu.jqxMenuItem();this.menuElements[p]=this.items[q]}q+=1;var s=0;var v=this;var h=r.children();h.each(function(){if(!f){this.className="";if(v.autoGenerate){a(v.items[q-1].subMenuElement)[0].className="";a(v.items[q-1].subMenuElement).addClass(v.toThemeProperty("jqx-widget-content"));a(v.items[q-1].subMenuElement).addClass(v.toThemeProperty("jqx-menu-dropdown"))}}if(this.className.indexOf("jqx-menu-dropdown")!=-1){if(f){v.items[q-1].subMenuElement=this}return false}else{if(v.autoGenerate&&(this.tagName=="ul"||this.tagName=="UL")){if(f){v.items[q-1].subMenuElement=this}this.className="";a(this).addClass(v.toThemeProperty("jqx-widget-content"));a(this).addClass(v.toThemeProperty("jqx-menu-dropdown"));if(v.rtl){a(this).addClass(v.toThemeProperty("jqx-rc-l"))}else{a(this).addClass(v.toThemeProperty("jqx-rc-r"))}a(this).addClass(v.toThemeProperty("jqx-rc-b"));return false}}});var u=r.parents();u.each(function(){if(this.className.indexOf("jqx-menu-item")!=-1){s=this.id;return false}else{if(v.autoGenerate&&(this.tagName=="li"||this.tagName=="LI")){s=this.id;return false}}});var e=false;var d=m.getAttribute("type");var b=m.getAttribute("ignoretheme");if(b){if(b=="true"||b==true){b=true}}else{b=false}if(!d){d=m.type}else{if(d=="separator"){var e=true}}if(!e){if(s){d="sub"}else{d="top"}}var g=this.items[q-1];if(f){g.id=p;g.parentId=s;g.type=d;g.separator=e;g.element=t[j];var l=r.find("a:first");g.level=r.parents("li").length;g.anchor=l.length>0?l:null}g.ignoretheme=b;var n=this.menuElements[s];if(n!=null){if(n.ignoretheme){g.ignoretheme=n.ignoretheme;b=n.ignoretheme}}if(this.autoGenerate){if(d=="separator"){r.removeClass();r.addClass(this.toThemeProperty("jqx-menu-item-separator"))}else{if(!b){r[0].className="";if(this.rtl){r.addClass(this.toThemeProperty("jqx-rtl"))}if(g.level>0){r.addClass(this.toThemeProperty("jqx-item"));r.addClass(this.toThemeProperty("jqx-menu-item"))}else{r.addClass(this.toThemeProperty("jqx-item"));r.addClass(this.toThemeProperty("jqx-menu-item-top"))}}}}if(f&&!b){g.hasItems=r.find("li").length>0}}},destroy:function(){var c=this.host.closest("div.jqx-menu-wrapper");c.remove();var b=this;this.removeHandler(a(document),"mousedown.menu"+this.element.id,b._closeAfterClick);this.removeHandler(a(document),"mouseup.menu"+this.element.id,b._closeAfterClick);a(window).off("resize.menu"+b.element.id);a.each(this.items,function(){var e=this;var d=a(e.element);b.removeHandler(d,"click");b.removeHandler(d,"selectstart");b.removeHandler(d,"mouseenter");b.removeHandler(d,"mouseleave");b.removeHandler(d,"mousedown");b.removeHandler(d,"mouseleave")});a.data(document.body,"menuel",null);this.items=new Array();this.host.removeClass();this.host.remove()},_raiseEvent:function(f,c){if(c==undefined){c={owner:null}}var d=this.events[f];args=c;args.owner=this;var e=new jQuery.Event(d);if(f=="2"){args=c.item;args.owner=this;a.extend(e,c.event);e.type="itemclick"}e.owner=this;e.args=args;var b=this.host.trigger(e);return b},propertyChangedHandler:function(b,d,g,f){if(this.isInitialized==undefined||this.isInitialized==false){return}if(f==g){return}if(d=="touchMode"){this._isTouchDevice=null;b._render(f,g)}if(d=="source"){if(b.source!=null){var c=b.loadItems(b.source);b.element.innerHTML=c;var e=b.host.find("ul:first");if(e.length>0){b.refresh();b._createMenu(e[0]);b._render()}}}if(d=="autoCloseOnClick"){if(f==false){b.removeHandler(a(document),"mousedown.menu"+this.element.id,b._closeAll)}else{b.addHandler(a(document),"mousedown.menu"+this.element.id,b,b._closeAll)}}else{if(d=="mode"||d=="width"||d=="height"||d=="showTopLevelArrows"){b.refresh();if(d=="mode"){b._render(f,g)}else{b._applyOrientation()}}else{if(d=="theme"){a.jqx.utilities.setTheme(g,f,b.host)}}}}})})(jQuery);(function(a){a.jqx._jqxMenu.jqxMenuItem=function(e,d,c){var b={id:e,parentId:d,parentItem:null,anchor:null,type:c,disabled:false,level:0,isOpen:false,hasItems:false,element:null,subMenuElement:null,arrow:null,openHorizontalDirection:"right",openVerticalDirection:"down",closeOnClick:true};return b}})(jQuery);