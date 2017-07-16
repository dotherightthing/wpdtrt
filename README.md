# DTRT WordPress Framework

1. This framework theme (`wpdtrt__parent`) contains generic templating, functionality, and documentation.
2. Framework child themes (`wpdtrt__child`) may be built on top of this theme.
3. Generic theme functionality deemed appropriate to plugins will be promoted to framework helper plugins (`wpdtrt__pluginhelper_foo`). These can then be used with themes or in tandem with specialised plugins.
4. Specialised plugins (`wpdtrt__plugin_bar`) can use Framework Helper plugins.

## Build

1. Stylesheets: `gulpfile.js`: `scss/wpdtrt__parent.scss -> css/wpdtrt__parent.min.css`
2. Scripts: `gulpfile.js`: `js/wpdtrt__parent.js -> js/wpdtrt__parent.min.js`
3. Images: `wp-content/uploads/*`: `ImageOptim.app`
