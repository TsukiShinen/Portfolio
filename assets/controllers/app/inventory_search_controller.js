import { Controller } from '@hotwired/stimulus';
import $ from 'jquery';

export default class extends Controller {
    connect() {
        $(".inventory-search input").change(e => {
            $.ajax({
                type: "POST",
                url: e.currentTarget.dataset.src,
                data: {
                    "search" : e.currentTarget.value
                },
                success: function (data) {
                    $(".inventory-projects").html(data["html"])
                    console.log(e.currentTarget.dataset.src)
                    console.log(e.currentTarget.value)
                }
            })
        })
    }
}
