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
                    class="hidden md:block bg-blue-300"
                >
                    <a :href="route('admin.index')">
                        <img
                            :src="'/images/logo-buyuwant.png'"
                            alt=""
                            class="p-4 mx-auto"
                            width="150"
                        />
                    </a>

                    <n-menu
                        :collapsed="collapsed"
                        :collapsed-width="32"
                        :collapsed-icon-size="22"
                        :options="menu"
                    />
                </n-layout-sider>
                <n-layout>
                    <div
                        class="container mx-auto p-6 md:px-0 flex justify-between"
                    >
                        <div><slot name="title"></slot></div>
                        <SideBar :options="menu" />
                    </div>
                    <slot name="admin" class="container mx-auto px-6"></slot>
                </n-layout>
            </n-layout>
        </n-space>
    </div>
</template>

<script>
import { ref, defineComponent } from "vue";
import SideBar from "@web/Master/SideBar.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Menu from "@/CustomAdminSideMenu";

const menu = Menu();

export default defineComponent({
    components: {
        SideBar,
        Link,
    },
    setup() {
        return {
            menu,
            collapsed: ref(false),
        };
    },
});
</script>
