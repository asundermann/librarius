
document.addEventListener('click', (event) =>
{
    let searchBar = document.getElementById('frm-searchForm-term');
    let searchForm = document.getElementById('searchBar')
    let magnifyingGlass = document.querySelector('.fa-search');
    let targetEl = event.target;

    do {
        if (targetEl == searchBar){
            searchForm.classList.add('border-librarius-900')
            magnifyingGlass.classList.add('text-librarius-900')
            return
        }
        targetEl = targetEl.parentNode;

    } while (targetEl);
        searchForm.classList.remove('border-librarius-900')
        magnifyingGlass.classList.remove('text-librarius-900')

})