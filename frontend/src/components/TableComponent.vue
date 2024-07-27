<template>
  <thead>
    <tr>
      <th class="text-left">ID</th>
      <th class="text-left">Nome</th>
      <th class="text-left">CPF</th>
      <th class="text-left">Telefone</th>
      <th class="text-left">Email</th>
      <th class="text-left">Nome da Mãe</th>
      <th class="text-left">Nome do Pai</th>
      <th class="text-left">Nome Social</th>
      <th class="text-left">Quantidade de Endereços</th>
      <th class="text-left">Ações</th>
    </tr>
  </thead>
  <tbody>
    <tr v-if="clients.length == 0">
      <td
        colspan="9"
        style="text-align: center; font-size: 20px; font-weight: bold"
      >
        Nenhum conteudo cadastrado
      </td>
    </tr>
    <tr v-for="item in clients" v-else :key="item.id_public">
      <td>{{ item.id }}</td>
      <td>{{ item.nome }}</td>
      <td>{{ formatCPF(item.cpf) }}</td>
      <td>{{ formatPhone(item.telefone) }}</td>
      <td>{{ item.email }}</td>
      <td>{{ item?.nome_mae }}</td>
      <td>{{ item?.nome_pai }}</td>
      <td>{{ item?.nome_social }}</td>
      <td>{{ item.quantidade_endereco }}</td>
      <td style="display: flex; gap: 12px; align-items: center">
        <v-btn @click="openAddressForm(item)" color="primary">
          {{
            item.quantidade_endereco > 0 ? "Alterar Endereço" : "Criar Endereço"
          }}
        </v-btn>
        <v-btn
          @click="openAddressHistory(item)"
          v-if="item.quantidade_endereco > 0"
          color="secondary"
          >Ver Histórico
        </v-btn>
      </td>
    </tr>
  </tbody>
</template>

<script>
import { defineComponent, toRefs } from "vue";

export default defineComponent({
  name: "TableComponent",
  props: {
    clients: {
      type: Array,
      required: true,
    },
  },
  setup(props, { emit }) {
    const { clients } = toRefs(props);

    const openAddressForm = (item) => {
      emit("openAddressForm", item);
    };

    const openAddressHistory = (item) => {
      emit("openAddressHistory", item);
    };

    const formatCPF = (cpf) => {
      return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
    };

    const formatPhone = (phone) => {
      return phone.replace(/(\d{2})(\d{5})(\d{4})/, "($1) $2-$3");
    };

    return {
      clients,
      openAddressForm,
      openAddressHistory,
      formatCPF,
      formatPhone,
    };
  },
});
</script>

<style scoped></style>
