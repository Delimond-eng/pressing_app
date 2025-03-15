new Vue({
  el: "#AppLivraison",

  data() {
    return {
      livraisons: [],
      colis: phpData,
      selectedColis: null,
      searchColis: "",
      form: {
        flivId: "",
        flivDest: "",
        flivDestTel: "",
        flivPiecTyp: "",
        flivPieceNum: "",
        flivObs: "",
        fliColis: "",
      },
    };
  },

  mounted() {
    const self = this;

    this.listerLivraisons();
    document.addEventListener("DOMContentLoaded", function (e) {
      if (self.colis.length > 0) {
        $("#modalShowColis").modal("show");
      }
    });
  },

  methods: {
    selectColis(data) {
      this.selectedColis = data;
      this.form.fliColis = data.colis_id;
    },
    // Lister les clients
    listerLivraisons() {
      const self = this;
      fetch("/view_livraison_url").then(async function (res) {
        let json = await res.json();
        self.livraisons = json.livraisons;
        console.log(self.livraisons);
      });
    },

    // Créer ou modifier un client
    creerLivraisons() {
      const self = this;
      const formData = new FormData();
      formData.append("destinataire", this.form.flivDest);
      formData.append("destinataire_tel", this.form.flivDestTel);
      formData.append("piece_type", this.form.flivPiecTyp);
      formData.append("piece_num", this.form.flivPieceNum);
      formData.append("obs", this.form.flivObs);
      formData.append("colis_id", this.form.fliColis);

      if (this.form.flivId !== "") {
        formData.append("livraison_id", this.form.flivId);
      }

      fetch("/create_livraison_url", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          console.log("Response data:", data); // Log de la réponse
          if (data.status === "success") {
            self.viderZoneSaisie();
            self.listerLivraisons();
            $("#modalShowColis").modal("show");
          } else {
            console.log("Erreur:", data.message);
          }
        })
        .catch((error) => {
          console.log("Error:", error);
        });
    },

    // Supprimer un client
    deleteLivraison(id) {
      const self = this;
      const formData = new FormData();
      formData.append("livraison_id", id);

      const isConfirm = confirm("Voulez-vous vraiment supprimer ce client ?");

      if (isConfirm) {
        fetch("/delete_livraison_url", {
          method: "POST",
          body: formData,
        })
          .then((response) => response.json())
          .then((data) => {
            console.log(JSON.stringify(data));
            self.listerLivraisons();
          })
          .catch((error) => {
            console.log("Error:", error);
          });
      }
    },

    // Vider les champs du formulaire
    viderZoneSaisie() {
      this.form.flivId = "";
      this.form.flivDest = "";
      this.form.flivDestTel = "";
      this.form.flivPiecTyp = "";
      this.form.flivPieceNum = "";
      this.form.flivObs = "";
      this.form.fliColis = "";
      $("#modalCreateLivraison").modal("hide");
    },

    // Éditer un client (pré-remplissage du formulaire)
    editerClient(livraisons) {
      this.form.flivId = livraisons.livraison_id;
      this.form.flivDest = livraisons.livraison_destinataire_nom;
      this.form.flivDestTel = livraisons.livraison_destinataire_tel;
      this.form.flivPiecTyp =
        livraisons.livraison_destinataire_identite_piece_type;
      this.form.flivPieceNum =
        livraisons.livraison_destinataire_identite_piece_num;
      this.form.flivObs = livraisons.livraison_obs;
      this.form.fliColis = livraisons.livraison_colis_id;
    },
  },

  computed: {
    pendingColis() {
      if (this.searchColis) {
        return this.colis.filter((el) =>
          el.colis_code
            .toLocaleLowerCase()
            .includes(this.searchColis.toLocaleLowerCase())
        );
      } else {
        return this.colis;
      }
    },
  },
});
