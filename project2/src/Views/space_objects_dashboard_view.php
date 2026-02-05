<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruimteobject Dashboard</title>
    <link rel="stylesheet" href="assets/css/global.css">
</head>
<body>
    <main>
        <h1>Ruimteobjecten</h1>
        <div class="action-links">
            <a href="space_objects_create.php">Nieuw Ruimteobject</a>
        </div>
        <section>
            <h2>Alle Ruimteobjecten</h2>
            <?php if (empty($spaceObjects)): ?>
                <div class="card">
                    <p>Geen ruimteobjecten gevonden. <a href="space_objects_create.php">Maak je eerste ruimteobject</a>.</p>
                </div>
            <?php else: ?>
                <div class="card-container">
                    <?php foreach ($spaceObjects as $object): ?>
                        <div class="card space-object-card" onclick="showModal(<?= $object->getId() ?>)">
                            <?php if ($object->getImageFilename()): ?>
                                <img src="image.php?file=<?= urlencode($object->getImageFilename()); ?>&w=400&h=300" 
                                     alt="<?= htmlspecialchars($object->getName()) ?>">
                            <?php elseif ($object->getFileUrl()): ?>
                                <img src="<?= htmlspecialchars($object->getFileUrl()) ?>" 
                                     alt="<?= htmlspecialchars($object->getName()) ?>"
                                     onerror="this.parentElement.innerHTML='<div class=\'no-image\'>Geen afbeelding beschikbaar</div>'">
                            <?php else: ?>
                                <div class="no-image">Geen afbeelding beschikbaar</div>
                            <?php endif; ?>
                            <div class="space-object-overlay">
                                <h3 style="margin: 0 0 5px 0;"><?= htmlspecialchars($object->getName()) ?></h3>
                                <p style="margin: 0; font-size: 0.9em;"><?= htmlspecialchars($object->getType()) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <div id="modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modal-title"></h2>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <img id="modal-image" class="modal-image" src="" alt="" style="display: none;">
                <p><strong>Beschrijving:</strong> <span id="modal-description"></span></p>
                <p><strong>Type:</strong> <span id="modal-type"></span></p>
                <p><strong>Ontdekkingsdatum:</strong> <span id="modal-date"></span></p>
                <p><strong>Bestands-URL:</strong> <a id="modal-url" target="_blank">Bekijk bestand</a></p>
            </div>
            <div class="modal-actions">
                <a id="modal-edit">Bewerken</a>
                <a id="modal-delete" class="danger">Verwijderen</a>
                <button onclick="closeModal()">Sluiten</button>
            </div>
        </div>
    </div>

    <script>
        const objectData = {
            <?php foreach ($spaceObjects as $obj): ?>
            <?= $obj->getId() ?>: {
                name: <?= json_encode($obj->getName()) ?>,
                description: <?= json_encode($obj->getDescription()) ?>,
                type: <?= json_encode($obj->getType()) ?>,
                date: <?= json_encode($obj->getDiscoveredDate()) ?>,
                url: <?= json_encode($obj->getFileUrl()) ?>,
                imageFilename: <?= json_encode($obj->getImageFilename()) ?>
            },
            <?php endforeach; ?>
        };

        function showModal(id) {
            const data = objectData[id];
            if (!data) return;
            
            document.getElementById('modal-title').textContent = data.name;
            document.getElementById('modal-description').textContent = data.description;
            document.getElementById('modal-type').textContent = data.type;
            document.getElementById('modal-date').textContent = data.date;
            const urlEl = document.getElementById('modal-url');
            urlEl.href = data.url;
            urlEl.textContent = 'Bekijk bestand';
            document.getElementById('modal-edit').href = 'space_objects_update.php?id=' + id;
            document.getElementById('modal-delete').href = 'space_objects_delete.php?id=' + id;
            
            // Set image
            const imgEl = document.getElementById('modal-image');
            if (data.imageFilename) {
                imgEl.src = 'image.php?file=' + encodeURIComponent(data.imageFilename) + '&w=600&h=400';
                imgEl.alt = data.name;
                imgEl.style.display = 'block';
            } else if (data.url) {
                imgEl.src = data.url;
                imgEl.alt = data.name;
                imgEl.style.display = 'block';
            } else {
                imgEl.style.display = 'none';
            }
            
            document.getElementById('modal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('modal').classList.remove('active');
        }

        document.getElementById('modal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        <?php if ($selectedObject): ?>
        showModal(<?= $selectedObject->getId() ?>);
        <?php endif; ?>
    </script>
</body>
</html>
