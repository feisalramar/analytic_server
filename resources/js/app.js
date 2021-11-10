require('./bootstrap');
import React from 'react';
import { render } from 'react-dom';
import { InertiaApp } from '@inertiajs/inertia-react';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

import 'vuesax/dist/vuesax.css'
import 'equal-vue/dist/style.css'

// import vuesax from 'vuesax'
// import Equal from 'equal-vue'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Analytics';

// const  app = createInertiaApp({
//     title: (title) => `${title} - ${appName}`,
//     resolve: (name) => require(`./Pages/${name}.vue`),
//     setup({ el, app, props, plugin }) {
//         return createApp({ render: () => h(app, props) })
//             .use(plugin)
//             .mixin({ methods: { route } })
//             .mount(el);
//     },
// });
//
// InertiaProgress.init({ color: '#4B5563' });

const app = document.getElementById('app');

render(
    <InertiaApp
        initialPage={JSON.parse(app.dataset.page)}
        resolveComponent={name =>
            import(`./Pages/${name}`).then(module => module.default)
        }
    />,
    app
);
