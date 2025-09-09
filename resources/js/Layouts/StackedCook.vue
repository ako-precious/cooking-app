<template>
    <!-- From Uiverse.io by janisar-hyder --> 
<p class="browser-warning">
  If this looks wonky to you it's because this browser doesn't support the CSS
  property 'aspect-ratio'.
</p>
<div class="stack">
  <div class="card">
    <div class="image"> <img alt="..." src="images/kaptured-by-kasia-HpKkTi0ThKM.jpg" class="w-full h-full object-cover ">
       </div> <h4 class="text-3xl font-bold text-oynx dark:text-snow uppercase text-center mt-4">
           How We Select and Approve Every Cook?  
          </h4> 
  </div>
</div>

</template>

<style scoped>/* From Uiverse.io by janisar-hyder */ 
img {
  display: block;
  
  height:100%;
}

.stack {
  width: 80%;
  max-width: 400px;
  transition: 0.25s ease;
  &:hover {
    transform: rotate(5deg);
    .card:before {
      transform: translatey(-2%) rotate(-4deg);
    }
    .card:after {
      transform: translatey(2%) rotate(4deg);
    }
  }
}

.card {
  aspect-ratio: 3 / 2;
  border: 4px solid;
  background-color: #FCF7F8;
  position: relative;
  transition: 0.15s ease;
  cursor: pointer;
  padding: 5% 5% 15% 5%;
  &:before,
  &:after {
    content: "";
    display: block;
    position: absolute;
    height: 100%;
    width: 100%;
    border: 4px solid;
    background-color: #FCF7F8;
    transform-origin: center center;
    z-index: -1;
    transition: 0.15s ease;
    top: 0;
    left: 0;
  }

  &:before {
    transform: translatey(-2%) rotate(-6deg);
  }

  &:after {
    transform: translatey(2%) rotate(6deg);
  }
}
.image {
  width: 100%;
  border: 4px solid;
  background-color: #eee;
  aspect-ratio: 1 / 1;
  position: relative;
  overflow: hidden
}

.browser-warning {
  margin-bottom: 4rem;
}

@supports (aspect-ratio: 1 / 1) {
  .browser-warning {
    display: none;
  }
}
</style>