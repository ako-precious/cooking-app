<template>
    <div class="loader">
      <div class="loader-inner"></div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'Loader',
  };
  </script>
  
  <style scoped>
  .loader {
    /* Style your loader here (e.g., spinner, dots) */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 999;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .loader-inner {
    /* Style your loader animation here */
    border: 4px solid #fff;
    border-radius: 50%;
    border-top-color: transparent;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
  }
  
  @keyframes spin {
    from {
      transform: rotate(0deg);
    }
    to {
      transform: rotate(360deg);
    }
  }
  </style>
  