import { Chart } from './components/Charts'

export {
  Chart as VueFrappe
}

export default {
    install (Vue, options) {
        Vue.component('vue-frappe', Chart)
    }
}
