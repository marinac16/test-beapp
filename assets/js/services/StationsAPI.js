import axios from "axios";


function findByCity(value) {
  return axios
    .get("http://localhost:8080/api/stations?City.name=" + value)
    .then(response => response.data["hydra:member"]);
}

export default {
  findByCity
}