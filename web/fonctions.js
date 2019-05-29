function effa() {
    Swal.fire({
        title: 'Êtes - vous sûr ?',
        text: "Vous ne pourrez plus récupérer votre compte !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5bc0de',
        cancelButtonColor: '#f26419',
        confirmButtonText: 'Supprimer !',
        cancelButtonText: 'Annuler',
    }).then((result) => {
        if (result.value) {
            Swal.fire({
                title: 'Votre compte a été supprimé.',
                html:
                '<img style="width: 200px" src="assets/img/gif/sad.gif">',
                confirmButtonText: 'Adieu..',
            }).then(function () {
                setTimeout("location.href = 'effacercompte.php';");
            })
        }
    })
}
function ajout() {
    Swal.fire({
        position: 'top-end',
        type: 'success',
        title: 'Enregistrer dans la Base de Données !',
        showConfirmButton: false,
        timer: 1500
    })

}

function rechercher() {
    Swal.fire({
        title: "Rentrez le nom d'un artiste",
        html:
            '<img style="width: 200px; padding: 15px" src="assets/img/gif/bongo.gif">'
            +'<form action="recherche.php" method="get">'
            +'<input name="r" type="text" placeholder="Rechercher" style="width: 80%"/>'
            +'<input style="margin: 15px" type="submit" value="Rechercher"/> </form>',
        showCancelButton: false,
        showConfirmButton: false,
    })

}