import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

const address = document.getElementById('address')

address.addEventListener("keyup", function(){
    alert('ciao');
})
