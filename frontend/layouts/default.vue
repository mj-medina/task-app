<template>
  <div class="bg-gray-100 min-h-screen flex flex-col">
    <header class="bg-blue-500 p-4 flex items-center justify-between">
      <div>
        <span class="text-white text-2xl font-bold">Task App</span>
      </div>
      <client-only>
        <div v-if="$auth.loggedIn">
          <span class="text-white mr-2">{{ $auth.user.name }}</span>
          <a href="#" class="text-white" @click.prevent="logout">Logout</a>
        </div>
      </client-only>
    </header>

    <main class="container mx-auto p-4 flex-grow">
      <nuxt />
    </main>

    <footer class="bg-blue-500 p-4 text-white text-center">
      <p>A simple task app</p>
    </footer>
  </div>
</template>
<script>
export default {
  methods: {
    async logout () {
      try {
        await this.$auth.logout()
      } catch (error) {
        console.log(error)
      }
    }
  }
}
</script>
