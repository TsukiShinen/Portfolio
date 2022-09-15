import { Controller } from '@hotwired/stimulus';
import $ from 'jquery';

export default class extends Controller {
    connect() {
        $(".image-delete").each(function() {
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
                            "entityId": e.currentTarget.dataset.id
                        },
                        success: function() {
                            location.reload();
                        }
                    })
                }
            })
        })
    }
}
