<template>
    <n-space vertical>
        <n-layout has-sider>
            <n-layout-sider
                bordered
                collapse-mode="width"
                :collapsed-width="64"
                :width="240"
                :collapsed="collapsed"
                show-trigger
                @collapse="collapsed = true"
                @expand="collapsed = false"
            >
                <n-menu
                    :collapsed="collapsed"
                    :collapsed-width="32"
                    :collapsed-icon-size="22"
                    :options="menuOptions"
                    :render-label="renderMenuLabel"
                    :render-icon="renderMenuIcon"
                    :expand-icon="expandIcon"
                    class="fixed"
                />
            </n-layout-sider>
            <n-layout>
                <Dashboard />
            </n-layout>
        </n-layout>
    </n-space>
</template>

<script>
import { h, ref, defineComponent } from "vue";
import { NIcon, NSpace, NLayout, NLayoutSider, NMenu } from "naive-ui";
import Dashboard from "../../Components/Admin/Dashboard/Dashboard.vue";

const menuOptions = [
    {
        label: "Hear the Wind Sing",
        key: "hear-the-wind-sing",
        href: "https://en.wikipedia.org/wiki/Hear_the_Wind_Sing",
    },

    {
        label: "Dance Dance Dance",
        key: "Dance Dance Dance",
        children: [
            {
                type: "group",
                label: "People",
                key: "people",
                children: [
                    {
                        label: "Narrator",
                        key: "narrator",
                    },
                    {
                        label: "Sheep Man",
                        key: "sheep-man",
                    },
                ],
            },
            {
                label: "Beverage",
                key: "beverage",
                children: [
                    {
                        label: "Whisky",
                        key: "whisky",
                        href: "https://en.wikipedia.org/wiki/Whisky",
                    },
                ],
            },
            {
                label: "Food",
                key: "food",
                children: [
                    {
                        label: "Sandwich",
                        key: "sandwich",
                    },
                ],
            },
            {
                label: "The past",
                key: "the-past",
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
        Dashboard,
    },
    setup() {
        return {
            menuOptions,
            collapsed: ref(false),
            renderMenuLabel(option) {
                if ("href" in option) {
                    return h("a", { href: option.href, target: "_blank" }, [
                        option.label,
                    ]);
                }
                return option.label;
            },
            renderMenuIcon(option) {
                if (option.key === "sheep-man") return true;
                if (option.key === "food") return null;
                return h(NIcon, null);
            },
            expandIcon() {
                return h(NIcon, null);
            },
        };
    },
});
</script>
