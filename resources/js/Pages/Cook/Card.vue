<template>
    <div
        class="flex flex-col lg:grid grid-rows-6 grid-flow-col gap-5 auto-cols-fr md:px-6 lg:p-8"
    >
        <div class="row-span-4 shadow-extra-small rounded-3">
            <div class="card h-full rounded-3 group">
                <img
                    class="h-full group-hover:scale-110 transition-all duration-[0.8s]"
                    src="/images/ordering.jpeg"
                    alt=""
                />

                <div
                    class="card__content2 bg-lighred dark:bg-polynesian text-oynx dark:text-snow"
                >
                    <p class="card__description text-sm md:text-base">
                        List your culinary specialties so they can browse your
                        delicious options and choose their favorites. Customers
                        can then pick a date that works for them to enjoy your
                        cooking. Once they submit a request, you can confirm
                        your availability to ensure a smooth and delightful
                        dining experience
                    </p>
                </div>
                <div class="card__content bg-persian text-oynx dark:text-snow">
                    <p class="card__description text-sm md:text-base">
                        List your culinary specialties so they can browse your
                        delicious options and choose their favorites. Customers
                        can then pick a date that works for them to enjoy your
                        cooking. Once they submit a request, you can confirm
                        your availability to ensure a smooth and delightful
                        dining experience
                    </p>
                </div>
            </div>
        </div>
        <div
            class="col-start-2 col-end-4 row-span-2 md:h-50 shadow-extra-small rounded-3 ..."
        >
            <div
                class="transition-all duration-[0.6s] h-full w-full flex flex-col-reverse md:flex-row relative items-center justify-center md:justify-start cursor-pointer overflow-hidden group md:hover:justify-end"
            >
                <img
                    class="hidden md:block h-full absolute z-[9] transition-all duration-[0.8s] right-0 group-hover:-right-1/2"
                    src="/images/cook.png"
                    alt=""
                />
                <!-- <span
                    class="text-sm md:text-base p-6 text-oynx dark:text-snow relative w-full md:w-[60%] z-[1] -translate-x-3 transition-all duration-[0.8s] group-hover:translate-x-3"
                    >Remember to check the date of the confirmed orders. Prepare
                    each dish by the customer's selected date. Don't forget to
                    let them know when their food is prepared!.</span
                >
                <span
                    class="circle bg-lighred dark:bg-polynesian absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-full transition-all duration-[0.8s] opacity-0 group-hover:w-[250px] group-hover:h-[250px] group-hover:opacity-100"
                ></span> -->
                <img
                    class="relative hidden md:block h-full md:absolute z-[9] transition-all duration-[0.8s] md:-left-1/2 group-hover:left-0"
                    src="/images/cook.png"
                    alt=""
                />
                <span
                    class="text-sm md:text-base p-8 z-10 bottom-0 text-oynx bg-oynx bg-opacity-50 dark:text-snow absolute md:relative w-[110%] md:w-[60%] md:z-[1] -translate-x-3 transition-all duration-[0.8s] group-hover:translate-x-3"
                    >Remember to check the date of the confirmed orders. Prepare
                    each dish by the customer's selected date. Don't forget to
                    let them know when their food is prepared!.</span
                >
                <span
                    class="circle  bg-lighred dark:bg-polynesian absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-full transition-all duration-[0.8s] opacity-0 group-hover:w-[250px] group-hover:h-[250px] group-hover:opacity-100"
                ></span>
                <img
                    class="relative object-cover md:hidden md:absolute z-[9] transition-all duration-[0.8s] md:-left-1/2 group-hover:left-0"
                    src="/images/cook.png"
                    alt=""
                />
            </div>
        </div>
        <div
            class="row-start-3 h-[420px] row-end-7 shadow-extra-small rounded-3 ..."
        >
            <div class="cardie h-full w-full group box-content">
                <div class="blob"></div>
                <span class="img group-hover:bg-snow dark:group-hover:bg-oynx">
                    <img class="h-full" src="/images/packing.jpeg" alt="" />
                </span>
                <p
                    class="text-sm md:text-base text-oynx pb-0 p-4 test-sm dark:text-snow"
                >
                    Pack the freshly prepared meal with the customer's
                    satisfaction in mind, ensuring it arrives fresh and ready to
                    enjoy.
                </p>
            </div>
        </div>
        <div
            class="row-start-5 row-end-7 col-start-1 col-end-3 md:h-50 shadow-extra-small rounded-3 ..."
        >
            <div
                class="transition-all duration-[0.6s] h-full w-full flex flex-col md:flex-row relative items-center justify-between md:justify-end cursor-pointer overflow-hidden group md:hover:justify-start"
            >
                <img
                    class="relative w-full md:h-full md:w-auto md:absolute z-[9] transition-all duration-[0.8s] md:group-hover:left-[72%] left-0"
                    src="/images/deliver.png"
                    alt=""
                />
                <span
                    class="text-sm md:text-base w-full lg:p-8 text-oynx dark:text-snow relative md:w-[60%] z-[1] md:-translate-x-3 transition-all duration-[0.8s] md:group-hover:translate-x-3 p-4 md:p-0"
                    >Now comes the exciting part! Deliver the delicious meal to
                    the customer, ready to be savored.</span
                >
                <span
                    class="circle bg-lighred dark:bg-polynesian absolute w-5 h-5 top-0 right-0 rounded-full transition-all duration-[0.8s] group-hover:w-full group-hover:h-full group-hover:opacity-100"
                ></span>
                <span
                    class="circle shadow-polynesian dark:shadow-lighred shadow-inner absolute w-5 h-5 top-10 right-10 rounded-full transition-all duration-[0.8s]"
                ></span>
                <span
                    class="circle shadow-polynesian dark:shadow-lighred shadow-inner absolute w-5 h-5 top-20 right-20 rounded-full transition-all duration-[0.8s]"
                ></span>
                <span
                    class="circle shadow-polynesian dark:shadow-lighred shadow-inner absolute w-5 h-5 top-30 right-30 rounded-full transition-all duration-[0.8s]"
                ></span>
                <span
                    class="circle shadow-polynesian dark:shadow-lighred shadow-inner absolute w-5 h-5 top-40 right-40 rounded-full transition-all duration-[0.8s]"
                ></span>
                <span
                    class="circle shadow-polynesian dark:shadow-lighred shadow-inner absolute w-5 h-5 top-50 right-50 rounded-full transition-all duration-[0.8s]"
                ></span>
                <span
                    class="group-hover:left-44 bg-transparent top-12 left-1 absolute shadow-persian shadow-inner rounded-xl transition-all ease-in-out group-hover:duration-1000 duration-1000 w-44 h-44"
                ></span>
            </div>
        </div>

        <div
            class="col-start-2 col-end-3 row-span-2 shadow-extra-small rounded-3 ..."
        >
            <div
                class="cursor-pointer group overflow-hidden p-5 duration-1000 hover:duration-1000 relative h-full w4 mx-auto rounded-xl"
            >
                <div
                    class="group-hover:-top-3 bg-transparent -top-12 -left-12 absolute shadow-yellow-800 shadow-inner rounded-xl transition-all ease-in-out group-hover:duration-1000 duration-1000 w-24 h-24"
                ></div>
                <div
                    class="group-hover:top-60 bg-transparent top-44 left-14 absolute shadow-lighred shadow-inner rounded-xl transition-all ease-in-out group-hover:duration-1000 duration-1000 w-24 h-24"
                ></div>
                <div
                    class="group-hover:-left-12 bg-transparent top-24 left-56 absolute shadow-sky-800 shadow-inner rounded-xl transition-all ease-in-out group-hover:duration-1000 duration-1000 w-24 h-24"
                ></div>
                <div
                    class="group-hover:-top-44 bg-transparent top-12 left-12 absolute shadow-lighred shadow-inner rounded-xl transition-all ease-in-out group-hover:duration-1000 duration-1000 w-12 h-12"
                ></div>
                <div
                    class="group-hover:left-44 bg-transparent top-12 left-12 absolute shadow-persian shadow-inner rounded-xl transition-all ease-in-out group-hover:duration-1000 duration-1000 w-44 h-44"
                ></div>
                <div
                    class="group-hover:-left-2 bg-transparent -top-24 -left-12 absolute shadow-sky-800 shadow-inner rounded-xl transition-all ease-in-out group-hover:duration-1000 duration-1000 w-64 h-64"
                ></div>
                <div
                    class="group-hover:top-44 bg-transparent top-24 left-12 absolute shadow-sky-500 shadow-inner rounded-xl transition-all ease-in-out group-hover:duration-1000 duration-1000 w-4 h-4"
                ></div>
                <div
                    class="w-full h-full shadow-xl shadow-neutral-900 p-3 bg-snow dark:bg-oynx opacity-60 rounded-xl flex-col gap-2 flex justify-center"
                >
                    <span class="text-neutral-50 font-bold text-xl italic"
                        >Get Paid</span
                    >
                    <p class="text-oynx dark:text-snow">
                        Accept the order, prepare the meal, and deliver it – get
                        paid once the customer confirms receiving it
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.card {
    position: relative;

    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    perspective: 1000px;
    /* box-shadow: 0 0 0 5px #ffffff80; */
    transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.card svg {
    width: 48px;
    fill: #333;
    transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.card:hover {
    box-shadow: 0 8px 16px rgba(255, 255, 255, 0.2);
}

.card__content {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 40%;
    padding: 20px;
    box-sizing: border-box;
    /* background-color: #f2f2f2; */
    transform: rotateX(-90deg);
    transform-origin: bottom;
    transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.card__content2 {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 40%;
    padding: 20px;
    box-sizing: border-box;
    /* background-color: #f2f2f2; */
    /* transform: rotateX(-90deg); */
    transform-origin: bottom;
    transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.card:hover .card__content {
    transform: rotateX(0deg);
}

.card:hover svg {
    scale: 0;
}

.cardie {
    border-radius: 10px;
    text-align: center;
    transition: all 0.5s;
}

.cardie:hover {
    box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.623);
    background-color: #1b998b;
}

.cardie .blob {
    height: 10px;
    width: 75%;
    border-radius: 0 0 30px 30px;
    margin: 0 auto;
    background-color: #1b998b;
    visibility: visible;
    transition: all 0.3s;
}

.cardie:hover .blob {
    height: 0;
}

.cardie .img {
    display: flex;
    margin: 15px auto 0 auto;
    width: 100%;
    height: 65%;
    border-radius: 50%;
    font-size: 11px;
    justify-content: center;
    align-items: center;
    transition: all 0.5s;
}

.cardie:hover .img {
    width: 100%;
    height: 70%;
    border-radius: 10px 0 0;
    margin: 0 auto;
    z-index: 99999;
}

.cardie span {
    font-size: 18px;
}

.cardie:hover h2 {
    width: 100%;
    /* position: absolute; */
    transition: all 0.5s;
}
</style>
