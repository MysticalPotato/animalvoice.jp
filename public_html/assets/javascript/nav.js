var hideOnScrollDown = true;
var fadeOnTop = false;

function showMenu() {
    // $("#nav").toggleClass("extend");
    document.getElementById("nav").classList.toggle("extend");
    openFolder("default");
}

function openFolder(e, folder) {
    e.preventDefault();
    // $("#mobile-menu>.nav-folder").removeClass("active");
    // $("#mobile-menu").find("[data-folder='" + folder + "']").addClass("active");
    [].forEach.call(document.querySelectorAll("#mobile-menu > .nav-folder"), function (el) {
        el.classList.remove("active");
        if (el.getAttribute("data-folder") === folder) {
            el.classList.add("active");
        }
    });
}

document.getElementById("menu-toggle").addEventListener("click", function () {
    // document.getElementsByTagName('html')[0].classList.toggle('nav-open');
    document.body.classList.toggle("nav-open");
    showMenu();
});

/* When the user scrolls down, hide the navbar. When the user scrolls up, show the navbar */
if (hideOnScrollDown) {
    var nav = document.getElementById("nav");
    var navHeight = document.getElementById("top-nav").offsetHeight;

    let lastScrollPos = 0;
    let lastChangePos = 0;

    addEventListener("scroll", () => {
        if (!nav.classList.contains("extend")) {
            // current scroll position
            const scrollPos = window.scrollY || document.documentElement.scrollTop;

            // update last change position if directen changed
            if (
                (scrollPos > lastScrollPos && scrollPos < lastChangePos) ||
                (scrollPos < lastScrollPos && scrollPos > lastChangePos)
            ) {
                lastChangePos = scrollPos;
            }

            // check scroll direction
            const distance = scrollPos - lastChangePos;

            if (distance > 80) {
                nav.style.top = -navHeight + "px";
            } else if (distance < -80) {
                nav.style.top = "0";
            }

            // update last scroll position
            lastScrollPos = scrollPos;
        }
    });
}

/* Fade on top */
if (fadeOnTop) {
    var navbar = document.getElementById("top-nav");
    let stickyPos = 300;

    addEventListener("scroll", () => {
        if (window.scrollY > stickyPos) {
            navbar.classList.add("solid");
        } else {
            navbar.classList.remove("solid");
        }
    });
}
