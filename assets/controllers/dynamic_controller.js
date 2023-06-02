import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    async refresh() {
        const response = await fetch("http://localhost/index.php/default/ajax");
        this.element.innerHTML = await response.text();
    }

    connect() {
        console.log("qwer");
        //this.refresh();
    }
}
