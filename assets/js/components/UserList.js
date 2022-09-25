import React, { useEffect, useState }  from 'react';
import axios from 'axios';
import Table from 'react-bootstrap/Table';
import Button from 'react-bootstrap/Button';
import { Link } from 'react-router-dom';
import UserForm from './UserForm';

function UserList() {

    const [users, setUsers] = useState([]);
    const [isShow, setIsShow] = useState(true);

  
  const handleShow = () => {
    setIsShow(!isShow);
  };

    useEffect(() => {
      fetchUserList()
  }, [])

   
  const fetchUserList = () => {
    axios.get('https://localhost:8000/api/users')
    .then(function (response) {
      setUsers(response.data);
    })
    .catch(function (error) {
      console.log(error);
    })
}

const handleDelete = (id) => {
  axios.delete(`https://localhost:8000/api/user/${id}`)
  .then(response => {
    console.log(response);
    fetchUserList();
    const filteredState = users.filter(user => user.id !== id);
    setUsers(users);
  });
  
}





  return (
    <div className='container mt-5'>
          <Table striped bordered hover size="sm">
    <thead>
      <tr>
        <th>#</th>
        <th>Prénom</th>
        <th>Nom</th>
        <th>email</th>
        <th>adresse</th>
        <th>tel</th>
        <th>âge</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    {users.map((user) => (
            <tr key={user.id}> 
            <td>{user.id}</td>
            <td>{user.firstName}</td>
            <td>{user.lastName}</td>
            <td>{user.email}</td>
            <td>{user.address}</td>
            <td>{user.tel}</td>
            <td>{user.age}</td>
            <td><Button variant="danger" onClick={() => handleDelete(user.id)} >Supprimer</Button></td>
            <td> <Link to={`/show/${user.id}`}><Button variant="secondary" >Voir</Button></Link></td>
            </tr>
            ))}
      
    </tbody>
  </Table>
  <Button variant="primary" onClick={handleShow}>
        Ajouter un utilisateur
      </Button>
      {!isShow && 
       <UserForm/>
 }
     

</div>
  )
}

export default UserList