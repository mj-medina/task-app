<template>
  <div>
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-2xl font-semibold">
        Task List
      </h1>
      <button>
        <i class="fas fa-plus-circle text-blue-500 text-4xl" @click="openCreateTaskModal">&nbsp;</i>
      </button>
    </div>
    <TaskList :tasks="tasks" />
    <TaskModal v-if="modal.isModalOpen" />
  </div>
</template>
<script>
import TaskList from '~/components/task-list.vue'
import TaskModal from '~/components/task-modal.vue'
export default {
  components: {
    TaskList,
    TaskModal
  },
  data () {
    return {
      tasks: [
        {
          title: 'Task 1',
          description: 'Description for Task 1',
          due_date: '2023-12-31',
          completed: false
        }
      ]
    }
  },
  mounted () {
    this.getUserTask()
  },
  methods: {
    openCreateTaskModal () {
      this.$store.dispatch('task-modal/openModal', { type: 'add', task: null })
    },
    async getUserTask () {
      const response = await this.$axios.get('/api/getTask')
      this.tasks = response.data
      console.log(response.data)
    }
  }
}
</script>
