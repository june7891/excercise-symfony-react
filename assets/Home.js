
import React from 'react';
import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import {BrowserRouter as Router, Routes, Route} from 'react-router-dom';
import UserList from './js/components/UserList';


import UserDetails from './js/components/UserDetails';

function Home() {
 

  return (
<>
   
        <Routes>
            <Route exact path="/" element={<UserList />} />
             
      
            {/* <Route exact path="/add" element={<UserForm />} /> */}
                

            <Route path="/show/:id" element={<UserDetails />}/>
        </Routes>
        
     
  
</>
   

  );
}

export default Home;

if (document.getElementById('root')) {
    const rootElement = document.getElementById("root");
    const root = createRoot(rootElement);
  
    root.render(
        <StrictMode>
          <Router>
            <Home />
            </Router>
        </StrictMode>
    );
}