require("./bootstrap");

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { library } from "@fortawesome/fontawesome-svg-core";
import {
    faCartShopping,
    faUserPlus,
    faMagnifyingGlass,
    faPlus,
    faEnvelope,
    faPhone,
    faLocationPin,
    faMinus,
    faStar,
} from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

library.add(
    faMagnifyingGlass,
    faUserPlus,
    faCartShopping,
    faPlus,
    faEnvelope,
    faPhone,
    faLocationPin,
    faMinus,
    faStar
);

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .component("FontAwesomeIcon", FontAwesomeIcon)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: "#4B5563" });
