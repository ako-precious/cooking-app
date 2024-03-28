<template>
<div class="cardie h-full w-full group box-content ">
<div class="blob"></div>
  <span class="img group-hover:bg-snow dark:group-hover:bg-oynx">
    <img
                                        class=" h-full  "
                                        src="/images/packing.jpeg"
                                        alt=""
                                    />
                                </span>
                                <p class="text-sm md:text-base text-oynx pb-0 p-4 test-sm dark:text-snow">Pack the freshly prepared meal with the customer's satisfaction in mind, ensuring it arrives fresh and ready to enjoy.</p>
 
</div>
</template>
<style scoped>
.cardie {
 
 border-radius: 10px;
 text-align: center;
 transition: all 0.5s;
 
}

.cardie:hover {
 box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.623);
 background-color: #1B998B;
}

.cardie .blob {
 height: 10px;
 width: 75%;
 border-radius: 0 0 30px 30px;
 margin: 0 auto;
 background-color: #1B998B;
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