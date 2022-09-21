<template>
    <nav
        class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-900 border-b-2"
    >
        <div
            class="container flex flex-wrap justify-between items-center mx-auto"
        >
            <Link :href="route('main.index')" class="flex items-center">
                <span
                    class="self-center text-xl font-semibold whitespace-nowrap dark:text-white"
                    >Buy U Want</span
                >
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
                        >
                            <font-awesome-icon
                                icon="fa-solid fa-magnifying-glass"
                                class="mx-2 fa-xl"
                            />
                        </a>
                    </li>
                    <li>
                        <Link
                            :href="route('login')"
                            class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                        >
                            <font-awesome-icon
                                icon="fa-solid fa-user-plus"
                                class="mx-2 fa-xl"
                            />
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('cart.index')"
                            class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                        >
                            <font-awesome-icon
                                icon="fa-solid fa-cart-shopping"
                                class="mx-2 fa-xl"
                            />
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link,
    },
};
</script>
