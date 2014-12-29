/******************************************************************************
Name:    Higzplide JS
Version: 3.2.6 (September 8 2007)
Author:  Torstein Hønsi
Support: http://vikjavev.no/zooming/forum
Email:   See http://vikjavev.no/megsjol

Licence:
Higzplide JS is licensed under a Creative Commons Attribution-NonCommercial 2.5
License (http://creativecommons.org/licenses/by-nc/2.5/).

You are free:
	* to copy, distribute, display, and perform the work
	* to make derivative works

Under the following conditions:
	* Attribution. You must attribute the work in the manner  specified by  the
	  author or licensor.
	* Noncommercial. You may not use this work for commercial purposes.

* For  any  reuse  or  distribution, you  must make clear to others the license
  terms of this work.
* Any  of  these  conditions  can  be  waived  if  you  get permission from the 
  copyright holder.

Your fair use and other rights are in no way affected by the above.
******************************************************************************/

var zp = {

// Apply your own settings here, or override them in the html file.  
graphicsDir : 'zooming/graphics/',
restoreCursor : "zoomout.cur", // necessary for preload
expandSteps : 10, // number of steps in zoom. Each step lasts for duration/step milliseconds.
expandDuration : 250, // milliseconds
restoreSteps : 10,
restoreDuration : 250,
allowMultipleInstances: true,
hideThumbOnExpand : true,
captionSlideSpeed : 1, // set to 0 to disable slide in effect
outlineWhileAnimating : false, // not recommended, animation gets jaggy on slow systems.
outlineStartOffset : 3, // ends at 10
marginLeft : 10,
marginRight : 35, // leave room for scrollbars + outline
marginTop : 10,
marginBottom : 35, // leave room for scrollbars + outline
numberOfImagesToPreload : 5,
zIndexCounter : 1001, // adjust to other absolutely positioned elements
fullExpandIcon : 'fullexpand.gif',
fullExpandTitle : 'Expand to actual size',
restoreTitle : 'Click to close image, click and drag to move. Use arrow keys for next and previous.',
focusTitle : 'Click to bring to front',
loadingText : 'Loading...',
loadingTitle : 'Click to cancel',
loadingOpacity : 0.75,
showCredits : true, // you can set this to false if you want
creditsText : 'Powered by <i>Higzplide JS</i>',
creditsHref : 'http://vikjavev.no/zooming/',
creditsTitle : 'Go to the Higzplide JS homepage',
enableKeyListener : true,

// These settings can also be overridden inline for each image
anchor : 'auto', // where the image expands from
align : 'auto', // position in the client (overrides anchor)
targetX: null, // the id of a target element
targetY: null,
captionId : null,
captionTemplateId : null,
slideshowGroup : null, // defines groups for next/previous links and keystrokes
spaceForCaption : 30, // leaves space below images with captions
minWidth: 200,
minHeight: 200,
allowSizeReduction: true, // allow the image to reduce to fit client size. If false, this overrides minWidth and minHeight
outlineType : 'drop-shadow', // set null to disable outlines
wrapperClassName : null, // for enhanced css-control

		
// END OF YOUR SETTINGS


// declare internal properties
preloadTheseImages : [],
continuePreloading: true,
expandedImagesCounter : 0,
expanders : [],
overrides : [
	'anchor',
	'align',
	'targetX',
	'targetY',
	'outlineType',
	'outlineWhileAnimating',
	'spaceForCaption', 
	'wrapperClassName',
	'minWidth',
	'minHeight',
	'captionId',
	'captionTemplateId',
	'allowSizeReduction',
	'slideshowGroup'
],
overlays : [],
pendingOutlines : {},
clones : {},
faders : [],
ie : (document.all && !window.opera),
safari : navigator.userAgent.indexOf("Safari") != -1,
hasFocused : false,

$ : function (id) {
	return document.getElementById(id);
},

push : function (arr, val) {
	arr[arr.length] = val;
},

createElement : function (tag, attribs, styles, parent, nopad) {
	var el = document.createElement(tag);
	if (attribs) zp.setAttribs(el, attribs);
	if (nopad) zp.setStyles(el, {padding: 0, border: 'none', margin: 0});
	if (styles) zp.setStyles(el, styles);
	if (parent) parent.appendChild(el);	
	return el;
},

setAttribs : function (el, attribs) {
	for (var x in attribs) {
		el[x] = attribs[x];
	}
},

setStyles : function (el, styles) {
	for (var x in styles) {
		try { 
			if (zp.ie && x == 'opacity') el.style.filter = 'alpha(opacity='+ (styles[x] * 100) +')';
			else el.style[x] = styles[x]; 
		}
		catch (e) {}
	}
},

ieVersion : function () {
	arr = navigator.appVersion.split("MSIE");
	return parseFloat(arr[1]);
},

clientInfo : function ()	{
	var iebody = document.compatMode && document.compatMode != "BackCompat" 
		? document.documentElement : document.body;
	
	this.width = zp.ie ? iebody.clientWidth : self.innerWidth;
	this.height = zp.ie ? iebody.clientHeight : self.innerHeight;
	this.scrollLeft = zp.ie ? iebody.scrollLeft : pageXOffset;
	this.scrollTop = zp.ie ? iebody.scrollTop : pageYOffset;
} ,

position : function(el)	{ 
	var parent = el;	
	var p = { x: parent.offsetLeft, y: parent.offsetTop };
	while (parent.offsetParent)	{
		parent = parent.offsetParent;
		p.x += parent.offsetLeft;
		p.y += parent.offsetTop;
		if (parent != document.body && parent != document.documentElement) {
			p.x -= parent.scrollLeft;
			p.y -= parent.scrollTop;
		}
	}
	return p;
},

expand : function(a, params, custom) {
	try {
		new ZpExpander(a, params, custom);
		return false;		
	} catch (e) { return true; }	
},

focusTopmost : function() {
	var topZ = 0, topmostKey = -1;
	for (i = 0; i < zp.expanders.length; i++) {
		if (zp.expanders[i]) {
			if (zp.expanders[i].wrapper.style.zIndex && zp.expanders[i].wrapper.style.zIndex > topZ) {
				topZ = zp.expanders[i].wrapper.style.zIndex;
				
				topmostKey = i;
			}
		}
	}
	if (topmostKey == -1) zp.focusKey = -1;
	else zp.expanders[topmostKey].focus();
},

closeId : function(id) { // for text links
	return zp.close(id);
},

close : function(el) {
	try { zp.getExpander(el).doClose(); } catch (e) {}
	return false;
},

getAdjacentAnchor : function(key, op) {
	var aAr = document.getElementsByTagName('A'), zpAr = {}, activeI = -1, j = 0;
	for (i = 0; i < aAr.length; i++) {
		if (zp.isZpAnchor(aAr[i]) && ((zp.expanders[key].slideshowGroup == zp.getParam(aAr[i], 'slideshowGroup')))) {
			zpAr[j] = aAr[i];
			if (zp.expanders[key] && aAr[i] == zp.expanders[key].a) {
				activeI = j;
			}
			j++;
		}
	}
	return zpAr[activeI + op];
},

getParam : function (a, param) {
	try {
		var s = a.onclick.toString().replace(/\s/g, ' ').split('{')[2].split('}')[0];
		if (zp.safari) { // stupid bug
			for (var i = 0; i < zp.overrides.length; i++) {
				s = s.replace(zp.overrides[i] +':', ','+ zp.overrides[i] +':').replace(new RegExp("^\\s*?,"), '');
			}
		}
		eval('var arr = {'+ s +'};');
		if (arr[param]) return arr[param];
		else return zp[param];
	} catch (e) {
		return zp[param];
	}
},

getSrc : function (a) {
	var src = zp.getParam(a, 'src');
	if (src) return src;
	return a.rel.replace(/_slash_/g, '/') || a.href;
},

getNode : function (id) {
	var node = zp.$(id), clone = zp.clones[id], a = {};
	if (!node && !clone) return null;
	if (!clone) {
		clone = node.cloneNode(true);
		clone.id = '';
		zp.clones[id] = clone;
		return node;
	} else {
		return clone.cloneNode(true);
	}
},

purge : function(d) {
	if (!zp.ie) return;
	var a = d.attributes, i, l, n;
    if (a) {
        l = a.length;
        for (i = 0; i < l; i += 1) {
            n = a[i].name;
            if (typeof d[n] === 'function') {
                d[n] = null;
            }
        }
    }
    if (zp.geckoBug && zp.geckoBug(d)) return;
	a = d.childNodes;
    if (a) {
        l = a.length;
        for (i = 0; i < l; i += 1) {
            zp.purge(d.childNodes[i]);
        }
    }
},

previousOrNext : function (el, op) {
	var exp = zp.getExpander(el);	
	try { zp.getAdjacentAnchor(exp.key, op).onclick(); } catch (e) {}
	try { exp.doClose(); } catch (e) {}	
	return false;
},

previous : function (el) {
	return zp.previousOrNext(el, -1);
},

next : function (el) {
	return zp.previousOrNext(el, 1);	
},

keyHandler : function(e) {
	if (!e) e = window.event;
	if (!e.target) e.target = e.srcElement; // ie
	if (e.target.form) return; // form element has focus
	
	var op = null;
	switch (e.keyCode) {
		case 34: // Page Down
		case 39: // Arrow right
		case 40: // Arrow down
			op = 1;
			break;
		case 33: // Page Up
		case 37: // Arrow left
		case 38: // Arrow up
			op = -1;
			break;
		case 27: // Escape
		case 13: // Enter
			op = 0;
	}
	if (op !== null) {
		zp.removeEventListener(document, 'keydown', zp.keyHandler);
		try { if (!zp.enableKeyListener) return true; } catch (e) {}
		
		if (e.preventDefault) e.preventDefault();
    	else e.returnValue = false;
		if (op == 0) {
			try { zp.getExpander().doClose(); } catch (e) {}
			return false;
		} else {
			return zp.previousOrNext(zp.focusKey, op);
		}
	} else return true;
},

registerOverlay : function (overlay) {
	zp.push(zp.overlays, overlay);
},

getWrapperKey : function (element) {
	var el, re = /^zooming-wrapper-([0-9]+)$/;
	// 1. look in open expanders
	el = element;
	while (el.parentNode)	{
		el = el.parentNode;
		if (el.id && el.id.match(re)) return el.id.replace(re, "$1");
	}
	// 2. look in thumbnail
	el = element;
	while (el.parentNode)	{
		if (el.tagName && zp.isZpAnchor(el)) {
			for (key = 0; key < zp.expanders.length; key++) {
				exp = zp.expanders[key];
				if (exp && exp.a == el) return key;
			}
		}
		el = el.parentNode;
	}
},

getExpander : function (el) {
	try {
		if (!el) return zp.expanders[zp.focusKey];
		if (typeof el == 'number') return zp.expanders[el];
		if (typeof el == 'string') el = zp.$(el);
		return zp.expanders[zp.getWrapperKey(el)];
	} catch (e) {}
},

cleanUp : function () {
	for (i = 0; i < zp.expanders.length; i++) {
		if (zp.expanders[i] && zp.expanders[i].isExpanded) zp.focusTopmost();
	}
},

mouseClickHandler : function(e) 
{	
	if (!e) e = window.event;
	if (e.button > 1) return true;
	if (!e.target) e.target = e.srcElement;
	if (e.target.form) return;
	
	var fobj = e.target;
	while (fobj.parentNode
		&& !(fobj.className && fobj.className.match(/zooming-(image|move|html)/)))
	{
		fobj = fobj.parentNode;
	}

	if (!fobj.parentNode) return;
	
	zp.dragExp = zp.getExpander(fobj);
	
	if (fobj.className.match(/zooming-(image|move)/)) {
		var isDraggable = true;
		var wLeft = parseInt(zp.dragExp.wrapper.style.left);
		var wTop = parseInt(zp.dragExp.wrapper.style.top);			
	}

	if (e.type == 'mousedown') {
		if (isDraggable) // drag or focus
		{
			if (fobj.className.match('zooming-image')) zp.dragExp.content.style.cursor = 'move';
			
			zp.wLeft = wLeft;
			zp.wTop = wTop;
			
			zp.dragX = e.clientX;
			zp.dragY = e.clientY;
			zp.addEventListener(document, 'mousemove', zp.mouseMoveHandler);
			if (e.preventDefault) e.preventDefault(); // FF
			
			if (zp.dragExp.content.className.match(/zooming-(image|html)-blur/)) {
				zp.dragExp.focus();
				zp.hasFocused = true;
			}
			return false;
		}
		else if (fobj.className.match(/zooming-html/)) { // just focus
			zp.dragExp.focus();
			zp.dragExp.redoShowHide();
			zp.hasFocused = false; // why??
		}
		
	} else if (e.type == 'mouseup') {
		zp.removeEventListener(document, 'mousemove', zp.mouseMoveHandler);
		if (isDraggable && zp.dragExp) {
			if (fobj.className.match('zooming-image')) {
				fobj.style.cursor = zp.styleRestoreCursor;
			}
			var hasMoved = wLeft != zp.wLeft || wTop != zp.wTop;
			if (!hasMoved && !zp.hasFocused && !fobj.className.match(/zooming-move/)) {
				zp.dragExp.onClick();
			} else if (hasMoved || (!hasMoved && zp.hasHtmlexpanders)) {
				zp.dragExp.redoShowHide();
			}
			zp.hasFocused = false;
		
		} else if (fobj.className.match('zooming-image-blur')) {
			fobj.style.cursor = zp.styleRestoreCursor;		
		}
	}
},

mouseMoveHandler : function(e)
{
	if (!zp.dragExp || !zp.dragExp.wrapper) return;
	if (!e) e = window.event;

	zp.dragExp.x.min = zp.wLeft + e.clientX - zp.dragX;
	zp.dragExp.y.min = zp.wTop + e.clientY - zp.dragY;
	
	var w = zp.dragExp.wrapper;
	
	w.style.left = zp.dragExp.x.min +'px';
	w.style.top  = zp.dragExp.y.min +'px';
	
	if (zp.dragExp.objOutline) {
		var o = zp.dragExp.objOutline;
		o.table.style.left = (zp.dragExp.x.min - o.offset) +'px';
		o.table.style.top = (zp.dragExp.y.min - o.offset) +'px';
	}	
	return false;
},

addEventListener : function (el, event, func) {
	try {
		el.addEventListener(event, func, false);
	} catch (e) {
		try {
			el.detachEvent('on'+ event, func);
			el.attachEvent('on'+ event, func);
		} catch (e) {
			el['on'+ event] = func;
		}
	} 
},

removeEventListener : function (el, event, func) {
	try {
		el.removeEventListener(event, func, false);
	} catch (e) {
		try {
			el.detachEvent('on'+ event, func);
		} catch (e) {
			el['on'+ event] = null;
		}
	}
},

isZpAnchor : function (a) {
	return (a.onclick && a.onclick.toString().replace(/\s/g, ' ').match(/zp.(htmlE|e)xpand/));
},

preloadFullImage : function (i) {
	if (zp.continuePreloading && zp.preloadTheseImages[i] && zp.preloadTheseImages[i] != 'undefined') {
		var img = document.createElement('img');
		img.onload = function() { zp.preloadFullImage(i + 1); };
		img.src = zp.preloadTheseImages[i];
	}
},

preloadImages : function (number) {
	if (number && typeof number != 'object') zp.numberOfImagesToPreload = number;
	var re, j = 0;
	
	var aTags = document.getElementsByTagName('A');
	for (i = 0; i < aTags.length; i++) {
		a = aTags[i];
		re = zp.isZpAnchor(a);
		if (re && re[0] == 'zp.expand') {
			if (j < zp.numberOfImagesToPreload) {
				zp.preloadTheseImages[j] = zp.getSrc(a); 
				j++;
			}
		}
	}
	
	// preload outlines
	new ZpOutline(zp.outlineType, function () { zp.preloadFullImage(0)} );
	
	// preload cursor
	var cur = zp.createElement('img', { src: zp.graphicsDir + zp.restoreCursor });
},

genContainer : function () {
	if (!zp.container) {
		zp.container = zp.createElement('div', 
			null, 
			{ position: 'absolute', left: 0, top: 0, width: '100%', zIndex: zp.zIndexCounter }, 
			document.body,
			true
		);
	}	
},

fade : function (el, o, oFinal, dir, i) {
	o = parseFloat(o);
	el.style.visibility = (o <= 0) ? 'hidden' : 'visible';
	if (o < 0 || (dir == 1 && o > oFinal)) return;
	if (i == null) i = zp.faders.length;
	if (typeof(el.i) != 'undefined' && el.i != i) {
		clearTimeout(zp.faders[el.i]);
		o = el.tempOpacity;
	}
	el.i = i;
	el.tempOpacity = o;
	el.style.visibility = (o <= 0) ? 'hidden' : 'visible';
	zp.setStyles(el, { opacity: o });
	zp.faders[i] = setTimeout(function() { 
			zp.fade(el, Math.round((o + 0.1 * dir)*100)/100, oFinal, dir, i);
	 	}, 25);
}
}; // end zp object

//-----------------------------------------------------------------------------
ZpOutline = function (outlineType, onLoad) {
	if (!outlineType) {
		if (onLoad) onLoad();
		return;
	}
	this.onLoad = onLoad;
	this.outlineType = outlineType;
	var v = zp.ieVersion(), tr;
	
	zp.genContainer();
	
	this.hasAlphaImageLoader = zp.ie && v >= 5.5 && v < 7;
	this.hasPngSupport = !zp.ie || (zp.ie && v >= 7);
	this.hasOutline = this.outlineType && (this.hasAlphaImageLoader || this.hasPngSupport);
	
	this.table = zp.createElement(
		'table',
		{	
			cellSpacing: 0 // saf
		},
		{
			visibility: 'hidden',
			position: 'absolute',
			zIndex: zp.zIndexCounter++,
			borderCollapse: 'collapse'
		},
		zp.container,
		true
	);
	this.tbody = zp.createElement('tbody', null, null, this.table);
	
	this.td = Array();
	for (var i = 0; i <= 8; i++) {
		if (i % 3 == 0) tr = zp.createElement('tr', null, null, this.tbody, true);
		this.td[i] = zp.createElement('td', null, null, tr, true);
		var style = i != 4 ? { lineHeight: 0, fontSize: 0} : { position : 'relative' };
		zp.setStyles(this.td[i], style);
	}
	this.td[4].className = outlineType;
	
	this.preloadGraphic(); 
};

ZpOutline.prototype.preloadGraphic = function () {	
	var src = zp.graphicsDir + this.outlineType +".png";
				
	var appendTo = zp.safari ? zp.container : null;
	this.graphic = zp.createElement('img', null, { position: 'absolute', left: '-9999px', 
		top: '-9999px' }, appendTo, true); // for onload trigger
	
	var pThis = this;
	this.graphic.onload = function() { pThis.onGraphicLoad(); };
	
	this.graphic.src = src;
};

ZpOutline.prototype.onGraphicLoad = function () {
	var o = this.offset = this.graphic.width / 4;
	var pos = [[0,0],[0,-4],[-2,0],[0,-8],0,[-2,-8],[0,-2],[0,-6],[-2,-2]];
	for (var i = 0; i <= 8; i++) {
		if (pos[i]) {
			if (this.hasAlphaImageLoader) {
				var w = (i == 1 || i == 7) ? '100%' : this.graphic.width +'px';
				var div = zp.createElement('div', null, { width: '100%', height: '100%', position: 'relative', overflow: 'hidden'}, this.td[i], true);
				zp.createElement ('div', null, { 
						filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale, src='"+ this.graphic.src + "')", 
						position: 'absolute',
						width: w, 
						height: this.graphic.height +'px',
						left: (pos[i][0]*o)+'px',
						top: (pos[i][1]*o)+'px'
					}, 
				div,
				true);
			} else {
				zp.setStyles(this.td[i], { background: 'url('+ this.graphic.src +') '+ (pos[i][0]*o)+'px '+(pos[i][1]*o)+'px'});
			}
			
			// common
			var dim = 2 * o;
			zp.setStyles (this.td[i], { height: dim +'px', width: dim +'px' } );
		}
	}
	
	zp.pendingOutlines[this.outlineType] = this;
	if (this.onLoad) this.onLoad();
};

ZpOutline.prototype.destroy = function() {
	zp.purge(this.table);
	try { this.table.parentNode.removeChild(this.table); } catch (e) {}
};

//-----------------------------------------------------------------------------
// The expander object
ZpExpander = function(a, params, custom, contentType) {
	zp.continuePreloading = false;
		
	this.custom = custom;
	// override inline parameters
	for (i = 0; i < zp.overrides.length; i++) {
		var name = zp.overrides[i];
		if (params && typeof params[name] != 'undefined') this[name] = params[name];
		else this[name] = zp[name];
	}
	
	// get thumb
	var el;
	if (params && params.thumbnailId) el = zp.$(params.thumbnailId);
	else el = a.getElementsByTagName('IMG')[0];
	if (!el) el = a;
	
	// cancel other
	for (i = 0; i < zp.expanders.length; i++) {
		if (zp.expanders[i] && zp.expanders[i].thumb != el && !zp.expanders[i].onLoadStarted) {
			zp.expanders[i].cancelLoading();
		}
	}
	// check if already open
	for (i = 0; i < zp.expanders.length; i++) {
		if (zp.expanders[i] && zp.expanders[i].a == a) {
			zp.expanders[i].focus();
			return false;
		}		
	}

	if (!zp.allowMultipleInstances) {
		try { zp.expanders[zp.expandedImagesCounter - 1].doClose(); } catch (e){}
	}
	
	var key = this.key = zp.expandedImagesCounter++;
	zp.expanders[this.key] = this;
	if (contentType == 'html') {
		this.isHtml = true;
		this.contentType = 'html';
	} else {
		this.isImage = true;
		this.contentType = 'image';
	}
	this.a = a;
	
	this.thumbsUserSetId = el.id || a.id;
	this.thumb = el;		
	
	this.overlays = [];

	var pos = zp.position(el); 
	
	// instanciate the wrapper
	this.wrapper = zp.createElement(
		'div',
		{
			id: 'zooming-wrapper-'+ this.key,
			className: this.wrapperClassName
		},
		{
			visibility: 'hidden',
			position: 'absolute',
			zIndex: zp.zIndexCounter++
		}, null, true );
	this.wrapper.onmouseover = function (e) { 
    	try { zp.expanders[key].onMouseOver(); } catch (e) {} 
    };
    this.wrapper.onmouseout = function (e) { 
    	try { zp.expanders[key].onMouseOut(); } catch (e) {}
	};
	
	// store properties of thumbnail
	this.thumbWidth = el.width ? el.width : el.offsetWidth;		
	this.thumbHeight = el.height ? el.height : el.offsetHeight;
	this.thumbLeft = pos.x;
	this.thumbTop = pos.y;
	
	// thumb borders
	this.thumbOffsetBorderW = (this.thumb.offsetWidth - this.thumbWidth) / 2;
	this.thumbOffsetBorderH = (this.thumb.offsetHeight - this.thumbHeight) / 2;
	
	// get the wrapper
	zp.genContainer();
	if (zp.pendingOutlines[this.outlineType]) {
		this.connectOutline();
		this[this.contentType +'Create']();
	} else if (!this.outlineType) {
		this[this.contentType +'Create']();
	} else {
		this.displayLoading();
		var pThis = this;
		new ZpOutline(this.outlineType, 
			function () { 
				pThis.connectOutline();
				pThis[pThis.contentType +'Create']();
			} 
		);
	}
	
};

ZpExpander.prototype.connectOutline = function(x, y) {	
	var w = zp.pendingOutlines[this.outlineType];
	this.objOutline = w;
	zp.pendingOutlines[this.outlineType] = null;
};

ZpExpander.prototype.displayLoading = function() {
	if (this.onLoadStarted || this.loading) return;
		
	this.originalCursor = this.a.style.cursor;
	this.a.style.cursor = 'wait';
	
	if (!zp.loading) {
		zp.loading = zp.createElement('a',
			{
				className: 'zooming-loading',
				title: zp.loadingTitle,
				innerHTML: zp.loadingText
			},
			{
				position: 'absolute',
				opacity: zp.loadingOpacity
			}, zp.container
		);
	}
	
	this.loading = zp.loading;
	this.loading.href = 'javascript:zp.expanders['+ this.key +'].cancelLoading()';
	this.loading.visibility = 'visible';		
	
	this.loading.style.left = (this.thumbLeft + this.thumbOffsetBorderW 
		+ (this.thumbWidth - this.loading.offsetWidth) / 2) +'px';
	this.loading.style.top = (this.thumbTop 
		+ (this.thumbHeight - this.loading.offsetHeight) / 2) +'px';
	setTimeout(
		"if (zp.expanders["+ this.key +"] && zp.expanders["+ this.key +"].loading) "
		+ "zp.expanders["+ this.key +"].loading.style.visibility = 'visible';", 
		100
	);
};

ZpExpander.prototype.imageCreate = function() {
	var key = this.key;

	var img = document.createElement('img');
    this.content = img;
    img.onload = function () { try { zp.expanders[key].onLoad(); } catch (e) {} };
    img.className = 'zooming-image';
    img.style.visibility = 'hidden'; // prevent flickering in IE
    img.style.display = 'block';
	img.style.position = 'absolute';
	img.style.maxWidth = 'none';
    img.style.zIndex = 3;
    img.title = zp.restoreTitle;
    if (zp.safari) zp.container.appendChild(img);
    // uncomment this to flush img size:
    // if (zp.ie) img.src = null;
	img.src = zp.getSrc(this.a);
	
	this.displayLoading();
};

ZpExpander.prototype.onLoad = function() {
	try { 
	
		if (!this.content) return;
		if (this.onLoadStarted) return; // old Gecko loop
		else this.onLoadStarted = true;
		
			   
		if (this.loading) {
			this.loading.style.visibility = 'hidden';
			this.loading = null;
			this.a.style.cursor = this.originalCursor || '';
		}
		if (this.isImage) {			
			this.newWidth = this.content.width;
			this.newHeight = this.content.height;
			this.fullExpandWidth = this.newWidth;
			this.fullExpandHeight = this.newHeight;
			
			this.content.width = this.thumbWidth;
			this.content.height = this.thumbHeight;
			
		} else if (this.htmlGetSize) this.htmlGetSize();
		
		this.marginBottom = zp.marginBottom;
		this.getCaption();
		
		this.wrapper.appendChild(this.content);
		this.content.style.position = 'relative'; // Saf
		if (this.caption) this.wrapper.appendChild(this.caption);
		this.wrapper.style.left = this.thumbLeft +'px';
		this.wrapper.style.top = this.thumbTop +'px';
		zp.container.appendChild(this.wrapper);
		
		// correct for borders
		this.offsetBorderW = (this.content.offsetWidth - this.thumbWidth) / 2;
		this.offsetBorderH = (this.content.offsetHeight - this.thumbHeight) / 2;
		var modMarginRight = zp.marginRight + 2 * this.offsetBorderW;
		this.marginBottom += 2 * this.offsetBorderH;
		
		var ratio = this.newWidth / this.newHeight;
		var minWidth = this.allowSizeReduction ? this.minWidth : this.newWidth;
		var minHeight = this.allowSizeReduction ? this.minHeight : this.newHeight;
		
		var justify = { x: 'auto', y: 'auto' };
		if (this.align == 'center') {
			justify.x = 'center';
			justify.y = 'center';
		} else {
			if (this.anchor.match(/^top/)) justify.y = null;
			if (this.anchor.match(/right$/)) justify.x = 'max';
			if (this.anchor.match(/^bottom/)) justify.y = 'max';
			if (this.anchor.match(/left$/)) justify.x = null;
		}
		
		client = new zp.clientInfo();		
		
		// justify
		this.x = { 
			min: parseInt(this.thumbLeft) - this.offsetBorderW + this.thumbOffsetBorderW,
			span: this.newWidth,
			minSpan: this.newWidth < minWidth ? this.newWidth : minWidth,
			justify: justify.x,
			target: this.targetX,
			marginMin: zp.marginLeft, 
			marginMax: modMarginRight,
			scroll: client.scrollLeft,
			clientSpan: client.width,
			thumbSpan: this.thumbWidth
		};
		var oldRight = this.x.min + parseInt(this.thumbWidth);
		this.x = this.justify(this.x);
		this.y = { 
			min: parseInt(this.thumbTop) - this.offsetBorderH + this.thumbOffsetBorderH,
			span: this.newHeight,
			minSpan: this.newHeight < minHeight ? this.newHeight : minHeight,
			justify: justify.y,
			target: this.targetY,
			marginMin: zp.marginTop, 
			marginMax: this.marginBottom, 
			scroll: client.scrollTop,
			clientSpan: client.height,
			thumbSpan: this.thumbHeight
		};
		var oldBottom = this.y.min + parseInt(this.thumbHeight);
		this.y = this.justify(this.y);
		
		if (this.isHtml) this.htmlSizeOperations();	
		if (this.isImage) this.correctRatio(ratio);

		var x = this.x;
		var y = this.y;
		
		this.show();
	} catch (e) {
		if (zp.expanders[this.key] && zp.expanders[this.key].a) 
			window.location.href = zp.getSrc(zp.expanders[this.key].a);
	}
};

ZpExpander.prototype.show = function () {
	// Selectbox bug
	var imgPos = {x: this.x.min - 20, y: this.y.min - 20, w: this.x.span + 40, h: this.y.span + 40 + this.spaceForCaption};
	zp.hideSelects = (zp.ie && zp.ieVersion() < 7);
	if (zp.hideSelects) this.showHideElements('SELECT', 'hidden', imgPos);
	// Iframes bug
	zp.hideIframes = (window.opera || navigator.vendor == 'KDE' || (zp.ie && zp.ieVersion() < 5.5));
	if (zp.hideIframes) this.showHideElements('IFRAME', 'hidden', imgPos);
	
	// Make outline ready	
	if (this.objOutline && !this.outlineWhileAnimating) this.positionOutline(this.x.min, this.y.min, this.x.span, this.y.span);
	var o2 = this.objOutline ? this.objOutline.offset : 0;
	
	// Apply size change		
	this.changeSize(
		1,
		this.thumbLeft + this.thumbOffsetBorderW - this.offsetBorderW,
		this.thumbTop + this.thumbOffsetBorderH - this.offsetBorderH,
		this.thumbWidth,
		this.thumbHeight,
		this.x.min,
		this.y.min,
		this.x.span,
		this.y.span, 
		zp.expandDuration,
		zp.expandSteps,
		zp.outlineStartOffset,
		o2
	);
};

ZpExpander.prototype.justify = function (p) {
	
	var tgt, dim = p == this.x ? 'x' : 'y';
	if (p.target && p.target.match(/ /)) {
		tgt = p.target.split(' ');
		p.target = tgt[0];
	}
	if (p.target && zp.$(p.target)) {
		p.min = zp.position(zp.$(p.target))[dim];
		if (tgt && tgt[1] && tgt[1].match(/^[-]?[0-9]+px$/)) p.min += parseInt(tgt[1]);
		
	} else if (p.justify == 'auto' || p.justify == 'center') {
		var hasMovedMin = false;
		var allowReduce = true;
		
		// calculate p.min
		if (p.justify == 'center') p.min = Math.round(p.scroll + (p.clientSpan - p.span - p.marginMax) / 2);
		else p.min = Math.round(p.min - ((p.span - p.thumbSpan) / 2)); // auto
		
		if (p.min < p.scroll + p.marginMin) {
			p.min = p.scroll + p.marginMin;
			hasMovedMin = true;		
		}
		
		if (p.span < p.minSpan) {
			p.span = p.minSpan;
			allowReduce = false;
		}
		// calculate right/newWidth
		if (p.min + p.span > p.scroll + p.clientSpan - p.marginMax) {
			if (hasMovedMin && allowReduce) p.span = p.clientSpan - p.marginMin - p.marginMax; // can't expand more
			else if (p.span < p.clientSpan - p.marginMin - p.marginMax) { // move newTop up
				p.min = p.scroll + p.clientSpan - p.span - p.marginMin - p.marginMax;
			} else { // image larger than client
				p.min = p.scroll + p.marginMin;
				if (allowReduce) p.span = p.clientSpan - p.marginMin - p.marginMax;
			}
			
		}
		
		if (p.span < p.minSpan) {
			p.span = p.minSpan;
			allowReduce = false;
		}
		
	} else if (p.justify == 'max') {
		p.min = Math.floor(p.min - p.span + p.thumbSpan);
	}
		
	if (p.min < p.marginMin) {
		tmpMin = p.min;
		p.min = p.marginMin; 
		if (allowReduce) p.span = p.span - (p.min - tmpMin);
	}
	return p;
};

ZpExpander.prototype.correctRatio = function(ratio) {
	var x = this.x;
	var y = this.y;
	var changed = false;
	if (x.span / y.span > ratio) { // width greater
		var tmpWidth = x.span;
		x.span = y.span * ratio;
		if (x.span < x.minSpan) { // below minWidth
			x.span = x.minSpan;	
			y.span = x.span / ratio;
		}
		changed = true;
	
	} else if (x.span / y.span < ratio) { // height greater
		var tmpHeight = y.span;
		y.span = x.span / ratio;
		changed = true;
	}
	
	if (changed) {
		x.min = parseInt(this.thumbLeft) - this.offsetBorderW + this.thumbOffsetBorderW;
		x.minSpan = x.span;
		this.x = this.justify(x);
		
		y.min = parseInt(this.thumbTop) - this.offsetBorderH + this.thumbOffsetBorderH;
		y.minSpan = y.span;
		this.y = this.justify(y);
	}
};

ZpExpander.prototype.changeSize = function(dir, x1, y1, w1, h1, x2, y2, w2, h2, dur, steps, oo1, oo2) {
	var dW = (w2 - w1) / steps,
	dH = (h2 - h1) / steps,
	dX = (x2 - x1) / steps,
	dY = (y2 - y1) / steps,
	dOo = (oo2 - oo1) /steps,
	t,
	exp = "zp.expanders["+ this.key +"]";
	for (i = 1; i <= steps; i++) {
		w1 += dW;
		h1 += dH;
		x1 += dX;
		y1 += dY;
		oo1 += dOo;
		t = Math.round(i * (dur / steps));
		
		var s = "try {";
		if (i == 1) {
			s += exp +".content.style.visibility = 'visible';"
				+ "if ("+ exp +".thumb.tagName == 'IMG' && zp.hideThumbOnExpand) "+ exp +".thumb.style.visibility = 'hidden';"
		}
		if (i == steps) {
			w1 = w2;
			h1 = h2;
			x1 = x2;
			y1 = y2;
			oo1 = oo2;
		}
		s += exp +"."+ this.contentType +"SetSize("+ Math.round(w1) +", "+ Math.round(h1) +", "
			+ Math.round(x1) +", "+ Math.round(y1) +", "+ Math.round(oo1);
		s += ");} catch (e) {}";
		setTimeout(s, t);
	}
	if (dir == 1) {
		setTimeout('try { '+ exp +'.objOutline.table.style.visibility = "visible"; } catch (e){}', t);
		setTimeout('try { '+ exp +'.onExpanded(); } catch(e){}', t+50);
	}
	else setTimeout('try { '+ exp +'.onEndClose(); } catch(e){}', t);
		
};

ZpExpander.prototype.imageSetSize = function (w, h, x, y, offset) {
	try {
		this.content.width = w;
		this.content.height = h;
		
		if (this.objOutline && this.outlineWhileAnimating) {
			var o = this.objOutline.offset - offset;
			this.positionOutline(x + o, y + o, w - 2 * o, h - 2 * o, 1);
		}
		
		zp.setStyles ( this.wrapper,
			{
				'visibility': 'visible',
				'left': x +'px',
				'top': y +'px'
			}
		);
		
	} catch (e) { window.location.href = zp.getSrc(this.a);	}
};

ZpExpander.prototype.positionOutline = function(x, y, w, h, vis) {
	if (!this.objOutline) return;
	var o = this.objOutline;
	if (vis) o.table.style.visibility = 'visible';
	o.table.style.left = (x - o.offset) +'px';
	o.table.style.top = (y - o.offset) +'px';
	o.table.style.width = (w + 2 * (this.offsetBorderW + o.offset)) +'px';
	w += 2 * (this.offsetBorderW - o.offset);
	h += + 2 * (this.offsetBorderH - o.offset);
	o.td[4].style.width = w >= 0 ? w +'px' : 0;
	o.td[4].style.height = h >= 0 ? h +'px' : 0;
	if (o.hasAlphaImageLoader) o.td[3].style.height = o.td[5].style.height = o.td[4].style.height;
};

ZpExpander.prototype.onExpanded = function() {
	
	this.isExpanded = true;
	this.focus();
	if (this.isHtml && this.objectLoadTime == 'after') this.writeExtendedContent();
	this.createCustomOverlays();
	if (zp.showCredits) this.writeCredits();
	
	if (this.caption) this.writeCaption();
	
	if (this.fullExpandWidth > this.x.span) this.createFullExpand();
	if (!this.caption) this.onDisplayFinished();
};

ZpExpander.prototype.onDisplayFinished = function() {
	var key = this.key;
	var outlineType = this.outlineType;
	new ZpOutline(outlineType, function () { 
		try { zp.expanders[key].preloadNext();	} catch (e) {}
	});
};

ZpExpander.prototype.preloadNext = function() {
	var next = zp.getAdjacentAnchor(this.key, 1);	
	if (next.onclick.toString().match(/zp\.expand/)) 
		var img = zp.createElement('img', { src: zp.getSrc(next) });
};

ZpExpander.prototype.cancelLoading = function() {
	this.a.style.cursor = this.originalCursor;	
	if (this.loading) zp.loading.style.visibility = 'hidden';		
	zp.expanders[this.key] = null;
};

ZpExpander.prototype.writeCredits = function () {
	var credits = zp.createElement('a',
		{
			href: zp.creditsHref,
			className: 'zooming-credits',
			innerHTML: zp.creditsText,
			title: zp.creditsTitle
		}
	);
	this.createOverlay(credits, 'top left');
};

ZpExpander.prototype.getCaption = function() {
	if (!this.captionId && this.thumbsUserSetId)  this.captionId = 'caption-for-'+ this.thumbsUserSetId;
	if (this.captionId) {
		this.caption = zp.getNode(this.captionId);
	}
	if (this.captionTemplateId) {
		var s = (this.caption) ? this.caption.innerHTML : '';
		this.caption = zp.getNode(this.captionTemplateId);
		if (this.caption) this.caption.innerHTML
			= this.caption.innerHTML.replace(/\s/g, ' ').replace('{caption}', s);
	}		
	if (this.caption) this.marginBottom += this.spaceForCaption;

};

ZpExpander.prototype.writeCaption = function() {
	try {
		this.wrapper.style.width = this.wrapper.offsetWidth +'px';	
		this.caption.style.visibility = 'hidden';
		this.caption.className += ' zooming-display-block';
		
		var height;
		if (zp.ie && (zp.ieVersion() < 6 || document.compatMode == 'BackCompat')) {
			height = this.caption.offsetHeight;
		} else {
			var temp = zp.createElement('div', {innerHTML: this.caption.innerHTML}, 
				null, null, true); // to get height
			this.caption.innerHTML = '';
			this.caption.appendChild(temp);	
			height = this.caption.childNodes[0].offsetHeight;//parseInt(zp.getStyle(this.caption, 'height'));
			this.caption.innerHTML = this.caption.childNodes[0].innerHTML;
		}
		zp.setStyles(this.caption, { overflow: 'hidden', height: 0, zIndex: 2 });
		
		if (zp.captionSlideSpeed) {
			step = Math.round(height/50);
			if (step == 0) step = 1;
			step = step * zp.captionSlideSpeed;
		} else {
			this.placeCaption(height, 1);
			return;
		}

		var t = 0;
		for (var h = height % step; h <= height; h += step, t += 10) {
			var end = (h == height) ? 1 : 0;
			var eval = "try { "
				+ "zp.expanders["+ this.key +"].placeCaption("+ h +", "+ end +");"
				+ "} catch (e) {}";			
			setTimeout (eval, t);
		}
	
	} catch (e) {}	
};

ZpExpander.prototype.placeCaption = function(height, end) {
	if (!this.caption) return;
	this.caption.style.height = height +'px';
	this.caption.style.visibility = 'visible';
	this.y.span = this.wrapper.offsetHeight - 2 * this.offsetBorderH;
	var o = this.objOutline;
	if (o) {
		o.td[4].style.height = (this.wrapper.offsetHeight - 2 * this.objOutline.offset) +'px';
		if (o.hasAlphaImageLoader) o.td[3].style.height = o.td[5].style.height = o.td[4].style.height;
	}
	if (end) this.onDisplayFinished();
};

ZpExpander.prototype.showHideElements = function (tagName, visibility, imgPos) {
	var els = document.getElementsByTagName(tagName);
	if (els) {			
		for (i = 0; i < els.length; i++) {
			if (els[i].nodeName == tagName) {  
				var hiddenBy = els[i].getAttribute('hidden-by');
				 
				if (visibility == 'visible' && hiddenBy) {
					hiddenBy = hiddenBy.replace('['+ this.key +']', '');
					els[i].setAttribute('hidden-by', hiddenBy);
					if (!hiddenBy) els[i].style.visibility = 'visible';				
					
				} else if (visibility == 'hidden') { // hide if behind
					var elPos = zp.position(els[i]);
					elPos.w = els[i].offsetWidth;
					elPos.h = els[i].offsetHeight;
				
					var clearsX = (elPos.x + elPos.w < imgPos.x || elPos.x > imgPos.x + imgPos.w);
					var clearsY = (elPos.y + elPos.h < imgPos.y || elPos.y > imgPos.y + imgPos.h);
					var wrapperKey = zp.getWrapperKey(els[i]);
					if (!clearsX && !clearsY && wrapperKey != this.key) { // element falls behind image
						if (!els[i].currentStyle || (els[i].currentStyle && els[i].currentStyle['visibility'] != 'hidden')) { // IE
							if (!hiddenBy) {
								els[i].setAttribute('hidden-by', '['+ this.key +']');
							} else if (!hiddenBy.match('['+ this.key +']')) {
								els[i].setAttribute('hidden-by', hiddenBy + '['+ this.key +']');
							}
							els[i].style.visibility = 'hidden';	  
						}
					} else if (hiddenBy == '['+ this.key +']' || zp.focusKey == wrapperKey) { // on move
						els[i].setAttribute('hidden-by', '');
						els[i].style.visibility = 'visible';
					} else if (hiddenBy && hiddenBy.match('['+ this.key +']')) {
						els[i].setAttribute('hidden-by', hiddenBy.replace('['+ this.key +']', ''));
					}
				}   
			}
		}
	}
};

ZpExpander.prototype.focus = function() {
	// blur others
	for (i = 0; i < zp.expanders.length; i++) {
		if (zp.expanders[i] && i == zp.focusKey) {
			var blurExp = zp.expanders[i];
			blurExp.content.className += ' zooming-'+ blurExp.contentType +'-blur';
			if (blurExp.caption) {
				blurExp.caption.className += ' zooming-caption-blur';
			}
			if (blurExp.isImage) {
				blurExp.content.style.cursor = zp.ie ? 'hand' : 'pointer';
				blurExp.content.title = zp.focusTitle;	
			}
		}
	}
	
	// focus this
	this.wrapper.style.zIndex = zp.zIndexCounter++;
	if (this.objOutline) this.objOutline.table.style.zIndex = this.wrapper.style.zIndex;
	
	this.content.className = 'zooming-'+ this.contentType;
	if (this.caption) {
		this.caption.className = this.caption.className.replace(' zooming-caption-blur', '');
	}
	
	if (this.isImage) {
		this.content.title = zp.restoreTitle;
		
		zp.styleRestoreCursor = window.opera ? 'pointer' : 'url('+ zp.graphicsDir + zp.restoreCursor +'), pointer';
		if (zp.ie && zp.ieVersion() < 6) zp.styleRestoreCursor = 'hand';
		this.content.style.cursor = zp.styleRestoreCursor;
	}
	
	zp.focusKey = this.key;	
	zp.addEventListener(document, 'keydown', zp.keyHandler);
	
};

ZpExpander.prototype.onClick = function() {
	this.doClose();
};

ZpExpander.prototype.doClose = function() {
	zp.removeEventListener(document, 'keydown', zp.keyHandler);
	try {
		this.isClosing = true;
		
		var x = parseInt(this.wrapper.style.left);
		var y = parseInt(this.wrapper.style.top);
		var w = (this.isImage) ? this.content.width : parseInt(this.content.style.width);
		var h = (this.isImage) ? this.content.height : parseInt(this.content.style.height);
		
		if (this.objOutline) {
			if (this.outlineWhileAnimating) this.positionOutline(x, y, w, h);
			else if (this.preserveContent) this.objOutline.table.style.visibility = 'hidden';
			else this.objOutline.destroy();
		}
		
		// remove children
		var n = this.wrapper.childNodes.length;
		for (i = n - 1; i >= 0 ; i--) {
			var child = this.wrapper.childNodes[i];
			if (child != this.content) {
				zp.purge(this.wrapper.childNodes[i]);
				this.wrapper.removeChild(this.wrapper.childNodes[i]);
			}
		}
		if (this.isHtml) this.htmlOnClose();
		
		this.wrapper.style.width = 'auto';
		this.content.style.cursor = 'default';
		var o2 = this.objOutline ? this.objOutline.offset : 0;
		
		this.changeSize(
			-1,
			x,
			y,
			w,
			h,
			this.thumbLeft - this.offsetBorderW + this.thumbOffsetBorderW,
			this.thumbTop - this.offsetBorderH + this.thumbOffsetBorderH,
			this.thumbWidth,
			this.thumbHeight, 
			zp.restoreDuration,
			zp.restoreSteps,
			o2,
			zp.outlineStartOffset
		);
		
	} catch (e) {
		this.onEndClose();
	} 
};

ZpExpander.prototype.onEndClose = function () {
	this.thumb.style.visibility = 'visible';
	
	if (zp.hideSelects) this.showHideElements('SELECT', 'visible');
	if (zp.hideIframes) this.showHideElements('IFRAME', 'visible');
	
	if (this.preserveContent) this.sleep();
	else {
		if (this.objOutline && this.outlineWhileAnimating) this.objOutline.destroy();
		zp.purge(this.wrapper);
		this.wrapper.parentNode.removeChild(this.wrapper);
	}
	zp.expanders[this.key] = null;

	zp.cleanUp();
};

ZpExpander.prototype.createOverlay = function (el, position, hideOnMouseOut, opacity) {
	if (typeof el == 'string') el = zp.getNode(el);
	if (!el || typeof el == 'string' || !this.isImage) return;
	
	var overlay = zp.createElement(
		'div',
		null,
		{
			'left' : 0,
			'top' : 0,
			'position' : 'absolute',
			'zIndex' : 3,
			'visibility' : 'hidden'
		},
		this.wrapper,
		true
	);
	if (opacity) zp.setStyles(el, { 'opacity': opacity });
	el.className += ' zooming-display-block';
	overlay.appendChild(el);	
	
	var left = this.offsetBorderW;
	var dLeft = this.content.width - overlay.offsetWidth;
	var top = this.offsetBorderH;
	var dTop = this.content.height - overlay.offsetHeight;
	
	if (!position) position = 'center center';
	if (position.match(/^bottom/)) top += dTop;
	if (position.match(/^center/)) top += dTop / 2;
	if (position.match(/right$/)) left += dLeft;
	if (position.match(/center$/)) left += dLeft / 2;
	overlay.style.left = left +'px';
	overlay.style.top = top +'px';
	
	if (hideOnMouseOut) overlay.setAttribute('hideOnMouseOut', true);
	if (!opacity) opacity = 1;
	overlay.setAttribute('opacity', opacity);
	zp.fade(overlay, 0, opacity, 1);
	
	zp.push(this.overlays, overlay);
};

ZpExpander.prototype.createCustomOverlays = function() {
	for (i = 0; i < zp.overlays.length; i++) {
		var o = zp.overlays[i];
		if (o.thumbnailId == null || o.thumbnailId == this.thumbsUserSetId) {
			this.createOverlay(o.overlayId, o.position, o.hideOnMouseOut, o.opacity);
		}
	}
};

ZpExpander.prototype.onMouseOver = function () {
	for (i = 0; i < this.overlays.length; i++) {
		var o = this.overlays[i];
		if (o.getAttribute('hideOnMouseOut'))
			zp.fade(o, 0, o.getAttribute('opacity'), 1);
	}
};

ZpExpander.prototype.onMouseOut = function() {
	for (i = 0; i < this.overlays.length; i++) {
		var o = this.overlays[i];
		if (o.getAttribute('hideOnMouseOut')) 
			zp.fade(o, o.getAttribute('opacity'), 0, -1);
	}
};

ZpExpander.prototype.createFullExpand = function () {
	var a = zp.createElement(
		'a',
		{
			href: 'javascript:zp.expanders['+ this.key +'].doFullExpand();',
			title: zp.fullExpandTitle
		},
		{
			background: 'url('+ zp.graphicsDir + zp.fullExpandIcon+')',
			display: 'block',
			margin: '0 10px 10px 0',
			width: '45px',
			height: '44px'
		}, null, true
	);
	
	this.createOverlay(a, 'bottom right', true, 0.75);
	this.fullExpandIcon = a;
};

ZpExpander.prototype.doFullExpand = function () {
	try {
		zp.purge(this.fullExpandIcon);
		this.fullExpandIcon.parentNode.removeChild(this.fullExpandIcon);
		this.focus();
		
		this.x.min = parseInt(this.wrapper.style.left) - (this.fullExpandWidth - this.content.width) / 2;
		if (this.x.min < zp.marginLeft) this.x.min = zp.marginLeft;		
		this.wrapper.style.left = this.x.min +'px';
		
		var borderOffset = this.wrapper.offsetWidth - this.content.width;		
		
		this.content.width = this.fullExpandWidth;
		this.content.height = this.fullExpandHeight;
		
		this.x.span = this.content.width;
		this.wrapper.style.width = (this.x.span + borderOffset) +'px';
		
		this.y.span = this.wrapper.offsetHeight - 2 * this.offsetBorderH;
		this.positionOutline(this.x.min, this.y.min, this.x.span, this.y.span);
		
		// reposition overlays
		for (var i = 0; i < this.overlays.length; i++) {
			zp.purge(this.overlays[i]);
			this.overlays[i].parentNode.removeChild(this.overlays[i]);
		}	
		if (zp.showCredits) this.writeCredits();
		this.createCustomOverlays();
		
		this.redoShowHide();
	
	} catch (e) {
		window.location.href = this.content.src;
	}
};

// on end move and resize
ZpExpander.prototype.redoShowHide = function() {
	var imgPos = {
		x: parseInt(this.wrapper.style.left) - 20, 
		y: parseInt(this.wrapper.style.top) - 20, 
		w: this.content.offsetWidth + 40, 
		h: this.content.offsetHeight + 40 + this.spaceForCaption
	};
	if (zp.hideSelects) this.showHideElements('SELECT', 'hidden', imgPos);
	if (zp.hideIframes) this.showHideElements('IFRAME', 'hidden', imgPos);

};

// set handlers
zp.addEventListener(document, 'mousedown', zp.mouseClickHandler);
zp.addEventListener(document, 'mouseup', zp.mouseClickHandler);
zp.addEventListener(window, 'load', zp.preloadImages);