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
    faAngleLeft,
    faPencil,
    faTruck,
    faMoneyBill,
    faUsers,
    faTrash,
    faCircleInfo,
    faBars,
    faDotCircle,
} from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import AOS from "aos";
import "aos/dist/aos.css";

library.add(
    faMagnifyingGlass,
    faUserPlus,
    faCartShopping,
    faPlus,
    faEnvelope,
    faPhone,
    faLocationPin,
    faMinus,
    faStar,
    faAngleLeft,
    faPencil,
    faTruck,
    faMoneyBill,
    faUsers,
    faTrash,
    faCircleInfo,
    faBars,
    faDotCircle
);
import { createPinia } from "pinia";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

const pinia = createPinia();

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(pinia)
            .use(AOS.init())
            .component("FontAwesomeIcon", FontAwesomeIcon)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: "#4B5563" });
