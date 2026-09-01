<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Formulaire de candidature</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f2f2f2;
      padding: 30px;
    }

    .container {
      max-width: 500px;
      margin: auto;
      background: white;
      padding: 25px;
      border-radius: 10px;
    }

    h1 {
      text-align: center;
    }

    label {
      display: block;
      margin-top: 15px;
      margin-bottom: 5px;
    }

    input,
    select {
      width: 100%;
      padding: 10px;
      box-sizing: border-box;
    }

    button {
      width: 100%;
      margin-top: 20px;
      padding: 12px;
      cursor: pointer;
    }

    .success {
      margin-top: 20px;
      padding: 10px;
      background: #d4edda;
      color: #155724;
      display: none;
    }
  </style>
</head>

<body>

<div class="container">

  <h1>Formulaire de candidature</h1>

  <form id="formulaire">

    <label for="nom">Nom :</label>
    <input
      type="text"
      id="nom"
      placeholder="Entrez votre nom"
      required
    >

    <label for="prenom">Prénom :</label>
    <input
      type="text"
      id="prenom"
      placeholder="Entrez votre prénom"
      required
    >

    <label for="pays">Choisissez votre pays :</label>

    <select id="pays" required>
      <option value="">-- Choisir un pays --</option>
      <option value="Burundi">Burundi</option>
      <option value="Rwanda">Rwanda</option>
      <option value="France">France</option>
      <option value="Canada">Canada</option>
    </select>

    <label for="universite">Choisissez une université :</label>

    <select id="universite" required>
      <option value="">-- Choisir une université --</option>
    </select>

    <button type="submit">
      Envoyer la candidature
    </button>

  </form>

  <div id="message" class="success"></div>

</div>

<script>

const universites = {

  "Burundi": [
    "Université du Burundi",
    "Université Lumière de Bujumbura",
    "Université du Lac Tanganyika",
    "Université Espoir d'Afrique",
    "Université de Ngozi",
    "Université de Gitega",
    "Université du Grand Lac",
    "Université Martin Luther King",
    "Université Sagesse d'Afrique",
    "Université de Mwaro",
    "Université Polytechnique de Gitega",
    "Université de Kiriri",
    "Université Shalom de Bujumbura",
    "Université de Bujumbura",
    "Université du Paysan",
    "Université des Grands Lacs du Burundi",
    "Université du Sud",
    "Université des Martyrs",
    "Université Lumière de Ngozi",
    "Université de Muyinga"
  ],

  "Rwanda": [
    "University of Rwanda",
    "Kigali Independent University",
    "University of Kigali",
    "Adventist University of Central Africa",
    "Mount Kigali University",
    "Rwanda Polytechnic",
    "African Leadership University Rwanda",
    "INES Ruhengeri",
    "Catholic University of Rwanda",
    "Protestant Institute of Arts and Social Sciences",
    "University of Lay Adventists of Kigali",
    "Kepler",
    "Adventist University of Rwanda",
    "East African University Rwanda",
    "Carnegie Mellon University Africa",
    "African Institute for Mathematical Sciences",
    "University of Global Health Equity",
    "Kigali Health Institute",
    "Rwanda Institute for Conservation Agriculture",
    "University of Tourism, Technology and Business Studies"
  ],

  "France": [
    "Sorbonne Université",
    "Université Paris Cité",
    "Université Paris-Saclay",
    "Université Paris 1 Panthéon-Sorbonne",
    "Université Paris-Panthéon-Assas",
    "Université de Strasbourg",
    "Université de Lyon",
    "Université de Bordeaux",
    "Université de Lille",
    "Université de Nantes",
    "Université de Montpellier",
    "Université de Rennes",
    "Université de Toulouse",
    "Université de Grenoble Alpes",
    "Université de Lorraine",
    "Université de Caen Normandie",
    "Université de Rouen Normandie",
    "Université de Nice Côte d'Azur",
    "Université de Tours",
    "Université de Poitiers"
  ],

  "Canada": [
    "Université de Montréal",
    "Université Laval",
    "Université de Sherbrooke",
    "Université du Québec à Montréal",
    "Université du Québec à Trois-Rivières",
    "Université du Québec en Outaouais",
    "Université du Québec à Chicoutimi",
    "Université d'Ottawa",
    "Université de Toronto",
    "Université McGill",
    "Université de Waterloo",
    "Université Western",
    "Université Queen's",
    "Université de Calgary",
    "Université de l'Alberta",
    "Université de la Colombie-Britannique",
    "Université du Manitoba",
    "Université Dalhousie",
    "Université de Victoria",
    "Université Concordia"
  ]

};


// Quand on choisit un pays
document.getElementById("pays").addEventListener("change", function() {

  const pays = this.value;
  const selectUniversite = document.getElementById("universite");

  selectUniversite.innerHTML =
    '<option value="">-- Choisir une université --</option>';

  if (pays !== "" && universites[pays]) {

    universites[pays].forEach(function(universite) {

      const option = document.createElement("option");

      option.value = universite;
      option.textContent = universite;

      selectUniversite.appendChild(option);

    });
  }

});


// Envoyer le formulaire
document.getElementById("formulaire").addEventListener("submit", function(e) {

  e.preventDefault();

  const nom = document.getElementById("nom").value;
  const prenom = document.getElementById("prenom").value;
  const pays = document.getElementById("pays").value;
  const universite = document.getElementById("universite").value;

  if (nom === "" || prenom === "" || pays === "" || universite === "") {
    alert("Veuillez remplir tous les champs.");
    return;
  }

  google.script.run
    .withSuccessHandler(function(message) {

      document.getElementById("message").textContent = message;
      document.getElementById("message").style.display = "block";

      document.getElementById("formulaire").reset();

      document.getElementById("universite").innerHTML =
        '<option value="">-- Choisir une université --</option>';

    })
    .withFailureHandler(function(erreur) {

      alert("Erreur : " + erreur.message);

    })
    .enregistrerCandidature(
      nom,
      prenom,
      pays,
      universite
    );

});

</script>

</body>
</html>
