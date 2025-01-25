import { onMounted, reactive, ref, shallowRef } from "vue";
import axios from "axios";
import { Validator } from "quival";
import moment from "moment";
import { usePage } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";
import Toast from "@/Components/Form/Toast.vue";
export default function init() {
    const loading = ref(false)
    const props=usePage().props
    const user=props.auth.user
    const form = reactive({
        name: '', email: "", message: '', phone: '', subject: "", contactMethod: '', country: '', file: '', dob: '', termsndCondition: false
    })
    const errors = ref({})
    const countries = shallowRef([])
    onMounted(() => {
        getCountries()
        intializeEcho()
    })
    const formClear=()=>{
        Object.entries(form).forEach(([key,val])=>{
            form[key]=''
        })
        form.termsndCondition=false
    }
    const getCountries = async () => {
        try {
            const res = await axios.get('https://countriesnow.space/api/v0.1/countries/info?returns=country')
            countries.value = res.data.data
        } catch (error) {
            console.error(error);

        }
    }
    const validate = async () => {
        const rules = {
            name: 'required',
            email: 'required|email',
            message: 'required|min:10',
            phone: 'nullable|min:10',
            subject: 'required',
            contactMethod: 'required',
            file: 'nullable|file|mimetypes:application/pdf,image/jpeg,image/png,application/vnd.openxmlformats-officedocument.wordprocessingml.document|max:5000',
            country: 'required',
            termsndCondition: 'accepted',
            dob: 'nullable|date|before_or_equal:' + moment().format('YYYY-MM-DD')
        };
        const validate = new Validator(form, rules)
        const errorBag = (await validate.validate())
        if (errorBag.isNotEmpty()) {
            Object.entries(errorBag.messages()).forEach(([key, val]) => {
                errors.value[key] = val[0]
            })
            setTimeout(() => {
                errors.value = {}
            }, 5000)
            return false
        }
        errors.value = []
        return true
    }
    const handleSubmit = async () => {
        loading.value = true
        try {
            if (await validate()) {
                const res = await axios.post(route('form-upload'), form, { headers: { "Content-Type": 'multipart/form-data' } })
                // alert(res.data.message)
                // window.location.reload()
                toast(res.data.message,{type:'success'})
                formClear()

            }
        } catch (error) {
            alert('Some Thing Went Wrong Please Try Again Later')
            window.location.reload()
        }
        loading.value = false
    }
    const intializeEcho = () => {
        const echo=window.Echo
        echo.private(`form-notifications.${user.id}`)
            .listen('.formUpdate', (e) => {
                toast(Toast,{
                    contentProps:{data:e.data},
                    "theme": "light",
                    "type": "default",
                    "closeOnClick": false,
                    "autoClose": false,
                    "hideProgressBar": true,
                    "dangerouslyHTMLString": true,
                    "newestOnTop":true,
                });
        });
    }
    return { form, handleSubmit, countries, errors, loading }
}
