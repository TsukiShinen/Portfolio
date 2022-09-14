import { Controller } from '@hotwired/stimulus';
import $ from 'jquery';

export default class extends Controller {
    connect() {
        $(".skill-icon").on('click', e => {
            $.ajax({
                type: "POST",
                url: e.currentTarget.dataset.src,
                data: {
                    "search" : e.currentTarget.dataset.value
                },
                success: function (data) {
                    $("#content").html(data["html"])
                }
            })
        })
    }
}
