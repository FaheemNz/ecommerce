try {
    window.Popper = require("popper.js").default;
    window.$ = window.jQuery = require("jquery");

    require("bootstrap");
} catch (e) {}

window.Vue = require("vue");

window.axios = require("axios");
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

window.events = new Vue();
window.flash = (message, type = null) =>
    window.events.$emit("flash", message, type);
