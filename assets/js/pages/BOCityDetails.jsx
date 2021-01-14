import React, {useState, useEffect} from 'react';
import CitiesAPI from "../services/CitiesAPI";
import {Link} from "react-router-dom";
import StationsAPI from "../services/StationsAPI";

const BOCityDetails = ({match}) => {

  const id = match.params.id;

  const [city, setCity] = useState({
    name:""
  });
  const [stations, setStations] = useState({
    name:"",
    adress:"",
    capacity:"",
    bikeQuantityAvailable:"",
    position: [],
    statut:"",
  });
  const [display, setDisplay] = useState(false);

  const fetchCity = async id => {
    try {
      const data = await CitiesAPI.find(id);
      setCity(data);
    }catch (e) {
      console.log(e)
    }
  };

  useEffect(() => {
    fetchCity(id);
  }, [id]);

  const fetchStations = async city => {
    try {
      const data = await StationsAPI.findByCity(city);
      setStations(data);
      console.log(stations)
    }catch (e) {
      console.log(e)
    }
  };

  useEffect( () => {
    fetchStations(city.name)
  }, [city.name]);

  function getDisplay () {
    setDisplay(true);
    console.log(display);
  }


  return(<>
      <h1>Welcome to {city.name}</h1>
      <button className="btn" onClick={getDisplay}>
        <i className="fas fa-plus-circle"/> Add stations
      </button>

      <div className="">
        <table className="table">
          <thead>
          <tr>
            <th>Stations List</th>
            <th/>
          </tr>
          </thead>
          <tbody>
          {/*{stations.map(station => (
            <tr key={station.id}>
              <td>{station.name.charAt(0).toUpperCase() + station.name.substring(1)}</td>
              <td>
              </td>
            </tr>
          ))}*/}
          </tbody>
        </table>

      </div>
    </>
  );
};

export default BOCityDetails;