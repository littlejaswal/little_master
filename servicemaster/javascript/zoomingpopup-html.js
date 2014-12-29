/******************************************************************************
Name:    Higzplide HTML Extension
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

zp.allowWidthReduction = false;
zp.allowHeightReduction = true;
zp.objectLoadTime = 'before'; // Load iframes 'before' or 'after' expansion.
zp.cacheAjax = true; // Cache ajax popups for instant display. Can be overridden for each popup.
zp.preserveContent = true; // Preserve changes made to the content and position of HTML popups.

// These properties can be overridden in the function call for each expander:
zp.push(zp.overrides, 'contentId');
zp.push(zp.overrides, 'allowWidthReduction');
zp.push(zp.overrides, 'allowHeightReduction');
zp.push(zp.overrides, 'objectType');
zp.push(zp.overrides, 'objectWidth');
zp.push(zp.overrides, 'objectHeight');
zp.push(zp.overrides, 'objectLoadTime');
zp.push(zp.overrides, 'swfObject');
zp.push(zp.overrides, 'cacheAjax');
zp.push(zp.overrides, 'preserveContent');

// Internal
zp.preloadTheseAjax = [];
zp.cacheBindings = [];
zp.sleeping = [];
zp.clearing = zp.createElement('div', null, 
		{ clear: 'both', borderTop: '1px solid white' }, null, true);

zp.htmlExpand = function(a, params, custom) {
	if (!zp.$(params.contentId) && !zp.clones[params.contentId]) return true;
	
	for (var i = 0; i < zp.sleeping.length; i++) {
		if (zp.sleeping[i] && zp.sleeping[i].a == a) {
			zp.sleeping[i].awake();
			zp.sleeping[i] = null;
			return false;
		}
	}
	try {
		zp.hasHtmlexpanders = true;
    	new ZpExpander(a, params, custom, 'html');
    	return false;
	} catch (e) {
		return true;
	}	
};

zp.identifyContainer = function (parent, className) {
	for (i = 0; i < parent.childNodes.length; i++) {
    	if (parent.childNodes[i].className == className) {
			return parent.childNodes[i];
		}
	}
};

zp.preloadAjax = function (e) {
	var aTags = document.getElementsByTagName('A');
	var a, re;
	for (i = 0; i < aTags.length; i++) {
		a = aTags[i];
		re = zp.isZpAnchor(a);
		if (re && re[0] == 'zp.htmlExpand' && zp.getParam(a, 'objectType') == 'ajax' && zp.getParam(a, 'cacheAjax')) {
			zp.push(zp.preloadTheseAjax, a);
		}
	}
	zp.preloadAjaxElement(0);
};

zp.preloadAjaxElement = function (i) {
	if (!zp.preloadTheseAjax[i]) return;
	var a = zp.preloadTheseAjax[i];
	var cache = zp.getNode(zp.getParam(a, 'contentId'));
	var ajax = new ZpAjax(a, cache);	
   	ajax.onError = function () { };
   	ajax.onLoad = function () {
   		zp.push(zp.cacheBindings, [a, cache]);
   		zp.preloadAjaxElement(i + 1);
   	};
   	ajax.run();
};

zp.getCacheBinding = function (a) {
	for (i = 0; i < zp.cacheBindings.length; i++) {
		if (zp.cacheBindings[i][0] == a) {
			var c = zp.cacheBindings[i][1];
			zp.cacheBindings[i][1] = c.cloneNode(1);
			return c;
		}
	}
};

ZpExpander.prototype.htmlCreate = function () {
	this.tempContainer = zp.createElement('div', null,
		{
			padding: '0 '+ zp.marginRight +'px 0 '+ zp.marginLeft +'px',
			position: 'absolute',
			left: 0,
			top: 0
		},
		document.body
	);
	this.innerContent = zp.getCacheBinding(this.a);
	if (!this.innerContent) this.innerContent = zp.getNode(this.contentId);
	
	this.setObjContainerSize(this.innerContent);
	this.tempContainer.appendChild(this.innerContent); // to get full width
	zp.setStyles (this.innerContent, { position: 'relative', visibility: 'hidden' });
	this.innerContent.className += ' zooming-display-block';
	
	this.content = zp.createElement(
    	'div',
    	{	className: 'zooming-html' },
		{
			position: 'relative',
			zIndex: 3,
			overflow: 'hidden',
			width: this.thumbWidth +'px',
			height: this.thumbHeight +'px'
		}
	);
    
	if (this.objectType == 'ajax' && !zp.getCacheBinding(this.a)) {
    	var ajax = new ZpAjax(this.a, this.innerContent);
    	var pThis = this;
    	ajax.onLoad = function () {	pThis.onLoad(); };
    	ajax.onError = function () { location.href = zp.getSrc(this.a); };
    	ajax.run();
	}
    else this.onLoad();
};
    
ZpExpander.prototype.htmlGetSize = function() {
	this.innerContent.appendChild(zp.clearing);
	this.newWidth = this.innerContent.offsetWidth;
    this.newHeight = this.innerContent.offsetHeight;
    this.innerContent.removeChild(zp.clearing);
    if (zp.ie && this.newHeight > parseInt(this.innerContent.currentStyle.height)) { // ie css bug
		this.newHeight = parseInt(this.innerContent.currentStyle.height);
	}
};

ZpExpander.prototype.setObjContainerSize = function(parent, auto) {
	if (this.swfObject || this.objectType == 'iframe') {
		var c = zp.identifyContainer(parent, 'zooming-body');
		c.style.width = this.swfObject ? this.swfObject.attributes.width +'px' : this.objectWidth +'px';
		c.style.height = this.swfObject ? this.swfObject.attributes.height +'px' : this.objectHeight +'px';
	}
};

ZpExpander.prototype.writeExtendedContent = function () {
	if (this.hasExtendedContent) return;
	this.objContainer = zp.identifyContainer(this.innerContent, 'zooming-body');
	if (this.objectType == 'iframe') {
		if (zp.ie && zp.ieVersion() < 5.5) window.location.href = zp.getSrc(this.a);
		var key = this.key;
		this.iframe = zp.createElement('iframe', { frameBorder: 0 },
		   { width: this.objectWidth +'px', height: this.objectHeight +'px' }, 
		   this.objContainer);
		if (zp.safari) this.iframe.src = null;
		this.iframe.src = zp.getSrc(this.a);
		
		if (this.objectLoadTime == 'after') this.correctIframeSize();
		
	} else if (this.swfObject) {	
		this.objContainer.id = this.objContainer.id || 'zp-flash-id-' + this.key;
		this.swfObject.write(this.objContainer.id);	
	}
	this.hasExtendedContent = true;
};

ZpExpander.prototype.correctIframeSize = function () {
	var wDiff = this.innerContent.offsetWidth - this.objContainer.offsetWidth;
	if (wDiff < 0) wDiff = 0;
    
	var hDiff = this.innerContent.offsetHeight - this.objContainer.offsetHeight;
	zp.setStyles(this.iframe, { width: (this.x.span - wDiff) +'px', height: (this.y.span - hDiff) +'px' });
    zp.setStyles(this.objContainer, { width: this.iframe.style.width, height: this.iframe.style.height });
    
    this.scrollingContent = this.iframe;
    this.scrollerDiv = this.scrollingContent;
};

ZpExpander.prototype.htmlSizeOperations = function () {
	this.setObjContainerSize(this.innerContent);
	
	if (this.objectLoadTime == 'before') this.writeExtendedContent();		

    // handle minimum size
    if (this.x.span < this.newWidth && !this.allowWidthReduction) this.x.span = this.newWidth;
    if (this.y.span < this.newHeight && !this.allowHeightReduction) this.y.span = this.newHeight;
    this.scrollerDiv = this.innerContent;
    
    this.mediumContent = zp.createElement('div', null, 
    	{ 
    		width: this.x.span +'px',
    		position: 'relative',
    		left: (this.x.min - this.thumbLeft) +'px',
    		top: (this.y.min - this.thumbTop) +'px'
    	}, this.content, true);
	
    this.mediumContent.appendChild(this.innerContent);
    document.body.removeChild(this.tempContainer);
    zp.setStyles(this.innerContent, { border: 'none', width: 'auto', height: 'auto' });
    
    var node = zp.identifyContainer(this.innerContent, 'zooming-body');
    if (node && !this.swfObject && this.objectType != 'iframe') {    
    	var cNode = node; // wrap to get true size
    	node = zp.createElement(cNode.nodeName, null, {overflow: 'hidden'}, null, true);
    	cNode.parentNode.insertBefore(node, cNode);
    	node.appendChild(zp.clearing); // IE6
    	node.appendChild(cNode);
    	
    	var wDiff = this.innerContent.offsetWidth - node.offsetWidth;
    	var hDiff = this.innerContent.offsetHeight - node.offsetHeight;
    	node.removeChild(zp.clearing);
    	
    	var kdeBugCorr = zp.safari || navigator.vendor == 'KDE' ? 1 : 0; // KDE repainting bug
    	zp.setStyles(node, { 
    			width: (this.x.span - wDiff - kdeBugCorr) +'px', 
    			height: (this.y.span - hDiff) +'px',
    			overflow: 'auto', 
    			position: 'relative' 
    		} 
    	);
		if (kdeBugCorr && cNode.offsetHeight > node.offsetHeight)	{
    		node.style.width = (parseInt(node.style.width) + kdeBugCorr) + 'px';
		}
    	this.scrollingContent = node;
    	this.scrollerDiv = this.scrollingContent;
    	
	} 
	
    if (this.iframe && this.objectLoadTime == 'before') this.correctIframeSize();
    if (!this.scrollingContent && this.y.span < this.mediumContent.offsetHeight) this.scrollerDiv = this.content;
	
	if (this.scrollerDiv == this.content && !this.allowWidthReduction && this.objectType != 'iframe') {
		this.x.span += 17; // room for scrollbars
	}
	if (this.scrollerDiv && this.scrollerDiv.offsetHeight > this.scrollerDiv.parentNode.offsetHeight) {
		setTimeout("try { zp.expanders["+ this.key +"].scrollerDiv.style.overflow = 'auto'; } catch(e) {}",
			 zp.expandDuration);
	}
};

ZpExpander.prototype.htmlSetSize = function (w, h, x, y, offset, end) {
	try {
		zp.setStyles(this.wrapper, { visibility: 'visible', left: x +'px', top: y +'px'});
		zp.setStyles(this.content, { width: w +'px', height: h +'px' });
		zp.setStyles(this.mediumContent, { left: (this.x.min - x) +'px', top: (this.y.min - y) +'px' });
		
		this.innerContent.style.visibility = 'visible';
		
		if (this.objOutline && this.outlineWhileAnimating) {
			var o = this.objOutline.offset - offset;
			this.positionOutline(x + o, y + o, w - 2*o, h - 2*o, 1);
		}
				
	} catch (e) {
		window.location.href = zp.getSrc(this.a);
	}
};

ZpExpander.prototype.reflow = function () {
	zp.setStyles(this.scrollerDiv, { height: 'auto', width: 'auto' });
	this.x.span = this.innerContent.offsetWidth;
	this.y.span = this.innerContent.offsetHeight;
	var size = { width: this.x.span +'px', height: this.y.span +'px' };
	zp.setStyles(this.content, size);
	this.positionOutline(this.x.min, this.y.min, this.x.span, this.y.span);
};

ZpExpander.prototype.htmlOnClose = function() {
	if (this.objectLoadTime == 'after' && !this.preserveContent) this.destroyObject();		
	if (this.scrollerDiv && this.scrollerDiv != this.scrollingContent) 
		this.scrollerDiv.style.overflow = 'hidden';
	if (this.swfObject) zp.$(this.swfObject.getAttribute('id')).StopPlay();
};

ZpExpander.prototype.destroyObject = function () {
	this.objContainer.innerHTML = '';
};

ZpExpander.prototype.sleep = function() {
	if (this.objOutline) this.objOutline.table.className = 'zooming-display-none';
	this.wrapper.className += ' zooming-display-none';
	zp.push(zp.sleeping, this);
};

ZpExpander.prototype.awake = function() {
	zp.expanders[this.key] = this;
	
	this.wrapper.className = this.wrapper.className.replace(/zooming-display-none/, '');
	var z = zp.zIndexCounter++;
	this.wrapper.style.zIndex = z;
	if (o = this.objOutline) {
		if (!this.outlineWhileAnimating) o.table.style.visibility = 'hidden';
		o.table.className = null;
		o.table.style.zIndex = z;
	}
	this.show();
};

// ZpAjax object prototype
ZpAjax = function (a, content) {
	this.a = a;
	this.content = content;
};

ZpAjax.prototype.run = function () {
	try { this.xmlHttp = new XMLHttpRequest(); }
	catch (e) {
		try { this.xmlHttp = new ActiveXObject("Msxml2.XMLHTTP"); }
		catch (e) {
			try { this.xmlHttp = new ActiveXObject("Microsoft.XMLHTTP"); }
			catch (e) { this.onError(); }
		}
	}
	this.src = zp.getSrc(this.a);
	if (this.src.match('#')) {
		var arr = this.src.split('#');
		this.src = arr[0];
		this.id = arr[1];
	}
	var pThis = this;
	this.xmlHttp.onreadystatechange = function() {
		if(pThis.xmlHttp.readyState == 4) {	
			if (pThis.id) pThis.getElementContent();
			else pThis.loadHTML();
		}
	};
	
	this.xmlHttp.open("GET", this.src, true);
	this.xmlHttp.send(null);
};

ZpAjax.prototype.getElementContent = function() {
	zp.genContainer();
	var attribs = window.opera ? { src: this.src } : null; // Opera needs local src
	this.iframe = zp.createElement('iframe', attribs, 
		{ position: 'absolute', left: '-9999px' }, zp.container);
		
	try {
		this.loadHTML();
	} catch (e) { // Opera security
		var pThis = this;
		setTimeout(function() {	pThis.loadHTML(); }, 1);
	}
};

ZpAjax.prototype.loadHTML = function() {
	var s = this.xmlHttp.responseText;
	if (!zp.ie || zp.ieVersion() >= 5.5) {
		s = s.replace(/\s/g, ' ');
		if (this.iframe) {
			s = s.replace(new RegExp('<link[^>]*>', 'gi'), '');
			s = s.replace(new RegExp('<script[^>]*>.*?</script>', 'gi'), '');
			var doc = this.iframe.contentDocument || this.iframe.contentWindow.document;
			doc.open();
			doc.write(s);
			doc.close();
			try { s = doc.getElementById(this.id).innerHTML; } catch (e) {
				try { s = this.iframe.document.getElementById(this.id).innerHTML; } catch (e) {} // opera
			}
			zp.container.removeChild(this.iframe);
		} else {
			s = s.replace(new RegExp('^.*?<body[^>]*>(.*?)</div> </body>.*?$', 'i'), '$1');
		}
		
	}
	zp.identifyContainer(this.content, 'zooming-body').innerHTML = s;
	this.onLoad();
};

zp.addEventListener(window, 'load', zp.preloadAjax);