<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 px-5">
        <div class="w-full  mt-6 px-7 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg ">
            <form @submit.prevent="handleSubmit" novalidate>
                <div class="grid  grid-cols-2 gap-3">
                    <div>
                        <Input label="Name" v-model="form.name" :required="true" :error-message="errors?.name" v-block-numbers/>
                        <Input label="Email" v-model="form.email" :required="true" type="email" :error-message="errors?.email"/>
                        <Input label="Message" :input="false" :error-message="errors?.message">
                        <textarea
                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm resize-none"
                            rows="5" v-model="form.message"></textarea>
                        </Input>
                        <Input :input="false" label="Preferred Contact Method" :error-message="errors?.contactMethod">
                        <div class="flex">
                            <div class="flex items-center w-40">
                                <input type="radio" name="contact" id="email" class="mr-2" value="email"
                                    v-model="form.contactMethod">
                                <label for="email" class="cursor-pointer">
                                    Email
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" name="contact" id="Phone" class="mr-2" value="phone"
                                    v-model="form.contactMethod">
                                <label for="Phone" class="cursor-pointer">
                                    Phone
                                </label>
                            </div>
                        </div>
                        </Input>
                    </div>
                    <div>
                        <Input label="Phone Number" v-model="form.phone" v-numeric :error-message="errors?.phone"/>
                        <Input :input="false" label="Subject " :error-message="errors?.subject">
                        <select
                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            v-model="form.subject">
                            <option value="">Select Subject</option>
                            <option>General Inquiry</option>
                            <option>Feedback</option>
                            <option>Support Request</option>
                            <option>Others</option>
                        </select>
                        </Input>
                        <Input :input="false" label="Countries" :error-message="errors?.country">
                        <select
                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            v-model="form.country">
                            <option value="">Select Country</option>
                            <option v-for="country in countries" :key="'country'+country.name" :value="country.name">
                                {{ country.name }}
                            </option>
                        </select>
                        </Input>
                        <Input label="Date of Birth" type="date" v-model="form.dob" :max="curentDate" :error-message="errors?.dob"/>
                        <Input label="Upload File " :input="false" :error-message="errors?.file">
                           <input type="file"
                            accept="image/png, image/jpg, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf"
                            @change="(e)=>form.file=e.target.files[0]" class="cursor-pointer" />
                        </Input>
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <div>
                    <div class="my-3 flex items-center">
                        <input type="checkbox" id="terms"
                            class="focus:border-indigo-500 focus:ring-indigo-500 mr-2 rounded-md cursor-pointer"
                            :value="true" v-model="form.termsndCondition" />
                        <label for="terms" class="cursor-pointer">I agree to the terms and conditions.</label>
                    </div>
                    <div>
                        <InputError :message="errors?.termsndCondition"/>
                    </div>
                    </div>
                    <div>
                        <SubmitBtn :loading/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import moment from "moment";
import Input from "./Input.vue";
import init from '@/composables/notificationform.js'
import InputError from "../InputError.vue";
import SubmitBtn from "./SubmitBtn.vue";
const {errors,form,countries,handleSubmit,loading}=init()
const curentDate=moment().format('YYYY-MM-DD')
</script>
