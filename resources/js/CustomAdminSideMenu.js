import { h } from "vue";

export default function () {
    const sideMenuStyle = "font-bold";

    return [
        {
            label: () =>
                h("div", [
                    h(
                        "a",
                        {
                            href: route("admin.index"),
                            class: sideMenuStyle,
                        },
                        "Dashboard"
                    ),
                ]),
            key: "dashboardMain",
        },
        {
            label: () =>
                h(
                    "p",
                    {
                        class: sideMenuStyle,
                    },
                    "Products"
                ),
            key: "products",
            children: [
                {
                    label: () =>
                        h(
                            "a",
                            {
                                href: route("products.admin"),
                                class: sideMenuStyle,
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
                                class: sideMenuStyle,
                            },
                            "Create"
                        ),
                    key: "createProducts",
                },
            ],
        },
        {
            label: () =>
                h(
                    "p",
                    {
                        class: sideMenuStyle,
                    },
                    "Orders"
                ),
            key: "orders",
            children: [
                {
                    label: () =>
                        h(
                            "a",
                            {
                                href: route("orders.index"),
                                class: sideMenuStyle,
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
                                class: sideMenuStyle,
                            },
                            "Create"
                        ),
                    key: "dashboardCreate",
                },
            ],
        },

        {
            label: () =>
                h(
                    "p",
                    {
                        class: sideMenuStyle,
                    },
                    "Users"
                ),
            key: "users",
            children: [
                {
                    label: () =>
                        h(
                            "a",
                            {
                                href: route("users.create"),
                                class: sideMenuStyle,
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
                                class: sideMenuStyle,
                            },
                            "Index"
                        ),
                },
            ],
        },
    ];
}
