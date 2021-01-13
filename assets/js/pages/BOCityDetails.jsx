import React, {useState, useEffect} from 'react';
import CitiesAPI from "../services/CitiesAPI";

const BOCityDetails = ({match}) => {

  const id = match.params.id;

  const [city, setCity] = useState({
    name:""
  });

  const fetchCity = async id => {
    try {
      console.log(match.params);
      const data = await CitiesAPI.find(id);
      setCity(data);
    }catch (e) {
      console.log(e)
    }
  };

  useEffect(() => {
    fetchCity(id);
  }, [id]);


  return(<>
      <h1>Welcome to {city.name}</h1>
    </>
  );
};

export default BOCityDetails;