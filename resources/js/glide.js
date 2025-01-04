import Glide from "@glidejs/glide";
import "@glidejs/glide/dist/css/glide.core.min.css";
import "@glidejs/glide/dist/css/glide.theme.min.css";

document.querySelectorAll(".glide").forEach((element) => {
    let config = {};

    try {
        config = JSON.parse(element.dataset.glide);
    } catch (exception) {
        console.error("Error parsing JSON; using defaults.");
    }

    new Glide(element, config).mount();
});
