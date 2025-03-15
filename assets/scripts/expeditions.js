new Vue({
    el: "#AppExpedition",

    data() {
        return {
            expeditions: [],
            form: {
                fexpedId: "",
                fexpedExtID: "",
                fexpDest: "",
                fexpDestTel: "",
                fexpColisId: "",
            },
        };
    },

    mounted() {
        this.listerexpedition();
    },

    methods: {
        // Lister les clients
        listerexpedition() {
            const self = this;
            fetch("/view_expedition_url")
                .then(async function (res) {
                    let json = await res.json();
                    self.expeditions = json.expeditions;
                    console.log(self.expeditions);
                });
        },

        // Créer ou modifier un client
        creerExpeditions() {
            const self = this;
            const formData = new FormData();
            formData.append("ext_id", this.form.fexpedExtID);
            formData.append("destinataire", this.form.fexpDest);
            formData.append("destinataire_tel", this.form.fexpDestTel);
            formData.append("colis_id", this.form.fexpColisId);

            if (this.form.fexpedId !== "") {
                formData.append("exp_id", this.form.fexpedId);
            }

            fetch("/create_expedition_url", {
                method: "POST",
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(JSON.stringify(data));
                    self.viderZoneSaisie();
                    self.listerexpedition();
                })
                .catch((error) => {
                    console.log("Error:", error);
                });
        },


        // Supprimer un client
        deleteExpedition(id) {
            const self = this;
            const formData = new FormData();
            formData.append("exp_id", id);

            const isConfirm = confirm("Voulez-vous vraiment supprimer ce client ?");

            if (isConfirm) {
                fetch("/delete_expedition_url", {
                    method: "POST",
                    body: formData,
                })
                    .then((response) => response.json())
                    .then((data) => {
                        console.log(JSON.stringify(data));
                        self.listerexpedition();
                    })
                    .catch((error) => {
                        console.log("Error:", error);
                    });
            }
        },

        // Vider les champs du formulaire
        viderZoneSaisie() {
            this.form.fexpedId = "";
            this.form.fexpedExtID = "";
            this.form.fexpDest = "";
            this.form.fexpDestTel = "";
            this.form.fexpColisId = "";

        },


        // Éditer un client (pré-remplissage du formulaire)
        editerClient(expeditions) {
            this.form.fexpedId = expeditions.exp_id;
            this.form.fexpedExtID = expeditions.exp_ext_id;
            this.form.fexpDest = expeditions.exp_destinataire_nom;
            this.form.fexpDestTel = expeditions.exp_destinataire_tel;
            this.form.fexpColisId = expeditions.exp_colis_id;

        }
    }
});
