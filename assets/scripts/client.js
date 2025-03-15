new Vue({
    el: "#AppClient",

    data() {
        return {
            clients: [],
            form: {
                fclientid: "",
                fclientnom: "",
                fclientemail: "",
                fclienttel: "",
                fclientadresse: "",
                fclientprovince: "",
                fidentite_type: "",  // Ajout
                fidentite_num: ""    // Ajout
            },
        };
    },

    mounted() {
        this.listerClients();
    },

    methods: {
        // Lister les clients
        listerClients() {
            const self = this;
            fetch("/view_client_url")
                .then(async function (res) {
                    let json = await res.json();
                    self.clients = json.clients;
                    console.log(self.clients);
                });
        },

        // Créer ou modifier un client
        creerClient() {
            const self = this;
            const formData = new FormData();
            formData.append("nom", this.form.fclientnom);
            formData.append("email", this.form.fclientemail);
            formData.append("telephone", this.form.fclienttel);
            formData.append("adresse", this.form.fclientadresse);
            formData.append("province", this.form.fclientprovince);
            formData.append("identite_type", this.form.fidentite_type); // Ajout
            formData.append("identite_num", this.form.fidentite_num);   // Ajout

            if (this.form.fclientid !== "") {
                formData.append("client_id", this.form.fclientid);
            }

            fetch("/create_client_url", {
                method: "POST",
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(JSON.stringify(data));
                    self.viderZoneSaisie();
                    self.listerClients();
                })
                .catch((error) => {
                    console.log("Error:", error);
                });
        },

        // Supprimer un client
        deleteClient(id) {
            const self = this;
            const formData = new FormData();
            formData.append("client_id", id);

            const isConfirm = confirm("Voulez-vous vraiment supprimer ce client ?");

            if (isConfirm) {
                fetch("/delette_client_url", {
                    method: "POST",
                    body: formData,
                })
                    .then((response) => response.json())
                    .then((data) => {
                        console.log(JSON.stringify(data));
                        self.listerClients();
                    })
                    .catch((error) => {
                        console.log("Error:", error);
                    });
            }
        },

        // Vider les champs du formulaire
        viderZoneSaisie() {
            this.form.fclientid = "";
            this.form.fclientnom = "";
            this.form.fclientemail = "";
            this.form.fclienttel = "";
            this.form.fclientadresse = "";
            this.form.fclientprovince = "";
            this.form.fidentite_type = ""; // Ajout
            this.form.fidentite_num = "";  // Ajout
        },

        // Éditer un client (pré-remplissage du formulaire)
        editerClient(client) {
            this.form.fclientid = client.client_id;
            this.form.fclientnom = client.client_nom_complet;
            this.form.fclientemail = client.client_email;
            this.form.fclienttel = client.client_tel;
            this.form.fclientadresse = client.client_adresse;
            this.form.fclientprovince = client.client_province_id;
            this.form.fidentite_type = client.client_identite_piece_type; // Ajout
            this.form.fidentite_num = client.client_identite_piece_num;   // Ajout
        }
    }
});
