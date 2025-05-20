import './App.css';
import { use, useState } from 'react';
import ScuoleTable from './ScuoleTable.js';

function App() {

  const [scuole, setScuole] = useState([]);
  const [loading, setCounting] = useState(false);
  const [elimina, setElimina] = useState(false);
  const [inserisci, setInserisci] = useState(false);
  const [nome, setNome] = useState("");
  const [indirizzo, setIndirizzo] = useState("");
  const [addErr, setAddErr] = useState("");

  async function caricaScuola(){
    setCounting(true);
    const data = await fetch( "http://localhost:8080/scuole", {method : "GET"} );
    const myData = await data.json();
    setCounting(false);
    setScuole(myData);
  };

  async function salvaScuola(){
    //curl -X POST http://localhost:8080/alunni -H "Content-Type: application/json" -d '{"nome": "giulio", "cognome": "martinenghi"}'
    if(nome === "" || indirizzo === ""){
      setAddErr("campo obbligatorio")
      return
    }
    const data = await fetch( "http://localhost:8080/scuole", {
      method: "POST",
      headers: {'Content-Type' : 'application/json'},
      body: JSON.stringify({
        nome,
        indirizzo
      })
    });
    setNome("");
    setIndirizzo("");
    setAddErr("");
    caricaScuola();
  };

  return (
    <div className = "App">
      {scuole.length > 0 ? (
        <div>
          <ScuoleTable myArray = {scuole} caricaScuola = {caricaScuola} />
          {inserisci ? (
            <div>
                <div>Nome:</div>
                <input onChange={(e) => setNome(e.target.value)} type='text'></input>
                {addErr !== "" && <div>{addErr}</div>}
                <div>Indirizzo:</div>
                <input onChange={(e) => setIndirizzo(e.target.value)} type='text'></input>
                {addErr !== "" && <div>{addErr}</div>}
                <div>
                  <button onClick={salvaScuola}>salva</button>
                  <button onClick={() => setInserisci(false)}>annulla</button>
                </div>
            </div>
          ) : (
            <button onClick={() => setInserisci(true)}> INSERISCI ALUNNO</button>
          )}
        </div>
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
