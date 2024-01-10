<template>
    <div class="flex items-center justify-center rounded-full">
        <!-- Start Date Input -->
        <div class="relative ">
            <input
                placeholder="Username"
                class="input1"
                name="text"
                type="date"
            />
        </div>
        <!-- End Date Input -->
        <div class="relative ">
            <input
                placeholder="Username"
                class="input1"
                name="text"
                type="date"
            />
          </div>
          <button class="button">
            <font-awesome-icon :icon="['fas', 'arrow-right']" class="svgIcon text-oynx dark:text-snow "/>
          </button>
    </div>
</template>

<script></script>

<style scoped>
/* Add Tailwind CSS styles here or in your global styles */
.input1 {
    margin: 30px;
    background: none;
    border: none;
    outline: none;
    max-width: 190px;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 9999px;
    color: #fff;
    box-shadow: inset 2px 5px 10px rgb(5, 5, 5);
}
/* .input1.hover,
.input1.active {
} */

.button {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background: linear-gradient(145deg, #2b312e, #333a37);
  border: none;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 18px 18px 36px #1f2321, -18px -18px 36px #414945;
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
  width: 140px;
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
  content: "Continue";
  color: white;
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
