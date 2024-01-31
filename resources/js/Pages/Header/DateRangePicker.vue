<template>
    <div class="flex items-center justify-center pb-3 rounded- w-full text-oynx dark:text-snow">
       
        <div class="relative pr-3 ">
            <input 
                placeholder="Search for food"
                class="input1 bg-transparent border-none w-full text-oynx dark:text-white max-w-xl rounded-full py-3 px-5"
                name="text"
                type="text"
            />
        </div>

          <button class="button bg-gradient-to-br from-[#e3dedf] to-[#ffffff] -shadow-snow-sm hover:shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37]  dark:-shadow-oynx-sm text-lg">
            <font-awesome-icon :icon="['fas', 'search']" class="svgIcon "/>
          </button>
    </div>
</template>

<script></script>

<style scoped>
/* Add Tailwind CSS styles here or in your global styles */
.input1 {
  box-shadow: inset 8px 8px 13px #848484,
            inset -8px -8px 13px #ffffff;
}
/* .input1.hover,
.input1.active {
} */

.button {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  border: none;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition-duration: 0.3s;
  overflow: hidden;
  position: relative;
}

.svgIcon {
  width: 12px;
  transition-duration: 0.3s;
}


.button:hover {
  width: 120px;
  border-radius: 50px;
  transition-duration: 0.3s;
  background-color: rgb(181, 160, 255);
  align-items: center;
}

.button:hover .svgIcon {
  /* width: 20px; */
  transition-duration: 0.3s;
  transform: translateX(320%);
}

.button::before {
  position: absolute;
  bottom: -20px;
  content: "Search";
  /* transition-duration: .3s; */
  font-size: 0px;
}

.button:hover::before {
  font-size: 13px;
  opacity: 1;
  bottom: unset;
  /* transform: translateY(-30px); */
  transition-duration: 0.3s;
}

</style>
