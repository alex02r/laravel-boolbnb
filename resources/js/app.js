import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])
import { services } from '@tomtom-international/web-sdk-services';
import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';

//dichiariamo il container dove inserire la searchbox
const div = document.getElementById('search')
//dichiariamo il campo input di address 
const address = document.getElementById('address')
//dichiariamo il button per l'invio della form
const btnAdd = document.getElementById('btnAdd') 

//inseriamo l'api in una variabile
let api = import.meta.env.VITE_TOMTOM_API_KEY;

//inizializiamo la searchbox di tomtom
let options = {
    searchOptions: {
    key: api,
    language: "it-IT",
    limit: 5,
    },
    autocompleteOptions: {
    key: api,
    language: "it-IT",
    },
}
let ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
let searchBoxHTML = ttSearchBox.getSearchBoxHTML();
//facciamo l'append della searchbox al div container
div.append(searchBoxHTML)

//recuperiamo il valore dell'attributo old-value
let old = div.getAttribute('old-value');
//controlliamo se nell'attributo old sia stato inserito il vecchio indirizzo
if (old != "") {
    //assegnamo all'input il valore del vecchio indirizzo
    address.value = ttSearchBox.setValue(old)
}

//al click del pulsante per l'invio dei dati inviamo il valore della searchbox all'input address
btnAdd.addEventListener('click', ()=>{
    address.value = ttSearchBox.getValue()
})


