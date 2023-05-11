import "./ckeditor/ckeditor.js"

let editor;

ClassicEditor
    .create(document.querySelector('.js-wysiwyg'),{
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
    .then(newEditor => {
        editor = newEditor;
    })
    .catch( error => console.log(error))

document.querySelector( '#send' ).addEventListener( 'click', () => {
    const editorData = editor.getData();
    console.log(editorData)
} );