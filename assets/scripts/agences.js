
new Vue({
    el:"#AppAgence",
    /**
     * Hook
     * */

    //creation de variable
    data(){
        return{

            //creation des variables de la categories
            agences:[],
            form:{
                fagnceId:"",
                fagenceLIb:"",
                fagenceProv:"",
                fagenceAdr:"",
                fagenceEmail:"",
                fagenceTel:""
            },

        }
    },

    //lorsque le DOM est monté
    mounted(){
        this.listerAgences()
    },


    //permet de creer une liste des fonction
    methods:{

        //lister les agences
        listerAgences(){
            const self = this;
            fetch('/view_agence_url')
                .then(async function(res) {
                    let json = await res.json();
                    self.agences = json.agences;
                    console.log(self.agences);
                })
        },

        //creation des agences
        creerAgence(){
            const self = this;
            const formData = new FormData();
            formData.append('libelle', this.form.fagenceLIb);
            formData.append('province', this.form.fagenceProv);
            formData.append('adresse', this.form.fagenceAdr);
            formData.append('email', this.form.fagenceEmail);
            formData.append('telephone', this.form.fagenceTel);
            if(this.form.fagnceId !== ''){
                formData.append("agence_id", this.form.fagnceId);
            }

            fetch('/create_agence_url', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    console.log(JSON.stringify(data))
                    self.viderZoneSaisie();
                    self.listerAgences();
                })
                .catch(error => {

                    console.log('Error:', error)
                });
        },

//suppression
        deleteAgence(id){
            const self = this;
            const formData = new FormData();
            formData.append('agence_id', id);

            const isConfirm  = confirm("Voulez-vous vraiment supprimer ce role ??");

            if(isConfirm){
                fetch('/delette_agence_url', {
                    method: 'POST',
                    body: formData,
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(JSON.stringify(data))
                        self.listerAgences();
                    })
                    .catch(error => {
                        console.log('Error:', error)
                    });
            }


        },


        //vider  les zones de categorie

        viderZoneSaisie(){

            this.form.fagnceId="";
            this.form.fagenceLIb="";
            this.form.fagenceProv="";
            this.form.fagenceAdr="";
            this.form.fagenceEmail="";
            this.form.fagenceTel="";


        },

        //update role
        editerAgence(agences){
            this.form.fagnceId=   agences.agence_id;
            this.form.fagenceLIb=agences.agence_libelle;
            this.form.fagenceProv=agences.agence_province_id;
            this.form.fagenceAdr=agences.agence_adresse;
            this.form.fagenceEmail=agences.agence_email;
            this.form.fagenceTel=agences.agence_telephone;
        }


    }
})



{

}