import axios from "axios";
import jwtDecode from "jwt-decode";


function authenticate(credentials) {
  return axios
    .post("http://localhost:8080/api/login_check", credentials)
    .then(response => response.data.token)
    .then(token => {
      //Stock Token
      window.localStorage.setItem("authToken", token);
      //Add header for futures http request
      axios.defaults.headers["Authorization"] = "Bearer " + token;

      return true;
    })
}

function logout() {
  window.localStorage.removeItem("authToken");
  delete axios.defaults.headers["Authorization"];

}

function setAxiosToken(token) {
  axios.defaults.headers["Authorization"] = "Bearer " + token;
}

function setup() {
  const token = window.localStorage.getItem("authToken");

  if (token) {
    const {exp: expiration} = jwtDecode(token);
    if (expiration * 1000 > new Date().getTime()) {
      setAxiosToken(token);
    }
  }
}

function isAuthenticated() {
  const token = window.localStorage.getItem("authToken");
  if (token) {
    const {exp: expiration} = jwtDecode(token);
    if (expiration * 1000 > new Date().getTime()) {
      return true
    }
    return false
  }
  return false
}

export default {
  authenticate,
  logout,
  setup,
  isAuthenticated

};