<template>
    <div class="h-screen relative">
        <n-space vertical>
            <n-layout has-sider position="absolute">
                <n-layout-sider
                    bordered
                    collapse-mode="width"
                    :collapsed-width="64"
                    :width="240"
                    :collapsed="collapsed"
                    show-trigger
                    @collapse="collapsed = true"
                    @expand="collapsed = false"
                    class="hidden md:block"
                >
                    <n-menu
                        :collapsed="collapsed"
                        :collapsed-width="32"
                        :collapsed-icon-size="22"
                        :options="menu"
                    />
                </n-layout-sider>
                <n-layout>
                    <div class="flex justify-between">
                        <div><slot name="title"></slot></div>
                        <SideBar :options="menu" />
                    </div>
                    <slot name="admin"></slot>
                </n-layout>
            </n-layout>
        </n-space>
    </div>
</template>

<script>
import { ref, defineComponent, h } from "vue";
import SideBar from "@web/Master/SideBar.vue";

const menu = [
    {
        label: () =>
            h(
                "a",
                {
                    href: route("admin.index"),
                },
                "Dashboard"
            ),
        key: "dashboardMain",
    },
    {
        label: "Products",
        key: "products",
        children: [
            {
                label: () =>
                    h(
                        "a",
                        {
                            href: route("products.admin"),
                        },
                        "Dashboard"
                    ),
                key: "dashboardProducts",
            },
            {
                label: () =>
                    h(
                        "a",
                        {
                            href: route("products.create"),
                        },
                        "Create"
                    ),
                key: "createProducts",
            },
        ],
    },
    {
        label: "Orders",
        key: "orders",
        children: [
            {
                label: () =>
                    h(
                        "a",
                        {
                            href: route("orders.index"),
                        },
                        "Dashboard"
                    ),
                key: "dashboardOrders",
            },
            {
                label: () =>
                    h(
                        "a",
                        {
                            href: route("orders.create"),
                        },
                        "Create"
                    ),
                key: "dashboardCreate",
            },
        ],
    },

    {
        label: "Users",
        key: "users",
        children: [
            {
                label: () =>
                    h(
                        "a",
                        {
                            href: route("users.create"),
                        },
                        "Create"
                    ),
                key: "userCreate",
            },
            {
                label: () =>
                    h(
                        "a",
                        {
                            href: route("users.index"),
                        },
                        "Index"
                    ),
            },
        ],
    },
];

export default defineComponent({
    components: {
        SideBar,
    },
    setup() {
        return {
            menu,
            collapsed: ref(false),
        };
    },
});
</script>
