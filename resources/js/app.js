import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])
import { services } from '@tomtom-international/web-sdk-services';
import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';

//prendiamo il container dove inserire la searchbox
const div = document.getElementById('search')

//inseriamo l'api in una variabile
let api = "hr4ctYlqY1McGvola1seXuSFgR5grVBj"

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
var ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
var searchBoxHTML = ttSearchBox.getSearchBoxHTML();
//facciamo l'append della searchbox al div container
div.append(searchBoxHTML)

