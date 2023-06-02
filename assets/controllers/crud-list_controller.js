import { Controller } from '@hotwired/stimulus';
import { useDispatch } from 'stimulus-use';

export default class extends Controller {
    static targets = [ "list" ];
    static values = {listUrl: String, setPageUrl: String};

    async refresh() {
        const response = await fetch(this.listUrlValue);
        this.listTarget.innerHTML = await response.text();
    }

    reset() {
        this.listTarget.innerHTML = "";
    }

    async paginate(event) {
        await fetch(this.setPageUrlValue + "?page=" + event.target.dataset.page);
        this.refresh();
    }
}
