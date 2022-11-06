import VueRouter from 'vue-router';

import homeComponent from "./components/tasks/homeComponent";
import HeaderComponent from "./components/HeaderComponent";

import TaskListComponent from "./components/tasks/TaskListComponent";
import TaskShowComponent from "./components/tasks/TaskShowComponent";
import TaskCreateComponent from "./components/tasks/TaskCreateComponent";
import TaskEditComponent from "./components/tasks/TaskEditComponent";

import WorksShowComponent from "./components/works/WorksShowComponent";
import WorksListComponent from "./components/works/WorksListComponent";
import WorksCreateComponent from "./components/works/WorksCreateComponent";
import WorksEditComponent from "./components/works/WorksEditComponent";

import SkillsListComponent from "./components/skills/SkillsListComponent";
import SkillsCreateComponent from "./components/skills/SkillsCreateComponent";
import SkillsEditComponent from "./components/skills/SkillsEditComponent";

import ProductsListComponent from "./components/products/ProductsListComponent";
import ProductsCreateComponent from "./components/products/ProductsCreateComponent";
import ProductsEditComponent from "./components/products/ProductsEditComponent";

import ProfilesListComponent from "./components/profiles/ProfilesListComponent";
import ProfilesCreateComponent from "./components/profiles/ProfilesCreateComponent";
import ProfilesEditComponent from "./components/profiles/ProfilesEditComponent";

import HistorysListComponent from "./components/historys/HistorysListComponent";
import HistorysCreateComponent from "./components/historys/HistorysCreateComponent";
import HistorysEditComponent from "./components/historys/HistorysEditComponent";

import viewComponent from "./components/viewComponent";

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
//window.Vue = require('vue');

// Vueルータの定義
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: homeComponent
        },
        {
            path: '/home/', 
            name: 'task.list',
            //component: WorksListComponent,
            components: {
            //default: TaskListComponent,
            default: "",
            works: WorksListComponent,
            skills: SkillsListComponent,
            products: ProductsListComponent,
            profiles: ProfilesListComponent,
            historys: HistorysListComponent,
            },
            //props: true
        },
        /* task */
        /*{
            path: '/home/:taskId',
            name: 'task.show',
            component: TaskShowComponent,
            props: true//この一文を追加すると props　が利用できる
        },*/
        {
            path: '/home/create',
            name: 'task.create',
            component: TaskCreateComponent
        },
        {
            path: '/home/:taskId/edit',
            name: 'task.edit',
            component: TaskEditComponent,
            props: true
        },
        
        /* works */
        {
            path: '/home/create_work',
            name: 'work.create',
            component: WorksCreateComponent
        },
        {
            path: '/home/:workId/edit_work',
            name: 'work.edit',
            component: WorksEditComponent,
            props: true
        },
        /* skills */
        {
            path: '/home/create_skill',
            name: 'skill.create',
            component: SkillsCreateComponent
        },
        {
            path: '/home/:skillId/edit_skill',
            name: 'skill.edit',
            component: SkillsEditComponent,
            props: true
        },
        /* products */
        {
            path: '/home/create_product',
            name: 'product.create',
            component: ProductsCreateComponent
        },
        {
            path: '/home/:productId/edit_product',
            name: 'product.edit',
            component: ProductsEditComponent,
            props: true
        },
        /* profiles */
        {
            path: '/home/create_profile',
            name: 'profile.create',
            component: ProfilesCreateComponent
        },
        {
            path: '/home/:profileId/edit_profile',
            name: 'profile.edit',
            component: ProfilesEditComponent,
            props: true
        },
        /* historys */
        {
            path: '/home/create_history',
            name: 'history.create',
            component: HistorysCreateComponent
        },
        {
            path: '/home/:historyId/edit_history',
            name: 'history.edit',
            component: HistorysEditComponent,
            props: true
        },
    ]
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/tasks/ExampleComponent.vue').default);
Vue.component('header-component', HeaderComponent);
Vue.component('view-component', viewComponent);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
