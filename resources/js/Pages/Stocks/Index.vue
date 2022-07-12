<template>
  <div>
    <Head title="Stocks Management" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/contacts">Stocks</Link>
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.quantity" :error="form.errors.quantity" class="pb-8 pr-6 w-full lg:w-1/2" label="Quantity" />
        </div>
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Submit</loading-button>
        </div>
      </form>
      <div class="bg-white rounded-md shadow overflow-x-auto">
      <div role="alert" v-if="stocks.error">
        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
          Danger
        </div>
        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
          <p>{{stocks.error}}</p>
        </div>
      </div>
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">Quantity</th>
          <th class="pb-4 pt-6 px-6">Price</th>
          <th class="pb-4 pt-6 px-6">Value</th>
        </tr>
        <tr v-for="(stock,key) in stocks" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <span class="flex items-center px-6 py-4 focus:text-indigo-500">{{stock.quantity}}</span>
          </td>
          <td class="border-t">
            <span class="flex items-center px-6 py-4 focus:text-indigo-500">{{stock.price}}</span>
          </td>
          <td class="border-t">
            <span class="flex items-center px-6 py-4 focus:text-indigo-500">{{stock.value}}</span>
          </td>
        </tr>
      </table>
    </div>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  components: {
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
  },
  layout: Layout,
  props: {
    stocks: Array,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        quantity: '0',
        stocks: []
      })
    }
  },
  methods: {
    store() {
      this.form.stocks = this.stocks
      this.form.post('/stocks')
    },
  },
}
</script>
