import {initAll} from "./initializers.js";

document.addEventListener(`DOMContentLoaded`, () => {
    initAll().then(() => {
        console.log("All modules successfully loaded")
    })
})

