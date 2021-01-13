import React, {useEffect, useState} from 'react';
import CitiesAPI from "../services/CitiesAPI"

const Backoffice = props => {

  const [citiesDeactivated, setCitiesDeactivated] = useState([]);
  const [statusCity, setStatusCity] = useState(true);


  //Get Cities List where status is deactivated
  const fetchCitiesByStatusFalse = async () => {
    const value = false;
    try {
      const data = await CitiesAPI.findAllByStatus(value);
      setCitiesDeactivated(data);
    }catch (e) {
    }
  };

  //Components Charging
  useEffect(() => {
    fetchCitiesByStatusFalse();
  });

  //Update the city's status
  const handleUpdateStatus = async (id) => {
    try {
      await CitiesAPI.update(statusCity, id);
      console.log("put");
    }catch (e) {
      console.log(e);
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
        {citiesDeactivated.map(city => (
          <tr key={city.id}>
            <td>{city.name.charAt(0).toUpperCase() + city.name.substring(1)}</td>
            <td>
              <input  name="name" type="button" className="btn btn-outline-success mr-1" value="Activer" onClick={() => handleUpdateStatus(city.id)}/>
            </td>
          </tr>
        ))}


        </tbody>

      </table>
    </>
  );
};

export default Backoffice;