// Import global dependencies
import './bootstrap';
// Import required modules
import Template from './modules/template';
// require('lozad/dist/lozad.js');
require('sharer.js');
// App extends Template
export default class App extends Template {
    constructor() {
        super();
    }
}

// Once everything is loaded
jQuery(() => {
    // Create a new instance of App
   window.Codebase = new App();
});