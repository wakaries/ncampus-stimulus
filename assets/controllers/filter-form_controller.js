import { Controller } from '@hotwired/stimulus';
import { useDispatch } from 'stimulus-use';

export default class extends Controller {

    onSubmit(event) {
        event.preventDefault();

        fetch(this.element.action, {
            method: this.element.method,
            body: new URLSearchParams(new FormData(this.element))
        }).then(async (response) => {
            if (response.status === 204) {
                return this.dispatch("success");
            }
            this.element.innerHTML = await response.text();
        });
    }
}
