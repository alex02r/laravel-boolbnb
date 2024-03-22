import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import axios from 'axios';
import.meta.glob([
    '../img/**'
])

//prendiamo tramite id il campo input dove inseriamo l'address
const address = document.getElementById('address')
//inseriamo il contenuto in una variabile
let query = address.value;
//controlliamo quando viene inserita una lettera nel campo address
address.addEventListener("keyup", function(){
    alert(query);
    //eseguiamo una chiamata API per avere un autocomplete
    axios.get(`${process.env.TOMTOM_BASE_URL}//search/2/autocomplete/${query}.json?key=${process.env.TOMTOM_API_KEY}&language=it-IT`).then(response =>{
        
    })
})
