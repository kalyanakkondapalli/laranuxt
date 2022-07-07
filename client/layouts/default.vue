<template>
  <main class="default-layout">
    <Nuxt />
  </main>
</template>
<script>
export default {
}
</script>

<style lang="scss">
html,body {
  @apply bg-gray-100 h-full;
}
.default-layout {
  @apply max-w-screen-lg mx-auto;
}
</style>
