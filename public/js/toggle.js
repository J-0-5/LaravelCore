document.addEventListener("DOMContentLoaded", function () {
    var aside = document.getElementById("collapseAside");
    var openAside = document.querySelector("#collapseButton");
    var content_page = document.querySelector(".content-page");
    if(openAside == null){
        return;
    }
    // var closeAside = document.querySelector("#toHidden");
    var openIs = true;
    openAside.addEventListener("click", function () {
        // console.log("Abriendo");
        if (openIs) {
            openIs = false;
            aside.style.left = "-260px";
            aside.style.position = "absolute";
            aside.classList.add("openAside");
            // aside.style.transition = "all 1000ms";
            content_page.style.width = '100vw';
        }
        else{
            openIs = true
            aside.style.position = "relative";
            aside.style.left = "0px";
            aside.classList.remove("openAside");
            content_page.style.width = 'calc(100vw - 260px)';
            // content_page.style.transition = "all 1000ms";
        }
    });
});
