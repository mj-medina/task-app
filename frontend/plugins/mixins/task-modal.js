import Vue from 'vue'
import { mapGetters } from 'vuex'

const TaskModal = {
  install (Vue, options) {
    Vue.mixin({
      computed: {
        ...mapGetters({
          modal: 'task-modal/modal'
        })
      }
    })
  }
}

Vue.use(TaskModal)
