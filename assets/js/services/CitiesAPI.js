import axios from "axios";

function findAll() {
  return axios
    .get("http://localhost:8080/api/cities")
    .then(response => response.data["hydra:member"]);
}

function findAllByStatus(value) {
  return axios
    .get("http://localhost:8080/api/cities?statut=" + value)
    .then(response => response.data["hydra:member"]);
}

function update(city, id) {
  return axios.put("http://localhost:8080/api/cities/" + id, {city});
}

export default {
  findAll,
  findAllByStatus,
  update,
}