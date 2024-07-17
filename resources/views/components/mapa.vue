

<template>
    <div v-if="showContent" class="grid grid-cols-1 gap-4">
        <div class="pback p-4 rounded-lg shadow-md">
          <div id="map" style="height: 480px;"></div>
        </div>
    </div>

    <div v-if="!showContent" class="max-w-7xl mx-auto p-1 lg:p-8">
        <div class="grid grid-cols-2 gap-4" style="display:flex; justify-content:center;">
            <div class="bg-white p-4 rounded-lg shadow-md">
              <div>
                  <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Inicia sesión en tu cuenta</h2>
              </div>

              <div v-if="error" class="error">{{ error }}</div>
              <div v-if="success" class="bg-green-100 border-green-400 text-green-700 px-4 py-3 rounded relative mt-4">{{ success }}</div>

              <form class="mt-8 space-y-6" @submit.prevent="login">
                  <input type="hidden" name="remember" value="true">
                  <div class="rounded-md shadow-sm -space-y-px">
                      <div class="pdding">
                          <label for="email-address" class="sr-only">Correo electrónico</label>
                          <input id="email-address" v-model="email" name="email" type="email" autocomplete="email" required
                              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                              placeholder="Correo electrónico">
                      </div>
                      <div class="pdding">
                          <label for="password" class="sr-only">Contraseña</label>
                          <input id="password" v-model="password" name="password" type="password" autocomplete="current-password"
                              required
                              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                              placeholder="Contraseña">
                      </div>
                  </div>

                  <div class="pdding">
                      <button type="submit"
                          class="w-full flex  pback justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                          Iniciar sesión
                      </button>
                  </div>
              </form>
            </div>
        </div>
    </div>

    <div v-if="error && showContent" class="error">{{ error }}</div>
</template>

<script>
import Utils from '../../js/services/utils.js';
import { reactive, onMounted, computed } from 'vue';

export default {
  data() {
    return {
      visits: [],
      error: null,
      map: null,
      showContent: true,
      email: '',
      password: '',
      success:null,
    };
  },

  mounted() {
    Utils.initMap();
    Utils.fetchVisits();
  },
  methods:
  {
      login() 
      {
          axios.post('/api/login-users', 
          {
              email: this.email,
              password: this.password
          })
          .then(response => {

              if (response.status === 200)
              {
                  this.success = 'Inicio de sesión exitoso';
                  this.showContent = true;
                 // Utils.initMap();
                  Utils.fetchVisits();
              }else{
                  this.error = response.data.message;
              }
          })
          .catch(error => {
              this.error = error.response.data.message;
          });
      }
  }
}
</script>