require('./bootstrap');
window.Vue = require('vue').default;

import Vue from "vue"
import VueRouter from "vue-router"


Vue.use(VueRouter)
window.Vue = require('vue').default;
window.axios = require('axios');

import Vue2Editor from "vue2-editor";
Vue.use( Vue2Editor );
//... configure axios...

Vue.prototype.$http = window.axios;



//Routes
import Home from './components/admin/Home.vue'
import About from './components/admin/About.vue'
import ListPermission from './components/admin/Permission/ListPermission.vue'
import EditPermission from './components/admin/Permission/EditPermission.vue'
import newPermission from './components/admin/Permission/newPermission.vue'

import Category from './components/admin/Category.vue'

import updateInfo from './components/admin/updateInfo.vue'

import ListPost from './components/admin/Post/ListPost.vue'
import ListPostAll from './components/admin/Post/ListPostAll.vue'
import NewPost from './components/admin/Post/NewPost.vue'
import UpdatePost from './components/admin/Post/UpdatePost.vue'

import NewPostChild from './components/admin/PostChilld/NewPostChild.vue'
import ListPostChilld from './components/admin/PostChilld/ListPostChilld.vue'
import UpdatePostChild from './components/admin/PostChilld/UpdatePostChild.vue'


import NewBlog from './components/admin/Blog/NewBlog.vue'
import ListBlog from './components/admin/Blog/ListBlog.vue'
import ListAllBlog from './components/admin/Blog/ListAllBlog.vue'
import UpdateBlog from './components/admin/Blog/UpdateBlog.vue'

import Contact from './components/admin/Contact.vue'

import ReportVisitor from './components/admin/ReportVisitor.vue'

export const routes = [
    {
		path: '/ReportVisitor',
        component: ReportVisitor,
        name: 'ReportVisitor',
    },
    {
		path: '/Contact',
        component: Contact,
        name: 'Contact',
    },
    {
		path: '/About',
        component: About,
        name: 'About',
    },
    {
		path: '/UpdateBlog/:id',
        component: UpdateBlog,
        name: 'UpdateBlog',
    },
    {
		path: '/ListAllBlog',
        component: ListAllBlog,
        name: 'ListAllBlog',
    },
    {
		path: '/ListBlog',
        component: ListBlog,
        name: 'ListBlog',
    },
    {
		path: '/NewBlog',
        component: NewBlog,
        name: 'NewBlog',
    },
    {
		path: '/UpdatePostChild/:id',
        component: UpdatePostChild,
        name: 'UpdatePostChild',
    },
    {
		path: '/ListPostChilld/:id',
        component: ListPostChilld,
        name: 'ListPostChilld',
    },
    {
		path: '/NewPostChild/:id',
        component: NewPostChild,
        name: 'NewPostChild',
    },
    {
		path: '/UpdatePost/:id',
        component: UpdatePost,
        name: 'UpdatePost',
    },
    {
		path: '/NewPost',
        component: NewPost,
        name: 'NewPost',
    },
    {
		path: '/ListPostAll',
        component: ListPostAll,
        name: 'ListPostAll',
    },
    {
		path: '/ListPost',
        component: ListPost,
        name: 'ListPost',
    },
    {
		path: '/updateInfo',
        component: updateInfo,
        name: 'updateInfo',
    },
    {
		path: '/Category',
        component: Category,
        name: 'Category',
    },
    {
		path: '/newPermission',
        component: newPermission,
        name: 'newPermission',
    },
    {
		path: '/EditPermission/:id',
        component: EditPermission,
        name: 'EditPermission',
    },
    {
		path: '/ListPermission',
        component: ListPermission,
        name: 'ListPermission',
    },
    {
		path: '/',
        component: Home,
        name: 'home',
    },
    {
		path: '*',
        component: Home,
        name: 'home',
    },

];


export const router = new VueRouter({
    base: '/admin/',
    mode: 'history',
    routes
});



Vue.component('admin-login', require('./components/admin/temp/login.vue').default);
Vue.component('admin-sidebar', require('./components/admin/temp/sidebar.vue').default);
Vue.component('admin-main', require('./components/admin/temp/Main.vue').default);



const app = new Vue({
    router
}).$mount('#app')


