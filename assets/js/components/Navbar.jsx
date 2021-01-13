import React, {useContext} from 'react';
import {Link, NavLink} from "react-router-dom";
import UsersAPI from "../services/UsersAPI";
import AuthContext from "../contexts/AuthContext";

const Navbar = ({history}) => {

  const {isAuthenticated, setIsAuthenticated} = useContext(AuthContext);

  const handleLogout = () => {
    UsersAPI.logout();
    setIsAuthenticated(false);
    history.push("/login")
  };

  return(
    <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
      <NavLink to="/" className="navbar-brand">TAPANDGO</NavLink>
      {isAuthenticated && <>
        <ul className="navbar-nav mr-auto">
          <li className="nav-item">
            <NavLink to="/backoffice/Cities" className="nav-link text-muted">My cities</NavLink>
          </li>
        </ul>
      </>
      }
      <ul className="navbar-nav ml-auto">
        {!isAuthenticated && <>
          <li className="nav-item">
            <NavLink to="/backoffice/Cities" className="btn btn-outline-secondary">BackOffice</NavLink>
          </li>
        </> ||
        <li className="nav-item">
          <button onClick={handleLogout} className="btn btn-danger">Logout</button>
          </li>
        }

      </ul>
    </nav>

  );
};

export default Navbar;