var btns = document.getElementsByClassName("tab-btn");

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
	showAndHide(idName, 'tab-content');
}

for (var i = 0; i < btns.length; i++) {
	btns[i].addEventListener('click', function(e) {
		e.preventDefault();
		removeClass('.tab-btn', 'dark')
		this.classList.toggle('dark');
		
		// hide current and show right content
		var attr = e.target.getAttribute('attr');
		showContent(attr);
	})
}

showContent('tab-videos');