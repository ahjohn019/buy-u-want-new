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
                        :options="menuOptions"
                    />
                </n-layout-sider>
                <n-layout>
                    <div class="flex justify-between">
                        <div><slot name="title"></slot></div>
                        <div class="mr-6 flex items-center block md:hidden">
                            <n-dropdown trigger="click" :options="menuOptions">
                                <n-button
                                    ><n-icon
                                        ><font-awesome-icon
                                            icon="fa-solid fa-bars"
                                            class="fa-lg" /></n-icon
                                ></n-button>
                            </n-dropdown>
                        </div>
                    </div>
                    <slot name="admin"></slot>
                </n-layout>
            </n-layout>
        </n-space>
    </div>
</template>

<script>
import { ref, defineComponent, h } from "vue";
import {
    NSpace,
    NLayout,
    NLayoutSider,
    NMenu,
    NDropdown,
    NButton,
    NIcon,
} from "naive-ui";

const menuOptions = [
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
                            href: route("users.index"),
                        },
                        "Index"
                    ),
                key: "dashboardUsers",
            },
        ],
    },
];

export default defineComponent({
    components: {
        NSpace,
        NLayout,
        NLayoutSider,
        NMenu,
        NDropdown,
        NButton,
        NIcon,
    },
    setup() {
        return {
            menuOptions,
            collapsed: ref(false),
        };
    },
});
</script>
