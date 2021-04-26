require("./bootstrap");

import App from "./components/Website.svelte";

const app = new App({
    target: document.body,
});

window.app = app;

export default app;
