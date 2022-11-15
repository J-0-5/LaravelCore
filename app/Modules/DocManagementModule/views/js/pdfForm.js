import { Form } from "@pdfme/ui";

export default class pdfForm {
    initialize() {
        this.initial();
    }

    initial() {
        var stringg = document.querySelector('p[contenteditable="true"]');
        stringg.addEventListener("focus", function () {
            // console.log(stringg.innerHTML);
            //Expresion Regular Solo Letras
            var ExpRegSoloLetras = "/^{?([a-z])$/";
            console.log(stringg.innerHTML.match(ExpRegSoloLetras));

        });
    }
}
