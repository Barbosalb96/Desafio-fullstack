<template>
  <v-app>
    <v-main>
      <v-app-bar :elevation="2">
        <v-app-bar-title>Prodemge</v-app-bar-title>
      </v-app-bar>

      <v-container>
        <div style="display: flex; align-items: center">
          <v-col cols="12" md="5">
            <v-text-field v-model="search" label="Buscar"></v-text-field>
          </v-col>
          <v-col cols="12" md="3">
            <v-btn @click="searchClient" color="primary">Buscar</v-btn>
          </v-col>
          <v-col cols="12" md="4" class="d-flex justify-end">
            <v-btn @click="openPersonForm" color="primary"
              >Cadastrar Cliente</v-btn
            >
          </v-col>
        </div>

        <!--   Tabela para listagem -->
        <v-table>
          <TableComponent
            @open-address-form="openAddressForm"
            @open-address-history="openAddressHistory"
            :clients="clients"
          />
        </v-table>

        <!--    Modal para cadastrar Cliente  -->
        <v-dialog v-model="dialog" max-width="1300px">
          <v-card>
            <v-card-title class="headline">Cadastrar Cliente</v-card-title>
            <v-card-text>
              <v-skeleton-loader v-if="loading" type="card"></v-skeleton-loader>
              <v-container v-else>
                <v-row>
                  <v-col cols="12" md="5">
                    <v-text-field
                      v-model="formData.nome"
                      label="Nome"
                      :error-messages="errors.nome"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" md="5">
                    <v-text-field
                      v-model="formData.nome_social"
                      label="Nome Social"
                      :error-messages="errors.nome_social"
                    ></v-text-field>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12" md="5">
                    <v-text-field
                      v-model="formData.cpf"
                      label="CPF"
                      :error-messages="errors.cpf"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" md="5">
                    <v-text-field
                      v-model="formData.telefone"
                      label="Telefone"
                      :error-messages="errors.telefone"
                    ></v-text-field>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12" md="5">
                    <v-text-field
                      v-model="formData.email"
                      label="Email"
                      :error-messages="errors.email"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" md="5">
                    <v-text-field
                      v-model="formData.nome_mae"
                      label="Nome da Mãe"
                      :error-messages="errors.nome_mae"
                    ></v-text-field>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12" md="8">
                    <v-text-field
                      v-model="formData.nome_pai"
                      label="Nome do Pai"
                      :error-messages="errors.nome_pai"
                    ></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDialog"
                >Cancelar</v-btn
              >
              <v-btn color="blue darken-1" text @click="save">Salvar</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>

        <!--    Modal para  endereço  -->
        <v-dialog v-model="addressDialog" max-width="600px">
          <v-card>
            <v-card-title class="headline">{{
              addressDialogTitle
            }}</v-card-title>
            <v-card-text>
              <v-skeleton-loader v-if="loading" type="card"></v-skeleton-loader>
              <v-container v-else>
                <v-row v-if="showAddressForm">
                  <v-col cols="12" md="5">
                    <v-text-field
                      v-model="addressFormData.cep"
                      @focusout="getCep"
                      label="CEP"
                      :error-messages="errors.cep"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" md="5">
                    <v-text-field
                      v-model="addressFormData.logradouro"
                      label="Logradouro"
                      :error-messages="errors.logradouro"
                    ></v-text-field>
                  </v-col>
                </v-row>
                <v-row v-if="showAddressForm">
                  <v-col cols="12" md="5">
                    <v-text-field
                      v-model="addressFormData.numero"
                      label="Número"
                      :error-messages="errors.numero"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" md="5">
                    <v-text-field
                      v-model="addressFormData.complemento"
                      label="Complemento"
                      :error-messages="errors.complemento"
                    ></v-text-field>
                  </v-col>
                </v-row>
                <v-row v-if="showAddressForm">
                  <v-col cols="12" md="5">
                    <v-text-field
                      v-model="addressFormData.bairro"
                      label="Bairro"
                      :error-messages="errors.bairro"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" md="5">
                    <v-text-field
                      v-model="addressFormData.cidade"
                      label="Cidade"
                      :error-messages="errors.cidade"
                    ></v-text-field>
                  </v-col>
                </v-row>
                <v-row v-if="showAddressForm">
                  <v-col cols="12" md="5">
                    <v-text-field
                      v-model="addressFormData.estado"
                      label="Estado"
                      :error-messages="errors.estado"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" md="5">
                    <v-select
                      v-model="addressFormData.tipo_endereco_id"
                      :items="optionsTypeAddress"
                      item-title="nome"
                      item-value="id"
                      label="Tipo de Endereço"
                      persistent-hint
                      return-object
                      single-line
                      :error-messages="errors.tipo_endereco_id"
                    ></v-select>
                  </v-col>
                </v-row>
                <v-list v-if="showAddressHistory">
                  <v-list-item
                    v-for="address in addressHistory"
                    :key="address.id_public"
                  >
                    <v-list-item-content>
                      <v-list-item-title
                        >{{ address.logradouro }},
                        {{ address.numero }}</v-list-item-title
                      >
                      <v-list-item-subtitle
                        >{{ address.bairro }}, {{ address.cidade }} -
                        {{ address.estado }} -
                        {{ address.historico ? "Historico" : "Atual" }}
                      </v-list-item-subtitle>
                    </v-list-item-content>
                  </v-list-item>
                </v-list>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeAddressDialog"
                >Cancelar</v-btn
              >
              <v-btn
                v-if="showAddressForm"
                color="blue darken-1"
                text
                @click="saveAddress"
                >Confirmar Endereço</v-btn
              >
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import { ref, reactive, onMounted } from "vue";
import apiService from "../Services/apiService";
import TableComponent from "@/components/TableComponent.vue";

export default {
  components: { TableComponent },
  setup() {
    const search = ref("");
    const clients = ref([]);
    const dialog = ref(false);
    const loading = ref(false);
    const addressDialog = ref(false);
    const clientId = ref("");
    const addressDialogTitle = ref("");
    const showAddressForm = ref(false);
    const showAddressHistory = ref(false);
    const optionsTypeAddress = ref([]);

    const formData = reactive({
      nome: "",
      nome_social: "",
      cpf: "",
      telefone: "",
      nome_pai: "",
      nome_mae: "",
      email: "",
    });

    const addressFormData = reactive({
      cep: "",
      logradouro: "",
      numero: "",
      complemento: "",
      bairro: "",
      cidade: "",
      estado: "",
      tipo_endereco_id: "",
    });

    const addressHistory = ref([]);
    const errors = reactive({
      nome: [],
      nome_social: [],
      cpf: [],
      telefone: [],
      nome_pai: [],
      nome_mae: [],
      email: [],
      cep: [],
      logradouro: [],
      numero: [],
      complemento: [],
      bairro: [],
      cidade: [],
      estado: [],
      tipo_endereco_id: [],
    });

    const searchClient = () => {
      apiService
        .search(search.value)
        .then((response) => {
          clients.value = response.data.data;
        })
        .catch((error) => {
          console.error(error);
        });
    };

    const openPersonForm = () => {
      dialog.value = true;
    };

    const closeDialog = () => {
      dialog.value = false;
      resetForm();
    };

    const save = () => {
      loading.value = true;
      apiService
        .save(formData)
        .then(() => {
          searchClient();
          loading.value = false;
          closeDialog();
        })
        .catch((error) => {
          loading.value = false;
          if (
            error.response &&
            error.response.data &&
            error.response.data.errors
          ) {
            Object.assign(errors, error.response.data.errors);
          }
        });
    };

    const getTypeAddress = () => {
      apiService
        .getTypeAddress()
        .then((response) => {
          optionsTypeAddress.value = response.data.data;
        })
        .catch((error) => {
          console.error(error);
        });
    };

    const resetForm = () => {
      Object.assign(formData, {
        nome: "",
        nome_social: "",
        cpf: "",
        telefone: "",
        nome_pai: "",
        nome_mae: "",
        email: "",
      });
      Object.assign(errors, {
        nome: [],
        nome_social: [],
        cpf: [],
        telefone: [],
        nome_pai: [],
        nome_mae: [],
        email: [],
      });
    };

    const openAddressForm = (client) => {
      addressDialogTitle.value =
        client.quantidade_endereco > 0
          ? `Alterar Endereço para ${client.nome}`
          : `Criar Endereço para ${client.nome}`;
      showAddressForm.value = true;
      clientId.value = client.id;
      showAddressHistory.value = false;
      addressDialog.value = true;
      loading.value = true;
      getTypeAddress();
      apiService.getAddress(client.id).then((response) => {
        if (response.data.data) {
          loading.value = false;
          Object.assign(addressFormData, response.data.data);
        } else {
          loading.value = false;
        }
      });
    };

    const openAddressHistory = (client) => {
      addressDialogTitle.value = `Histórico de Endereços de ${client.nome}`;
      showAddressForm.value = false;
      loading.value = true;
      showAddressHistory.value = true;
      apiService
        .get(client.id_public)
        .then((response) => {
          loading.value = false;
          addressHistory.value = response.data.data;
        })
        .catch((error) => {
          loading.value = false;
          console.error(error);
        });
      addressDialog.value = true;
    };

    const closeAddressDialog = () => {
      addressDialog.value = false;
      resetAddressForm();
    };

    const saveAddress = () => {
      if (addressFormData.tipo_endereco_id.id) {
        addressFormData.tipo_endereco_id = addressFormData.tipo_endereco_id.id;
      }
      addressFormData.pessoa_id = clientId.value;
      loading.value = true;
      apiService
        .saveAddress(addressFormData)
        .then(() => {
          searchClient();
          loading.value = false;
          closeAddressDialog();
        })
        .catch((error) => {
          loading.value = false;
          if (
            error.response &&
            error.response.data &&
            error.response.data.errors
          ) {
            Object.assign(errors, error.response.data.errors);
          }
        });
    };

    const resetAddressForm = () => {
      Object.assign(addressFormData, {
        cep: "",
        logradouro: "",
        numero: "",
        complemento: "",
        bairro: "",
        cidade: "",
        estado: "",
        tipo_endereco_id: "",
      });
      Object.assign(errors, {
        cep: [],
        logradouro: [],
        numero: [],
        complemento: [],
        bairro: [],
        cidade: [],
        estado: [],
        tipo_endereco_id: [],
      });
    };

    const getCep = () => {
      apiService
        .getAddressByCep(addressFormData.cep)
        .then((response) => {
          Object.assign(addressFormData, {
            logradouro: response.data.logradouro,
            bairro: response.data.bairro,
            cidade: response.data.localidade,
            estado: response.data.uf,
          });
        })
        .catch((error) => {
          console.error(error);
        });
    };

    onMounted(() => {
      searchClient();
    });

    return {
      search,
      clients,
      dialog,
      loading,
      addressDialog,
      clientId,
      addressDialogTitle,
      showAddressForm,
      showAddressHistory,
      optionsTypeAddress,
      formData,
      addressFormData,
      addressHistory,
      errors,
      searchClient,
      openPersonForm,
      closeDialog,
      save,
      getTypeAddress,
      resetForm,
      openAddressForm,
      openAddressHistory,
      closeAddressDialog,
      saveAddress,
      resetAddressForm,
      getCep,
    };
  },
};
</script>
