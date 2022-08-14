<template>
    <div>
        <p class="text-4xl py-8 font-semibold">Filters</p>
        <div>
            <p class="text-2xl font-semibold">Colors</p>
            <div class="flex space-x-4 py-4">
                <div>
                    <button class="border rounded-full w-6 h-6 bg-red-500"></button>
                </div>
                <div>
                    <button class="border rounded-full w-6 h-6 bg-green-500"></button>
                </div>
                <div>
                    <button class="border rounded-full w-6 h-6 bg-blue-500"></button>
                </div>
                <div>
                    <button class="border rounded-full w-6 h-6 bg-yellow-300"></button>
                </div>
            </div>
        </div>

        <div>
            <p class="text-2xl font-semibold py-4">Prices</p>
            <div class="py-2">
                <p>RM0 - RM 100</p>
                <p>RM100 - RM 200</p>
                <p>RM200 - RM 300</p>
            </div>
        </div>

        <div id="accordion-flush" data-accordion="collapse"
            data-active-classes="bg-white dark:bg-gray-900 text-gray-500 dark:text-white"
            data-inactive-classes="text-gray-900 dark:text-gray-400">
            <h2 id="accordion-flush-heading-1">
                <button type="button"
                    class="flex items-center justify-between w-full py-4 font-semibold text-left text-gray-500 "
                    data-accordion-target="#accordion-flush-body-1" aria-expanded="true"
                    aria-controls="accordion-flush-body-1">
                    <span class="text-2xl">Brands</span>
                    <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </h2>
            <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1">
                <div class="py-2 font-light">
                    <div class="grid grid-cols-4 gap-2">
                        <div>Addidas</div>
                        <div>Nike</div>
                        <div>Umbro</div>
                        <div>Puma</div>
                    </div>
                </div>
            </div>
        </div>

        <div id="accordion-flush" data-accordion="collapse"
            data-active-classes="bg-white dark:bg-gray-900 text-gray-500 dark:text-white"
            data-inactive-classes="text-gray-900 dark:text-gray-400">
            <h2 id="accordion-flush-heading-2">
                <button type="button"
                    class="flex items-center justify-between w-full py-4 font-semibold text-left text-gray-500 "
                    data-accordion-target="#accordion-flush-body-2" aria-expanded="true"
                    aria-controls="accordion-flush-body-2">
                    <span class="text-2xl">Collection</span>
                    <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </h2>
            <div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2">
                <div class="py-2 font-light">
                    <div class="grid grid-rows-4 gap-2">
                        <div class="font-semibold">Best Sellers</div>
                        <div class="font-semibold">Nike</div>
                        <div class="font-semibold">Umbro</div>
                        <div class="font-semibold">Puma</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>