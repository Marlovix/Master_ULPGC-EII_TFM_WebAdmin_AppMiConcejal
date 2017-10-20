var components = {
    "packages": [
        {
            "name": "bootstrap",
            "main": "bootstrap-built.js"
        },
        {
            "name": "angularjs",
            "main": "angularjs-built.js"
        },
        {
            "name": "jquery",
            "main": "jquery-built.js"
        },
        {
            "name": "bootstrap-switch",
            "main": "bootstrap-switch-built.js"
        },
        {
            "name": "select2",
            "main": "select2-built.js"
        }
    ],
    "shim": {
        "bootstrap-switch": {
            "exports": "BootstrapSwitch"
        }
    },
    "baseUrl": "components"
};
if (typeof require !== "undefined" && require.config) {
    require.config(components);
} else {
    var require = components;
}
if (typeof exports !== "undefined" && typeof module !== "undefined") {
    module.exports = components;
}