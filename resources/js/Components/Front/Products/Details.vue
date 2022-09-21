<template>
    <ul
        class="nav nav-tabs flex flex-col md:flex-row flex-wrap list-none border-b-0 pl-0 mb-4"
        id="tabs-tabFill"
        role="tablist"
    >
        <li class="nav-item flex-auto text-center" role="presentation">
            <a
                href="#tabs-homeFill"
                class="nav-link w-full block font-medium text-xs leading-tight uppercase border-x-0 border-t-0 border-b-2 border-transparent px-6 py-3 my-2 hover:border-transparent hover:bg-gray-100 focus:border-transparent active"
                id="tabs-home-tabFill"
                data-bs-toggle="pill"
                data-bs-target="#tabs-homeFill"
                role="tab"
                aria-controls="tabs-homeFill"
                aria-selected="true"
                >Product Descriptions</a
            >
        </li>
        <li class="nav-item flex-auto text-center" role="presentation">
            <a
                href="#tabs-profileFill"
                class="nav-link w-full block font-medium text-xs leading-tight uppercase border-x-0 border-t-0 border-b-2 border-transparent px-6 py-3 my-2 hover:border-transparent hover:bg-gray-100 focus:border-transparent"
                id="tabs-profile-tabFill"
                data-bs-toggle="pill"
                data-bs-target="#tabs-profileFill"
                role="tab"
                aria-controls="tabs-profileFill"
                aria-selected="false"
                >Product Reviews</a
            >
        </li>
    </ul>
    <div class="tab-content" id="tabs-tabContentFill">
        <div
            class="tab-pane fade show active"
            id="tabs-homeFill"
            role="tabpanel"
            aria-labelledby="tabs-home-tabFill"
        >
            {{ products.description }}
        </div>
        <div
            class="tab-pane fade"
            id="tabs-profileFill"
            role="tabpanel"
            aria-labelledby="tabs-profile-tabFill"
        >
            Product Reviews
        </div>
    </div>
</template>

<script>
export default {
    props: ["products"],
};
</script>
