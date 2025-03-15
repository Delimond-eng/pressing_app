new Vue({
    el: "#AppReclamation",

    data() {
        return {
            reclamations: [],
            form: {
                freclamId: "",
                freclamMotif: "",
                freclamColis: "",
                freclamExp: "",

            },
        };
    },

    mounted() {
        this.listerReclamation();
    },

    methods: {
        // Lister les clients
        listerReclamation() {
            const self = this;
            fetch("/view_reclamation_url")
                .then(async function (res) {
                    let json = await res.json();
                    self.reclamations = json.reclamations;
                    console.log(self.reclamations);
                });
        },

        // Créer ou modifier un client
        creerReclamation() {
            const self = this;
            const formData = new FormData();
            formData.append("reclam_motif", this.form.freclamMotif);
            formData.append("reclam_colis_id", this.form.freclamColis);
            formData.append("reclam_exp_id", this.form.freclamExp);

            if (this.form.freclamId !== "") {
                formData.append("reclam_id", this.form.freclamId);
            }

            fetch("/create_reclamation_url", {
                method: "POST",
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log("Réponse du serveur :", data);
                    if (data.status === "success") {
                        self.viderZoneSaisie();
                        self.listerReclamation();
                    } else {
                        alert("Erreur : " + data.message);
                    }
                })
                .catch((error) => {
                    console.log("Erreur :", error);
                });
        },


        // Supprimer un client
        deleteReclamation(id) {
            const self = this;
            const formData = new FormData();
            formData.append("reclam_id", id);

            const isConfirm = confirm("Voulez-vous vraiment supprimer ce client ?");

            if (isConfirm) {
                fetch("/delete_reclamation_url", {
                    method: "POST",
                    body: formData,
                })
                    .then((response) => response.json())
                    .then((data) => {
                        console.log(JSON.stringify(data));
                        self.listerReclamation();
                    })
                    .catch((error) => {
                        console.log("Error:", error);
                    });
            }
        },

        // Vider les champs du formulaire
        viderZoneSaisie() {
            this.form.freclamId = "";
            this.form.freclamMotif = "";
            this.form.freclamColis = "";
            this.form.freclamExp = "";
        },

        // Éditer un client (pré-remplissage du formulaire)
        editerReclamations(reclamations) {
            this.form.freclamId = reclamations.reclam_id;
            this.form.freclamMotif = reclamations.reclam_motif;
            this.form.freclamColis = reclamations.reclam_colis_id;
            this.form.freclamExp = reclamations.reclam_exp_id;

        }
    }
});
