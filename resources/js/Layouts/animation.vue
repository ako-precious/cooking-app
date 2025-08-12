<template>
 
</template>
<script setup>



import DropdownLink from '@/Components/DropdownLink.vue';
import { useDark, useToggle } from "@vueuse/core";

const isDark = useDark();
const toggleDarkMode = useToggle(isDark);
</script>

<script>
export default {
   
    data() {
        return {
            isClassAdded: "-right-90",
         
        };
    },
    methods: {
        toggleClass() {
            // Toggle the value when the button is clicked

            this.isClassAdded =
                this.isClassAdded === "-right-90" ? "right-0" : "-right-90";
        },
       


    },
};
</script>

<style scoped>
body {
  background: #0a3f63;
  margin: 0;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
}
.container {
  height: 250px;
  width: 250px;
  position: relative;
}
.circle {
  position: absolute;
  height: 100%;
  width: 100%;
  border-radius: 50%;
  animation: rotate 3s linear infinite;
}
.circle::before {
  content: "";
  position: absolute;
  height: 10px;
  width: 50px;
  background-color: #fff;
  border-radius: 5px;
  top: -6px;
  left: 50%;
  transform: translateX(-50%);
}
.ball {
  position: absolute;
  height: 35px;
  width: 35px;
  border-radius: 50%;
  background-color: #fe95ff;
  top: 20px;
  left: 50%;
  transform: translateX(-50%);
  animation: move 1.5s ease-in alternate infinite;
}

@keyframes rotate {
  from {
  }
  to {
    transform: rotate(360deg);
  }
}
@keyframes move {
  from {
    box-shadow: 0 10px 0 -1px #fe95ffaa, 0 20px 0 -2px #fe95ffaa;
  }
  to {
    top: 220px;
    box-shadow: 0 -10px 0 -1px #fe95ffaa, 0 -20px 0 -2px #fe95ff55;
  }
}

</style>
