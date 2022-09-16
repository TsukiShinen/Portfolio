import { Controller } from '@hotwired/stimulus';
import $ from 'jquery';

export default class extends Controller {
    connect() {
        $(".inventory-card").on('click', e => {
            $.ajax({
                type: "POST",
                url: e.currentTarget.dataset.src,
                data: {
                    "id" : e.currentTarget.dataset.id
                },
                success: function (data) {
                    $("#content").html(data["html"])
                }
            })
        })
    }
}
