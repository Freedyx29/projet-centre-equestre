<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['iduti'])) {
    $current_page = urlencode($_SERVER['PHP_SELF']);
    header("Location: ../vue/vue.index.php?redirect_to=" . $current_page);
    exit();
}
include '../include/haut.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css' rel='stylesheet' />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/style_crud.css">
</head>
<body>

  <div id='calendar'></div>

  <div id="editForm">
    <form id="editCourseForm">
      <input type="hidden" id="courseId" name="courseId">
      
      <label for="libcours">Nom du cours</label>
      <input type="text" id="libcours" name="libcours" readonly>
      
      <label for="hdebut">Heure de début</label>
      <input type="time" id="hdebut" name="hdebut" readonly>
      
      <label for="hfin">Heure de fin</label>
      <input type="time" id="hfin" name="hfin" readonly>

      <div class="cavaliers-section">
          <label for="cavaliers">Cavaliers inscrits</label>
          <div class="cavaliers-list">
              <select id="cavaliers" name="cavaliers[]" multiple class="form-control" disabled>
                  <!-- Les cavaliers seront ajoutés ici dynamiquement -->
              </select>
          </div>
      </div>
      
      <div class="form-buttons">
          <button type="button" class="btn-annuler" onclick="closeEditForm()">Retour</button>
      </div>
    </form>
  </div>

  <div class="form-overlay" style="display:none;"></div>

  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js'></script>
  <script>
    function loadCavaliers(eventId) {
        console.log("Chargement des cavaliers pour le cours ID:", eventId);
        fetch(`../fullcalendar/getCavaliers.php?courseId=${eventId}`)
            .then(response => {
                console.log("Réponse reçue:", response);
                return response.json();
            })
            .then(data => {
                console.log("Données reçues:", data);
                const cavaliersSelect = document.getElementById('cavaliers');
                cavaliersSelect.innerHTML = '';
                
                if (data && data.length > 0) {
                    data.forEach(cavalier => {
                        console.log("Ajout du cavalier:", cavalier);
                        const option = document.createElement('option');
                        option.value = cavalier.idcava;
                        option.textContent = cavalier.nomcava;
                        option.selected = true;
                        cavaliersSelect.appendChild(option);
                    });
                } else {
                    console.log("Aucun cavalier trouvé");
                    const option = document.createElement('option');
                    option.disabled = true;
                    option.textContent = 'Aucun cavalier inscrit';
                    cavaliersSelect.appendChild(option);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                const cavaliersSelect = document.getElementById('cavaliers');
                cavaliersSelect.innerHTML = '<option disabled>Erreur de chargement</option>';
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        fetch('../fullcalendar/getEvents.php')
          .then(response => response.json())
          .then(data => {
            var calendar = new FullCalendar.Calendar(calendarEl, {
              initialView: 'timeGridWeek',
              locale: 'fr',
              firstDay: 1,
              headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
              },
              buttonText: {
                today: "Aujourd'hui",
                month: 'Mois',
                week: 'Semaine',
                day: 'Jour',
                list: 'Liste'
              },
              events: data,
              slotMinTime: '08:00:00',
              slotMaxTime: '20:00:00',
              allDaySlot: false,
              height: 'auto',
              expandRows: true,
              slotEventOverlap: false,
              eventClick: function(info) {
                openEditForm(info.event);
              },
              eventContent: function(arg) {
                return { html: `<b>${arg.event.title}</b>` };
              }
            });
            calendar.render();
          })
          .catch(error => console.error('Error fetching events:', error));
    });

    function openEditForm(event) {
        console.log("ID du cours:", event.id); // Debug
        document.querySelector('.form-overlay').style.display = 'block';
        document.getElementById('editForm').style.display = 'block';
        document.getElementById('courseId').value = event.id;
        document.getElementById('libcours').value = event.title.split(' - ')[0];
        document.getElementById('hdebut').value = event.extendedProps.hdebut;
        document.getElementById('hfin').value = event.extendedProps.hfin;
        
        loadCavaliers(event.id);
    }

    function deleteCourse() {
        document.getElementById('action').value = 'supprimer';
        document.getElementById('editCourseForm').submit();
    }

    document.getElementById('editCourseForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        fetch('../traitement/traitement.cours.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Action réussie');
                location.reload();
            } else {
                console.error('Erreur:', data.error);
                alert('Erreur lors de l\'action');
            }
        })
        .catch(error => console.error('Error:', error));
    });

    function closeEditForm() {
        document.querySelector('.form-overlay').style.display = 'none';
        document.getElementById('editForm').style.display = 'none';
    }
  </script>
</body>
</html>
