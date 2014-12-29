
	window.addEvent('domready', function() {
		
		//slider variables for making things easier below
		var itemsHolder = $('slider');
		var myItems = $$(itemsHolder.getElements('.item'));
		
		//controls for slider
		var theControls = $('controls1');
		var thePrevBtn = $(theControls.getElement('.prev_btn'));
		var theNextBtn = $(theControls.getElement('.next_btn'));
		
		
		//create instance of the slider, and start it up		
		var mySlider = new SL_Slider({
			slideTimer: 6000,
			orientation: 'none',      //vertical, horizontal, or none: None will create a fading in/out transition.
			fade: true,                    //if true will fade the outgoing slide - only used if orientation is != None
			isPaused: true,
			slider: itemsHolder,
			items: myItems,
			prevBtn: thePrevBtn,
			nextBtn: theNextBtn
		});
		mySlider.start();
		
		
		//adding a little animated rollover highlight to the play and prev/next buttons
		var origBkgdColor = theNextBtn.getStyle('background-color');
		var newBkgdColor = "#999";
		var btnArray = new Array(thePrevBtn, theNextBtn);
		
		btnArray.each(function(e, i){
			e.set('tween', {duration: 350, transition: 'cubic:out', link: 'cancel'});
			e.addEvents({ 
				'mouseenter' : function() {
					this.tween('background-color', newBkgdColor);
				},
				'mouseleave' : function() {
					this.tween('background-color', origBkgdColor);
				}
			});
		});
					 
	});
	