$(document).ready(
/**
 * * Initialise et gère les fonctionnalités de deux tables de données et des fenêtres modales contrôlant les actions sur les articles et les commentaires.
 *
  Fonctionnalités:
  - Affiche les articles de blog avec leur nombre de vues et de commentaires.
  * - Permet de sélectionner des lignes dans les tables et d'en modifier le style.
  * - Gère le chargement asynchrone des données pour les tables de données avec un traitement côté serveur.
  * - Permet d'interagir avec les boîtes de dialogue modales pour confirmer la suppression des commentaires et des articles.
  *
  * Tables:
  * - TableBlog:
  * - Affiche une liste d'articles avec des détails tels que la date de création, le titre, le nombre de vues et le nombre de commentaires.
  * - Fournit un bouton pour afficher les commentaires relatifs à un article spécifique.
  * - Permet la sélection de lignes et met en surbrillance la ligne sélectionnée.
  *
  * - TableMem:
  * - Affiche les commentaires associés à un article spécifique.
  * - Inclut des détails sur les commentaires tels que la date de création, le pseudonyme de l'auteur et le contenu.
  * - Fournit un bouton pour déclencher une fenêtre modale de confirmation de suppression de commentaires.
  * - Active la sélection de ligne et met en surbrillance la ligne sélectionnée.
  *
  * Fenêtres modales:
  * - confirmModa:
  * - Permet de confirmer la suppression d'un commentaire spécifique.
  * - Supprime le commentaire après confirmation et supprime la ligne du tableau dynamiquement via AJAX.
  *
  * - ArticleconfirmModal:
  * - Permet de confirmer la suppression d'un article spécifique.
  * - Supprime l'article après confirmation et recharge la page pour les données mises à jour.
  *
  * Étapes fonctionnelles clés:
  * 1. Initialiser les tables de données avec la configuration du traitement côté serveur, des dimensions des colonnes et du comportement dynamique.
  * 2. Associer des écouteurs d'événements pour gérer les sélections de lignes et les interactions modales.
  * 3. Fournir des mécanismes basés sur AJAX pour la suppression des commentaires et des articles, avec gestion des erreurs et mises à jour de l'interface utilisateur.
 **/
function () {
     // Tableau qui affiche les articles et les quantités de vues et nombre de commentaires
    $('#TableBlog').DataTable({
   /**
    * Affiche un indicateur de chargement
    * Traitement côté serveur
    * Désactive la pagination
    * Masque les informations de pagination
    * Désactive la recherche
    *  Tri par défaut sur la 2ème colonne (index 1) en ordre croissant
    **/
       processing: true,
       serverSide: true,
       paging:false,
       info: false,
       searching:false,
        order: [[1, 'asc']],
        ajax: {
            url: 'index.php?action=showStatisticsArticle',
            type: 'POST'
        },
        columns: [
            { data: 'id',
                visible:false,
                orderable: false
            },
            { data: 'datecreation'  },
            { data: 'title'  },
            { data: 'nbvues'  },
            { data: 'qteCommentaires'  },
            {data: 'details'    }
        ],
        columnDefs: [
            { width: "50px", targets: 0 },
            { width: "140px", targets: 1 },
            { width: "380px", targets: 2 },
            { width: "50px", targets: 3 },
            { width: "50px", targets: 4 },
            {
                width: "100px",
                targets: 5,
                orderable: false,
                render:function(data, type, row) {
                    var id = row.id; // Supposons que l'ID est dans la première colonne
                    return '<a href="index.php?action=showComment&id=' + id + '" class="comment-btn">Voir</a>';
                }
            },
            { targets: [3], className: 'dt-center' },
            { targets: [4], className: 'dt-center' },
            { targets: [5], className: 'dt-center' },
       ],
       scrollY: true
    });

    // selction d'une ligne du tableau (DataTable) changer la couleur de fond en bleu ou la retire
    $('#TableBlog tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected').siblings().removeClass('selected');
    });


    $('#TableMemo').DataTable({
       processing: true, // Affiche un indicateur de chargement
        serverSide: true,// Traitement côté serveur
        paging:false, // Désactive la pagination
        info: false, //Masque les informations de pagination
        searching:false, // Désactive la recherche
        order: [[1, 'asc']],// Tri par défaut sur la 2ème colonne (index 1) en ordre croissant
        //- Définit la requête AJAX pour charger les données
        //- Ajoute l'ID de l'article aux données envoyées
        ajax: {
            url: 'index.php?action=showDataComment',
            type: 'POST',
            data: function(d){
                const idval =  document.getElementById("TableMemo").dataset.id; // récupérer ID article
                d.keyarticle= idval;
            }
        },
        createdRow: function(row, data, dataIndex) {
            $(row).attr('id', '#keyid_' + data.id); //Attribue un ID unique à chaque ligne créée.

        },
        //Définit la structure des colonnes et leurs propriétés.
        columns: [
            { data: 'id',
                visible:false,
                orderable: false
            },
            { data: 'datecreation'  },
            { data: 'pseudo'  },
            { data: 'content'  },
            {data: 'details'  }
        ],
        /*
            - Configure la largeur des colonnes
            - Ajoute un bouton de suppression dans la dernière colonne
            - Centre le contenu de certaines colonnes
        */
        columnDefs: [
            { width: "50px", targets: 0 },
            { width: "200px", targets: 1 },
            { width: "120px", targets: 2 },
            { width: "400px", targets: 3 },
            {
                width: "100px",
                targets: 4,
                orderable: false,
                render:function(data, type, row) {
                    const id = row.id; //  l'ID doit être dans la premiére colonne
                    return `<button type="button" class="comment-btn" data-bs-toggle="modal" data-bs-target="#confirmModal" data-bs-id="${id}" >Supprimer</button>`
                }
            },
            { targets: [1], className: 'dt-center' },
            { targets: [2], className: 'dt-center' },
            { targets: [3], className: 'dt-center' },
       ],
       scrollY: true // Active le défilement vertical
    });
    /*
        - Quand on clique sur une ligne, elle devient "sélectionnée" (via la classe CSS 'selected')
        - Si elle était déjà sélectionnée, elle est désélectionnée
        - Toutes les autres lignes sont automatiquement désélectionnées
     */
    $('#TableMemo tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected').siblings().removeClass('selected');
    });
    /*
        1. Est probablement utilisé dans un système de confirmation de suppression de commentaires
        2. Utilise Bootstrap pour la gestion du modal
        3. Capture l'ID du commentaire à supprimer lorsque le modal de confirmation s'ouvre
        4. Stock cet ID pour qu'il puisse être utilisé plus tard (probablement lors de la confirmation de la suppression)
     */
      const ModalConfirme = document.getElementById('confirmModal')
      let commentIdToDelete;
      if (ModalConfirme) {
          ModalConfirme.addEventListener('show.bs.modal', event => {
              // Button that triggered the modal
              const button = event.relatedTarget
              // Extract info from data-bs-* attributes
              const recipient = button.getAttribute('data-bs-id');
              commentIdToDelete = recipient;
          })
      }
   /*
        - Ce code utilise jQuery pour :
        - La gestion des événements
        - Les requêtes AJAX
        - La manipulation de modales Bootstrap
        - Il combine l'API DOM native () avec jQuery `document.getElementById`
        - Il s'agit d'une suppression de commentaires avec confirmation via une modale
    */
   $('#confirmDelete').on('click', function() {
          if (commentIdToDelete) {
              $.ajax({
                  url: 'index.php?action=deleteComment',
                  type: 'POST',
                  data: {id: commentIdToDelete},
                  success: function (response) {
                      var iddata ="#keyid_" + commentIdToDelete;
                      var ligne = document.getElementById(iddata);
                      if (ligne) {
                          // retirer la ligne commentaire du DOM :
                          ligne.remove();
                      } else {
                          console.log("Ligne non trouvée :" + iddata);
                      }
                      $(ModalConfirme).modal('hide');
                  },
                  error: function (xhr, status, error) {
                      console.error('Erreur lors de la suppression :', error);
                  }
              });
          }
      });
// gestion du bouton supprimer article

    /*
        1. Gère l'ouverture d'une modale Bootstrap
        2. Récupère un ID depuis le bouton qui a déclenché la modale
        3. Transmet cet ID à un autre bouton dans la modale (le bouton de confirmation)
        4. cela permettra lors de la requête d'avoir ID correspondant à l'article
     */

    const myModal = document.getElementById('ArticleconfirmModal');
    myModal.addEventListener('show.bs.modal', function (event)
    {
        const button = event.relatedTarget; // Le bouton qui a déclenché la modal
        const newId = button.getAttribute('data-bs-id'); // On récupère la valeur qu'on veut
        //const modalButton = myModal.querySelector('.modal-footer button');
        const modalButton = myModal.querySelector('.modal-footer button');
        $('#confirmDeleteBtn').attr('data-button-id', newId);
    });

    /*
        - Écoute le clic sur un bouton de confirmation de suppression
        - Envoie une requête AJAX pour supprimer un article
        - Ferme la modale de confirmation si la suppression réussit
        - Recharge la page pour montrer les changements
        - Gère les erreurs avec des messages appropriés
        - Autre méthode d'appel AJAX avec FETCH
     */
    document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
        const articleId = this.getAttribute('data-button-id');
        const url = `index.php?action=deleteArticle&id=${articleId}`;

        fetch(url)
            .then(response => {
                if (response.status === 200) {
                    // Ferme la modale
                    const modal = bootstrap.Modal.getInstance(document.getElementById('ArticleconfirmModal'));
                    modal.hide();

                    // Recharge la page après un petit délai
                    setTimeout(() => {
                        location.reload();
                    }, 50);
                } else {
                    alert("Erreur lors de la suppression.");
                }
            })
            .catch(error => {
                console.error("Erreur fetch:", error);
                alert("Erreur réseau.");
            });
    });
});