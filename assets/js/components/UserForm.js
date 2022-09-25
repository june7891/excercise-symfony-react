import React, { useState } from 'react';
import axios from 'axios';
import { useNavigate } from "react-router-dom";
import '../../styles/app.css';
import Modal from "react-bootstrap/Modal";


function UserForm() {
    const navigate = useNavigate();
    const [show, setShow ] = useState(true);
    const handleClose = () => setShow(false);


    const [inputs, setInputs] = useState([]);

    const handleChange = (event) => {
      const name = event.target.name;
      const value = event.target.value;
      setInputs((values) => ({ ...values, [name]: value }));
    };
    const handleSubmit = (event) => {
      event.preventDefault();
      const refreshPage = ()=>{
        window.location.reload();
     }
  
      axios
        .post("https://localhost:8000/api/users", inputs)
        .then(function (response) {
          console.log(response.data);
          handleClose();
          refreshPage();
        });
    };



  return (
    <>
    <Modal show={show} onHide={handleClose}>
    <Modal.Header closeButton>
    <Modal.Title>Ajouter un nouvel utilisateur</Modal.Title>
        </Modal.Header>
      <div className='container myModal'>
    <form onSubmit={handleSubmit}>
  <div className="form-row">
    <div className="form-group col-md-6">
      <label htmlFor="input4">Nom</label>
      <input type="text" className="form-control" name="lastName" id="input4" required onChange={handleChange} />
    </div>
    <div className="form-group col-md-6">
      <label htmlFor="firstname">Prénom</label>
      <input type="text" className="form-control" name="firstName"id="firstname" required onChange={handleChange} />
    </div>
  </div>
  <div className="form-group col-md-6">
    <label htmlFor="inputAddress">email</label>
    <input type="email" className="form-control" name="email" id="inputAddress" required onChange={handleChange} />
  </div>

  <div className="form-row">
    <div className="form-group col-md-6">
      <label htmlFor="inputCity">Adresse</label>
      <input type="text" className="form-control" name="address" id="inputCity" required onChange={handleChange} />
    </div>

    <div className="form-group col-md-2">
      <label htmlFor="inputZip">tel</label>
      <input type="text" className="form-control" name="tel" id="inputZip" required onChange={handleChange} />
    </div>
 
    <div className="form-group col-md-2">
      <label htmlFor="inputZip">Date de naissance</label>
      <input type="date" className="form-control" name="birthDate" id="inputZip" required onChange={handleChange} />
    </div>
  </div>
 
  <button type="submit" className="btn btn-primary">Ajouter</button>
</form>
</div>

    </Modal>





  </>
  )
}

export default UserForm;