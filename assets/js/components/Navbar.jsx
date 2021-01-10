import React from 'react';
import {Link, NavLink} from "react-router-dom";

const Navbar = props => {
  return(
    <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
      <NavLink to="/" className="navbar-brand">TAPANDGO</NavLink>
      <ul className="navbar-nav mr-auto">
        <li className="nav-item">
          <NavLink to="/backoffice/Cities" className="nav-link text-muted">My cities</NavLink>
        </li>
        <li className="nav-item">
          <NavLink to="/backoffice/Stations" className="nav-link text-muted">Station</NavLink>
        </li>
      </ul>
      <ul className="navbar-nav ml-auto">
        <li className="nav-item">
          <NavLink to="/backoffice" className="btn btn-outline-secondary">BackOffice</NavLink>
        </li>
      </ul>
    </nav>

  );
};

export default Navbar;