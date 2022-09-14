import { Controller } from '@hotwired/stimulus';
import $ from 'jquery';

export default class extends Controller {
    connect() {
        $(".image-delete").each(function(i) {
            console.log( $(this).text())
            $(this).on("click", e => {
                e.preventDefault()
                console.log(e.currentTarget.dataset.token)
                if(confirm("Voulez-vous supprimer cette image ?")){
                    $.ajax({
                        type: "DELETE",
                        url: e.currentTarget.dataset.src,
                        data: {
                            "token": e.currentTarget.dataset.token,
                            "skillId": e.currentTarget.dataset.id
                        },
                        success: function(data) {
                            location.reload();
                        }
                    })
                }
            })
        })
    }
}
