var btnContainer = document.getElementById("nav-btn-container");
var btns = btnContainer.getElementsByClassName("nav-btn");

function removeClass(elems, className) {
	[].forEach.call(document.querySelectorAll(elems), function(el) {
		el.classList.remove(className);
	});
}

function showAndHide(idName, className) {
	[].forEach.call(document.getElementsByClassName(className), function(el) {
		el.classList.remove('show');
	});
	document.getElementById(idName).classList.add('show');
}

function showContent(idName) {
	showAndHide(idName, 'content');
}

for (var i = 0; i < btns.length; i++) {
	btns[i].addEventListener('click', function(e) {
		e.preventDefault();
		removeClass('.nav-btn', 'active')
		this.classList.toggle('active');
		
		// hide current and show right content
		var attr = e.target.getAttribute('attr');
		showContent(attr);
	})
}

showContent('new-group');