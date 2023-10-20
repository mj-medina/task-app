<template>
  <div class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
      <h2 class="text-2xl font-semibold text-gray-800 mb-4">
        Login
      </h2>
      <form @submit.prevent="login">
        <div class="mb-4">
          <label for="email" class="block text-gray-600 text-sm font-medium mb-2">
            Email
          </label>
          <input id="email" v-model="email" type="text" :class="{'border-rose-500' : errors.email}" class="w-full px-3 py-2 border rounded-lg">
          <p v-if="errors.email" class="text-rose-500">
            {{ errors.email[0] }}
          </p>
        </div>
        <div class="mb-6">
          <label for="password" class="block text-gray-600 text-sm font-medium mb-2">
            Password
          </label>
          <input id="password" v-model="password" type="password" :class="{'border-rose-500' : errors.password}" class="w-full px-3 py-2 border rounded-lg">
          <p v-if="errors.password" class="text-rose-500">
            {{ errors.password[0] }}
          </p>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 rounded-lg hover:bg-blue-600">
          Login
        </button>
      </form>
      <div class="text-center mt-4">
        <p>Don't have an account? <a href="/register" class="text-blue-500 hover:underline">Create an account</a></p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      email: '',
      password: ''
    }
  },
  mounted () {
    if (this.$auth.loggedIn) {
      this.$router.push('/')
    }
  },
  methods: {
    /**
     * Login user
     * @returns {Promise<void>}
     */
    async login () {
      try {
        await this.$auth.loginWith('laravelSanctum', {
          data: {
            email: this.email,
            password: this.password
          }
        })

        await this.$router.push('/')
      } catch (error) {}
    }
  }
}
</script>
