<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuwe Digitale Vondst aanmaken</title>
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
        <h1>Nieuwe Digitale Vondst aanmaken</h1>
        
        <?php if (isset($error)): ?>
            <div style="color: red; margin-bottom: 20px;">
                <strong>Fout:</strong> <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="create.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Titel</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="description">Beschrijving</label>
                <textarea id="description" name="description" required></textarea>
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" id="type" name="type" required>
            </div>

            <div class="form-group">
                <label for="discover_date">Ontdekkingsdatum</label>
                <input type="date" id="discover_date" name="discover_date" required>
            </div>

            <!-- Image input tabs -->
            <fieldset class="form-group">
                <legend>Afbeelding</legend>
                
                <div class="tabs">
                    <button type="button" class="tab-button active" onclick="switchTab('upload')">Afbeelding uploaden</button>
                    <button type="button" class="tab-button" onclick="switchTab('url')">Afbeelding URL</button>
                </div>

                <!-- Upload tab -->
                <div id="upload" class="tab-content active">
                    <div class="form-group">
                        <label for="image_upload">Selecteer afbeelding</label>
                        <input type="file" id="image_upload" name="image_upload" accept="image/*" onchange="previewImage(this)">
                        <small>Ondersteunde formaten: JPEG, PNG, GIF, WebP</small>
                        <div class="image-preview" id="upload-preview">
                            <img id="upload-preview-img" src="" alt="Preview">
                        </div>
                    </div>
                </div>

                <!-- URL tab -->
                <div id="url" class="tab-content">
                    <div class="form-group">
                        <label for="file_url">Afbeelding URL</label>
                        <input type="url" id="file_url" name="file_url" placeholder="https://example.com/image.jpg" onchange="previewImageUrl(this.value)">
                        <small>Voer een volledige URL in naar een afbeelding</small>
                        <div class="image-preview" id="url-preview">
                            <img id="url-preview-img" src="" alt="Preview">
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
                    alert('Afbeelding kon niet worden geladen. Controleer de URL.');
                };
                testImg.src = url;
            } else {
                preview.classList.remove('active');
            }
        }
    </script>
</body>
</html>
