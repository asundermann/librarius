
const queryString = window.location.search;
const classesNodeList = document.querySelectorAll(".paginator-number");
const pageOne = document.getElementById("pages-1")

let parameterPage = new URLSearchParams(queryString);
let page = parameterPage.get('page');
let concretePage = document.getElementById("pages-"+page)

if (page == null){
    pageOne.classList.remove("text-gray-500")
    pageOne.classList.add("text-librarius-900")
}
concretePage.classList.remove("text-gray-500")
concretePage.classList.add("text-librarius-900")
