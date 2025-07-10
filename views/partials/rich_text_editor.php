<input type="hidden" name="content" id="quill-content" maxlength="500" required>

<div class="editor-container">
    <div id="editor">
        <?= $content ?>
        <!-- <p>こんにちは、</p>
        <p>Some initial <strong>bold</strong> text</p>
        <p><br /></p> -->
    </div>
</div>

<!-- Include the Quill library -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

<!-- Initialize Quill editor -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var toolbarOptions = [
            [{ 'header': [1, 2, 3, false] }],
    
            ['bold', 'italic', 'underline', 'strike'],			// toggled buttons
            [{ 'color': [] }, { 'background': [] }],			// dropdown with defaults from theme
    
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            // [{ 'indent': '-1'}, { 'indent': '+1' }],			// outdent/indent
            
            [ 'link', 'image' ],								// add's image support
            // [{ 'font': [] }],
            // [{ 'align': [] }],
    
            ['clean']											// remove formatting button
        ];
    
        const quill = new Quill('#editor', {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow'
        });
    
        const form = document.getElementById('<?= $form_id ?>');
        form.addEventListener('submit', function(event) {
            const contentInput = document.getElementById('quill-content');
            contentInput.value = quill.root.innerHTML; // or quill.getContents() for JSON
        });
    });

</script>