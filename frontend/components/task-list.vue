<template>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
    <TaskItem v-for="(task, index) in tasks" :key="index" :task="task" @reload="reloadTaskList" />
    <p v-if="tasks.length === 0">
      Add task by clicking the (+) button on the upper right.
    </p>
  </div>
</template>

<script>
import TaskItem from '~/components/task-item.vue'

export default {
  components: {
    TaskItem
  },
  props: {
    tasks: {
      type: Array,
      required: true
    }
  },
  methods: {
    /**
     * Emit reloadTaskList event
     */
    reloadTaskList () {
      this.$emit('reloadTaskList')
    }
  }
}
</script>
