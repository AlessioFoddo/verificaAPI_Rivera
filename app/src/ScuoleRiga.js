import { use, useState } from "react";

export default function ScuoleRiga(props) {
    const a = props.scuole;
    const carica = props.ricarica;
    const [cancellato, setCancellato] = useState(false);
    const [nome, setNome] = useState(a.nome);
    const [indirizzo, setIndirizzo] = useState(a.indirizzo);
    const [edit, setEdit] = useState(false);
    const [conferma, Setconferma] = useState(false);

    async function eliminaScuola(){
        const data = await fetch(`http://localhost:8080/scuole/${a.id}`, {method: "DELETE"});
        setCancellato(true);
    }

    async function updateScuola(){
        //curl -X PUT http://localhost:8080/alunni/3 -H "Content-Type: application/json" -d '{"nome": "giulio", "cognome": "martinenghi"}'
        const data = await fetch(`http://localhost:8080/scuole/${a.id}`, {
            method: "PUT",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify({
                nome,
                indirizzo
            })
        })
        setEdit(false);
        carica();
    }

    function annullaEdit(){
        setIndirizzo(a.indirizzo);
        setNome(a.nome);
        setEdit(false);
    }
    
    return(
        <>{!cancellato && <tr>
            <td>{a.id}</td>
            <td>
                {edit ? (
                    <input onChange={(e) => setNome(e.target.value)} type="text" value={nome}></input>
                ) : (
                    <p>{nome}</p>
                )}
            </td>
            <td>{edit ? (
                    <input onChange={(e) => setIndirizzo(e.target.value)} type="text" value={indirizzo}></input>
                ) : (
                    <p>{indirizzo}</p>
                )}
            </td>
            <td>
                {edit ? (
                    <div>
                        <button onClick={updateScuola}>salva</button>
                        <button onClick={annullaEdit}>annulla</button>
                    </div>
                ) : conferma ? (
                    <div>
                        sicuro?
                        <button onClick={eliminaScuola}>Sì</button>
                        <button onClick={() => Setconferma(false)}>No</button>
                    </div>
                ) : (
                    <div>
                        <button onClick={() => setEdit(true)}>Edit</button>
                        <button onClick={() => Setconferma(true)}>elimina</button>
                    </div>
                )}
            </td>
        </tr>}</>
        
    );

    
}