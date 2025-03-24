// let route = document.currentScript.getAttribute("route").replace(/^\/|\/$/g, "");

// For newsletter
function submitEmail(formId) {
    let form = document.getElementById(formId);
    let submitBtn = form.querySelector("button[type=submit]");
    let errorMsg = form.querySelector(".error-message");
    let formData = new FormData(form);

    form.classList.remove("error");
    submitBtn.classList.add("loading");

    fetch("admin/subscribers", {
        method: "POST",
        body: formData,
    })
        .then((res) => {
            if (res.ok) {
                form.classList.add("success");
            } else {
                form.classList.add("error");
            }
            return res.text();
        })
        .then((txt) => {
            submitBtn.classList.remove("loading");
            errorMsg.textContent = txt;
        })
        .catch((e) => consolse.log(e));

    // Stop form submit
    return false;
}

// For normal forms
function submitForm(formId) {
    let form = document.getElementById(formId);
    let submitBtn = form.querySelector("button[type=submit]");

    submitBtn.classList.add("loading");
}
