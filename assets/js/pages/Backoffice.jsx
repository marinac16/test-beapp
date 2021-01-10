import React, {useEffect, useState} from 'react';
import CitiesAPI from "../services/CitiesAPI"

const Backoffice = props => {

  const [cities, setcities] = useState([]);

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
          <tr key={city.id}>
            <td>{city.name.charAt(0).toUpperCase() + city.name.substring(1)}</td>
            <td>
              <button type="button" className="btn btn-outline-primary mr-1">Détails</button>
              <button type="button" className="btn btn-outline-success">Ajouter</button>
              <button type="button" className="btn btn-outline-danger ml-1">Supprimer</button>
            </td>
          </tr>
        ))}


        </tbody>

      </table>
    </>
  );
};

export default Backoffice;