
new Vue({
    el:"#AppExtension",
    /**
     * Hook
     * */

    //creation de variable
    data(){
        return{

            //creation des variables de la categories
            extensions:[],
            form:{
                fexId:"",
                fexLib:"",
                fexCod:"",
                fexAgence:"",
            },

        }
    },

    //lorsque le DOM est monté
    mounted(){
        this.listerExtensions()

    },


    //permet de creer une liste des fonction
    methods:{

        //lister les categories
        listerExtensions(){
            const self = this;
            fetch('/view_extension_url')
                .then(async function(res) {
                    let json = await res.json();
                    self.extensions = json.extensions;
                    console.log(self.extensions);
                })
        },


        //creation des categories
        creerExtension(){
            const self = this;
            const formData = new FormData();
            formData.append('ext_libelle', this.form.fexLib);
            formData.append('ext_code', this.form.fexCod);
            formData.append('ext_agence_id', this.form.fexAgence);
            if(this.form.fexId !== ''){
                formData.append("ext_id", this.form.fexId);
            }

            fetch('/create_extension_url', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    console.log(JSON.stringify(data))
                    self.viderZoneSaisie();
                    self.listerExtensions();
                })
                .catch(error => {

                    console.log('Error:', error)
                });
        },

//suppression
        deleteExtension(id){
            const self = this;
            const formData = new FormData();
            formData.append('ext_id', id);

            const isConfirm  = confirm("Voulez-vous vraiment supprimer ce role ??");

            if(isConfirm){
                fetch('/delette_extension_url', {
                    method: 'POST',
                    body: formData,
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(JSON.stringify(data))
                        self.listerExtensions();
                    })
                    .catch(error => {
                        console.log('Error:', error)
                    });
            }


        },


        //vider  les zones de categorie

        viderZoneSaisie(){

            this.form.fexId="";
            this.form.fexLib="";
            this.form.fexCod="";
            this.form.fexAgence="";

        },

        //update role
        editerExtension(extensions){
            this.form.fexId=   extensions.ext_id;
            this.form.fexLib=extensions.ext_libelle;
            this.form.fexCod=extensions.ext_code;
            this.form.fexAgence=extensions.ext_agence_id;
        }


    }
})



