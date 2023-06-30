export function initInfoModal(){

    let infoBtn = document.getElementById("info");
    let modal = document.getElementById("modal");
    let okBtn = document.getElementById("ok");

    infoBtn.addEventListener("click", ()=>
    {
        modal.classList.remove("hidden");
    })

    modal.addEventListener("click", ()=>
    {
        modal.classList.add("hidden");
    })
    okBtn.addEventListener("click", ()=>
    {
        modal.classList.add("hidden");
    })

    return
}