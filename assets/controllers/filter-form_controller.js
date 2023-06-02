import { Controller } from '@hotwired/stimulus';
import { useDispatch } from 'stimulus-use';

export default class extends Controller {
    static values = {resetUrl: String};

    onSubmit(event) {
        event.preventDefault();

        fetch(this.element.action, {
            method: this.element.method,
            body: new URLSearchParams(new FormData(this.element))
        }).then(async (response) => {
            if (response.status === 204) {
                this.dispatch("success");
            } else {
                this.element.innerHTML = await response.text();
            }
        });
    }

    async refresh() {
        const response = await fetch(this.element.action);
        this.element.innerHTML = await response.text();
    }

    async reset() {
        await fetch(this.resetUrlValue);
        this.refresh();
        this.dispatch("reset");
    }
}
