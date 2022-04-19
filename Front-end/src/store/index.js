import { createStore } from 'vuex'
import { station } from '@/store/station'
import { login } from '@/store/login'
import { report } from '@/store/report'


const store = createStore({
  modules: {
    station,
    login,
    report
  },
})

export default store;
