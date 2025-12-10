import 'bootstrap/dist/css/bootstrap.min.css';
import './bootstrap';
import { createApp } from 'vue';
import LearnerProgressComponent from './components/LearnerProgressComponent.vue'; // Example component

const app = createApp({});

// Register components
app.component('learner-progress-component', LearnerProgressComponent);

app.mount('#app'); // Mount the app to an element with id="app"
