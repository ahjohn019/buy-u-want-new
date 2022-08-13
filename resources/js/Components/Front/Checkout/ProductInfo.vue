<template>
    <div class="bg-gray-50 border-l-2">
        <div class="container" style="width:550px; margin-left:3.5em; margin-top:3.5em;">
            <br>
            <div class="grid grid-cols-6">
                <div class="border rounded-lg">
                    <img src="../../../../images/addidas_duramo.png" alt="">
                </div>
                <div class="col-start-2 col-span-2 m-auto ml-4">
                    <p class="text-xl font-medium">Sample One</p>
                    <p>Addidas</p>
                </div>
                <div class="col-start-7 text-right m-auto mr-0">
                    <p class="text-xl font-medium">RM 200</p>
                </div>
            </div>
            <br>
            <hr>
            <br>
            <div class="flex items-center justify-between">
                <div class="w-full">
                    <input type="text" id="small-input" placeholder="Discount Code"
                        class="block p-4 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="ml-4">
                    <button type="button"
                        class="bg-gray-400 text-white border border-gray-300 focus:outline-none hover:bg-gray-100 hover:text-black focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm p-4 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        Apply</button>
                </div>
            </div>
            <br>
            <hr>
            <br>
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <p>Subtotal</p>
                </div>
                <div class="text-right">
                    <p>RM 100</p>
                </div>
                <div>
                    <p>Shipping</p>
                </div>
                <div class="text-right">
                    <p>RM 1</p>
                </div>
            </div>
            <br>
            <hr>
            <br>
            <div class="grid grid-cols-2">
                <div>
                    <p class="font-semibold text-sm">Total</p>
                </div>
                <div class="text-right">
                    <span>MYR</span>
                    <span class="ml-4 text-3xl font-semibold">RM 100</span>
                </div>
            </div>
        </div>
    </div>

</template>