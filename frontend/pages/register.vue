<template>
  <div class="flex items-center justify-center h-screen">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
      <h2 class="text-2xl font-semibold text-gray-800 mb-4">
        Create an Account
      </h2>
      <form @submit.prevent="register">
        <div class="mb-4">
          <label for="name" class="block text-gray-600 text-sm font-medium mb-2">Name</label>
          <input id="name" v-model="name" type="text" class="w-full px-3 py-2 border rounded-lg">
          <p v-if="errors.name" class="text-rose-500">
            {{ errors.name[0] }}
          </p>
        </div>
        <div class="mb-4">
          <label for="email" class="block text-gray-600 text-sm font-medium mb-2">Email</label>
          <input id="email" v-model="email" type="email" class="w-full px-3 py-2 border rounded-lg">
          <p v-if="errors.email" class="text-rose-500">
            {{ errors.email[0] }}
          </p>
        </div>
        <div class="mb-6">
          <label for="password" class="block text-gray-600 text-sm font-medium mb-2">Password</label>
          <input id="password" v-model="password" type="password" class="w-full px-3 py-2 border rounded-lg">
          <p v-if="errors.password" class="text-rose-500">
            {{ errors.password[0] }}
          </p>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 rounded-lg hover:bg-blue-600">
          Register
        </button>
      </form>
      <div class="text-center mt-4">
        <p>Already have an account? <a href="/login" class="text-blue-500 hover:underline">Login</a></p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      name: '',
      email: '',
      password: ''
    }
  },
  methods: {
    /**
     * Register user account
     * @returns {Promise<void>}
     */
    async register () {
      try {
        await this.$axios.post('/api/register', {
          name: this.name,
          email: this.email,
          password: this.password
        })

        await this.$auth.loginWith('laravelSanctum', {
          data: {
            email: this.email,
            password: this.password
          }
        })

        await this.$router.push('home')
      } catch (e) {}
    }
  }
}
</script>
