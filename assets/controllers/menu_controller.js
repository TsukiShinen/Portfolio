import { Controller } from '@hotwired/stimulus';
import $ from 'jquery';

export default class extends Controller {
    connect() {
        $('.menu-btn').change(function (e) {
            if (e.currentTarget.dataset.show === "content") {
                $("#" + e.currentTarget.dataset.show).css("display", "block");
                $.ajax({
                    type: "POST",
                    url: e.currentTarget.dataset.src,
                    success: function (data) {
                        $("#content").html(data["html"])
                    }
                })
            }
            else {
                $("#" + e.currentTarget.dataset.show).css("display", e.currentTarget.checked ? "block" : "none");
            }

            if (e.currentTarget.dataset.hide === "") return
            $("#" + e.currentTarget.dataset.hide).css("display", "none");

            if (e.currentTarget.dataset.uncheck === "") return
            $("#" + e.currentTarget.dataset.uncheck)[0].checked = false;
        });
    }
}
