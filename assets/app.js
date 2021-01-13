import React, {useState} from 'react';
import ReactDOM from 'react-dom'
// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';
import Navbar from "./js/components/Navbar";
import HomePage from "./js/pages/HomePage";
import Backoffice from "./js/pages/Backoffice";
import BOCity from "./js/pages/BOCity";
import BOStation from "./js/pages/BOStation";
import {HashRouter, Switch, Route} from "react-router-dom";
import LoginPage from "./js/pages/LoginPage";
import UsersAPI from "./js/services/UsersAPI";
import PrivateRoute from "./js/components/PrivateRoute";
import AuthContext from "./js/contexts/AuthContext";
import { withRouter } from "react-router-dom"
import BOCityDetails from "./js/pages/BOCityDetails";

UsersAPI.setup();

const App = () => {

  const [isAuthenticated, setIsAuthenticated] = useState(UsersAPI.isAuthenticated);
  const contextValue = {isAuthenticated, setIsAuthenticated};
  const NavbarWithRouter = withRouter(Navbar);

  return (
    <AuthContext.Provider value={contextValue}>
      <HashRouter>
        <NavbarWithRouter/>
        <main className="container pt-5">
          <Switch>
            <Route path="/login" render={props => <LoginPage onLogin={setIsAuthenticated} {...props}/>}/>
            <PrivateRoute path="/backoffice/Cities/:id" component={BOCityDetails}/>
            <PrivateRoute path="/backoffice/Cities" component={BOCity}/>
            <PrivateRoute path="/backoffice/Stations" component={BOStation}/>
            <PrivateRoute path="/backoffice" component={Backoffice}/>
            <Route path="/" component={HomePage}/>
          </Switch>
        </main>
      </HashRouter>

    </AuthContext.Provider>

  )
};

const rootElement = document.querySelector('#app');
ReactDOM.render(<App />, rootElement);
