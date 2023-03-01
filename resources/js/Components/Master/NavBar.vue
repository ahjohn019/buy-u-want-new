<template>
    <nav
        class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-900 border-b-2"
    >
        <div
            class="container flex flex-wrap justify-between items-center mx-auto"
        >
            <Link :href="route('main.index')" class="flex items-center">
                <!-- <span
                    class="self-center text-xl font-semibold whitespace-nowrap dark:text-white"
                    >Buy U Want</span
                > -->
                <img :src="'/images/logo-buyuwant.png'" alt="" width="100" />
            </Link>

            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul
                    class="flex flex-col p-4 mt-4 bg-gray-50 border border-gray-100 md:flex-row md:space-x-4 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700"
                >
                    <li>
                        <a
                            href="#"
                            class="block py-2 pr-4 pl-3 text-gray-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white"
                            aria-current="page"
                            ><n-button>
                                <font-awesome-icon
                                    icon="fa-solid fa-magnifying-glass"
                                    class="mx-2 fa-xl"
                                />
                            </n-button>
                        </a>
                    </li>
                    <li>
                        <Link
                            :href="route('cart.index')"
                            class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                            ><n-button
                                ><font-awesome-icon
                                    icon="fa-solid fa-cart-shopping"
                                    class="mx-2 fa-xl"
                            /></n-button>
                        </Link>
                    </li>
                    <li>
                        <n-dropdown trigger="hover" :options="options">
                            <n-button>
                                <font-awesome-icon
                                    icon="fa-solid fa-user-plus"
                                    class="mx-2 fa-xl"
                            /></n-button>
                        </n-dropdown>
                    </li>
                </ul>
            </div>
            <SideBar :options="options" />
        </div>
    </nav>
</template>

<script>
import { defineComponent, h } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import SideBar from "./SideBar.vue";

export default defineComponent({
    components: {
        Link,
        SideBar,
    },
    props: ["auth", "roles"],
    setup() {
        return {
            options: [],
            display: false,
        };
    },

    methods: {
        handleResize() {
            this.display =
                window.getComputedStyle(document.getElementById("navBar"))
                    .display == "flex"
                    ? true
                    : false;
            this.options.find((e) => e.key == "cartMain").show = this.display;
        },
    },
    mounted() {
        var navBarDisplay = window.getComputedStyle(
            document.getElementById("navBar")
        ).display;

        window.addEventListener("resize", this.handleResize);

        if (this.roles == "admin") {
            this.options.push({
                label: () =>
                    h(
                        "a",
                        {
                            href: route("admin.index"),
                        },
                        "Admin"
                    ),
                key: "admin",
            });
        }

        this.options.push(
            {
                label: () =>
                    this.auth === null
                        ? h(
                              "a",
                              {
                                  href: route("login"),
                              },
                              "Login"
                          )
                        : h(
                              "form",
                              { method: "post", action: route("logout") },
                              [h("input", { type: "submit", value: "Logout" })]
                          ),
                key: this.auth === null ? "login" : "logout",
            },
            {
                label: () =>
                    h(
                        "a",
                        {
                            href: route("cart.index"),
                        },
                        "Cart"
                    ),

                key: "cartMain",
                show: navBarDisplay == "flex" ? true : false,
            }
        );
    },
});
</script>
