/**
 * plugins/vuetify.js
 *
 * Framework documentation: https://vuetifyjs.com
 */

// Styles
import "@mdi/font/css/materialdesignicons.css";
import "vuetify/styles";

// Composables
import { createVuetify } from "vuetify";

// Vuetify Components and Directives
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";

// Create and export the Vuetify instance
export default createVuetify({
  components,
  directives,
  theme: {},
});
