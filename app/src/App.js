import './App.css';
import { useState } from 'react';
import ScuoleTable from './ScuoleTable.js';

function App() {

  const [scuole, setScuole] = useState([]);
  const [loading, setCounting] = useState(false);

  async function caricaScuola(){
    setCounting(true);
    const data = await fetch( "http://localhost:8080/scuole", {method : "GET"} );
    const myData = await data.json();
    setCounting(false);
    setScuole(myData);
  };

  return (
    <div className = "App">
      {scuole.length > 0 ? (
        <ScuoleTable myArray = {scuole} />
      ) : (
        <>
        {loading ? (
          <div>caricamento</div>
        ) : (
          <button onClick={caricaScuola}>carica alunni</button>
        )}
        </>
      )}
    </div>
  );
}

export default App;
