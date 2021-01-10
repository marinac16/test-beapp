import axios from "axios";

function findAll() {
  return axios
    .get("https://api.jcdecaux.com/vls/v3/contracts?apiKey=eac86f2a1287f417645f574439af24278441bd8a")
    .then(response => response.data);

}

export default {
  findAll
}