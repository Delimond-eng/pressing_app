
new Vue({
    el:"#AppPaiement",
    /**
     * Hook
     * */

    //creation de variable
    data(){
        return{

            //creation des variables de la categories
            paiements:[],
            form:{
                fpaieId:"",
                fpaiemont:"",
                fpaiedevise:"",
                fpaieColisId:"",
            },

        }
    },

    //lorsque le DOM est monté
    mounted(){

        this.listerPaiement()
    },


    //permet de creer une liste des fonction
    methods:{

        //lister les agents
        listerPaiement(){
            const self = this;
            fetch('/view_paiement_url')
                .then(async function(res) {
                    let json = await res.json();
                    self.paiements = json.paiements;
                    console.log(self.paiements);
                })
        },

        //creation des agents
        creerPaiement(){
            const self = this;
            const formData = new FormData();
            formData.append('montant', this.form.fpaiemont);
            formData.append('devise', this.form.fpaiedevise);
            formData.append('colis_id', this.form.fpaieColisId);
            if(this.form.fpaieId !== ''){
                formData.append("paie_id", this.form.fpaieId);
            }

            fetch('/create_paiement_url', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    console.log(JSON.stringify(data))
                    self.viderZoneSaisie();
                    self.listerPaiement();
                })
                .catch(error => {

                    console.log('Error:', error)
                });
        },

//suppression
        deletePayement(id){
            const self = this;
            const formData = new FormData();
            formData.append('paie_id', id);

            const isConfirm  = confirm("Voulez-vous vraiment supprimer ce payement ??");
            if(isConfirm){
                fetch('/delete_paiement_url', {
                    method: 'POST',
                    body: formData,
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(JSON.stringify(data))
                        self.listerPaiement();
                    })
                    .catch(error => {
                        console.log('Error:', error)
                    });
            }


        },


        //vider  les zones de categorie

        viderZoneSaisie(){

            this.form.fpaieId="";
            this.form.fpaiemont="";
            this.form.fpaiedevise="";
            this.form.fpaieColisId="";

        },

        //update role
        editerPaiement(paiements){
            this.form.fpaieId= paiements.paie_id;
            this.form.fpaiemont=paiements.paie_montant;
            this.form.fpaiedevise=paiements.paie_montant_devise;
            this.form.fpaieColisId=paiements.paie_colis_id;
        }


    }
})



