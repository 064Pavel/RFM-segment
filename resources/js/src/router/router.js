import {createRouter, createWebHistory} from "vue-router";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [

        {
            path: '/test1',
            name: 'test1',
            component: () => import('../components/Test1.vue')
        },
        {
            path: '/test2',
            name: 'test2',
            component: () => import('../components/Test2.vue')
        },

    ]
})



export default router