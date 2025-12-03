<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digitale Vondst Bewerken</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <style>
        .image-preview {
            max-width: 300px;
            margin-top: 10px;
            display: none;
        }
        .image-preview.active {
            display: block;
        }
        .image-preview img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .current-image {
            max-width: 300px;
            margin: 10px 0;
        }
        .current-image img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            border-bottom: 2px solid #ddd;
        }
        .tab-button {
            padding: 10px 20px;
            border: none;
            background: none;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            font-weight: bold;
        }
        .tab-button.active {
            border-bottom-color: #007bff;
            color: #007bff;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
    </style>
</head>
<body>
    <main>
        <h1>Digitale Vondst Bewerken</h1>
        
        <?php if (isset($error)): ?>
            <div style="color: red; margin-bottom: 20px;">
                <strong>Fout:</strong> <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="update.php?id=<?= $digitaleFind->getId(); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Titel</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($digitaleFind->getTitle()); ?>" required>                
            </div>

            <div class="form-group">
                <label for="description">Beschrijving</label>
                <textarea id="description" name="description" required><?= htmlspecialchars($digitaleFind->getDescription()); ?></textarea>
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" id="type" name="type" value="<?= htmlspecialchars($digitaleFind->getType()); ?>" required>
            </div>

            <div class="form-group">
                <label for="discover_date">Ontdekkingsdatum</label>
                <input type="date" id="discover_date" name="discover_date" value="<?= htmlspecialchars($digitaleFind->getDiscoverDate()); ?>" required>
            </div>

            <!-- Image input tabs -->
            <fieldset class="form-group">
                <legend>Afbeelding</legend>
                
                <?php if ($digitaleFind->getImageFilename()): ?>
                    <div class="current-image">
                        <p><strong>Huidige afbeelding:</strong></p>
                        <img src="/project/public/image.php?file=<?= urlencode($digitaleFind->getImageFilename()); ?>&op=resize&w=300&h=300" 
                             alt="<?= htmlspecialchars($digitaleFind->getTitle()); ?>">
                    </div>
                <?php endif; ?>

                <div class="tabs">
                    <button type="button" class="tab-button active" onclick="switchTab('url')">Afbeelding URL</button>
                    <button type="button" class="tab-button" onclick="switchTab('upload')">Nieuwe afbeelding uploaden</button>
                </div>

                <!-- URL tab -->
                <div id="url" class="tab-content active">
                    <div class="form-group">
                        <label for="file_url">Afbeelding URL</label>
                        <input type="url" id="file_url" name="file_url" value="<?= htmlspecialchars($digitaleFind->getFileUrl()); ?>" placeholder="https://example.com/image.jpg" onchange="previewImageUrl(this.value)">
                        <small>Voer een volledige URL in naar een afbeelding (of laat leeg als u een afbeelding heeft geüpload)</small>
                        <div class="image-preview" id="url-preview">
                            <img id="url-preview-img" src="" alt="Preview">
                        </div>
                    </div>
                </div>

                <!-- Upload tab -->
                <div id="upload" class="tab-content">
                    <div class="form-group">
                        <label for="image_upload">Selecteer nieuwe afbeelding</label>
                        <input type="file" id="image_upload" name="image_upload" accept="image/*" onchange="previewImage(this)">
                        <small>Ondersteunde formaten: JPEG, PNG, GIF, WebP (optioneel - laat leeg om huidige afbeelding te behouden)</small>
                        <div class="image-preview" id="upload-preview">
                            <img id="upload-preview-img" src="" alt="Preview">
                        </div>
                    </div>
                </div>
            </fieldset>

            <div class="action-links">
                <button type="submit">Opslaan</button>
                <a href="dashboard.php">Annuleren</a>
            </div>
        </form>
    </main>

    <script>
        function switchTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('active');
            });

            // Show selected tab
            document.getElementById(tabName).classList.add('active');
            event.target.classList.add('active');
        }

        function previewImage(input) {
            const preview = document.getElementById('upload-preview');
            const previewImg = document.getElementById('upload-preview-img');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.classList.add('active');
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.classList.remove('active');
            }
        }

        function previewImageUrl(url) {
            const preview = document.getElementById('url-preview');
            const previewImg = document.getElementById('url-preview-img');
            
            if (url) {
                // Use a simple image load to test the URL
                const testImg = new Image();
                testImg.onload = function() {
                    previewImg.src = url;
                    preview.classList.add('active');
                };
                testImg.onerror = function() {
                    preview.classList.remove('active');
                };
                testImg.src = url;
            } else {
                preview.classList.remove('active');
            }
        }
    </script>
</body>
</html>