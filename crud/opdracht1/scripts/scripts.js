function laadNamen() {
            fetch('../verwerking/uitlezen.php')
                .then(response => response.json())
                .then(data => {
                    const lijst = document.getElementById('namen-lijst');
                    
                    if (data.length === 0) {
                        lijst.innerHTML = '<div class="no-data">Geen namen gevonden. Voeg een naam toe om te beginnen.</div>';
                        return;
                    }

                    let html = `
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Naam</th>
                                    <th>Acties</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;
                    
                    data.forEach(item => {
                        html += `
                            <tr>
                                <td>${item.id}</td>
                                <td id="naam-${item.id}">${item.naam}</td>
                                <td>
                                    <div class="actions">
                                        <button class="btn-warning" onclick="startBewerken(${item.id}, '${item.naam}')">Bewerken</button>
                                        <button class="btn-danger" onclick="verwijderNaam(${item.id}, '${item.naam}')">Verwijderen</button>
                                    </div>
                                    <div id="edit-form-${item.id}" class="edit-form">
                                        <form onsubmit="bewerkNaam(event, ${item.id})">
                                            <div class="form-group">
                                                <label>Nieuwe naam:</label>
                                                <input type="text" id="edit-naam-${item.id}" value="${item.naam}" required>
                                            </div>
                                            <button type="submit">Opslaan</button>
                                            <button type="button" onclick="stopBewerken(${item.id})">Annuleren</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        `;
                    });
                    
                    html += `
                            </tbody>
                        </table>
                    `;
                    
                    lijst.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('namen-lijst').innerHTML = '<div class="no-data">Er is een fout opgetreden bij het laden van de namen.</div>';
                });
        }

        function startBewerken(id, naam) {
            document.getElementById(`edit-form-${id}`).style.display = 'block';
            document.getElementById(`edit-naam-${id}`).focus();
        }

        function stopBewerken(id) {
            document.getElementById(`edit-form-${id}`).style.display = 'none';
        }

        function bewerkNaam(event, id) {
            event.preventDefault();
            
            const nieuweNaam = document.getElementById(`edit-naam-${id}`).value;
            
            const formData = new FormData();
            formData.append('id', id);
            formData.append('naam', nieuweNaam);
            
            fetch('../verwerking/verwerken.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    laadNamen();
                } else {
                    alert('Er is een fout opgetreden bij het bewerken van de naam.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Er is een fout opgetreden bij het bewerken van de naam.');
            });
        }

        function verwijderNaam(id, naam) {
            if (confirm(`Weet je zeker dat je "${naam}" wilt verwijderen?`)) {
                const formData = new FormData();
                formData.append('id', id);
                
                fetch('../verwerking/verwijderen.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        laadNamen(); 
                    } else {
                        alert('Er is een fout opgetreden bij het verwijderen van de naam.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Er is een fout opgetreden bij het verwijderen van de naam.');
                });
            }
        }

        document.addEventListener('DOMContentLoaded', laadNamen);