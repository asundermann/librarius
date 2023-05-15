export function initFlashMessageTimout()
{
    var flashMessage = document.getElementById('flash');
    window.setTimeout(() =>{
        flashMessage.classList.add('hidden');
    },3000)
    window.setTimeout(() => {
        flashMessage.style.display = 'none';
    },5000)
}
//TODO musím dořešit, aby se tento script nespouštěl neustále ale jen když bude flashmessage na window