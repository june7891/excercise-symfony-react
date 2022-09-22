import React, {useState, useEffect} from 'react';
import { useParams } from "react-router-dom";
import axios from "axios";

function UserDetails () {

  let params = useParams();
  const [user, setUser] = useState([]);
  const [possessions, setPossessions] = useState([]);
 
  const id = params.id;

  
  useEffect(() => {
    const getUser = async () => {
      await axios.get(`https://localhost:8000/api/user/${id}`)
      .then (response => {
        console.log(response.data);
        const data = response.data;
        setUser(data);
        setPossessions(data.possessions);
      })
      };
    getUser();
  }, [id]);


  return (

    <>

    <div className='container mt-5'>
       <h2>Profil d'utilisateur</h2>
    <div className='d-flex '>
         
      <p className='p-2'>{user.firstName}</p>
      <p className='p-2'>{user.lastName}</p>
    </div>
    </div>
   
 
      <div className='container'>
        <table className='table table-striped'>
      <thead>
        <tr>
      
          <th scope="col" >Nom de l'article</th>
          <th scope="col">Prix</th>
          <th scope="col">Description</th>
        </tr>
      </thead>
      <tbody>
      {possessions.map((possession) => (
          <tr key={possession.id}>
           <td scope="row">{possession.name}</td>
           <td>{possession.price}</td>
           <td>{possession.type}</td>
           </tr>
       
            ))}
      
      </tbody>
    </table>
      </div>
    
      
    </>
    
  )
}

export default UserDetails