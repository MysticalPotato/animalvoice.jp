<?php
    // Rich Text Editor
    $maxlength = $maxlength ?? 2000;
?>

<input type="hidden" name="content" id="quill-content" maxlength="<?= $maxlength ?>" required>
<input type="hidden" name="new_images">


<div class="editor-container">
    <div id="toolbar">
        <span class="ql-formats">
            <select class="ql-header">
                <option selected></option>
                <option value="1"></option>
                <option value="2"></option>
                <option value="3"></option>
            </select>
        </span>

        <span class="ql-formats">
            <button class="ql-bold"></button>
            <button class="ql-italic"></button>
            <button class="ql-underline"></button>
            <button class="ql-strike"></button>
        </span>

        <span class="ql-formats">
            <select class="ql-color"></select>
            <select class="ql-background"></select>
        </span>

        <span class="ql-formats">
            <button class="ql-list" value="ordered"></button>
            <button class="ql-list" value="bullet"></button>
        </span>

        <span class="ql-formats">
            <button class="ql-link"></button>
            <!-- <button class="ql-cta-link">🖱️</button> -->
        </span>

        <span class="ql-formats">
            <button class="ql-image"></button>
            <button class="ql-emoji"></button>
        </span>

        <span class="ql-formats">
            <button class="ql-clean"></button>
        </span>
    </div>

    <div id="editor">
        <?= $content ?>
        <!-- <p>こんにちは、</p>
        <p>Some initial <strong>bold</strong> text</p>
        <p><br /></p> -->
    </div>
</div>

<div id="char-count" style="margin-top: 8px; font-size: 0.9em; color: #666;">
    0 / <?= $maxlength ?> characters
</div>

<!-- Quill 1.3.7 -->
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>

<!-- quill-emoji (compatible with Quill 1.x) -->
<link href="https://cdn.jsdelivr.net/npm/quill-emoji@0.1.7/dist/quill-emoji.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/quill-emoji@0.1.7/dist/quill-emoji.min.js"></script>

<!-- Whitelist the class attribute -->
<script>
    const Link = Quill.import('formats/link');

    class CustomLink extends Link {
        static create(value) {
            let node = super.create(value);
            node.setAttribute('href', value);

            // Optionally set rel and target here
            node.setAttribute('rel', 'noopener noreferrer');
            node.setAttribute('target', '_blank');

            // Preserve any existing class if already set externally
            if (value && value.startsWith('cta:')) {
                node.setAttribute('href', value.replace(/^cta:/, ''));
                node.classList.add('cta-btn');
            }

            return node;
        }

        static formats(domNode) {
            let format = super.formats(domNode);
            if (domNode.classList.contains('cta-btn')) {
                format = 'cta:' + format; // flag it as CTA
            }
            return format;
        }
    }

    Quill.register(CustomLink, true);
</script>

<!-- Initialize Quill editor -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const maxlength = <?= $maxlength ?>;
        const uploadUrl = "<?= route('/admin/uploads') ?>";

        const newImages = [];
        const deletedImages = [];

        const form = document.getElementById('<?= $form_id ?>');

        function updateCharCount(quill) {
            const charCountEl = document.getElementById('char-count');
            const plainText = quill.getText().trim(); // Excludes formatting
            const length = plainText.length;
            charCountEl.textContent = `${length} / ${maxlength} characters`;

            // Optional: Prevent typing beyond maxlength
            if (length > maxlength) {
                quill.deleteText(maxlength, length); // Deletes extra
            }
        }

        function applyBtnStyles(html) {
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = html;

            const ctaButtons = tempDiv.querySelectorAll('a.cta-btn');
            ctaButtons.forEach(button => {
                button.style.display = 'inline-block';
                button.style.borderRadius = '8px';
                button.style.padding = '10px 24px';
                button.style.fontWeight = 'bold';
                button.style.backgroundColor = '#ff2e63';
                button.style.textDecoration = 'none';
                button.style.color = '#fff';
            });

            return tempDiv.innerHTML;
        }

        function removeBtnStyles() {
            const editor = document.getElementById('editor');
            const ctaButtons = editor.querySelectorAll('a.cta-btn');
            ctaButtons.forEach(button => {
                button.removeAttribute('style');
            });
        }

        async function imageHandler() {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.click();

            input.onchange = async function () {
                const file = input.files[0];
                if (!file) return;

                // // Add image validation
                // const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                // const maxSizeMB = 2;
                // // const dir = 'temp'; // Customize this as needed

                // if (!validTypes.includes(file.type)) {
                //     alert('Only JPG, PNG, or GIF images are allowed.');
                //     return;
                // }

                // if (file.size > maxSizeMB * 1024 * 1024) {
                //     alert(`Image must be smaller than ${maxSizeMB} MB.`);
                //     return;
                // }

                const formData = new FormData();
                formData.append('file', file);

                try {
                    const response = await fetch(uploadUrl, {
                        method: 'POST',
                        body: formData
                    });
                    const result = await response.json();

                    if (result.success && result.url) {
                        const range = quill.getSelection();
                        quill.insertEmbed(range.index, 'image', result.url);

                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'new_images[]';
                        input.value = result.url;
                        form.appendChild(input);
                    } else {
                        // console.error(result.error);
                        alert(result.error);
                    }
                } catch (err) {
                    console.error('Upload error:', err);
                }
            };
        }

        function trackImageDeletions(delta, oldDelta) {
            const oldImages = [];
            const newImagesInEditor = [];

            const traverse = (ops, list) => {
                ops.forEach(op => {
                    if (op.insert && typeof op.insert === 'object' && op.insert.image) {
                        list.push(op.insert.image);
                    }
                });
            };

            traverse(oldDelta.ops, oldImages);
            traverse(quill.getContents().ops, newImagesInEditor);

            oldImages.forEach(imgUrl => {
                if (!newImagesInEditor.includes(imgUrl) && !deletedImages.includes(imgUrl)) {
                    deletedImages.push(imgUrl);
                }
            });
        }

        // Remove styles from CTA buttons before Quill loads
        removeBtnStyles();
        
        // Quill 1.x
        const quill = new Quill('#editor', {
            modules: {
                toolbar: {
                    container: '#toolbar',
                    handlers: {
                        image: imageHandler
                    }
                },
                'emoji-toolbar': true,
                'emoji-textarea': false,
                'emoji-shortname': true
            },
            theme: 'snow'
        });
    
        form.addEventListener('submit', async function(event) {
            event.preventDefault(); // Prevent default form submit

            const contentInput = document.getElementById('quill-content');

            // Apply final styles and set input values
            const finalHtml = applyBtnStyles(quill.root.innerHTML);
            contentInput.value = finalHtml;

            // Optionally: Send DELETE requests for each deleted image
            for (const url of deletedImages) {
                const formData = new FormData();
                formData.append('url', url);
                formData.append('_method', 'DELETE');

                try {
                    const response = await fetch(uploadUrl, {
                        method: 'POST',
                        body: formData
                    });

                    const result = await response.json();
                    if (!result.success) {
                        console.warn(`Failed to delete image: ${url}`, result);
                    }
                } catch (err) {
                    console.error(`Error deleting image: ${url}`, err);
                }
            }

            // Submit the form manually after deletes complete
            form.submit();
        });

        quill.on('text-change', function (delta, oldDelta, source) {
            trackImageDeletions(delta, oldDelta);
            updateCharCount(quill);
        });

        // Update character count on page load
        updateCharCount(quill);
    });

</script>