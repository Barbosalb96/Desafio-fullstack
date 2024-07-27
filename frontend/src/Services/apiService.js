import axios from "axios";

const api = axios.create({
  baseURL: "http://localhost:8000/api",
});

export default {
  search(query) {
    return api.get("/cliente/", { params: { search: query } });
  },
  save(client) {
    return api.post("/cliente/", client);
  },
  get(id) {
    return api.get(`/cliente/${id}`);
  },
  getAddress(id) {
    return api.get(`/endereco/${id}`);
  },
  saveAddress(address) {
    return api.post(`/endereco/`, address);
  },
  getAddressByCep(cep) {
    return axios.get(`https://viacep.com.br/ws/${cep}/json/`);
  },
  getTypeAddress() {
    return api.get(`/type-address`);
  },
};
