import React from 'react';
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

const App = () => {
  return (
    <HashRouter>

    <Navbar/>

    <main className="container pt-5">
      <Switch>
        <Route path="/backoffice/Cities" component={BOCity}/>
        <Route path="/backoffice/Stations" component={BOStation}/>
        <Route path="/backoffice" component={Backoffice}/>
        <Route path="/" component={HomePage}/>
      </Switch>
    </main>

    </HashRouter>
  )
};

const rootElement = document.querySelector('#app');
ReactDOM.render(<App />, rootElement);
