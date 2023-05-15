import "./ckeditor/ckeditor.js"
import {initHamburgerMenu} from "./components/HamburgerMenu";
import {initFlashMessageTimout} from "./components/FadeOut";
let editor;

function initCKEditor() {
    // use observer to reduce load on JS engine
    // eg: many instances are used in form multipliers
    window.CKObserver =
        window.CKObserver ||
        new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    window.ClassicEditor.create(entry.target, {
                        height: 400,
                        simpleUpload: {
                            uploadUrl: entry.target.dataset.uploadUrl,
                            withCredentials: true,
                            headers: {},
                        },
                        toolbar: {
                            items: [
                                "heading",
                                "|",
                                "bold",
                                "italic",
                                "superscript",
                                "subscript",
                                "link",
                                "bulletedList",
                                "numberedList",
                                "removeFormat",
                                "code",
                                "|",
                                "indent",
                                "outdent",
                                "|",
                                "imageUpload",
                                "blockQuote",
                                "insertTable",
                                "mediaEmbed",
                                "undo",
                                "redo",
                            ],
                        },
                        language: "cs",
                        image: {
                            toolbar: [
                                "imageTextAlternative",
                                "imageStyle:full",
                                "imageStyle:side",
                            ],
                        },
                        table: {
                            contentToolbar: ["tableColumn", "tableRow", "mergeTableCells"],
                        },
                        mediaEmbed: {
                            previewsInData: true,
                        },
                        heading: {
                            options: [
                                {
                                    model: "paragraph",
                                    view: "p",
                                    title: "Paragraph",
                                    class: "ck-heading_paragraph",
                                },
                                {
                                    model: "heading1",
                                    view: "h3",
                                    title: "Heading 1",
                                    class: "ck-heading_heading1",
                                },
                                {
                                    model: "heading2",
                                    view: "h4",
                                    title: "Heading 2",
                                    class: "ck-heading_heading2",
                                },
                                {
                                    model: "heading3",
                                    view: {
                                        name: "h5",
                                        classes: "label",
                                    },
                                    title: "Label",
                                    class: "ck-heading_heading3",
                                },
                                {
                                    model: "heading4",
                                    view: {
                                        name: "span",
                                        classes: "btn-wysiwyg",
                                    },
                                    title: "Tlačítko",
                                    class: "ck-heading_heading4",
                                },
                            ],
                        },
                    })
                        .then((editor) => {
                            editor.model.document.on("change:data", () => {
                                editor.updateSourceElement()
                            })
                        })
                        .catch((err) => console.error(err.stack))
                    window.CKObserver.unobserve(entry.target)
                }
            })
        })
    window.CKObserver.disconnect()
    document.querySelectorAll(".js-wysiwyg").forEach((field) => {
        window.CKObserver.observe(field)
    })
}




export async function initAll() {
    initCKEditor()
    initHamburgerMenu()
    initFlashMessageTimout()
}


