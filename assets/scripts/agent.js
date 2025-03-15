
new Vue({
    el:"#AppAgent",
    /**
     * Hook
     * */

    //creation de variable
    data(){
        return{

            //creation des variables de la categories
            agents:[],
            form:{
                fagntId:"",
                fagntNom:"",
                fagntEmail:"",
                fagntTel:"",
                fagntAdresse:"",
                fagntDateEng:"",
                fagntProvince:"",
                fagntAgence:"",
                fagntExtension:"",
            },

        }
    },

    //lorsque le DOM est monté
    mounted(){
        this.listerAgent()
    },


    //permet de creer une liste des fonction
    methods:{

        //lister les agents
        listerAgent(){
            const self = this;
            fetch('/view_agent_url')
                .then(async function(res) {
                    let json = await res.json();
                    self.agents = json.agents;
                    console.log(self.agents);
                })
        },


        //creation des agents
        creerAgent(){
            const self = this;
            const formData = new FormData();
            formData.append('nom', this.form.fagntNom);
            formData.append('email', this.form.fagntEmail);
            formData.append('tel', this.form.fagntTel);
            formData.append('adresse', this.form.fagntAdresse);
            formData.append('dateEng', this.form.fagntDateEng);
            formData.append('province', this.form.fagntProvince);
            formData.append('agence', this.form.fagntAgence);
            formData.append('extension', this.form.fagntExtension);
            if(this.form.fagntId !== ''){
                formData.append("agent_id", this.form.fagntId);
            }

            fetch('/create_agent_url', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    console.log(JSON.stringify(data))
                    self.viderZoneSaisie();
                    self.listerAgent();
                })
                .catch(error => {

                    console.log('Error:', error)
                });
        },

//suppression
        deleteAgent(id){
            const self = this;
            const formData = new FormData();
            formData.append('agent_id', id);

            const isConfirm  = confirm("Voulez-vous vraiment supprimer cet agents ??");
            if(isConfirm){
                fetch('/delette_agent_url', {
                    method: 'POST',
                    body: formData,
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(JSON.stringify(data))
                        self.listerAgent();
                    })
                    .catch(error => {
                        console.log('Error:', error)
                    });
            }


        },


        //vider  les zones de categorie

        viderZoneSaisie(){

            this.form.fagntId="";
            this.form.fagntNom="";
            this.form.fagntEmail="";
            this.form.fagntTel="";
            this.form.fagntAdresse="";
            this.form.fagntDateEng="";
            this.form.fagntProvince="";
            this.form.fagntAgence="";
            this.form.fagntExtension="";


        },

        //update role
        editerAgent(agent){
            this.form.fagntId=   agent.agent_id;
            this.form.fagntNom=agent.agent_nom;
            this.form.fagntEmail=agent.agent_email;
            this.form.fagntTel=agent.agent_tel;
            this.form.fagntAdresse=agent.agent_adresse;
            this.form.fagntDateEng=agent.agent_date_eng;
            this.form.fagntProvince=agent.agent_province_id;
            this.form.fagntAgence=agent.agent_agence_id;
            this.form.fagntExtension=agent.agent_extension_id;
        }


    }
})



