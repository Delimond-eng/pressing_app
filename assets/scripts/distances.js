
new Vue({
    el:"#AppDistance",
    /**
     * Hook
     * */

    //creation de variable
    data(){
        return{

            //creation des variables de la distance
            distances:[],
            form:{
                fdistanceId:"",
                fdistancelib:"",
                fdistanceprix:""
            },

        }
    },

    //lorsque le DOM est monté
    mounted(){
        this.listerDistance()
    },


    //permet de creer une liste des fonction
    methods:{

        //lister les distances
        listerDistance(){
            const self = this;
            fetch('/view_distance_url')
                .then(async function(res) {
                    let json = await res.json();
                    self.distances = json.distances;
                })
        },


        //creation des categories
        creerDistances(){
            const self = this;
            const formData = new FormData();
            formData.append('libelle', this.form.fdistancelib);
            formData.append('prix', this.form.fdistanceprix);
            if(this.form.fdistanceId !== ''){
                formData.append("distance_id", this.form.fdistanceId);
            }

            fetch('/create_distance_url', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    console.log(JSON.stringify(data))
                    self.viderZoneSaisie();
                    self.listerDistance();
                })
                .catch(error => {

                    console.log('Error:', error)
                });
        },

//suppression
        deleteDistance(id){
            const self = this;
            const formData = new FormData();
            formData.append('distance_id', id);

            const isConfirm  = confirm("Voulez-vous vraiment supprimer ce role ??");

            if(isConfirm){
                fetch('/delette_distance_url', {
                    method: 'POST',
                    body: formData,
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(JSON.stringify(data))
                        self.listerDistance();
                    })
                    .catch(error => {
                        console.log('Error:', error)
                    });
            }


        },

        //vider  les zones de categorie

        viderZoneSaisie(){

            this.form.fdistanceId="";
            this.form.fdistancelib="";
            this.form.fdistanceprix="";

        },

        //update role
        editerDistance(distances){
            this.form.fdistanceId=   distances.distance_id;
            this.form.fdistancelib=distances.distance_libelle;
            this.form.fdistanceprix=distances.distance_prix_kilo;
        }


    }
})



