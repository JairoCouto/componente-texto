/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('./componente/tiny');
require('./componente/langs/pt_BR');

import { createApp } from 'vue';

import ComponentCkeditor from './components/CKeditor5.vue';

import Ckeditor from '@ckeditor/ckeditor5-vue';

//require('@ckeditor/ckeditor5-pagination/');

const app = createApp({});
app.component('textarea-model', ComponentCkeditor).use(Ckeditor);


app.mount("#app")

