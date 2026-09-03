
import './bootstrap';
import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';
import { registerSW } from 'virtual:pwa-register'



window.Alpine = Alpine;
window.Chart = Chart;



Alpine.start();


registerSW({ immediate: true })