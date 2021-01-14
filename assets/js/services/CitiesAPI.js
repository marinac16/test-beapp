import axios from "axios";


function findAllByStatus(value) {
  return axios
    .get("http://localhost:8080/api/cities?statut=" + value)
    .then(response => response.data["hydra:member"]);
}

function find(id) {
  return axios
    .get("http://localhost:8080/api/cities/" + id)
    .then(response => response.data)
}

function update(cityStatus, id) {
  return axios.put("http://localhost:8080/api/cities/" + id, cityStatus, {
    headers: {
      'Content-Type': 'application/json',
    }
  });
}

export default {
  findAllByStatus,
  update,
  find
}