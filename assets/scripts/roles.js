
new Vue({
    el:"#AppRole",
    /**
     * Hook
     * */

    //creation de variable
    data(){
        return{

            //creation des variables de la categories
            roles:[],
            form:{
                frole:"",
                froleid:""
            },

        }
    },

    //lorsque le DOM est monté
    mounted(){
        this.listerRoles()
    },


    //permet de creer une liste des fonction
    methods:{

        //lister les categories
        listerRoles(){
            const self = this;
            fetch('/view_role_url')
                .then(async function(res) {
                    let json = await res.json();
                    self.roles = json.roles;
                })
        },


        //creation des categories
        creerRoles(){
            const self = this;
            const formData = new FormData();
            formData.append('libelle', this.form.frole);
            if(this.form.froleid !== ''){
                formData.append("role_id", this.form.froleid);
            }

            fetch('/create_role_url', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    console.log(JSON.stringify(data))
                    self.viderZoneSaisie();
                    self.listerRoles();
                })
                .catch(error => {

                    console.log('Error:', error)
                });
        },

//suppression
        deleteRole(id){
            const self = this;
            const formData = new FormData();
            formData.append('role_id', id);

            const isConfirm  = confirm("Voulez-vous vraiment supprimer ce role ??");

            if(isConfirm){
                fetch('/delette_role_url', {
                    method: 'POST',
                    body: formData,
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(JSON.stringify(data))
                        self.listerRoles();
                    })
                    .catch(error => {
                        console.log('Error:', error)
                    });
            }


        },


        //vider  les zones de categorie

        viderZoneSaisie(){

            this.form.frole="";
            this.form.froleid="";

        },

        //update role
        editerRole(roles){
            this.form.frole=   roles.role_libelle;
            this.form.froleid=roles.role_id;
        }


    }
})



{

}