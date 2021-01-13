import React, {useState, useContext} from 'react';
import UsersAPI from "../services/UsersAPI";
import AuthContext from "../contexts/AuthContext";

const LoginPage = ({history}) => {

  const [credentials, setCredentials] = useState({
    username: "",
    password: ""
  });

  const {setIsAuthenticated} = useContext(AuthContext);

  const handleChange = (event) => {
    const value = event.currentTarget.value;
    const name = event.currentTarget.name;

    setCredentials({...credentials, [name]: value})
  };

  const handleSubmit = async event => {
    event.preventDefault();
    try {
      await UsersAPI.authenticate(credentials);
      setIsAuthenticated(true);
      history.replace("/backoffice")
    }catch (e) {
      console.log(e)
    }
  };

  return(<>
      <h1>Connect to Back Office</h1>

      <form onSubmit={handleSubmit}>
        <div className="form-group">
          <label htmlFor="username">Email</label>
          <input
            value={credentials.username}
            onChange={handleChange}
            type="username"
            placeholder="email@mail.fr"
            name="username"
            id="username"
            className="form-control"
          />
        </div>
        <div className="form-group">
          <label htmlFor="password">Password</label>
          <input
            value={credentials.password}
            onChange={handleChange}
            type="password"
            placeholder="Password"
            name="password"
            id="password"
            className="form-control"
          />
        </div>
        <div className="form-group">
          <button type="submit" className="btn btn-primary"> Log !</button>
        </div>
      </form>
    </>
  );
};

export default LoginPage;