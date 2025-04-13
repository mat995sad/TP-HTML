let j = 1;
let i = 0;
let secret;
let couleur = ["r", "b", "j", "v"];
let ms = 500;
new Audio().const
let audio1 = new Audio("Bon.mp3");
let audio2 = new Audio("Erreur.mp3");
let multiple = 1;
let score = 0;
let seconde = 0;
let bool = true;
let minute = 0;
let heure = 0;


function Rouge() {
    if (i == -1) {
        console.log("tu as perdu relance, change de difficulté ou quitte")
    } else if (secret[i] != "r") {
        fail();
    } else {
        pass()
    }
}

function Bleu() {
    if (i == -1) {
        console.log("tu as perdu relance, change de difficulté ou quitte")
    } else if (secret[i] != "b") {
        fail();
    } else {
        pass()
    }
}

function Vert() {
    if (i == -1) {
        console.log("tu as perdu relance, change de difficulté ou quitte")
    } else if (secret[i] != "v") {
        fail();
    } else {
        pass()
    }
}

function Jaune() {
    if (i == -1) {
        console.log("tu as perdu relance, change de difficulté ou quitte")
    } else if (secret[i] != "j") {
        fail();
    } else {
        pass()
    }
}

function pass() {
    console.log(i)
    i = i + 1;
    score = score + 1 * multiple;

    verifier_sequence()
}

document.querySelectorAll(".items").forEach(item => {
    item.addEventListener("click", function() {
        // Ajoute la classe 'clicked' pour déclencher l'animation
        this.classList.add("clicked");

        // Réinitialise l'animation après 300ms
        setTimeout(() => {
            this.classList.remove("clicked"); // Retire la classe 'clicked'
        }, 200); // Délai de 300ms (la durée de l'animation)
    });
});

function fail() {
    i = -1;
    j = 1;
    ms = 500;
    multiple = 1;
    document.getElementById("c1").checked = "true"
    audio2.play();
    window.alert("perdu clique sur le bouton quitter ou relance une séquence");
    window.alert(score);
    score = 0;

}

function choix_séquence() {
    i = 0;
    x = 1;
    document.querySelectorAll(".items").forEach(function(item) {
        item.disabled = true;
    });
    secret = [couleur[Math.floor(Math.random() * 4)]];
    while (x < j) {
        let test = Math.floor(Math.random() * 4);
        secret[x] = couleur[test];
        x = x + 1;
    }
    console.log(secret);

    document.getElementById("start").textContent = "press to replay sequence";
    affichagesequence()
    document.querySelectorAll(".items").forEach(function(item) {
        item.disabled = false;
    });


}

async function affichagesequence() {
    console.log("df");
    for (let k = 0; k < j; k++) {
        if (secret[k] == "r") {
            document.getElementById("red").style.background = "white";
            await sleep(ms);
            document.getElementById("red").style.background = "red";
            console.log("rouge");

        } else if (secret[k] == "b") {
            document.getElementById("bleu").style.background = "white";
            await sleep(ms);
            document.getElementById("bleu").style.background = "blue";
            console.log("bleu");

        } else if (secret[k] == "j") {
            document.getElementById("jaune").style.background = "white";
            await sleep(ms);
            document.getElementById("jaune").style.background = "yellow";
            console.log("jaune");
        } else if (secret[k] == "v") {
            document.getElementById("vert").style.background = "white";
            await sleep(ms);
            document.getElementById("vert").style.background = "green";
            console.log("vert");

        }
        await sleep(ms + 50);
    }
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms))
}


async function verifier_sequence() {
    if (i >= j) {
        console.log("Brovo tu a réussi nouvelles séquence")
        audio1.play();
        j++;
        i = 0;
        await sleep(1000);
        choix_séquence();
    }
}


function modifier_difficulte() {
    if (this.value == "1") {
        ms = 500;
        multiple = 1;
        i = -1;
        j = 1
    } else if (this.value == "2") {
        ms = 400;
        multiple = 2;
        i = -1;
        j = 1
    } else {
        ms = 250;
        multiple = 3;
        i = -1;
        j = 1
    }
}

document.getElementById("c1").checked = "true"

function azer() {
    let tousLesChoix = document.querySelectorAll('input[name="choix"]');
    for (y = 0; y < tousLesChoix.length; y++) {
        tousLesChoix[y].addEventListener("input", modifier_difficulte);

    }
}

function qwer() {
    let mot_passe = document.querySelectorAll(".password");
    for (p = 0; p < mot_passe.length; p++) {
        mot_passe[p].addEventListener("input", afficherpassword);

    }
}

function afficherpassword1() {
    let passwordInput = document.getElementById("password1");
    if (passwordInput.type == "password") {
        passwordInput.type = "text"; // Révéler le mot de passe
    } else {
        passwordInput.type = "password"; // Cacher le mot de passe
    }
}

function afficherpassword2() {
    let passwordInput = document.getElementById("password2");
    if (passwordInput.type == "password") {
        passwordInput.type = "text"; // Révéler le mot de passe
    } else {
        passwordInput.type = "password"; // Cacher le mot de passe
    }
}

function timer() {

    if (seconde < 60) {
        seconde++;
        document.getElementById("chrono").textContent = heure + ":" + minute + ":" + seconde;
    } else if (seconde == 60 && minute < 60) {
        minute++;
        seonde = 0;
        document.getElementById("chrono").textContent = heure + ":" + minute + ":" + seconde;
    } else {
        heure++;
        minute = 0;
        seconde = 0;
        document.getElementById("chrono").textContent = heure + ":" + minute + ":" + seconde;
    }
}

setInterval(timer(), 1000)

let playlist = ["chill.mp3", "projet.mp3"]; // Liste des musiques
let currentTrack = 0;
let audio3 = document.getElementById("background-music");
let button = document.querySelector(".music-button");

function toggleMusic() {
    if (audio3.paused) {
        audio3.play();
        button.textContent = "⏸️ Pause musique";
    } else {
        audio3.pause();
        button.textContent = "🎵 Activer la musique";
    }
}

function playNextTrack() {
    currentTrack = (currentTrack + 1) % playlist.length; // Passe au suivant
    audio3.src = playlist[currentTrack]; // Change la source
    audio3.play(); // Joue la nouvelle musique
}

// Démarrer la première musique
audio3.src = playlist[currentTrack];
audio3.play();
audio3.addEventListener("ended", playNextTrack);


let volumeControl1 = document.getElementById("volume-control1");
let volumeControl2 = document.getElementById("volume-control2");

volumeControl2.addEventListener("input", function() {
    audio3.volume = this.value; // Met à jour le volume
});

volumeControl1.addEventListener("input", function() {
    audio1.volume = this.value; // Met à jour le volume
    audio2.volume = this.value;
});

//test