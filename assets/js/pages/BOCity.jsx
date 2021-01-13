import React, {useEffect, useState} from 'react';
import CitiesAPI from "../services/CitiesAPI";
import {Link} from "react-router-dom";

const BOCity = (props) => {

  const [myCities, setMyCities] = useState([]);
  const [city, setCity] = useState({
    statut:false
  });

  //Get all my cities List with status activated
  const fetchCities = async () => {
    const value = true;
    try {
      const data = await CitiesAPI.findAllByStatus(value);
      setMyCities(data);
    }catch (e) {
      console.log (e)
    }
  };

  //Components Charging
  useEffect(() => {
    fetchCities();
  });

  //Update the city's status
  const handleUpdateStatus = async (id) => {
    try {
      await CitiesAPI.update(city, id);
    }catch (e) {
      console.log(e);
    }
  };

  return(<>
      <h1>My Cities</h1>
      <Link to={"/backoffice"}>
        <i className="fas fa-plus-circle"/> Add cities
      </Link>



      <table className="table">
        <thead>
        <tr>
          <th>My Cities list</th>
          <th/>
        </tr>
        </thead>
        <tbody>
        {myCities.map(city => (
          <tr key={city.id}>
            <td>{city.name.charAt(0).toUpperCase() + city.name.substring(1)}</td>
            <td>
              <Link to={"cities/" + city.id} className="btn btn-outline-secondary mr-1">
                <i className="fas fa-eye"/>
              </Link>
              <button name="statut" className="btn btn-outline-danger mr-1" onClick={() => handleUpdateStatus(city.id)}>
              <i className="fas fa-trash"/>
            </button>
            </td>
          </tr>
        ))}


        </tbody>

      </table>
    </>
  );
};

export default BOCity;