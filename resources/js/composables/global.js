
import { Validator } from "quival";
import enLocale from 'quival/src/locales/en.js';
Validator.setLocale('en');
Validator.setMessages('en', enLocale);
export const BlockNumbers = {
    mounted:(el)=>{
        el.addEventListener('keydown', (event) => {
            const key = event.key;
            if (!isNaN(key) && key.trim() !== '') {
                event.preventDefault();
            }
        });
    }
}
export const Numeric={
    mounted:(el)=>{
        el.addEventListener('keydown', (event) => {
            const key = event.key;
            const num=Number(key)
            if (key.trim()!='Backspace' && (isNaN(num) || typeof num!='number')) {
                event.preventDefault();
            }
        });
    }
}
