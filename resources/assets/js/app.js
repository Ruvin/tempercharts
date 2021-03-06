
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 /* Dev: Ruvin Roshan - 2019 */

import VueAxios from 'vue-axios';
import axios from 'axios';
// import Vue from 'vue';



require('./bootstrap');

 window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('vue-highchartscomponent', require('./components/ChartComponent.vue')); // Added to blade tempalte
import HighchartsVue from 'highcharts-vue';
//import Highcharts from 'highcharts';

Vue.use(HighchartsVue,VueAxios, axios)

 const app = new Vue({
  el: '#app'
})


