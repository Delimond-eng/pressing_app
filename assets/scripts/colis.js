new Vue({
    el: "#AppColis",

    data() {
        return {
            colis:[],
            form: {
                colisId:"",
                poids: "",
                valeur: "",
                description: "",
                client_id: "",
                distance_id: "",
                montant: "",  // Montant du paiement
                devise: ""    // Devise du paiement
            }
        }
    },

    //lorsque le DOM est monté
    mounted(){
        this.listerColis()
    },


    //permet de creer une liste des colis
    methods:{

        //lister les agents
        listerColis(){
            const self = this;
            fetch('/view_colis_url')
                .then(async function(res) {
                    let json = await res.json();
                    self.colis = json.colis;
                    console.log(self.colis);
                })
        },

        // Ajouter un colis avec paiement
        creerColis() {
            const formData = new FormData();
            formData.append("poids", this.form.poids);
            formData.append("valeur", this.form.valeur);
            formData.append("description", this.form.description);
            formData.append("client_id", this.form.client_id);
            formData.append("distance_id", this.form.distance_id);

            // Création de l'objet paiement et conversion en JSON
            const self = this;
            const paiement = {
                montant: this.form.montant,
                devise: this.form.devise
            };
            formData.append("paie", JSON.stringify(paiement)); // Correction ici

            fetch('/create_colis_url', {
                method: "POST",
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    console.log("Réponse serveur :", data);
                    self.viderZoneSaisie();
                    self.listerColis();
                })
                .catch(error => {

                    console.log('Error:', error)
                });
        },

        //suppression
        deleteColis(id){
            const self = this;
            const formData = new FormData();
            formData.append('colis_id', id);

            const isConfirm  = confirm("Voulez-vous vraiment supprimer ce colis ??");

            if(isConfirm){
                fetch('/delete_colis_url', {
                    method: 'POST',
                    body: formData,
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(JSON.stringify(data))
                        self.listerColis();
                    })
                    .catch(error => {
                        console.log('Error:', error)
                    });
            }


        },


        // Vider le formulaire après l'enregistrement
        viderZoneSaisie() {
            this.form = {
                poids: "",
                valeur: "",
                description: "",
                client_id: "",
                distance_id: "",
                montant: "",
                devise: ""
            };
        }
    }
})
