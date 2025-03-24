// get viewport height from attribute (0-100)
var vh = document.currentScript.getAttribute('vh');
var ref = document.currentScript.getAttribute('ref');
var always = document.currentScript.hasAttribute('always') ? true : false;

// viewport override to prevent twitchy scrolling on mobile devices
// if(always || $(window).width() < 990){
	// $(ref).css("height", $(window).height() * (vh / 100));
// }

if(always || window.screen.width < 990){
	[].forEach.call(document.querySelectorAll(ref), function(el) {
		el.style.height = window.screen.height * (vh / 100) + "px";
	});
}