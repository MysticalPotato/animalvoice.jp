document.getElementById("menu-toggle").addEventListener("click", function () {
    document.body.classList.toggle("show-nav");
});

// do only on mobile
if (window.innerWidth < 990) {
    [].forEach.call(document.getElementsByClassName("nav-btn"), function (el) {
        el.href = el.href + "?nav=close";
    });
}

// hide menu on page load
document.body.classList.remove("show-nav");
