import React, { useState } from 'react';
import axios from 'axios';
import { useNavigate } from "react-router-dom";


function UserForm() {
    const navigate = useNavigate();


    const [inputs, setInputs] = useState([]);

    const handleChange = (event) => {
      const name = event.target.name;
      const value = event.target.value;
      setInputs((values) => ({ ...values, [name]: value }));
    };
    const handleSubmit = (event) => {
      event.preventDefault();
  
      axios
        .post("https://localhost:8000/api/users", inputs)
        .then(function (response) {
          console.log(response.data);
          navigate("/");
        });
    };



  return (
    <>
<div className='container'>
    <form onSubmit={handleSubmit}>
  <div className="form-row">
    <div className="form-group col-md-6">
      <label for="input4">Nom</label>
      <input type="text" className="form-control" name="lastName" id="input4" onChange={handleChange} />
    </div>
    <div className="form-group col-md-6">
      <label for="firstname">Prénom</label>
      <input type="text" className="form-control" name="firstName"id="firstname" onChange={handleChange} />
    </div>
  </div>
  <div className="form-group col-md-6">
    <label for="inputAddress">email</label>
    <input type="email" className="form-control" name="email" id="inputAddress" onChange={handleChange} />
  </div>

  <div className="form-row">
    <div className="form-group col-md-6">
      <label for="inputCity">Adresse</label>
      <input type="text" className="form-control" name="address" id="inputCity" onChange={handleChange} />
    </div>

    <div className="form-group col-md-2">
      <label for="inputZip">tel</label>
      <input type="text" className="form-control" name="tel" id="inputZip" onChange={handleChange} />
    </div>
 
    <div className="form-group col-md-2">
      <label for="inputZip">Date de naissance</label>
      <input type="date" className="form-control" name="birthDate" id="inputZip" onChange={handleChange} />
    </div>
  </div>
 
  <button type="submit" className="btn btn-primary">Ajouter</button>
</form>
</div>





  </>
  )
}

export default UserForm;