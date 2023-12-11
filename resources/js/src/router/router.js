import {createRouter, createWebHistory} from "vue-router";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [

        {
            path: '/',
            name: 'app',
            component: () => import('../App.vue')
        },
        {
            path: '/segments',
            name: 'segments',
            component: () => import('../components/Segments.vue')
        },

    ]
})



export default router