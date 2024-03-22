import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import axios from 'axios';
import.meta.glob([
    '../img/**'
])

// città
const city_input = document.getElementById('city')
let city = city_input.value
axios.get(`${process.env.TOMTOM_BASE_URL}/search/2/geocode/${city}.json?key=${process.env.TOMTOM_API_KEY}&language=it-IT`).then(response =>{
    
    const lat = response.data.results.position.lat

    const lon = response.data.results.position.lon
})


//prendiamo tramite id il campo input dove inseriamo l'address
const address = document.getElementById('address')
//inseriamo il contenuto in una variabile
let query = address.value;
//controlliamo quando viene inserita una lettera nel campo address
address.addEventListener("keyup", function(){
    alert(query);
    //eseguiamo una chiamata API per avere un autocomplete
    axios.get(`${process.env.TOMTOM_BASE_URL}/search/2/search/${query}.json?key=${process.env.TOMTOM_API_KEY}&language=it-IT&lat=${lat}&lon=${lon}`).then(response =>{
        
    })
})
