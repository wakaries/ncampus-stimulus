import { Controller } from '@hotwired/stimulus';
import { useDispatch } from 'stimulus-use';

export default class extends Controller {

    connect() {

    }

    onSubmit(event) {
        event.preventDefault();

        fetch(this.element.action, {
            method: this.element.method,
            body: new URLSearchParams(new FormData(this.element))
        })
            .then(function(response) {
                this.dispatch("filter:success");
                //response.text()
            });
    }
}
