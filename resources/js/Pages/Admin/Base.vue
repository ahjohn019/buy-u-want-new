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
                    <slot name="admin"></slot>
                </n-layout>
            </n-layout>
        </n-space>
    </div>
</template>

<script>
import { ref, defineComponent } from "vue";
import { NSpace, NLayout, NLayoutSider, NMenu } from "naive-ui";

const menuOptions = [
    {
        label: "Products",
        key: "products",
    },

    {
        label: "Category",
        key: "category",
    },
];

export default defineComponent({
    components: {
        NSpace,
        NLayout,
        NLayoutSider,
        NMenu,
    },
    setup() {
        return {
            menuOptions,
            collapsed: ref(false),
        };
    },
});
</script>
