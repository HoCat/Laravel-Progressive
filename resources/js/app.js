require('./bootstrap');

window.Vue = require("vue");

Vue.component('tasks-component', require('./components/TasksComponent.vue').default);
Vue.component('cards-component', require('./components/CardsComponent.vue').default);

import VueSocketIO from 'vue-socket.io'
Vue.use(new VueSocketIO({
    debug: true,
    connection: 'http://127.0.0.1:9803/',  //
    options: {
        transports: ['websocket'],
        path: '/'
    }
}));


const app = new Vue({
    el: "#app"
});
