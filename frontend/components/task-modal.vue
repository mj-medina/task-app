<template>
  <div class="fixed inset-0 flex items-center justify-center z-50 overflow-x-hidden overflow-y-auto outline-none">
    <div class="modal-container p-6 bg-white w-full max-w-md m-auto rounded-lg shadow-xl relative">
      <button class="close-button absolute top-2 right-2 text-gray-500" @click="closeModal">
        <i class="fas fa-times">&nbsp;</i>
      </button>

      <h2 class="text-2xl font-semibold mb-4">
        {{ modal.modalType === 'add' ? 'Create Task' : 'Update Task' }}
      </h2>

      <div>
        <div class="mb-4">
          <label for="title" class="block text-gray-600">Title</label>
          <input id="title" v-model="localTask.title" type="text" class="w-full p-2 border rounded">
          <p v-if="errors.title" class="text-rose-500">
            {{ errors.title[0] }}
          </p>
        </div>

        <div class="mb-4">
          <label for="description" class="block text-gray-600">Description</label>
          <textarea id="description" v-model="localTask.description" rows="4" class="w-full p-2 border rounded" />
          <p v-if="errors.description" class="text-rose-500">
            {{ errors.description[0] }}
          </p>
        </div>

        <div class="mb-4">
          <label for="dueDate" class="block text-gray-600">Due Date</label>
          <input id="dueDate" v-model="localTask.due_date" type="date" class="w-full p-2 border rounded">
          <p v-if="errors.due_date" class="text-rose-500">
            {{ errors.due_date[0] }}
          </p>
        </div>
      </div>

      <div class="mt-6 text-right">
        <button class="mr-2 text-gray-500 hover:text-gray-700" @click="closeModal">
          Cancel
        </button>
        <button class="text-blue-500 hover:text-blue-700" @click.prevent="submit">
          Save
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    task: {
      type: Object,
      default: null
    }
  },
  data () {
    return {
      localTask: null
    }
  },
  created () {
    if (!this.modal.taskToEdit === false) {
      this.localTask = {
        title: this.modal.taskToEdit.title,
        description: this.modal.taskToEdit.description,
        due_date: this.modal.taskToEdit.due_date
      }
    } else {
      this.localTask = { ...this.task }
    }
  },
  methods: {
    /**
     * Close modal
     */
    closeModal () {
      this.$store.dispatch('task-modal/closeModal')
    },
    /**
     * Trigger submit button on modal
     * @returns {Promise<void>}
     */
    async submit () {
      try {
        if (this.modal.modalType === 'add') {
          await this.$axios.post('/api/createTask', this.localTask)
        } else {
          await this.$axios.post('/api/editTask', {
            ...this.localTask,
            id: this.modal.taskToEdit.id
          })
        }
        this.closeModal()
        window.location.reload()
      } catch (error) {}
    }
  }
}
</script>
