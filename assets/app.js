import './styles/app.css';

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');
 
// start the Stimulus application
import './bootstrap';
 
require('./Home');