export function initFlashMessageTimout()
{
    let flashMessage = document.getElementById('flash');

    window.setTimeout(() =>{
        flashMessage.classList.add('hidden');
    },3000)
    window.setTimeout(() => {
        flashMessage.style.display = 'none';
    },5000)
}
