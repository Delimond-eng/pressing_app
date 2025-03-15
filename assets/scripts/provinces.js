
new Vue({
    el:"#AppProvince",
    /**
     * Hook
     * */

    //creation de variable
    data(){
        return{

            //creation des variables de la provinces
            provinces:[],
            form:{
                fprovinceId:"",
                fprovinceLib:""

            },

        }
    },

    //lorsque le DOM est monté
    mounted(){
        this.listerProvinces()
    },


    //permet de creer une liste des fonction
    methods:{

        //lister les provinces
        listerProvinces(){
            const self = this;
            fetch('/view_province_url')
                .then(async function(res) {
                    let json = await res.json();
                    self.provinces = json.provinces;
                })
        },


        //creation des provinces
        creerProvinces(){
            const self = this;
            const formData = new FormData();
            formData.append('libelle', this.form.fprovinceLib);
            if(this.form.fprovinceId !== ''){
                formData.append("province_id", this.form.fprovinceId);
            }

            fetch('/create_province_url', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    console.log(JSON.stringify(data))
                    self.viderZoneSaisie();
                    self.listerProvinces();
                })
                .catch(error => {

                    console.log('Error:', error)
                });
        },

//suppression
        deleteProvince(id){
            const self = this;
            const formData = new FormData();
            formData.append('province_id', id);

            const isConfirm  = confirm("Voulez-vous vraiment supprimer cette province ??");

            if(isConfirm){
                fetch('/delette_province_url', {
                    method: 'POST',
                    body: formData,
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(JSON.stringify(data))
                        self.listerProvinces();
                    })
                    .catch(error => {
                        console.log('Error:', error)
                    });
            }


        },


        //vider  les zones de categorie

        viderZoneSaisie(){

            this.form.fprovinceId="";
            this.form.fprovinceLib="";

        },

        //update role
        editerProvince(provinces){
            this.form.fprovinceId= provinces.province_id;
            this.form.fprovinceLib= provinces.province_libelle;
        }


    }
})



{

}