<template>
  <div class="bg-white rounded-lg p-4 shadow-md mb-4">
    <h2 class="text-xl font-semibold">
      {{ task.title }}
    </h2>
    <p class="text-gray-600">
      {{ task.description }}
    </p>
    <p class="text-gray-600">
      Due Date: {{ task.due_date }}
    </p>
    <p :class="task.completed ? 'text-green-500' : 'text-red-500'">
      {{ task.completed ? 'Completed' : 'Incomplete' }}
    </p>
    <button v-if="!task.completed" class="text-green-500 hover:text-green-800">
      <i class="fas fa-check-circle">&nbsp;</i>
    </button>
    <button v-else class="text-red-500 hover:text-yellow-800">
      <i class="far fa-circle-alt">&nbsp;</i>
    </button>
    <button class="text-blue-500 hover:text-blue-800" @click="openEditTaskModal">
      <i class="fas fa-pencil-alt">&nbsp;</i>
    </button>
    <button class="text-red-500 hover:text-red-800">
      <i class="fas fa-trash-alt">&nbsp;</i>
    </button>
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
      this.$store.dispatch('task-modal/openModal', { type: 'edit', task: null })
    }
  }
}
</script>
