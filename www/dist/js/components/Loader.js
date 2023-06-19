export function initLoader()
{
    let loaderWrapper = document.querySelector('.loader-wrapper')
    window.addEventListener("load", ()=> {
        loaderWrapper.remove();
    })
}