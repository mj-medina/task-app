<template>
  <div class="bg-white rounded-lg p-4 shadow-md mb-4 relative">
    <h2 class="text-xl font-semibold break-words">
      {{ task.title }}
    </h2>
    <div class="flex justify-end items-center mb-2">
      <p class="text-gray-600 break-words">
        Due: {{ task.due_date }} &nbsp;
      </p>
    </div>
    <p class="text-gray-600 break-words pb-3">
      {{ task.description }}
    </p>
    <div class="flex justify-between items-center mt-3 absolute bottom-1 left-1 right-1">
      <p :class="task.completed ? 'text-green-500' : 'text-red-500'">
        {{ task.completed ? 'Completed' : 'Incomplete' }} &nbsp;
      </p>
    </div>
    <div class="flex justify-end items-center mt-3 absolute bottom-1 left-1 right-1">
      <button :class="task.completed ? 'text-green-500' : 'text-yellow-500'" class="hover:text-green-800" @click="markTask">
        <i :class="task.completed ? 'fas fa-check-circle' : 'far fa-circle'">&nbsp;</i>
      </button>
      <button class="text-blue-500 hover:text-blue-800" @click="openEditTaskModal">
        <i class="fas fa-pencil-alt">&nbsp;</i>
      </button>
      <button class="text-red-500 hover:text-red-800" @click="deleteTask">
        <i class="fas fa-trash-alt">&nbsp;</i>
      </button>
    </div>
    <TaskModal v-if="modal.isModalOpen" />
  </div>
</template>

<script>
import TaskModal from '~/components/task-modal.vue'

export default {
  components: {
    TaskModal
  },
  props: {
    task: {
      type: Object,
      required: true
    }
  },
  methods: {
    openEditTaskModal () {
      this.$store.dispatch('task-modal/openModal', { type: 'edit', task: this.task })
    },
    async deleteTask () {
      try {
        await this.$axios.post('/api/deleteTask', {
          id: this.task.id
        })
        window.location.reload()
      } catch (error) {
        console.error(error)
      }
    },
    async markTask () {
      try {
        await this.$axios.post('/api/markTask', {
          id: this.task.id,
          completed: this.task.completed === false
        })
        window.location.reload()
      } catch (error) {
        console.error(error)
      }
    }
  }
}
</script>
