import React, {useEffect, useState} from 'react';
import CitiesAPI from "../services/CitiesAPI"

const Backoffice = props => {

  const [cities, setcities] = useState([]);
  const [city, setCity] = useState({
    name: ""
  });

  //Get Cities List
  const fetchCities = async () => {
    try {
      const data = await CitiesAPI.findAll();
      setcities(data);
    }catch (e) {
      console.log("error : " + e)

    }
  };

  //Components Charging
  useEffect(() => {
    fetchCities();
  });

  // City register
  function register(cityName) {
    try {
      setCity(cityName);
      CitiesAPI.add(city);
      console.log("Well done, you just register " + cityName);
    }catch (e) {
      console.log("error " + e.response)
    }
  };

  return(<>
      <h1>Welcome on board</h1>
      <table className="table">
        <thead>
        <tr>
          <th>Cities list</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        {cities.map(city => (
          <tr key={city.name}>
            <td>{city.name.charAt(0).toUpperCase() + city.name.substring(1)}</td>
            <td>
              <input name="name" type="button" className="btn btn-outline-success mr-1" value="Activer" onClick={() => register(city.name)}/>
              <input name="name" type="button" className="btn btn-outline-danger" value="Désactiver" onClick={() => delete(city.name)}/>
            </td>
          </tr>
        ))}


        </tbody>

      </table>
    </>
  );
};

export default Backoffice;