import { Controller } from '@hotwired/stimulus';

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    connect() {
        setInterval(() => {
            let date = new Date();
            let h = date.getHours() < 10 ? "0"+date.getHours() : date.getHours()
            let m = date.getMinutes() < 10 ? "0"+date.getMinutes() : date.getMinutes()
            let s = date.getSeconds() < 10 ? "0"+date.getSeconds() : date.getSeconds()
            this.element.textContent = h + ":" + m + ":" + s
        }, 1000)
    }
}
