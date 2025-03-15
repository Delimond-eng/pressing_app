
new Vue({
    el:"#AppUser",
    /**
     * Hook
     * */

    //creation de variable
    data(){
        return{
            //creation des variables de l'utilisateurs
            users:[],
            form:{
                fagent_id:"",
                fpassword:"",
                femail:"",
                frole_id:"",
                fusid:""
            },


        }
    },

    //lorsque le DOM est monté
    mounted(){
       this.listerUsers()

    },


    //permet de creer une liste des fonction
    methods:{


        //lister les utilisateurs
        listerUsers(){
            const self = this;
            fetch('/view_users_url')
                .then(async function(res) {
                    let json = await res.json();
                    self.users = json.users;
                })
        },


        //creation des utilisateurs
        creerUsers() {
            const self = this;
            const formData = new FormData();
            formData.append('agent_id', this.form.fagent_id);
            formData.append('email', this.form.femail);
            formData.append('role_id', this.form.frole_id);

            if (this.form.fusid !== '') {
                formData.append("user_id", this.form.fusid);
                // On n'envoie pas le mot de passe si c'est une modification
                if (this.form.fpassword !== "**********" && this.form.fpassword !== "") {
                    formData.append('password', this.form.fpassword);
                }
            } else {
                formData.append('password', this.form.fpassword); // Obligatoire en création
            }

            fetch('/create_users_url', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    console.log(JSON.stringify(data));
                    self.viderZoneSaisie();
                    self.listerUsers();
                })
                .catch(error => {
                    console.log('Error:', error);
                });
        },




        //vider  les zones de saisie user

        viderZoneSaisie(){

            this.form.fagent_id="";
            this.form.fpassword="";
            this.form.femail="";
            this.form.frole_id="";
            this.form.fusid = "";
        },


        //suppression
        deleteUse(id){
            const self = this;
            const formData = new FormData();
            formData.append('user_id', id);

            const isConfirm  = confirm("Voulez-vous vraiment supprimer cet utilisateur ??");

            if(isConfirm){
                fetch('/delette_users_url', {
                    method: 'POST',
                    body: formData,
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(JSON.stringify(data))
                        self.listerUsers();
                    })
                    .catch(error => {
                        console.log('Error:', error)
                    });
            }


        },


        //update user
        editerUser(user){

            console.log(JSON.stringify(user))
            this.form.fagent_id = user.agent_id;
            this.form.fpassword = "**********"; // Indique que le mot de passe n'est pas modifié
            this.form.femail = user.user_email;
            this.form.frole_id = user.role_id;
            this.form.fusid = user.user_id;
        }


    }
})



{

}