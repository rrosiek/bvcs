import Vue from 'vue';

import datepicker from './components/datepicker.vue';
import isLoading from './directives/isLoading';
import notifyClose from './directives/notifyClose';

Vue.component('datepicker', datepicker);
Vue.directive('isLoading', isLoading);
Vue.directive('notifyClose', notifyClose);

new Vue({ // eslint-disable-line no-new
  data: {
    mobileNav: false,
    showModal: false,
  },
  el: '#app',
  methods: {
    slugify(text) {
      return text.toString().toLowerCase()
        .replace(/\s+/g, '-')
        .replace(/[^\w-]+/g, '')
        .replace(/--+/g, '-')
        .replace(/^-+/, '')
        .replace(/-+$/, '')
      ;
    },
    titleToSlug(e, id) {
      const el = document.getElementById(id);

      el.value = this.slugify(e.target.value);
    },
  },
});
