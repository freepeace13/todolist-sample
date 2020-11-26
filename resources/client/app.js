import Vue from 'vue';
import VueRouter from 'vue-router';
import Application from '@components/v-application';

import './bootstrap';

Vue.use(VueRouter);

Vue.prototype.$utils = require('@utils');

new Vue({
    template: '<router-view></router-view>',
    router: new VueRouter({
        mode: 'history',
        base: '/',
        routes: [
            { path: '/:date?', name: 'tasks', component: Application },
        ]
    }),
}).$mount('#app');
